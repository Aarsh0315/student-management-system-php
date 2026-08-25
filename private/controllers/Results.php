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

        $resultModel =
            $this->model('TeacherResultsModel');


        /*
        ========================================
        GET ALL RESULTS
        ========================================
        */

        $results =
            $resultModel->getAllResults();


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

    public function details(
        $result_id = null
    ) {

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
        LOAD MODEL
        ========================================
        */

        $resultModel =
            $this->model('TeacherResultsModel');


        /*
        ========================================
        GET RESULT
        ========================================
        */

        $result =
            $resultModel->getResultByIdAdmin(
                $result_id
            );


        /*
        ========================================
        RESULT NOT FOUND
        ========================================
        */

        if (!$result) {

            die(
                "Result not found."
            );
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