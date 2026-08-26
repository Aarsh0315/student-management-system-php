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
    GET RANK
    ========================================
    */

    $rank = $_SESSION['rank'] ?? '';


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    SUPER ADMIN
    ========================================
    */

    if ($rank === 'super_admin') {

        $tests =
            $testModel->getAllTests();

    }


    /*
    ========================================
    SCHOOL ADMIN
    ========================================
    */

    elseif ($rank === 'admin') {

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );

        }


        $tests =
            $testModel->getTestsBySchool(
                $school_id
            );

    }


    /*
    ========================================
    OTHER USERS
    ========================================
    */

    else {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


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
    GET RANK
    ========================================
    */

    $rank = $_SESSION['rank'] ?? '';


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    SUPER ADMIN
    ========================================
    */

    if ($rank === 'super_admin') {

        $test =
            $testModel->getTestByIdAdmin(
                $test_id
            );

    }


    /*
    ========================================
    SCHOOL ADMIN
    ========================================
    */

    elseif ($rank === 'admin') {

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );

        }


        $test =
            $testModel->getTestById(
                $test_id,
                $school_id
            );

    }


    /*
    ========================================
    OTHER USERS
    ========================================
    */

    else {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    TEST NOT FOUND
    ========================================
    */

    if (!$test) {

        header(
            "Location: " .
            ROOT .
            "/tests"
        );

        exit;
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