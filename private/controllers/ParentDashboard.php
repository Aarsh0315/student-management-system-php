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
        CHECK SCHOOL
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
        TEMPORARY CHILDREN DATA
        ========================================
        */

        $children = [];


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'parent-dashboard',
            [
                'children' => $children
            ]
        );
    }
}