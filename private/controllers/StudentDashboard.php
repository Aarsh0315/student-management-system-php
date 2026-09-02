<?php

class StudentDashboard extends Controller
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
        GET USER ID
        ========================================
        */

        $user_id =
            $_SESSION['user_id'] ?? null;


        if (!$user_id) {

            die(
                "Student user ID not found."
            );
        }


        /*
        ========================================
        LOAD STUDENT MODEL
        ========================================
        */

        $studentModel =
            $this->model('StudentModel');


        /*
        ========================================
        GET STUDENT ID
        ========================================
        */

        $studentQuery = "SELECT
                            student_id

                         FROM students

                         WHERE user_id = :user_id

                         LIMIT 1";


        $studentResult =
            $studentModel->query(
                $studentQuery,
                [
                    'user_id' => $user_id
                ]
            );


        $student_id =
            $studentResult[0]->student_id
            ?? null;


        if (!$student_id) {

            die(
                "Student record not found."
            );
        }


        /*
        ========================================
        GET STUDENT DETAILS
        ========================================
        */

        $student =
            $studentModel->getStudentDetails(
                $student_id
            );


        if (!$student) {

            die(
                "Student details not found."
            );
        }


        /*
        ========================================
        GET SCHOOL / CLASS / DIVISION
        ========================================
        */

        $school_id =
            $student->school_id
            ?? ($_SESSION['school_id'] ?? null);

        $class =
            $student->class
            ?? null;

        $division =
            $student->division
            ?? null;


        /*
        ========================================
        DEFAULT DASHBOARD DATA
        ========================================
        */

        $testCount = 0;

        $resultCount = 0;

        $recentTests = [];


        /*
        ========================================
        LOAD STUDENT TESTS MODEL
        ========================================
        */

        if (
            $school_id &&
            $class &&
            $division
        ) {

            $studentTestsModel =
                $this->model('StudentTestsModel');


            /*
            ----------------------------------------
            TOTAL TESTS
            ----------------------------------------
            */

            $testCount =
                $studentTestsModel->getStudentTestCount(
                    $school_id,
                    $class,
                    $division
                );


            /*
            ----------------------------------------
            RECENT TESTS
            ----------------------------------------
            */

            $recentTests =
                $studentTestsModel->getRecentTests(
                    $school_id,
                    $class,
                    $division,
                    5
                );
        }


        /*
        ========================================
        LOAD STUDENT RESULTS MODEL
        ========================================
        */

        $studentResultsModel =
            $this->model('StudentResultsModel');


        /*
        ========================================
        TOTAL RESULTS
        ========================================
        */

        $resultCount =
            $studentResultsModel->getStudentResultCount(
                $student_id
            );


        /*
        ========================================
        LOAD DASHBOARD VIEW
        ========================================
        */

        $this->view(
            'student-dashboard',
            [
                'student'     => $student,
                'testCount'   => $testCount,
                'resultCount' => $resultCount,
                'recentTests' => $recentTests
            ]
        );
    }
}