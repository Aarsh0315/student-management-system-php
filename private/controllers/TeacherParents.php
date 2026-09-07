<?php

require_once "../private/models/StudentModel.php";

class TeacherParents extends Controller
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

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }

    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        !in_array(
            $_SESSION['rank'] ?? '',
            ['staff', 'teacher']
        )
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
    GET SCHOOL ID
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;

    if (!$school_id) {

        die(
            "No school is assigned to this teacher."
        );
    }

    /*
    ========================================
    LOAD STUDENT MODEL
    ========================================
    */

    $studentModel =
        new StudentModel();

    /*
    ========================================
    SEARCH
    ========================================
    */

    $search =
        trim($_GET['search'] ?? '');

    /*
    ========================================
    SORT
    ========================================
    */

    $sort =
        $_GET['sort'] ?? 'parent_id';

    $direction =
        strtoupper(
            $_GET['direction'] ?? 'DESC'
        );

    /*
    ========================================
    ALLOWED SORTS
    ========================================
    */

    $allowedSorts = [
        'parent_id',
        'parent_name',
        'student_name',
        'email',
        'phone',
        'status'
    ];

    if (
        !in_array(
            $sort,
            $allowedSorts,
            true
        )
    ) {

        $sort = 'parent_id';
    }

    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'DESC';
    }

    /*
    ========================================
    GET PARENTS
    ========================================
    */

    $parents =
        $studentModel->getParentsBySchool(
            $school_id,
            $search,
            $sort,
            $direction
        );

    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-parents',
        [
            'parents'   => $parents,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction
        ]
    );
}

    public function details($parent_name = null)
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
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        !in_array(
            $_SESSION['rank'] ?? '',
            ['staff', 'teacher']
        )
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
    CHECK PARENT NAME
    ========================================
    */

    if (
        $parent_name === null ||
        $parent_name === ''
    ) {

        header(
            "Location: " .
            ROOT .
            "/teacherparents"
        );

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
            "No school is assigned to this teacher."
        );
    }


    /*
    ========================================
    LOAD STUDENT MODEL
    ========================================
    */

    $studentModel =
        new StudentModel();


    /*
    ========================================
    GET PARENT DETAILS
    ========================================
    */

    $students =
        $studentModel->getParentDetailsByName(
            $parent_name,
            $school_id
        );


    /*
    ========================================
    CHECK PARENT
    ========================================
    */

    if (empty($students)) {

        die(
            "Parent not found."
        );
    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-parent-details',
        [
            'parent_name' => $parent_name,
            'students'    => $students
        ]
    );
}
}