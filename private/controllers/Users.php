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

        // Only Super Admin
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $user = new User();

        $users = $user->getAllUsers();

        $this->view('users', [
            'users' => $users
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

        // Only Super Admin
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }


        // Get schools for dropdown

        $school = new School();

        $schools = $school->getAllSchools();


        /* =========================
           FORM SUBMITTED
        ========================= */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $firstname = trim(
                $_POST['firstname'] ?? ''
            );

            $lastname = trim(
                $_POST['lastname'] ?? ''
            );

            $email = trim(
                $_POST['email'] ?? ''
            );

            $gender = trim(
                $_POST['gender'] ?? ''
            );

            $school_id = $_POST['school_id'] ?? '';

            $rank = $_POST['rank'] ?? '';

            $password = $_POST['password'] ?? '';

            $password2 = $_POST['password2'] ?? '';

            $status = $_POST['status'] ?? 'active';


                        /* =========================
            PROFILE IMAGE
            ========================= */

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


                /* =========================
                CHECK FILE SIZE
                ========================= */

                if (
                    $_FILES['profile_image']['size']
                    > 2 * 1024 * 1024
                ) {
                    die("Profile image must be less than 2MB.");
                }


                /* =========================
                CHECK MIME TYPE
                ========================= */

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


                /* =========================
                CREATE UPLOAD DIRECTORY
                ========================= */

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


                /* =========================
                FILE EXTENSION
                ========================= */

                $extension = match ($fileType) {

                    'image/jpeg' => 'jpg',

                    'image/png' => 'png',

                    'image/webp' => 'webp'

                };


                /* =========================
                UNIQUE FILE NAME
                ========================= */

                $profileImage =
                    'user_'
                    . uniqid()
                    . '.'
                    . $extension;


                /* =========================
                MOVE IMAGE
                ========================= */

                $uploaded =
                    move_uploaded_file(
                        $_FILES['profile_image']['tmp_name'],
                        $uploadDirectory . $profileImage
                    );


                if (!$uploaded) {
                    die("Unable to save profile image.");
                }
            }


            /* =========================
               VALIDATION
            ========================= */

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


            // Password confirmation

            if ($password !== $password2) {

                $this->view('add-user', [

                    'schools' => $schools,

                    'error' =>
                        'Passwords do not match.'

                ]);

                return;
            }


            // Email validation

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $this->view('add-user', [

                    'schools' => $schools,

                    'error' =>
                        'Please enter a valid email address.'

                ]);

                return;
            }


            /* =========================
               HASH PASSWORD
            ========================= */

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            /* =========================
               CREATE USER
            ========================= */

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


            /* =========================
               REDIRECT
            ========================= */

            if ($result) {

                header(
                    "Location: "
                    . ROOT
                    . "/users"
                );

                exit;
            }


            // If insert failed

            $this->view('add-user', [

                'schools' => $schools,

                'error' =>
                    'Unable to create user.'

            ]);

            return;
        }


        /* =========================
           SHOW FORM
        ========================= */

        $this->view('add-user', [

            'schools' => $schools

        ]);
    }
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
}

