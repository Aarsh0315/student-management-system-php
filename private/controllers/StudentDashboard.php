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
        LOAD VIEW
        ========================================
        */

        $this->view(
            'student-dashboard',
            [
                'student' => $student
            ]
        );
    }
}