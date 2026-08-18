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

                'status' => $status

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

    // Only Super Admin
    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }

    // Check ID
    if ($user_id === null || $user_id === '') {
        header("Location: " . ROOT . "/users");
        exit;
    }

    $user = new User();

    // Get selected user
    $userData = $user->getUserDetails($user_id);

    if (!$userData) {
        die(
            "User not found. User ID: "
            . htmlspecialchars($user_id)
        );
    }

    // Send user data to view
    $this->view('user-details', [
        'user' => $userData
    ]);
}
}