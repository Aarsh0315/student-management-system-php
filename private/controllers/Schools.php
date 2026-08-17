<?php

class Schools extends Controller
{
    public function index()
    {
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $school = new School();

        $schools = $school->findAll();

        $data['schools'] = $schools;

        $this->view('schools', $data);
    }
}