<?php

require_once "../private/models/StudentModel.php";

class TeacherStudents extends Controller
{
    public function index()
    {
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
        GET SCHOOL ID
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
        LOAD STUDENT MODEL
        ========================================
        */

        $studentModel =
            new StudentModel();


        /*
        ========================================
        GET STUDENTS
        ========================================
        */

        $students =
            $studentModel->getStudentsBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-students',
            [
                'students' => $students
            ]
        );
    }

    public function details($student_id = null)
{
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
    CHECK STUDENT ID
    ========================================
    */

    if (
        $student_id === null ||
        $student_id === ''
    ) {

        header(
            "Location: " .
            ROOT .
            "/teacherstudents"
        );

        exit;
    }


    /*
    ========================================
    SCHOOL ID
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

    $studentModel =
        new StudentModel();


    /*
    ========================================
    GET STUDENT DETAILS
    ========================================
    */

    $student =
        $studentModel->getStudentDetailsBySchool(
            $student_id,
            $school_id
        );


    /*
    ========================================
    STUDENT NOT FOUND
    ========================================
    */

    if (!$student) {

        die(
            "Student not found or you do not have permission to view this student."
        );
    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-student-details',
        [
            'student' => $student
        ]
    );
}
}