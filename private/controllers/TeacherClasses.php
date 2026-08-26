<?php

require_once "../private/models/StudentModel.php";

class TeacherClasses extends Controller
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
        !in_array(
            $_SESSION['rank'] ?? '',
            ['staff', 'teacher']
        )
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
        GET CLASSES
        ========================================
        */

        $classes =
            $studentModel->getClassesBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-classes',
            [
                'classes' => $classes
            ]
        );
    }

    public function details($class = null, $division = null)
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
        !in_array(
            $_SESSION['rank'] ?? '',
            ['staff', 'teacher']
        )
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
    CHECK CLASS AND DIVISION
    ========================================
    */

    if (
        $class === null ||
        $class === '' ||
        $division === null ||
        $division === ''
    ) {

        header(
            "Location: " .
            ROOT .
            "/teacherclasses"
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
    $studentModel->getStudentsByClassAndDivision(
        $school_id,
        $class,
        $division
    );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-class-details',
        [
            'students' => $students,
            'class'    => $class,
            'division' => $division
        ]
    );
}
}