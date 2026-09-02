<?php

class TeacherDashboard extends Controller
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
        CHECK TEACHER ROLE
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
        GET SCHOOL
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
        GET TEACHER ID
        ========================================
        */

        $teacher_id =
            $_SESSION['user_id'] ?? null;


        /*
        ========================================
        LOAD STUDENT MODEL
        ========================================
        */

        $studentModel =
            $this->model('StudentModel');


        /*
        ========================================
        STUDENT COUNT
        ========================================
        */

        $studentCount =
            $studentModel->getStudentCountBySchool(
                $school_id
            );


        /*
        ========================================
        CLASS COUNT
        ========================================
        */

        $classes =
            $studentModel->getClassesBySchool(
                $school_id
            );

        $classCount =
            count($classes);


        /*
        ========================================
        PARENT COUNT
        ========================================
        */

        $parents =
            $studentModel->getParentsBySchool(
                $school_id
            );

        $parentCount =
            count($parents);


        /*
        ========================================
        LOAD TEACHER TEST MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        TEST COUNT
        ========================================
        */

        $testQuery = "SELECT
                        COUNT(*) AS total

                      FROM tests

                      WHERE school_id = :school_id

                      AND teacher_id = :teacher_id";


        $testResult =
            $testModel->query(
                $testQuery,
                [
                    'school_id' =>
                        $school_id,

                    'teacher_id' =>
                        $teacher_id
                ]
            );


        $testCount =
            (int) (
                $testResult[0]->total ?? 0
            );


        /*
        ========================================
        RESULT COUNT
        ========================================
        */

        $resultQuery = "SELECT
                            COUNT(*) AS total

                        FROM results r

                        INNER JOIN tests t
                            ON r.test_id = t.test_id

                        WHERE r.school_id = :school_id

                        AND t.school_id = :school_id

                        AND t.teacher_id = :teacher_id";


        $resultResult =
            $testModel->query(
                $resultQuery,
                [
                    'school_id' =>
                        $school_id,

                    'teacher_id' =>
                        $teacher_id
                ]
            );


        $resultCount =
            (int) (
                $resultResult[0]->total ?? 0
            );


        /*
        ========================================
        LOAD DASHBOARD
        ========================================
        */

        $this->view(
            'teacher-dashboard',
            [

                'studentCount' =>
                    (int) $studentCount,

                'classCount' =>
                    $classCount,

                'testCount' =>
                    $testCount,

                'resultCount' =>
                    $resultCount,

                'parentCount' =>
                    $parentCount

            ]
        );
    }
}