<?php

require_once "../private/models/StudentModel.php";
require_once "../private/models/School.php";


class Students extends Controller
{

    /* =====================================================
       STUDENTS LIST
    ===================================================== */

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['rank'])) {

            header(
                "Location: " . ROOT . "/login"
            );

            exit;
        }


        $rank = $_SESSION['rank'];

        $studentModel = new StudentModel();


        /* ==============================
           SUPER ADMIN
        ============================== */

        if ($rank === 'super_admin') {

            $search = trim(
                $_GET['search'] ?? ''
            );

            $sort = $_GET['sort']
                ?? 'student_id';

            $direction = $_GET['direction']
                ?? 'DESC';

            $gender = $_GET['gender']
                ?? '';

            $status = $_GET['status']
                ?? '';

            $school_id = $_GET['school_id']
                ?? '';


            $students =
                $studentModel->getAllStudents(
                    $search,
                    $sort,
                    $direction,
                    $gender,
                    $status,
                    $school_id
                );


            /* ==============================
               LOAD SCHOOLS
            ============================== */

            $schoolModel = new School();

            $schools =
                $schoolModel->getAllSchools();


            $this->view(
                'students',
                [
                    'students'  => $students,
                    'schools'   => $schools,
                    'search'    => $search,
                    'sort'      => $sort,
                    'direction' => $direction,
                    'gender'    => $gender,
                    'status'    => $status,
                    'school_id' => $school_id
                ]
            );

            return;
        }


        /* ==============================
           SCHOOL ADMIN
        ============================== */

        elseif ($rank === 'admin') {

            $school_id =
                $_SESSION['school_id']
                ?? null;


            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );
            }


            $students =
                $studentModel->getStudentsBySchool(
                    $school_id
                );


            $this->view(
                'students',
                [
                    'students' => $students
                ]
            );

            return;
        }


        /* ==============================
           OTHER USERS
        ============================== */

        else {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }
    }


    /* =====================================================
       STUDENT DETAILS
    ===================================================== */

    public function details(
        $student_id = null
    ) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['rank'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        if (
            $student_id === null ||
            $student_id === ''
        ) {

            header(
                "Location: "
                . ROOT
                . "/students"
            );

            exit;
        }


        $studentModel =
            new StudentModel();

        $rank =
            $_SESSION['rank'];


        /* ==============================
           SUPER ADMIN
        ============================== */

        if ($rank === 'super_admin') {

            $studentData =
                $studentModel->getStudentDetails(
                    $student_id
                );
        }


        /* ==============================
           SCHOOL ADMIN
        ============================== */

        elseif ($rank === 'admin') {

            $school_id =
                $_SESSION['school_id']
                ?? null;


            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );
            }


            $studentData =
                $studentModel->getStudentDetailsBySchool(
                    $student_id,
                    $school_id
                );
        }


        /* ==============================
           OTHER USERS
        ============================== */

        else {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        /* ==============================
           STUDENT NOT FOUND
        ============================== */

        if (!$studentData) {

            die(
                "Student not found or you do not have permission to view this student."
            );
        }


        $this->view(
            'student-details',
            [
                'student' => $studentData
            ]
        );
    }


    /* =====================================================
       EDIT STUDENT
    ===================================================== */

    public function edit(
        $student_id
    ) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ==============================
           CHECK LOGIN
        ============================== */

        if (!isset($_SESSION['rank'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        $rank =
            $_SESSION['rank'];


        /* ==============================
           CHECK ROLE
        ============================== */

        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        $studentModel =
            new StudentModel();

        $schoolModel =
            new School();


        /* ==============================
           SUPER ADMIN
        ============================== */

        if ($rank === 'super_admin') {

            $student =
                $studentModel->getStudentDetails(
                    $student_id
                );

            $schools =
                $schoolModel->getAllSchools();
        }


        /* ==============================
           SCHOOL ADMIN
        ============================== */

        else {

            $school_id =
                $_SESSION['school_id']
                ?? null;


            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );
            }


            $student =
                $studentModel->getStudentDetailsBySchool(
                    $student_id,
                    $school_id
                );


            /*
             * We use getAllSchools() because
             * getSchoolById() does not exist
             * in your School model.
             */

            $schools =
                $schoolModel->getAllSchools();
        }


        /* ==============================
           STUDENT NOT FOUND
        ============================== */

        if (!$student) {

            header(
                "Location: "
                . ROOT
                . "/students"
            );

            exit;
        }


        /* ==============================
           LOAD EDIT VIEW
        ============================== */

        $this->view(
            'edit-student',
            [
                'student' => $student,
                'schools'  => $schools
            ]
        );
    }


    /* =====================================================
       UPDATE STUDENT
    ===================================================== */

    public function update(
        $student_id
    ) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ==============================
           CHECK LOGIN
        ============================== */

        if (!isset($_SESSION['rank'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        $rank =
            $_SESSION['rank'];


        /* ==============================
           CHECK ROLE
        ============================== */

        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        /* ==============================
           ONLY POST REQUEST
        ============================== */

        if (
            $_SERVER['REQUEST_METHOD']
            !== 'POST'
        ) {

            header(
                "Location: "
                . ROOT
                . "/students"
            );

            exit;
        }


        /* ==============================
           CSRF PROTECTION
        ============================== */

        if (
            !CSRF::verify(
                $_POST['csrf_token']
                ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        $studentModel =
            new StudentModel();


        /* ==============================
           GET EXISTING STUDENT
        ============================== */

        if ($rank === 'super_admin') {

            $student =
                $studentModel->getStudentDetails(
                    $student_id
                );
        }

        else {

            $school_id =
                $_SESSION['school_id']
                ?? null;


            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );
            }


            $student =
                $studentModel->getStudentDetailsBySchool(
                    $student_id,
                    $school_id
                );
        }


        /* ==============================
           STUDENT NOT FOUND
        ============================== */

        if (!$student) {

            header(
                "Location: "
                . ROOT
                . "/students"
            );

            exit;
        }


        /* =================================================
           PERSONAL INFORMATION
        ================================================= */

        $firstname =
            trim(
                $_POST['firstname']
                ?? ''
            );


        $lastname =
            trim(
                $_POST['lastname']
                ?? ''
            );


        $email =
            trim(
                $_POST['email']
                ?? ''
            );


        $gender =
            trim(
                $_POST['gender']
                ?? ''
            );


        $date_of_birth =
            trim(
                $_POST['date_of_birth']
                ?? ''
            );


        /* =================================================
           STUDENT INFORMATION
        ================================================= */

        $admission_number =
            trim(
                $_POST['admission_number']
                ?? ''
            );


        $class =
            trim(
                $_POST['class']
                ?? ''
            );


        $division =
            trim(
                $_POST['division']
                ?? ''
            );


        $roll_number =
            trim(
                $_POST['roll_number']
                ?? ''
            );


        $admission_date =
            trim(
                $_POST['admission_date']
                ?? ''
            );


        $selected_school_id =
            $_POST['school_id']
            ?? '';


        /* =================================================
           PARENT INFORMATION
        ================================================= */

        $parent_name =
            trim(
                $_POST['parent_name']
                ?? ''
            );


        $parent_phone =
            trim(
                $_POST['parent_phone']
                ?? ''
            );


        $parent_email =
            trim(
                $_POST['parent_email']
                ?? ''
            );


        /* =================================================
           ADDRESS
        ================================================= */

        $address =
            trim(
                $_POST['address']
                ?? ''
            );


        /* =================================================
           STATUS
        ================================================= */

        $status =
            $_POST['status']
            ?? 'active';


        /* =================================================
           BASIC VALIDATION
        ================================================= */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === ''
        ) {

            $schoolModel =
                new School();


            $schools =
                $schoolModel->getAllSchools();


            /*
             * Preserve entered values
             */

            $student->firstname =
                $firstname;

            $student->lastname =
                $lastname;

            $student->email =
                $email;

            $student->gender =
                $gender;

            $student->date_of_birth =
                $date_of_birth;


            $student->admission_number =
                $admission_number;

            $student->class =
                $class;

            $student->division =
                $division;

            $student->roll_number =
                $roll_number;

            $student->admission_date =
                $admission_date;


            $student->parent_name =
                $parent_name;

            $student->parent_phone =
                $parent_phone;

            $student->parent_email =
                $parent_email;


            $student->address =
                $address;

            $student->status =
                $status;


            $this->view(
                'edit-student',
                [
                    'student' => $student,
                    'schools'  => $schools,
                    'error'   =>
                        'Please fill in all required fields.'
                ]
            );

            return;
        }


        /* =================================================
           SCHOOL ADMIN SCHOOL RESTRICTION
        ================================================= */

        if ($rank === 'admin') {

            $selected_school_id =
                $_SESSION['school_id'];
        }


        /* =================================================
           USER DATA
        ================================================= */

        $userData = [

            'firstname' =>
                $firstname,

            'lastname' =>
                $lastname,

            'email' =>
                $email,

            'gender' =>
                $gender,

            'date_of_birth' =>
                $date_of_birth,

            'status' =>
                $status
        ];


        /* =================================================
           STUDENT DATA
        ================================================= */

        $studentData = [

            'admission_number' =>
                $admission_number,

            'class' =>
                $class,

            'division' =>
                $division,

            'roll_number' =>
                $roll_number,

            'date_of_birth' =>
                $date_of_birth,

            'admission_date' =>
                $admission_date,

            'parent_name' =>
                $parent_name,

            'parent_phone' =>
                $parent_phone,

            'parent_email' =>
                $parent_email,

            'address' =>
                $address,

            'school_id' =>
                $selected_school_id,

            'status' =>
                $status
        ];


        /* =================================================
           UPDATE STUDENT
        ================================================= */

        $updated =
            $studentModel->updateStudent(
                $student_id,
                $student->user_id,
                $userData,
                $studentData
            );


        /* =================================================
           SUCCESS
        ================================================= */

        if ($updated) {

            header(
                "Location: "
                . ROOT
                . "/students/details/"
                . urlencode($student_id)
            );

            exit;
        }


        /* =================================================
           UPDATE FAILED
        ================================================= */

        $schoolModel =
            new School();


        $schools =
            $schoolModel->getAllSchools();


        $this->view(
            'edit-student',
            [
                'student' => $student,
                'schools'  => $schools,
                'error'   =>
                    'Unable to update student.'
            ]
        );
    }


    /* =====================================================
       ADD STUDENT
    ===================================================== */

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ========================================
           CHECK LOGIN
        ======================================== */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        /* ========================================
           CHECK ROLE
        ======================================== */

        $rank =
            $_SESSION['rank']
            ?? '';


        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        /* ========================================
           LOAD SCHOOLS
        ======================================== */

        $schools = [];


        if ($rank === 'super_admin') {

            $schoolModel =
                new School();

            $schools =
                $schoolModel->getAllSchools();
        }


        /* ========================================
           SCHOOL ADMIN
        ======================================== */

        if ($rank === 'admin') {

            $school_id =
                $_SESSION['school_id']
                ?? null;


            if (!$school_id) {

                die(
                    "No school is assigned to this account."
                );
            }
        }


        /* ========================================
           LOAD VIEW
        ======================================== */

        $this->view(
            'student-add',
            [
                'schools' => $schools
            ]
        );
    }


    /* =====================================================
       CREATE STUDENT
    ===================================================== */

    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ========================================
           CHECK LOGIN
        ======================================== */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        /* ========================================
           CHECK ROLE
        ======================================== */

        $rank =
            $_SESSION['rank']
            ?? '';


        if (
            $rank !== 'super_admin' &&
            $rank !== 'admin'
        ) {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        /* ========================================
           ONLY POST REQUEST
        ======================================== */

        if (
            $_SERVER['REQUEST_METHOD']
            !== 'POST'
        ) {

            header(
                "Location: "
                . ROOT
                . "/students/add"
            );

            exit;
        }


        /* ========================================
           CSRF
        ======================================== */

        if (
            !CSRF::verify(
                $_POST['csrf_token']
                ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        /* ========================================
           DETERMINE SCHOOL
        ======================================== */

        if ($rank === 'super_admin') {

            $school_id =
                $_POST['school_id']
                ?? null;

        } else {

            $school_id =
                $_SESSION['school_id']
                ?? null;
        }


        if (!$school_id) {

            die(
                "School ID is required."
            );
        }


        /* ========================================
           GET FORM DATA
        ======================================== */

        $firstname =
            trim(
                $_POST['firstname']
                ?? ''
            );


        $lastname =
            trim(
                $_POST['lastname']
                ?? ''
            );


        $email =
            trim(
                $_POST['email']
                ?? ''
            );


        $password =
            $_POST['password']
            ?? '';


        $gender =
            $_POST['gender']
            ?? '';


        $date_of_birth =
            $_POST['date_of_birth']
            ?? null;


        $admission_number =
            trim(
                $_POST['admission_number']
                ?? ''
            );


        $class =
            trim(
                $_POST['class']
                ?? ''
            );


        $division =
            trim(
                $_POST['division']
                ?? ''
            );


        $roll_number =
            trim(
                $_POST['roll_number']
                ?? ''
            );


        $admission_date =
            $_POST['admission_date']
            ?? null;


        $parent_firstname =
            trim(
                $_POST['parent_firstname']
                ?? ''
            );


        $parent_lastname =
            trim(
                $_POST['parent_lastname']
                ?? ''
            );


        $parent_phone =
            trim(
                $_POST['parent_phone']
                ?? ''
            );


        $parent_email =
            trim(
                $_POST['parent_email']
                ?? ''
            );


        $address =
            trim(
                $_POST['address']
                ?? ''
            );


        /* ========================================
           PROFILE IMAGE
        ======================================== */

        $profile_image = null;


        if (
            isset($_FILES['profile_image']) &&
            $_FILES['profile_image']['error']
            !== UPLOAD_ERR_NO_FILE
        ) {

            if (
                $_FILES['profile_image']['error']
                !== UPLOAD_ERR_OK
            ) {

                die(
                    "There was an error uploading the profile image."
                );
            }


            /* Maximum 2MB */

            if (
                $_FILES['profile_image']['size']
                > 2 * 1024 * 1024
            ) {

                die(
                    "Profile image must be less than 2MB."
                );
            }


            /* Allowed image types */

            $allowedTypes = [

                'image/jpeg' => 'jpg',

                'image/png' => 'png',

                'image/webp' => 'webp'

            ];


            /* Verify actual image */

            $imageInfo =
                getimagesize(
                    $_FILES['profile_image']['tmp_name']
                );


            if ($imageInfo === false) {

                die(
                    "Uploaded file is not a valid image."
                );
            }


            $mime =
                $imageInfo['mime'];


            if (
                !isset(
                    $allowedTypes[$mime]
                )
            ) {

                die(
                    "Only JPG, PNG and WEBP images are allowed."
                );
            }


            /* Upload folder */

            $uploadDirectory =
                __DIR__
                . '/../../public/uploads/users/';


            if (!is_dir($uploadDirectory)) {

                mkdir(
                    $uploadDirectory,
                    0755,
                    true
                );
            }


            /* Unique filename */

            $profile_image =
                uniqid(
                    'user_',
                    true
                )
                . '.'
                . $allowedTypes[$mime];


            /* Full path */

            $uploadPath =
                $uploadDirectory
                . $profile_image;


            /* Move image */

            if (
                !move_uploaded_file(
                    $_FILES['profile_image']['tmp_name'],
                    $uploadPath
                )
            ) {

                die(
                    "Unable to save profile image."
                );
            }
        }


        /* ========================================
           BASIC VALIDATION
        ======================================== */

        if (
            $firstname === '' ||
            $lastname === '' ||
            $email === '' ||
            $password === '' ||
            $gender === '' ||
            $admission_number === '' ||
            $class === '' ||
            $division === '' ||
            $parent_firstname === '' ||
            $parent_lastname === '' ||
            $parent_email === '' ||
            $parent_phone === ''
        ) {

            die(
                "Please fill all required fields."
            );
        }


        /* ========================================
           PASSWORD HASH
        ======================================== */

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        /* ========================================
           USER DATA
        ======================================== */

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

            'password' =>
                $hashedPassword,

            'profile_image' =>
                $profile_image
        ];


        /* ========================================
           STUDENT DATA
        ======================================== */

        $studentData = [

            'school_id' =>
                $school_id,

            'admission_number' =>
                $admission_number,

            'class' =>
                $class,

            'division' =>
                $division,

            'roll_number' =>
                $roll_number,

            'date_of_birth' =>
                $date_of_birth,

            'admission_date' =>
                $admission_date,

            'parent_firstname' =>
                $parent_firstname,

            'parent_lastname' =>
                $parent_lastname,

            'parent_phone' =>
                $parent_phone,

            'parent_email' =>
                $parent_email,

            'address' =>
                $address
        ];


        /* ========================================
           CREATE STUDENT
        ======================================== */

        $studentModel =
            new StudentModel();


        $created =
            $studentModel->createStudent(
                $userData,
                $studentData
            );


        /* ========================================
           RESULT
        ======================================== */

        if (!$created) {

            die(
                "Unable to create student."
            );
        }


        /* ========================================
           SUCCESS
        ======================================== */

        header(
            "Location: "
            . ROOT
            . "/students"
        );

        exit;
    }


    /* =====================================================
       CLASS DETAILS
    ===================================================== */

    public function classDetails(
        $class = null,
        $division = null
    ) {

        /* ========================================
           START SESSION
        ======================================== */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ========================================
           CHECK LOGIN
        ======================================== */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: "
                . ROOT
                . "/login"
            );

            exit;
        }


        /* ========================================
           CHECK SCHOOL ADMIN
        ======================================== */

        if (
            ($_SESSION['rank'] ?? '')
            !== 'admin'
        ) {

            header(
                "Location: "
                . ROOT
                . "/home"
            );

            exit;
        }


        /* ========================================
           GET SCHOOL ID
        ======================================== */

        $school_id =
            $_SESSION['school_id']
            ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }


        /* ========================================
           CHECK CLASS
        ======================================== */

        if (
            $class === null ||
            $class === ''
        ) {

            header(
                "Location: "
                . ROOT
                . "/classes"
            );

            exit;
        }


        /* ========================================
           LOAD STUDENT MODEL
        ======================================== */

        $studentModel =
            new StudentModel();


        /* ========================================
           GET STUDENTS
        ======================================== */

        $students =
            $studentModel->getStudentsByClass(
                $school_id,
                $class,
                $division
            );


        /* ========================================
           LOAD VIEW
        ======================================== */

        $this->view(
            'class-details',
            [
                'students' => $students,
                'class'    => $class,
                'division' => $division
            ]
        );
    }
}