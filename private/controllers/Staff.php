<?php

require_once "../private/models/StaffModel.php";
require_once "../private/models/School.php";

class Staff extends Controller
{
    /* =====================================================
       STAFF LIST
    ===================================================== */

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


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


        $this->view('staff', [
            'staff' => $staff
        ]);
    }


    /* =====================================================
       STAFF DETAILS
    ===================================================== */

    public function details($staff_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['rank'])) {

            header("Location: " . ROOT . "/login");
            exit;
        }


        if (
            $staff_id === null ||
            $staff_id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/staff"
            );

            exit;
        }


        $staffModel =
            new StaffModel();


        $rank = $_SESSION['rank'];


        /*
        ========================================
        SUPER ADMIN
        ========================================
        */

        if ($rank === 'super_admin') {

            $staffData =
                $staffModel->getStaffDetails(
                    $staff_id
                );
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


            $staffData =
                $staffModel->getStaffDetailsBySchool(
                    $staff_id,
                    $school_id
                );
        }


        else {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        if (!$staffData) {

            die(
                "Staff not found or you do not have permission to view this staff member."
            );
        }


        $this->view('staff-details', [
            'staff' => $staffData
        ]);
    }


    /* =====================================================
       ADD STAFF
    ===================================================== */

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

        if (!isset($_SESSION['rank'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        $rank = $_SESSION['rank'];


        /*
        ========================================
        ONLY SUPER ADMIN AND SCHOOL ADMIN
        ========================================
        */

        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        GET SCHOOLS
        ========================================
        */

        $schoolModel =
            new School();

        $schools =
            $schoolModel->getAllSchools();


        /*
        ========================================
        SHOW FORM
        ========================================
        */

        $this->view('staff-add', [

            'schools' => $schools

        ]);
    }


    /* =====================================================
       CREATE STAFF
    ===================================================== */

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

        if (!isset($_SESSION['rank'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        $rank = $_SESSION['rank'];


        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        ONLY POST
        ========================================
        */

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: " .
                ROOT .
                "/staff/add"
            );

            exit;
        }


        /*
        ========================================
        SCHOOL
        ========================================
        */

        if ($rank === 'super_admin') {

            $school_id =
                $_POST['school_id'] ?? null;

        } else {

            /*
            School Admin cannot choose another school.
            */

            $school_id =
                $_SESSION['school_id'] ?? null;
        }


        if (!$school_id) {

            die(
                "School is required."
            );
        }


        /*
        ========================================
        FORM DATA
        ========================================
        */

        $firstname =
            trim(
                $_POST['firstname'] ?? ''
            );


        $lastname =
            trim(
                $_POST['lastname'] ?? ''
            );


        $email =
            trim(
                $_POST['email'] ?? ''
            );


        $gender =
            trim(
                $_POST['gender'] ?? ''
            );


        $password =
            $_POST['password'] ?? '';


        $department =
            trim(
                $_POST['department'] ?? ''
            );


        $designation =
            trim(
                $_POST['designation'] ?? ''
            );


        $qualification =
            trim(
                $_POST['qualification'] ?? ''
            );


        $joining_date =
            $_POST['joining_date'] ?? null;


        $employment_type =
            trim(
                $_POST['employment_type'] ?? ''
            );


        $phone =
            trim(
                $_POST['phone'] ?? ''
            );


        $address =
            trim(
                $_POST['address'] ?? ''
            );

        

        /*
========================================
PROFILE IMAGE
========================================
*/

/*
========================================
PROFILE IMAGE
========================================
*/

$profile_image = null;

if (
    isset($_FILES['profile_image']) &&
    $_FILES['profile_image']['error'] === UPLOAD_ERR_OK
) {

    // Allowed image types
    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp'
    ];


    // Check image
    $imageInfo = getimagesize(
        $_FILES['profile_image']['tmp_name']
    );

    if ($imageInfo === false) {
        die("Invalid image file.");
    }


    $mime = $imageInfo['mime'];


    if (!isset($allowedTypes[$mime])) {
        die("Only JPG, PNG and WEBP images are allowed.");
    }


    // Upload folder
    $uploadDirectory =
        __DIR__ . '/../../public/uploads/users/';


    


    // Create folder if it doesn't exist
    if (!is_dir($uploadDirectory)) {

        mkdir(
            $uploadDirectory,
            0755,
            true
        );
    }


    // Generate filename
    $profile_image =
        uniqid('user_', true)
        . '.'
        . $allowedTypes[$mime];


    // Full path
    $uploadPath =
        $uploadDirectory . $profile_image;


    // Move uploaded image
    if (!move_uploaded_file(
        $_FILES['profile_image']['tmp_name'],
        $uploadPath
    )) {

        die("Unable to save profile image.");
    }

}

        $status =
            $_POST['status'] ?? 'active';


        /*
        ========================================
        VALIDATION
        ========================================
        */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === '' ||
            $gender === '' ||
            $password === '' ||
            $department === '' ||
            $designation === ''
        ) {

            die(
                "Please fill all required fields."
            );
        }


        /*
        ========================================
        EMAIL VALIDATION
        ========================================
        */

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            die(
                "Please enter a valid email address."
            );
        }


        /*
        ========================================
        PASSWORD HASH
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
        'teacher',

    'password' =>
        $hashedPassword,

    'status' =>
        $status,

    'profile_image' =>
        $profile_image
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
                $status

        ];


        /*
        ========================================
        CREATE STAFF
        ========================================
        */

        $staffModel =
            new StaffModel();


        $created =
            $staffModel->createStaff(
                $userData,
                $staffData
            );


        /*
        ========================================
        SUCCESS
        ========================================
        */

        if ($created) {

            header(
                "Location: " .
                ROOT .
                "/staff"
            );

            exit;
        }


        /*
        ========================================
        FAILED
        ========================================
        */

        die(
            "Unable to create staff."
        );
    }
}