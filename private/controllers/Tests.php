<?php

class Tests extends Controller
{
    /*
    ========================================
    TESTS LIST
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
        LOAD EXISTING TEST MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        GET ALL TESTS
        ========================================
        */

        $tests =
            $testModel->getAllTests();


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'tests',
            [
                'tests' => $tests
            ]
        );
    }


    /*
    ========================================
    TEST DETAILS
    ========================================
    */

    public function details($test_id = null)
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
        CHECK TEST ID
        ========================================
        */

        if (!$test_id) {

            header(
                "Location: " .
                ROOT .
                "/tests"
            );

            exit;
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        GET TEST
        ========================================
        */
            $test =
                $testModel->getTestByIdAdmin(
                    $test_id
                );


        /*
        ========================================
        TEST NOT FOUND
        ========================================
        */

        if (!$test) {

            die(
                "Test not found."
            );
        }


        /*
        ========================================
        GET QUESTIONS
        ========================================
        */

        $questions =
            $testModel->getQuestionsByTest(
                $test_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'test-details',
            [
                'test'      => $test,
                'questions' => $questions
            ]
        );
    }
}