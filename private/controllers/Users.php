<?php

require_once "../private/models/User.php";
require_once "../private/models/School.php";

class Users extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $search = trim($_GET['search'] ?? '');
        $sort = $_GET['sort'] ?? 'id';
        $direction = $_GET['direction'] ?? 'DESC';
        $role = $_GET['role'] ?? '';
        $status = $_GET['status'] ?? '';

        $user = new User();

        $users = $user->getAllUsers(
            $search,
            $sort,
            $direction,
            $role,
            $status
        );

        $this->view('users', [
            'users'     => $users,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction,
            'role'      => $role,
            'status'    => $status
        ]);
    }


    /* =========================
       ADD USER
    ========================= */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $school = new School();
        $schools = $school->getAllSchools();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $school_id = $_POST['school_id'] ?? '';
            $rank = $_POST['rank'] ?? '';
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            $status = $_POST['status'] ?? 'active';

            $profileImage = null;

            if (
                isset($_FILES['profile_image']) &&
                $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE
            ) {

                if (
                    $_FILES['profile_image']['error']
                    !== UPLOAD_ERR_OK
                ) {
                    die("Unable to upload profile image.");
                }

                if (
                    $_FILES['profile_image']['size']
                    > 2 * 1024 * 1024
                ) {
                    die("Profile image must be less than 2MB.");
                }

                $allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                $fileType = mime_content_type(
                    $_FILES['profile_image']['tmp_name']
                );

                if (!in_array($fileType, $allowedTypes)) {
                    die("Only JPG, PNG and WEBP images are allowed.");
                }

                $uploadDirectory =
                    $_SERVER['DOCUMENT_ROOT']
                    . '/school/public/uploads/users/';

                if (!is_dir($uploadDirectory)) {
                    mkdir(
                        $uploadDirectory,
                        0777,
                        true
                    );
                }

                $extension = match ($fileType) {

                    'image/jpeg' => 'jpg',
                    'image/png'  => 'png',
                    'image/webp' => 'webp'

                };

                $profileImage =
                    'user_'
                    . uniqid()
                    . '.'
                    . $extension;

                $uploaded = move_uploaded_file(
                    $_FILES['profile_image']['tmp_name'],
                    $uploadDirectory . $profileImage
                );

                if (!$uploaded) {
                    die("Unable to save profile image.");
                }
            }

            if (
                empty($firstname) ||
                empty($lastname) ||
                empty($email) ||
                empty($gender) ||
                empty($school_id) ||
                empty($rank) ||
                empty($password)
            ) {

                $this->view('add-user', [
                    'schools' => $schools,
                    'error' =>
                        'Please fill all required fields.'
                ]);

                return;
            }

            if ($password !== $password2) {

                $this->view('add-user', [
                    'schools' => $schools,
                    'error' =>
                        'Passwords do not match.'
                ]);

                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $this->view('add-user', [
                    'schools' => $schools,
                    'error' =>
                        'Please enter a valid email address.'
                ]);

                return;
            }

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $user = new User();

            $result = $user->createUser([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'gender' => $gender,
                'school_id' => $school_id,
                'rank' => $rank,
                'password' => $hashedPassword,
                'status' => $status,
                'profile_image' => $profileImage
            ]);

            if ($result) {

                header(
                    "Location: "
                    . ROOT
                    . "/users"
                );

                exit;
            }

            $this->view('add-user', [
                'schools' => $schools,
                'error' =>
                    'Unable to create user.'
            ]);

            return;
        }

        $this->view('add-user', [
            'schools' => $schools
        ]);
    }


    /* =========================
       EDIT USER
    ========================= */

    public function edit($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        if ($user_id === null || $user_id === '') {
            header("Location: " . ROOT . "/users");
            exit;
        }

        $user = new User();

        $userData = $user->getUserDetails($user_id);

        if (!$userData) {
            die("User not found.");
        }

        $school = new School();

        $schools = $school->getAllSchools();

        $this->view('edit-user', [
            'user'    => $userData,
            'schools' => $schools
        ]);
    }


    /* =========================
       UPDATE USER
    ========================= */

    public function update($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        if (
            $user_id === null ||
            $user_id === ''
        ) {
            header("Location: " . ROOT . "/users");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                "Location: "
                . ROOT
                . "/users/edit/"
                . urlencode($user_id)
            );
            exit;
        }


        /* =========================
           CSRF
        ========================= */

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token.");
        }


        /* =========================
           GET CURRENT USER
        ========================= */

        $user = new User();

        $currentUser = $user->findById($user_id);

        if (!$currentUser) {
            die("User not found.");
        }


        /* =========================
           FORM DATA
        ========================= */

        $firstname = trim($_POST['firstname'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $school_id = $_POST['school_id'] ?? '';
        $rank = $_POST['rank'] ?? '';
        $status = $_POST['status'] ?? 'active';

        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';


        /* =========================
           VALIDATION
        ========================= */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === '' ||
            $gender === '' ||
            $school_id === '' ||
            $rank === ''
        ) {

            $school = new School();

            $this->view('edit-user', [
                'user' => $currentUser,
                'schools' => $school->getAllSchools(),
                'error' =>
                    'Please fill all required fields.'
            ]);

            return;
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $school = new School();

            $this->view('edit-user', [
                'user' => $currentUser,
                'schools' => $school->getAllSchools(),
                'error' =>
                    'Please enter a valid email address.'
            ]);

            return;
        }


        /* =========================
           CHECK DUPLICATE EMAIL
        ========================= */

        $existingUser = $user->findByEmail($email);

        if (
            $existingUser &&
            $existingUser->user_id !== $user_id
        ) {

            $school = new School();

            $this->view('edit-user', [
                'user' => $currentUser,
                'schools' => $school->getAllSchools(),
                'error' =>
                    'This email address is already in use.'
            ]);

            return;
        }


        /* =========================
           CHECK SCHOOL
        ========================= */

        $schoolQuery = "SELECT
                            id,
                            status
                        FROM schools
                        WHERE id = :school_id
                        LIMIT 1";

        $schoolResult = $user->query(
            $schoolQuery,
            [
                'school_id' => $school_id
            ]
        );

        $selectedSchool = $schoolResult[0] ?? null;

        if (!$selectedSchool) {

            $school = new School();

            $this->view('edit-user', [
                'user' => $currentUser,
                'schools' => $school->getAllSchools(),
                'error' =>
                    'Selected school does not exist.'
            ]);

            return;
        }


        /* =========================
           INACTIVE SCHOOL
           FORCE USER INACTIVE
        ========================= */

        if ($selectedSchool->status !== 'active') {
            $status = 'inactive';
        }


        /* =========================
           PROFILE IMAGE
        ========================= */

        $profileImage =
            $currentUser->profile_image ?? null;


        if (
            isset($_FILES['profile_image']) &&
            $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            if (
                $_FILES['profile_image']['error']
                !== UPLOAD_ERR_OK
            ) {
                die("Unable to upload profile image.");
            }

            if (
                $_FILES['profile_image']['size']
                > 2 * 1024 * 1024
            ) {
                die("Profile image must be less than 2MB.");
            }

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            $fileType = mime_content_type(
                $_FILES['profile_image']['tmp_name']
            );

            if (!in_array($fileType, $allowedTypes)) {
                die("Only JPG, PNG and WEBP images are allowed.");
            }

            $uploadDirectory =
                $_SERVER['DOCUMENT_ROOT']
                . '/school/public/uploads/users/';

            if (!is_dir($uploadDirectory)) {
                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );
            }

            $extension = match ($fileType) {

                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp'

            };

            $profileImage =
                'user_'
                . uniqid()
                . '.'
                . $extension;

            $uploaded = move_uploaded_file(
                $_FILES['profile_image']['tmp_name'],
                $uploadDirectory . $profileImage
            );

            if (!$uploaded) {
                die("Unable to save profile image.");
            }
        }

        /* =========================
   CHECK PASSWORD CONFIRMATION
========================= */

