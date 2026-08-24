<?php

require_once "../private/models/SchoolAdminModel.php";
require_once "../private/models/School.php";
require_once "../private/models/User.php";

class SchoolAdmins extends Controller
{
    /* =====================================================
       SCHOOL ADMINS LIST
    ===================================================== */

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        ONLY SUPER ADMIN
        ========================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /*
        ========================================
        LOAD ADMINS
        ========================================
        */

        $adminModel =
            new SchoolAdminModel();

        $admins =
            $adminModel->getAllAdmins();


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view('school-admins', [

            'admins' => $admins

        ]);
    }


    /* =====================================================
       SCHOOL ADMIN DETAILS
    ===================================================== */

    public function details($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        ONLY SUPER ADMIN
        ========================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /*
        ========================================
        CHECK USER ID
        ========================================
        */

        if (
            $user_id === null ||
            $user_id === ''
        ) {

            header(
                "Location: " . ROOT . "/schooladmins"
            );

            exit;
        }


        /*
        ========================================
        GET ADMIN
        ========================================
        */

        $adminModel =
            new SchoolAdminModel();

        $admin =
            $adminModel->getAdminDetails(
                $user_id
            );


        /*
        ========================================
        ADMIN NOT FOUND
        ========================================
        */

        if (!$admin) {

            die(
                "School Admin not found. User ID: "
                . htmlspecialchars($user_id)
            );
        }


        /*
        ========================================
        VIEW
        ========================================
        */

        $this->view('school-admin-details', [

            'admin' => $admin

        ]);
    }


    /* =====================================================
       ADD SCHOOL ADMIN
    ===================================================== */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        ONLY SUPER ADMIN
        ========================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /*
        ========================================
        LOAD SCHOOLS
        ========================================
        */

        $schoolModel =
            new School();

        $schools =
            $schoolModel->getAllSchools();


        /*
        ========================================
        LOAD FORM
        ========================================
        */

        $this->view('schooladmin-add', [

            'schools' => $schools

        ]);
    }


    /* =====================================================
       CREATE SCHOOL ADMIN
    ===================================================== */

    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        ONLY SUPER ADMIN
        ========================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /*
        ========================================
        ONLY POST
        ========================================
        */

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST'
        ) {

            header(
                "Location: " . ROOT . "/schooladmins/add"
            );

            exit;
        }


        /*
        ========================================
        GET FORM DATA
        ========================================
        */

        $firstname =
            trim(
                $_POST['firstname'] ?? ''
            );

        $lastname =
            trim(
                $_POST['lastname'] ?? ''
            );

        $email =
            trim(
                $_POST['email'] ?? ''
            );

        $password =
            $_POST['password'] ?? '';

        $gender =
            trim(
                $_POST['gender'] ?? ''
            );

        $school_id =
            $_POST['school_id'] ?? '';

        $status =
            $_POST['status'] ?? 'active';


        /*
        ========================================
        LOAD SCHOOLS
        ========================================
        */

        $schoolModel =
            new School();

        $schools =
            $schoolModel->getAllSchools();


        /*
        ========================================
        VALIDATION
        ========================================
        */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === '' ||
            $password === '' ||
            $gender === '' ||
            $school_id === ''
        ) {

            $this->view('schooladmin-add', [

                'schools' => $schools,

                'error' =>
                    'Please fill all required fields.'

            ]);

            return;
        }


        /*
        ========================================
        EMAIL VALIDATION
        ========================================
        */

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $this->view('schooladmin-add', [

                'schools' => $schools,

                'error' =>
                    'Please enter a valid email address.'

            ]);

            return;
        }


        /*
        ========================================
        CHECK DUPLICATE EMAIL
        ========================================
        */

        $userModel =
            new User();

        $existingUser =
            $userModel->findByEmail(
                $email
            );


        if ($existingUser) {

            $this->view('schooladmin-add', [

                'schools' => $schools,

                'error' =>
                    'This email address is already registered. Please use another email address.'

            ]);

            return;
        }


        /*
        ========================================
        HASH PASSWORD
        ========================================
        */

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        /*
        ========================================
        CREATE USER
        ========================================

        User::createUser() automatically generates:

        USR001
        USR002
        USR003
        ...
        ========================================
        */

        $created =
            $userModel->createUser([

                'firstname' =>
                    $firstname,

                'lastname' =>
                    $lastname,

                'email' =>
                    $email,

                'gender' =>
                    $gender,

                'school_id' =>
                    $school_id,

                'rank' =>
                    'admin',

                'password' =>
                    $hashedPassword,

                'status' =>
                    $status

            ]);


        /*
        ========================================
        CREATION FAILED
        ========================================
        */

        if (!$created) {

            $this->view('schooladmin-add', [

                'schools' => $schools,

                'error' =>
                    'Unable to create School Admin.'

            ]);

            return;
        }


        /*
        ========================================
        SUCCESS
        ========================================
        */

        header(
            "Location: "
            . ROOT
            . "/schooladmins"
        );

        exit;
    }
}