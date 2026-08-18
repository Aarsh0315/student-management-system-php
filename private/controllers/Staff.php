<?php

require_once "../private/models/StaffModel.php";

class Staff extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $staffModel = new StaffModel();

        $staff = $staffModel->getAllStaff();

        $this->view('staff', [
            'staff' => $staff
        ]);
    }

    public function details($staff_id = null)
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

    // Staff ID missing
    if ($staff_id === null || $staff_id === '') {
        header("Location: " . ROOT . "/staff");
        exit;
    }

    $staffModel = new StaffModel();

    // Get selected staff
    $staffData = $staffModel->getStaffDetails($staff_id);

    if (!$staffData) {
        die(
            "Staff not found. Staff ID: "
            . htmlspecialchars($staff_id)
        );
    }

    $this->view('staff-details', [
        'staff' => $staffData
    ]);
}
}