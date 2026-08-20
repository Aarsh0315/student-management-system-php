<?php

require_once "../private/models/StaffModel.php";

class Staff extends Controller
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

        if (!isset($_SESSION['rank'])) {

            header("Location: " . ROOT . "/login");
            exit;

        }

        $rank = $_SESSION['rank'];

        $staffModel = new StaffModel();


        /*
        ========================================
        SUPER ADMIN
        ========================================
        */

        if ($rank === 'super_admin') {

            $staff =
                $staffModel->getAllStaff();

        }


        /*
        ========================================
        SCHOOL ADMIN
        ========================================
        */

        elseif ($rank === 'admin') {

            $school_id =
                $_SESSION['school_id'] ?? null;

            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );

            }

            $staff =
                $staffModel->getStaffBySchool(
                    $school_id
                );

        }


        /*
        ========================================
        OTHER USERS
        ========================================
        */

        else {

            header("Location: " . ROOT . "/home");
            exit;

        }


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view('staff', [
            'staff' => $staff
        ]);
    }


    /*
    ========================================
    STAFF DETAILS
    ========================================
    */

    public function details($staff_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only Super Admin for now
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header("Location: " . ROOT . "/home");
            exit;

        }


        // Staff ID missing
        if (
            $staff_id === null ||
            $staff_id === ''
        ) {

            header("Location: " . ROOT . "/staff");
            exit;

        }


        $staffModel =
            new StaffModel();


        // Get selected staff
        $staffData =
            $staffModel->getStaffDetails(
                $staff_id
            );


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


    /*
    ========================================
    ADD STAFF
    ========================================
    */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        // Only Super Admin for now
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {

            header("Location: " . ROOT . "/home");
            exit;

        }


        $this->view('staff-add');
    }
}