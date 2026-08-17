<?php

require_once "../private/models/School.php";

class Schools extends Controller
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

        $school = new School();

        $schools = $school->getAllSchools();

        $this->view('schools', [
            'schools' => $schools
        ]);
    }


    // School details
    public function details($school_id)
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

    $school = new School();

    // Get school
    $schoolData = $school->findBySchoolId($school_id);

    if (!$schoolData) {
        die("School not found.");
    }

    // Get role counts
    $roleCounts = $school->getRoleCounts($school_id);

    // Convert results into easy-to-use array
    $counts = [
        'student' => 0,
        'teacher' => 0,
        'admin' => 0,
        'principal' => 0,
        'vice_principal' => 0,
        'parent' => 0,
        'staff' => 0
    ];

    foreach ($roleCounts as $row) {

        if (isset($counts[$row->rank])) {
            $counts[$row->rank] = $row->total;
        }

    }

    $this->view('school', [
        'school' => $schoolData,
        'counts' => $counts
    ]);
}
}