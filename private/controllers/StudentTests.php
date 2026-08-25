<?php

class StudentTests extends Controller
{
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
        CHECK STUDENT
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'student'
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
        GET STUDENT DETAILS
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        $class =
            $_SESSION['class'] ?? null;


        $division =
            $_SESSION['division'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this student."
            );
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('StudentTestsModel');


        /*
        ========================================
        GET ACTIVE TESTS
        ========================================
        */

        $tests =
            $testModel->getAvailableTests(
                $school_id,
                $class,
                $division
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'student-tests',
            [
                'tests' => $tests
            ]
        );
    }
}