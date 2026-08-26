<?php

class StudentClasses extends Controller
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
        GET STUDENT USER ID
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
        GET STUDENT RECORD
        ========================================
        */

        $query = "SELECT
                    student_id,
                    school_id,
                    class,
                    division,
                    roll_number

                  FROM students

                  WHERE user_id = :user_id

                  LIMIT 1";


        $studentResult =
            $studentModel->query(
                $query,
                [
                    'user_id' => $user_id
                ]
            );


        $student =
            $studentResult[0] ?? null;


        if (!$student) {

            die(
                "Student record not found."
            );
        }


        /*
        ========================================
        GET CLASSMATES
        ========================================
        */

        $classmatesQuery = "SELECT
                                st.student_id,
                                st.roll_number,
                                u.firstname,
                                u.lastname

                            FROM students st

                            INNER JOIN users u
                                ON st.user_id = u.user_id

                            WHERE st.school_id = :school_id

                            AND st.class = :class

                            AND st.division = :division

                            AND st.status = 'active'

                            ORDER BY
                                st.roll_number ASC";


        $classmates =
            $studentModel->query(
                $classmatesQuery,
                [
                    'school_id' => $student->school_id,
                    'class'     => $student->class,
                    'division'  => $student->division
                ]
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'student-class',
            [
                'student'   => $student,
                'classmates' => $classmates
            ]
        );
    }
}