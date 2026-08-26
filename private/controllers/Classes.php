<?php

require_once "../private/models/StudentModel.php";


class Classes extends Controller
{
    /*
    ========================================
    CLASSES LIST
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
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /*
        ========================================
        GET ROLE
        ========================================
        */

        $rank =
            $_SESSION['rank'] ?? '';


        /*
        ========================================
        CHECK ROLE
        ========================================
        */

        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: " . ROOT . "/home"
            );

            exit;
        }


        /*
        ========================================
        LOAD STUDENT MODEL
        ========================================
        */

        $studentModel =
            new StudentModel();


        /*
        ========================================
        SUPER ADMIN
        ========================================
        */

        if ($rank === 'super_admin') {

            /*
            Get classes from ALL schools
            */

            $classes =
                $studentModel->getAllClasses();

        }


        /*
        ========================================
        SCHOOL ADMIN
        ========================================
        */

        elseif ($rank === 'admin') {

            /*
            Get logged-in school's ID
            */

            $school_id =
                $_SESSION['school_id'] ?? null;


            /*
            Check school
            */

            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );

            }


            /*
            Get classes ONLY
            from this school
            */

            $classes =
                $studentModel->getClassesBySchool(
                    $school_id
                );

        }


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'classes',
            [
                'classes' => $classes
            ]
        );
    }
}