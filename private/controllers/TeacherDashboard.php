<?php

class TeacherDashboard extends Controller
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
        LOAD DASHBOARD
        ========================================
        */

        $this->view(
            'teacher-dashboard',
            []
        );
    }
}