<?php

class TeacherResults extends Controller
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
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        CHECK SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this teacher."
            );
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
        GET RESULTS
        ========================================
        */

        $results =
            $resultModel->getResultsBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-results',
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
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
                "/teacherresults"
            );

            exit;
        }


        /*
        ========================================
        CHECK SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this teacher."
            );
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
            $resultModel->getResultById(
                $result_id,
                $school_id
            );


        /*
        ========================================
        RESULT NOT FOUND
        ========================================
        */

        if (!$result) {

            $this->view(
                'teacher-result-details',
                [
                    'result' => null
                ]
            );

            return;
        }


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-result-details',
            [
                'result' => $result
            ]
        );
    }
}