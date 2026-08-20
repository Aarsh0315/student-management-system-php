<?php

require_once "../private/models/StaffModel.php";

class Teachers extends Controller
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

        if (!isset($_SESSION['user_id'])) {

            header("Location: " . ROOT . "/login");
            exit;

        }


        /*
        ========================================
        CHECK SCHOOL ADMIN
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'admin'
        ) {

            header("Location: " . ROOT . "/home");
            exit;

        }


        /*
        ========================================
        GET SCHOOL ID
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );

        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $staffModel = new StaffModel();


        /*
        ========================================
        GET STAFF / TEACHERS
        ========================================
        */

        $teachers =
            $staffModel->getStaffBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view('teachers', [
            'teachers' => $teachers
        ]);
    }

    public function add()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header("Location: " . ROOT . "/login");
        exit;

    }


    /*
    ========================================
    CHECK SCHOOL ADMIN
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'admin'
    ) {

        header("Location: " . ROOT . "/home");
        exit;

    }


    /*
    ========================================
    CHECK SCHOOL
    ========================================
    */

    if (
        empty($_SESSION['school_id'])
    ) {

        die(
            "No school is assigned to this account."
        );

    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view('teacher-add');
}

public function create()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header("Location: " . ROOT . "/login");
        exit;

    }


    /*
    ========================================
    CHECK SCHOOL ADMIN
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'admin'
    ) {

        header("Location: " . ROOT . "/home");
        exit;

    }


    /*
    ========================================
    ONLY POST REQUEST
    ========================================
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        header(
            "Location: " . ROOT . "/teachers/add"
        );

        exit;
    }


    /*
    ========================================
    SCHOOL ID
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this account."
        );

    }


    /*
    ========================================
    GET FORM DATA
    ========================================
    */

    $firstname =
        trim($_POST['firstname'] ?? '');

    $lastname =
        trim($_POST['lastname'] ?? '');

    $email =
        trim($_POST['email'] ?? '');

    $password =
        $_POST['password'] ?? '';

    $gender =
        $_POST['gender'] ?? '';

    $department =
        trim($_POST['department'] ?? '');

    $designation =
        trim($_POST['designation'] ?? '');

    $qualification =
        trim($_POST['qualification'] ?? '');

    $joining_date =
        $_POST['joining_date'] ?? null;

    $employment_type =
        trim($_POST['employment_type'] ?? '');

    $phone =
        trim($_POST['phone'] ?? '');

    $address =
        trim($_POST['address'] ?? '');


    /*
    ========================================
    VALIDATION
    ========================================
    */

    if (
        $firstname === '' ||
        $lastname === '' ||
        $email === '' ||
        $password === '' ||
        $gender === '' ||
        $department === '' ||
        $designation === '' ||
        $qualification === '' ||
        $joining_date === '' ||
        $employment_type === '' ||
        $phone === ''
    ) {

        die(
            "Please fill all required fields."
        );

    }


    /*
    ========================================
    CHECK EMAIL
    ========================================
    */

    $staffModel =
        new StaffModel();


    /*
    ========================================
    HASH PASSWORD
    ========================================
    */

    $hashedPassword =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    /*
    ========================================
    USER DATA
    ========================================
    */

    $userData = [

        'firstname' =>
            $firstname,

        'lastname' =>
            $lastname,

        'email' =>
            $email,

        'gender' =>
            $gender,

        'school_id' =>
            $school_id,

        'rank' =>
            'staff',

        'password' =>
            $hashedPassword,

        'status' =>
            'active'
    ];


    /*
    ========================================
    STAFF DATA
    ========================================
    */

    $staffData = [

        'school_id' =>
            $school_id,

        'department' =>
            $department,

        'designation' =>
            $designation,

        'qualification' =>
            $qualification,

        'joining_date' =>
            $joining_date,

        'employment_type' =>
            $employment_type,

        'phone' =>
            $phone,

        'address' =>
            $address,

        'status' =>
            'active'
    ];


    /*
    ========================================
    CREATE STAFF
    ========================================
    */

    $created =
        $staffModel->createStaff(
            $userData,
            $staffData
        );


    if (!$created) {

        die(
            "Unable to create teacher."
        );

    }


    /*
    ========================================
    SUCCESS
    ========================================
    */

    header(
        "Location: " . ROOT . "/teachers"
    );

    exit;
}


public function details($staff_id = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {

        header("Location: " . ROOT . "/login");
        exit;

    }

    if (
        ($_SESSION['rank'] ?? '') !== 'admin'
    ) {

        header("Location: " . ROOT . "/home");
        exit;

    }

    if (
        $staff_id === null ||
        $staff_id === ''
    ) {

        header("Location: " . ROOT . "/teachers");
        exit;

    }

    $school_id =
        $_SESSION['school_id'] ?? null;

    if (!$school_id) {

        die("No school is assigned to this account.");

    }

    $staffModel = new StaffModel();

    $staffData =
        $staffModel->getStaffDetailsBySchool(
            $staff_id,
            $school_id
        );

    if (!$staffData) {

        die(
            "Teacher not found or you do not have permission to view this teacher."
        );

    }

    $this->view('teacher-details', [
        'teacher' => $staffData
    ]);
}
}