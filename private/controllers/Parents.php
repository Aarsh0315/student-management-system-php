<?php

require_once "../private/models/ParentModel.php";


class Parents extends Controller
{

    /* ========================================
       PARENTS LIST
    ======================================== */

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* CHECK LOGIN */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /* CHECK ROLE */

        $rank = $_SESSION['rank'] ?? '';


        if ($rank !== 'admin') {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /* SCHOOL ID */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }


        /* MODEL */

        $parentModel =
            new ParentModel();


        /* GET PARENTS */

        $parents =
            $parentModel->getParentsBySchool(
                $school_id
            );


        /* VIEW */

        $this->view(
            'parents',
            [
                'parents' => $parents
            ]
        );
    }



    /* ========================================
       PARENT DETAILS
    ======================================== */

    public function details($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* CHECK LOGIN */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /* CHECK USER ID */

        if (
            $user_id === null ||
            $user_id === ''
        ) {

            header(
                "Location: " . ROOT . "/parents"
            );

            exit;
        }


        /* CHECK ROLE */

        $rank =
            $_SESSION['rank'] ?? '';


        if ($rank !== 'admin') {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /* SCHOOL ID */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }


        /* MODEL */

        $parentModel =
            new ParentModel();


        /* GET PARENT */

        $parent =
            $parentModel->getParentDetailsBySchool(
                $user_id,
                $school_id
            );


        /* NOT FOUND */

        if (!$parent) {

            die(
                "Parent not found or you do not have permission to view this parent."
            );
        }


        /* VIEW */

        $this->view(
            'parent-details',
            [
                'parent' => $parent
            ]
        );
    }



    /* ========================================
       ADD PARENT
    ======================================== */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* CHECK LOGIN */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /* CHECK ROLE */

        $rank =
            $_SESSION['rank'] ?? '';


        if ($rank !== 'admin') {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /* CHECK SCHOOL */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }


        /* LOAD VIEW */

        $this->view(
            'parent-add'
        );
    }



    /* ========================================
       CREATE PARENT
    ======================================== */

    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* CHECK LOGIN */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /* CHECK ROLE */

        $rank =
            $_SESSION['rank'] ?? '';


        if ($rank !== 'admin') {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /* POST ONLY */

        if (
            $_SERVER['REQUEST_METHOD']
            !== 'POST'
        ) {

            header(
                "Location: " . ROOT . "/parents/add"
            );

            exit;
        }


        /* SCHOOL */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }


        /* FORM DATA */

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
            $_POST['gender'] ?? '';


        /* VALIDATION */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === '' ||
            $password === '' ||
            $gender === ''
        ) {

            die(
                "Please fill all required fields."
            );
        }


        /* HASH PASSWORD */

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        /* USER DATA */

        $userData = [

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

            'password' =>
                $hashedPassword

        ];


        /* CREATE */

        $parentModel =
            new ParentModel();


        $created =
            $parentModel->createParent(
                $userData
            );


        if (!$created) {

            die(
                "Unable to create parent."
            );
        }


        /* SUCCESS */

        header(
            "Location: "
            . ROOT
            . "/parents"
        );

        exit;
    }

}