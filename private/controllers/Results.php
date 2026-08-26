<?php

class Results extends Controller
{
    /*
    ========================================
    RESULTS LIST
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

    $resultModel =
        $this->model('TeacherResultsModel');


    /*
    ========================================
    SUPER ADMIN
    ========================================
    */

    if ($rank === 'super_admin') {

        $results =
            $resultModel->getAllResults();

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


        $results =
            $resultModel->getResultsBySchool(
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
        'results',
        [
            'results' => $results
        ]
    );
}

    /*
    ========================================
    RESULT DETAILS
    ========================================
    */

   public function details($result_id = null)
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
    CHECK RESULT ID
    ========================================
    */

    if (!$result_id) {

        header(
            "Location: " .
            ROOT .
            "/results"
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

    $resultModel =
        $this->model('TeacherResultsModel');


    /*
    ========================================
    SUPER ADMIN
    ========================================
    */

    if ($rank === 'super_admin') {

        $result =
            $resultModel->getResultByIdAdmin(
                $result_id
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


        $result =
            $resultModel->getResultById(
                $result_id,
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
    RESULT NOT FOUND
    ========================================
    */

    if (!$result) {

        header(
            "Location: " .
            ROOT .
            "/results"
        );

        exit;
    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'result-details',
        [
            'result' => $result
        ]
    );
}
}