if ($password !== '' && $password !== $password2) {

    $school = new School();

    $this->view('edit-user', [
        'user'    => $currentUser,
        'schools' => $school->getAllSchools(),
        'error'   => 'Passwords do not match.'
    ]);

    return;
}

        /* =========================
           UPDATE USER
        ========================= */

        $result = $user->updateUser(
            $user_id,
            [
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'email'         => $email,
                'gender'        => $gender,
                'school_id'     => $school_id,
                'rank'          => $rank,
                'status'        => $status,
                'profile_image' => $profileImage
            ]
        );


        if (!$result) {
            die("Unable to update user.");
        }


        /* =========================
           UPDATE PASSWORD
           ONLY IF PROVIDED
        ========================= */

        if ($password !== '') {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $passwordQuery = "UPDATE users
                              SET password = :password
                              WHERE user_id = :user_id
                              LIMIT 1";

            $user->query(
                $passwordQuery,
                [
                    'password' => $hashedPassword,
                    'user_id'  => $user_id
                ]
            );
        }


        /* =========================
           REDIRECT
        ========================= */

        header(
            "Location: "
            . ROOT
            . "/users/details/"
            . urlencode($user_id)
        );

        exit;
    }


    /* =========================
       USER DETAILS
    ========================= */

    public function details($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        if ($user_id === null || $user_id === '') {
            header("Location: " . ROOT . "/users");
            exit;
        }

        $user = new User();

        $userData = $user->getUserDetails($user_id);

        if (!$userData) {
            die(
                "User not found. User ID: "
                . htmlspecialchars($user_id)
            );
        }

        $this->view('user-details', [
            'user' => $userData
        ]);
    }

    public function deactivate($user_id = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: " . ROOT . "/users");
        exit;
    }

    if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
        die("Invalid CSRF token.");
    }

    if ($user_id === null || $user_id === '') {
        header("Location: " . ROOT . "/users");
        exit;
    }

    $user = new User();

    $currentUser = $user->getUserDetails($user_id);

    if (!$currentUser) {
        die("User not found.");
    }

    // Prevent Super Admin from deactivating their own account
    if ($currentUser->rank === 'super_admin') {
        die("Super Admin account cannot be deactivated.");
    }

    $query = "UPDATE users
              SET status = 'inactive'
              WHERE user_id = :user_id
              LIMIT 1";

    $user->query($query, [
        'user_id' => $user_id
    ]);

    header(
        "Location: " .
        ROOT .
        "/users"
    );

    exit;
}

public function activate($user_id = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: " . ROOT . "/users");
        exit;
    }

    if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
        die("Invalid CSRF token.");
    }

    if ($user_id === null || $user_id === '') {
        header("Location: " . ROOT . "/users");
        exit;
    }

    $user = new User();

    $currentUser = $user->getUserDetails($user_id);

    if (!$currentUser) {
        die("User not found.");
    }

    $query = "UPDATE users
              SET status = 'active'
              WHERE user_id = :user_id
              LIMIT 1";

    $user->query($query, [
        'user_id' => $user_id
    ]);

    header(
        "Location: " .
        ROOT .
        "/users"
    );

    exit;
}
}