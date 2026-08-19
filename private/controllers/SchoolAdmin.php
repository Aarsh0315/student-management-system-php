<?php

class SchoolAdmin extends Controller
{

    public function index()
    {

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
        CHECK ROLE
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '')
            !== 'admin'
        ) {

            die("Access Denied");

        }


        /*
        ========================================
        GET SCHOOL ID
        ========================================
        */

        $school_id =
            $_SESSION['school_id']
            ?? null;


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

        $studentModel = new StudentModel();

        $staffModel = new StaffModel();

        $userModel = new User();


        /*
        ========================================
        DASHBOARD DATA
        ========================================
        */

        $data = [];


        $data['school_id'] =
            $school_id;


        $data['student_count'] =
            $studentModel
                ->getStudentCountBySchool(
                    $school_id
                );


        $data['staff_count'] =
            $staffModel
                ->getStaffCountBySchool(
                    $school_id
                );


        $data['parent_count'] =
            $userModel
                ->getParentCountBySchool(
                    $school_id
                );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            "school-admin",
            $data
        );

    }

}