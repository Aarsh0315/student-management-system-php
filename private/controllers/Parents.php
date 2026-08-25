<?php

class Parents extends Controller
{
    /*
    ========================================
    PARENTS LIST
    ========================================
    */

    public function index()
    {
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        CHECK LOGIN
        ========================================
        */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        CHECK SUPER ADMIN
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'super_admin'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $parentModel =
            $this->model('ParentModel');


        /*
        ========================================
        GET ALL PARENTS
        ========================================
        */

        $parents =
            $parentModel->getAllParents();


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'parents',
            [
                'parents' => $parents
            ]
        );
    }


    /*
    ========================================
    VIEW PARENT DETAILS
    ========================================
    */

    public function details($parent_id = null)
    {
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        CHECK LOGIN
        ========================================
        */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        CHECK SUPER ADMIN
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'super_admin'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        CHECK PARENT ID
        ========================================
        */

        if (!$parent_id) {

            header(
                "Location: " .
                ROOT .
                "/parents"
            );

            exit;
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $parentModel =
            $this->model('ParentModel');


        /*
        ========================================
        GET PARENT
        ========================================
        */

        $parent =
            $parentModel->getParentById(
                $parent_id
            );


        /*
        ========================================
        PARENT NOT FOUND
        ========================================
        */

        if (!$parent) {

            die(
                "Parent not found."
            );
        }


        /*
        ========================================
        LOAD DETAILS VIEW
        ========================================
        */

        $this->view(
            'parent-details',
            [
                'parent' => $parent
            ]
        );
    }

    /*
========================================
ADD PARENT
========================================
*/

public function add()
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }


    /*
    ========================================
    CHECK SUPER ADMIN
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'super_admin'
    ) {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $parentModel =
        $this->model('ParentModel');


    /*
    ========================================
    HANDLE FORM SUBMISSION
    ========================================
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $firstname =
            trim($_POST['firstname'] ?? '');

        $lastname =
            trim($_POST['lastname'] ?? '');

        $email =
            trim($_POST['email'] ?? '');

        $phone =
            trim($_POST['phone'] ?? '');

        $address =
            trim($_POST['address'] ?? '');

        $school_id =
            $_POST['school_id'] ?? '';

        $status =
            $_POST['status'] ?? 'active';


        /*
        ========================================
        BASIC VALIDATION
        ========================================
        */

        if (
            $firstname === '' ||
            $email === '' ||
            $school_id === ''
        ) {

            $error =
                "First name, email and school are required.";

            $this->view(
                'parent-add',
                [
                    'error' => $error
                ]
            );

            return;
        }


        /*
        ========================================
        ADD PARENT
        ========================================
        */

        $parent_id =
            'PAR' .
            strtoupper(
                substr(
                    uniqid(),
                    -6
                )
            );


        $parentModel->createParent([
            'parent_id' => $parent_id,
            'user_id' => '',
            'school_id' => $school_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'status' => $status
        ]);


        /*
        ========================================
        REDIRECT
        ========================================
        */

        header(
            "Location: " .
            ROOT .
            "/parents"
        );

        exit;
    }


    /*
    ========================================
    LOAD ADD VIEW
    ========================================
    */

    $this->view(
        'parent-add'
    );
}
}