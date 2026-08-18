<?php

require_once "../private/models/SchoolAdminModel.php";

class SchoolAdmins extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only Super Admin
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $adminModel = new SchoolAdminModel();

        $admins = $adminModel->getAllAdmins();

        $this->view('school-admins', [
            'admins' => $admins
        ]);
    }


    public function details($user_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only Super Admin
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        if ($user_id === null || $user_id === '') {
            header("Location: " . ROOT . "/schooladmins");
            exit;
        }

        $adminModel = new SchoolAdminModel();

        $admin = $adminModel->getAdminDetails($user_id);

        if (!$admin) {
            die(
                "School Admin not found. User ID: "
                . htmlspecialchars($user_id)
            );
        }

        $this->view('school-admin-details', [
            'admin' => $admin
        ]);
    }
}