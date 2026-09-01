<?php

class SchoolAdmin extends Controller
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
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        /*
        ========================================
        CHECK SCHOOL ADMIN
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'admin'
        ) {

            die("Access Denied");
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
                "No school is assigned to this account."
            );
        }


        /*
        ========================================
        LOAD MODELS
        ========================================
        */

        $studentModel =
            $this->model('StudentModel');


        $staffModel =
            $this->model('StaffModel');


        $userModel =
            $this->model('User');


        /*
        ========================================
        DASHBOARD DATA
        ========================================
        */

        $data = [];


        $data['school_id'] =
            $school_id;


        /*
        ========================================
        STUDENTS
        ========================================
        */

        $data['student_count'] =
            $studentModel
                ->getStudentCountBySchool(
                    $school_id
                );


        /*
        ========================================
        TEACHERS / STAFF
        ========================================
        */

        $data['staff_count'] =
            $staffModel
                ->getStaffCountBySchool(
                    $school_id
                );


        /*
        ========================================
        PARENTS
        ========================================
        */

        $data['parent_count'] =
            $userModel
                ->getParentCountBySchool(
                    $school_id
                );


        /*
        ========================================
        CLASSES
        TEMPORARY
        ========================================
        */

        $data['class_count'] = 0;


        /*
        ========================================
        TESTS
        TEMPORARY
        ========================================
        */

        $data['test_count'] = 0;


        /*
        ========================================
        RESULTS
        TEMPORARY
        ========================================
        */

        $data['result_count'] = 0;


        /*
        ========================================
        LOAD SCHOOL ADMIN DASHBOARD
        ========================================
        */

        /*
========================================
RECENT ACTIVITY
========================================
*/

$data['recent_activities'] = [];


/*
----------------------------------------
STUDENT ACTIVITY
----------------------------------------
*/

if ($data['student_count'] > 0) {

    $data['recent_activities'][] = [

        'icon' => 'ST',

        'title' => 'Students',

        'description' =>
            $data['student_count']
            . ' student(s) registered in your school.',

        'time' => 'Current'
    ];
}


/*
----------------------------------------
TEACHER ACTIVITY
----------------------------------------
*/

if ($data['staff_count'] > 0) {

    $data['recent_activities'][] = [

        'icon' => 'TC',

        'title' => 'Teachers',

        'description' =>
            $data['staff_count']
            . ' teacher(s) registered in your school.',

        'time' => 'Current'
    ];
}


/*
----------------------------------------
PARENT ACTIVITY
----------------------------------------
*/

if ($data['parent_count'] > 0) {

    $data['recent_activities'][] = [

        'icon' => 'PR',

        'title' => 'Parents',

        'description' =>
            $data['parent_count']
            . ' parent(s) associated with your school.',

        'time' => 'Current'
    ];
}

        $this->view(
            'home',
            $data
        );
    }
}