<?php

class Home extends Controller
{
    public function index()
    {
        session_start();


        // User must be logged in
        if (!isset($_SESSION['user_id'])) {

            header("Location: " . ROOT . "/login");

            exit;
        }


        // Show dashboard
        $this->view('home');
    }
}