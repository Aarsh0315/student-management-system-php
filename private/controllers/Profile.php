<?php

class Profile extends Controller
{
    /*
    =====================================================
    PROFILE
    =====================================================
    */

    public function index()
    {
        $this->requireLogin();

        $user_id = $_SESSION['user_id'];

        $userModel = $this->model('User');

        $profile = $userModel->findById($user_id);

        if (!$profile) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $this->view('my-profile', [
            'profile' => $profile
        ]);
    }


    /*
    =====================================================
    EDIT PROFILE
    =====================================================
    */

    public function edit()
    {
        $this->requireLogin();

        $user_id = $_SESSION['user_id'];

        $userModel = $this->model('User');

        $profile = $userModel->findById($user_id);

        if (!$profile) {
            header("Location: " . ROOT . "/profile");
            exit;
        }

        $this->view('profile-edit', [
            'profile' => $profile
        ]);
    }


    /*
    =====================================================
    UPDATE PROFILE
    =====================================================
    */

    public function update()
    {
        $this->requireLogin();


        /*
        ========================================
        POST ONLY
        ========================================
        */

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: " .
                ROOT .
                "/profile"
            );

            exit;
        }


        /*
        ========================================
        CSRF CHECK
        ========================================
        */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        /*
        ========================================
        GET LOGGED-IN USER
        ========================================
        */

        $user_id =
            $_SESSION['user_id'];


        /*
        ========================================
        FORM DATA
        ========================================
        */

        $firstname = trim(
            $_POST['firstname'] ?? ''
        );

        $lastname = trim(
            $_POST['lastname'] ?? ''
        );

        $gender = trim(
            $_POST['gender'] ?? ''
        );


        /*
        ========================================
        VALIDATION
        ========================================
        */

        if (
            $firstname === '' ||
            $lastname === ''
        ) {

            die(
                "First name and last name are required."
            );
        }


        /*
        ========================================
        UPDATE
        ========================================
        */

        $userModel =
            $this->model('User');

        $result =
            $userModel->updateProfile(
                $user_id,
                $firstname,
                $lastname,
                $gender
            );


        /*
        ========================================
        UPDATE SESSION
        ========================================
        */

        if ($result) {

            $_SESSION['firstname'] =
                $firstname;

            $_SESSION['lastname'] =
                $lastname;

            $_SESSION['gender'] =
                $gender;


            /*
            ====================================
            REDIRECT
            ====================================
            */

            header(
                "Location: " .
                ROOT .
                "/profile"
            );

            exit;
        }


        die(
            "Unable to update profile."
        );
    }
}