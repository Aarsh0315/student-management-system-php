<?php

class Profile extends Controller
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
        GET USER RANK
        ========================================
        */

        $rank =
            $_SESSION['rank'] ?? '';


        /*
        ========================================
        CREATE PROFILE
        ========================================
        */

        $profile = (object) [

            'user_id' =>
                $_SESSION['user_id'] ?? '',

            'firstname' =>
                $_SESSION['firstname'] ?? '',

            'lastname' =>
                $_SESSION['lastname'] ?? '',

            'email' =>
                $_SESSION['email'] ?? '',

            'gender' =>
                $_SESSION['gender'] ?? '',

            'rank' =>
                $rank,

            'status' =>
                $_SESSION['status']
                ?? 'active'

        ];


        /*
        ========================================
        LOAD PROFILE VIEW
        ========================================
        */

        $this->view(
            'my-profile',
            [
                'profile' => $profile
            ]
        );
    }
}