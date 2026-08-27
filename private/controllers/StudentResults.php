<?php

class StudentResults extends Controller
{
    /*
    ========================================
    STUDENT RESULTS
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
        GET SCHOOL ID
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


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

        $resultModel =
            $this->model(
                'StudentResultsModel'
            );


        /*
        ========================================
        FIND ACTUAL STUDENT RECORD
        ========================================
        */

        $studentQuery = "SELECT
                            student_id

                         FROM students

                         WHERE user_id = :user_id

                         AND school_id = :school_id

                         LIMIT 1";


        $studentResult =
            $resultModel->query(
                $studentQuery,
                [
                    'user_id'   => $_SESSION['user_id'],
                    'school_id' => $school_id
                ]
            );


        $student =
            $studentResult[0] ?? null;


        /*
        ========================================
        STUDENT NOT FOUND
        ========================================
        */

        if (!$student) {

            die(
                "Student record not found."
            );
        }


        /*
        ========================================
        ACTUAL STUDENT ID
        ========================================
        */

        $student_id =
            $student->student_id;


        /*
        ========================================
        GET RESULTS
        ========================================
        */

        $results =
            $resultModel->getStudentResults(
                $student_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'student-results',
            [
                'results' => $results
            ]
        );
    }

    /*
========================================
VIEW RESULT DETAILS
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
    CHECK TEST ID
    ========================================
    */

    if (!$test_id) {

        header(
            "Location: " .
            ROOT .
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL ID
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


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

    $resultModel =
        $this->model(
            'StudentResultsModel'
        );


    /*
    ========================================
    FIND STUDENT
    ========================================
    */

    $studentQuery = "SELECT
                        student_id

                     FROM students

                     WHERE user_id = :user_id

                     AND school_id = :school_id

                     LIMIT 1";


    $studentResult =
        $resultModel->query(
            $studentQuery,
            [
                'user_id'   => $_SESSION['user_id'],
                'school_id' => $school_id
            ]
        );


    $student =
        $studentResult[0] ?? null;


    if (!$student) {

        die(
            "Student record not found."
        );
    }


    $student_id =
        $student->student_id;


    /*
    ========================================
    GET RESULT
    ========================================
    */

    $resultQuery = "SELECT
                        r.result_id,
                        r.test_id,
                        r.total_marks,
                        r.obtained_marks,
                        r.percentage,
                        r.status,
                        r.created_at,

                        t.title,
                        t.class,
                        t.division

                    FROM results r

                    INNER JOIN tests t
                    ON r.test_id = t.test_id

                    WHERE r.test_id = :test_id

                    AND r.student_id = :student_id

                    LIMIT 1";


    $resultData =
        $resultModel->query(
            $resultQuery,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );


    $result =
        $resultData[0] ?? null;


    /*
    ========================================
    RESULT NOT FOUND
    ========================================
    */

    if (!$result) {

        header(
            "Location: " .
            ROOT .
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    GET QUESTION DETAILS
    ========================================
    */

    $questions =
        $resultModel->getResultDetails(
            $test_id,
            $student_id
        );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'student-result-details',
        [
            'result'    => $result,
            'questions' => $questions
        ]
    );
}
}