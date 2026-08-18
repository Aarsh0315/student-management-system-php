<?php

class Profile extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        $profile = (object) [

            'user_id' => $_SESSION['user_id'],

            'firstname' =>
                $_SESSION['firstname'] ?? '',

            'lastname' =>
                $_SESSION['lastname'] ?? '',

            'email' =>
                $_SESSION['email'] ?? '',

            'gender' =>
                $_SESSION['gender'] ?? '',

            'rank' =>
                $_SESSION['rank'] ?? '',

            'status' =>
                $_SESSION['status'] ?? 'active'

        ];

        $this->view('my-profile', [
            'profile' => $profile
        ]);
    }
}