<?php

require_once "../private/models/School.php";

class Schools extends Controller
{
    /*
    =====================================================
    SCHOOL LIST
    SEARCH + SORT
    =====================================================
    */

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        =================================================
        ONLY SUPER ADMIN
        =================================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }


        /*
        =================================================
        GET SEARCH
        =================================================
        */

        $search = trim($_GET['search'] ?? '');


        /*
        =================================================
        GET SORT
        =================================================
        */

        $sort = $_GET['sort'] ?? 'id';


        /*
        =================================================
        GET DIRECTION
        =================================================
        */

        $direction = $_GET['direction'] ?? 'DESC';


        /*
        =================================================
        GET SCHOOLS
        =================================================
        */

        $search = trim($_GET['search'] ?? '');
        $sort = $_GET['sort'] ?? 'id';
        $direction = $_GET['direction'] ?? 'DESC';
        $status = $_GET['status'] ?? '';

        $school = new School();

        $schools = $school->getAllSchools(
            $search,
            $sort,
            $direction,
            $status
        );

        $this->view('schools', [
            'schools'   => $schools,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction,
            'status'    => $status
        ]);
    }


    /*
    =====================================================
    SCHOOL DETAILS
    =====================================================
    */

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

        $schoolData = $school->findBySchoolId($school_id);

        if (!$schoolData) {
            die("School not found.");
        }

        $roleCounts = $school->getRoleCounts($school_id);

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


    /*
    =====================================================
    ADD SCHOOL
    =====================================================
    */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ================================================
        ONLY SUPER ADMIN
        ================================================
        */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }


        /*
        ================================================
        FORM SUBMITTED
        ================================================
        */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $school_name = trim($_POST['school_name'] ?? '');
            $school_id = trim($_POST['school_id'] ?? '');
            $school_code = trim($_POST['school_code'] ?? '');

            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            $emergency_contact =
                trim($_POST['emergency_contact'] ?? '');

            $website =
                trim($_POST['website'] ?? '');

            $address =
                trim($_POST['address'] ?? '');

            $board =
                trim($_POST['board'] ?? '');

            $medium =
                trim($_POST['medium'] ?? '');

            $school_type =
                trim($_POST['school_type'] ?? '');

            $academic_year =
                trim($_POST['academic_year'] ?? '');

            $established_year =
                $_POST['established_year'] ?? null;

            $status =
                $_POST['status'] ?? 'active';


            /*
            ============================================
            VALIDATION
            ============================================
            */

            if (
                empty($school_name) ||
                empty($school_id)
            ) {

                $this->view('add-school', [
                    'error' =>
                        'School name and School ID are required.'
                ]);

                return;
            }


            /*
            ============================================
            CREATE SCHOOL
            ============================================
            */

            $school = new School();

            $school->createSchool([

                'school_id' =>
                    $school_id,

                'school_name' =>
                    $school_name,

                'school_code' =>
                    $school_code,

                'email' =>
                    $email,

                'phone' =>
                    $phone,

                'emergency_contact' =>
                    $emergency_contact,

                'website' =>
                    $website,

                'address' =>
                    $address,

                'board' =>
                    $board,

                'medium' =>
                    $medium,

                'school_type' =>
                    $school_type,

                'academic_year' =>
                    $academic_year,

                'established_year' =>
                    $established_year,

                'status' =>
                    $status
            ]);


            /*
            ============================================
            REDIRECT
            ============================================
            */

            header(
                "Location: "
                . ROOT
                . "/schools"
            );

            exit;
        }


        /*
        ================================================
        SHOW ADD FORM
        ================================================
        */

        $this->view('add-school');
    }

    public function edit($school_id)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    =================================================
    SUPER ADMIN ONLY
    =================================================
    */

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }


    /*
    =================================================
    GET SCHOOL
    =================================================
    */

    $school = new School();

    $schoolData = $school->findBySchoolId($school_id);

    if (!$schoolData) {
        die("School not found.");
    }


    /*
    =================================================
    SHOW EDIT PAGE
    =================================================
    */

    $this->view('edit-school', [
        'school' => $schoolData
    ]);
}


public function update($school_id)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    =================================================
    SUPER ADMIN ONLY
    =================================================
    */

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }


    /*
    =================================================
    POST ONLY
    =================================================
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: " . ROOT . "/schools");
        exit;
    }


    /*
    =================================================
    CSRF CHECK
    =================================================
    */

    if (!CSRF::verify($_POST['csrf_token'] ?? '')) {

        die("Invalid CSRF token.");
    }


    /*
    =================================================
    GET FORM DATA
    =================================================
    */

    $school_name = trim($_POST['school_name'] ?? '');
    $school_code = trim($_POST['school_code'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $emergency_contact = trim($_POST['emergency_contact'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $board = trim($_POST['board'] ?? '');
    $medium = trim($_POST['medium'] ?? '');
    $school_type = trim($_POST['school_type'] ?? '');
    $academic_year = trim($_POST['academic_year'] ?? '');
    $established_year = $_POST['established_year'] ?? null;
    $status = $_POST['status'] ?? 'active';


    /*
    =================================================
    VALIDATION
    =================================================
    */

    if ($school_name === '') {

        $school = new School();

        $schoolData = $school->findBySchoolId($school_id);

        $this->view('edit-school', [
            'school' => $schoolData,
            'error' => 'School name is required.'
        ]);

        return;
    }


    /*
    =================================================
    UPDATE SCHOOL
    =================================================
    */

    $school = new School();

    $school->updateSchool(
        $school_id,
        [
            'school_name'       => $school_name,
            'school_code'       => $school_code,
            'email'             => $email,
            'phone'             => $phone,
            'emergency_contact' => $emergency_contact,
            'website'           => $website,
            'address'           => $address,
            'board'             => $board,
            'medium'            => $medium,
            'school_type'       => $school_type,
            'academic_year'     => $academic_year,
            'established_year'  => $established_year,
            'status'            => $status
        ]
    );


    /*
    =================================================
    REDIRECT
    =================================================
    */

    header(
        "Location: " .
        ROOT .
        "/schools/details/" .
        urlencode($school_id)
    );

    exit;
}

public function delete($school_id)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    =================================================
    SUPER ADMIN ONLY
    =================================================
    */

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }


    /*
    =================================================
    POST ONLY
    =================================================
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: " . ROOT . "/schools");
        exit;
    }


    /*
    =================================================
    CSRF CHECK
    =================================================
    */

    if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
        die("Invalid CSRF token.");
    }


    /*
    =================================================
    DEACTIVATE SCHOOL
    =================================================
    */

    $school = new School();

    $school->deactivateSchool($school_id);


    /*
    =================================================
    REDIRECT
    =================================================
    */

    header(
        "Location: " .
        ROOT .
        "/schools"
    );

    exit;
}

public function activate($school_id)
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK SUPER ADMIN
    ========================================
    */

    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }


    /*
    ========================================
    CHECK POST REQUEST
    ========================================
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: " . ROOT . "/schools");
        exit;
    }


    /*
    ========================================
    CHECK CSRF
    ========================================
    */

    if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
        die("Invalid security token.");
    }


    /*
    ========================================
    ACTIVATE SCHOOL
    ========================================
    */

    $school = new School();

    $activated = $school->activateSchool($school_id);


    if (!$activated) {
        die("Unable to activate school.");
    }


    /*
    ========================================
    REDIRECT
    ========================================
    */

    header(
        "Location: " .
        ROOT .
        "/schools"
    );

    exit;
}
}