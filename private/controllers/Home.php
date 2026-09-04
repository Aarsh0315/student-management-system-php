<?php

class Home extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }


        // User must be logged in
        if (!isset($_SESSION['user_id'])) {

            header("Location: " . ROOT . "/login");

            exit;
        }


        // Show dashboard
        $this->view('home');
    }
}