<?php

require_once "../private/models/User.php";

class Parents extends Controller
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

            header("Location: " . ROOT . "/login");
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

            header("Location: " . ROOT . "/home");
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
                "No school is assigned to this account."
            );

        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $userModel = new User();


        /*
        ========================================
        GET PARENTS
        ========================================
        */

        $parents =
            $userModel->getParentsBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view('parents', [
            'parents' => $parents
        ]);
    }
}