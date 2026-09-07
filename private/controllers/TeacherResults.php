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
    GET SEARCH
    ========================================
    */

    $search =
        trim(
            $_GET['search'] ?? ''
        );


    /*
    ========================================
    GET SORT
    ========================================
    */

    $sort =
        $_GET['sort'] ?? 'result_id';


    /*
    ========================================
    GET DIRECTION
    ========================================
    */

    $direction =
        strtoupper(
            $_GET['direction'] ?? 'DESC'
        );


    /*
    ========================================
    ALLOWED SORTS
    ========================================
    */

    $allowedSorts = [

        'result_id',
        'student',
        'test',
        'class',
        'total_marks',
        'obtained_marks',
        'percentage',
        'status'

    ];


    /*
    ========================================
    VALIDATE SORT
    ========================================
    */

    if (
        !in_array(
            $sort,
            $allowedSorts,
            true
        )
    ) {

        $sort = 'result_id';
    }


    /*
    ========================================
    VALIDATE DIRECTION
    ========================================
    */

    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'DESC';
    }


    /*
    ========================================
    GET RESULTS
    ========================================
    */

    $results =
        $resultModel->getResultsBySchool(
            $school_id,
            $search,
            $sort,
            $direction
        );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-results',
        [

            'results' =>
                $results,

            'search' =>
                $search,

            'sort' =>
                $sort,

            'direction' =>
                $direction

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
        LOAD RESULT MODEL
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
                    'result' => null,

                    'integrity' => null,

                    'riskLevel' => 'LOW',

                    'events' => []
                ]
            );

            return;
        }


        /*
        ========================================
        EXAM INTEGRITY
        ========================================
        */

        $integrityModel =
            $this->model(
                'ExamIntegrityModel'
            );


        /*
        ----------------------------------------
        GET STUDENT ID
        ----------------------------------------
        */

        $student_id =
            $result->student_id ?? null;


        /*
        ----------------------------------------
        GET TEST ID
        ----------------------------------------
        */

        $test_id =
            $result->test_id ?? null;


        /*
        ----------------------------------------
        DEFAULT VALUES
        ----------------------------------------
        */

        $integrity = null;

        $riskLevel = 'LOW';

        $events = [];


        /*
        ----------------------------------------
        LOAD INTEGRITY DATA
        ----------------------------------------
        */

        if (
            $student_id &&
            $test_id
        ) {

            $integrity =
                $integrityModel->getIntegritySummary(
                    $test_id,
                    $student_id
                );


            $riskLevel =
                $integrityModel->getRiskLevel(
                    $test_id,
                    $student_id
                );


            $events =
                $integrityModel->getEvents(
                    $test_id,
                    $student_id
                );
        }


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-result-details',
            [
                'result' =>
                    $result,

                'integrity' =>
                    $integrity,

                'riskLevel' =>
                    $riskLevel,

                'events' =>
                    $events
            ]
        );
    }
}