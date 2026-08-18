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

public function add()
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


    // =========================
    // FORM SUBMITTED
    // =========================

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $school_name = trim($_POST['school_name'] ?? '');
        $school_id = trim($_POST['school_id'] ?? '');
        $school_code = trim($_POST['school_code'] ?? '');

        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        $emergency_contact =
            trim($_POST['emergency_contact'] ?? '');

        $website = trim($_POST['website'] ?? '');

        $address = trim($_POST['address'] ?? '');

        $board = trim($_POST['board'] ?? '');
        $medium = trim($_POST['medium'] ?? '');

        $school_type =
            trim($_POST['school_type'] ?? '');

        $academic_year =
            trim($_POST['academic_year'] ?? '');

        $established_year =
            $_POST['established_year'] ?? null;

        $status = $_POST['status'] ?? 'active';


        // =========================
        // VALIDATION
        // =========================

        if (
            empty($school_name) ||
            empty($school_id)
        ) {

            $this->view('add-school', [
                'error' => 'School name and School ID are required.'
            ]);

            return;
        }


        // =========================
        // INSERT SCHOOL
        // =========================

        $school = new School();

        $school->createSchool([

            'school_id' => $school_id,

            'school_name' => $school_name,

            'school_code' => $school_code,

            'email' => $email,

            'phone' => $phone,

            'emergency_contact' =>
                $emergency_contact,

            'website' => $website,

            'address' => $address,

            'board' => $board,

            'medium' => $medium,

            'school_type' => $school_type,

            'academic_year' =>
                $academic_year,

            'established_year' =>
                $established_year,

            'status' => $status

        ]);


        // =========================
        // BACK TO SCHOOLS
        // =========================

        header(
            "Location: "
            . ROOT
            . "/schools"
        );

        exit;
    }


    // =========================
    // SHOW FORM
    // =========================

    $this->view('add-school');
}
}