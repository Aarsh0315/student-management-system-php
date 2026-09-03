<?php

class ParentDashboard extends Controller
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
        CHECK PARENT
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'parent'
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
        GET PARENT USER ID
        ========================================
        */

        $parent_id =
            $_SESSION['user_id'] ?? null;


        if (!$parent_id) {

            die(
                "Parent user ID not found."
            );
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
                "No school is assigned to this parent."
            );
        }


        /*
        ========================================
        LOAD PARENT MODEL
        ========================================
        */

        $parentModel =
            $this->model('ParentModel');


        /*
        ========================================
        GET PARENT DETAILS
        ========================================
        */

        $parent =
            $parentModel->getParentByUserId(
                $parent_id
            );


        if (!$parent) {

            die(
                "Parent account not found."
            );
        }


        /*
        ========================================
        GET CHILDREN
        ========================================
        */

        $children =
            $parentModel->getDashboardChildren(
                $parent_id
            );


        /*
        ========================================
        CHILDREN COUNT
        ========================================
        */

        $childCount =
            $parentModel->getChildrenCount(
                $parent_id
            );


        /*
        ========================================
        TEST COUNT
        ========================================
        */

        $testCount = 0;


        /*
        ========================================
        RESULT COUNT
        ========================================
        */

        $resultCount = 0;


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'parent-dashboard',
            [
                'parent'      => $parent,
                'children'    => $children,
                'childCount'  => $childCount,
                'testCount'   => $testCount,
                'resultCount' => $resultCount
            ]
        );
    }
}