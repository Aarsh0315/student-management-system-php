<?php

class Superadmin extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Security check
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $this->view('superadmin');
    }
}