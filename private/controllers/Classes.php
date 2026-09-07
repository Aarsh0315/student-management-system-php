<?php

require_once "../private/models/StudentModel.php";


class Classes extends Controller
{
    /*
    ========================================
    CLASSES LIST
    ========================================
    */

   public function index()
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
    GET ROLE
    ========================================
    */

    $rank =
        $_SESSION['rank'] ?? '';


    /*
    ========================================
    CHECK ROLE
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
    LOAD STUDENT MODEL
    ========================================
    */

    $studentModel =
        new StudentModel();


    /*
    ========================================
    GET SEARCH + SORT
    ========================================
    */

    $search =
        trim($_GET['search'] ?? '');

    $sort =
        $_GET['sort'] ?? 'class';

    $direction = strtoupper(
        $_GET['direction'] ?? 'ASC'
    );


    /*
    ========================================
    ALLOWED SORTS
    ========================================
    */

    $allowedSorts = [
        'class',
        'division',
        'students',
        'status'
    ];


    /*
    ========================================
    VALIDATE SORT
    ========================================
    */

    if (!in_array(
        $sort,
        $allowedSorts,
        true
    )) {

        $sort = 'class';
    }


    /*
    ========================================
    VALIDATE DIRECTION
    ========================================
    */

    if (!in_array(
        $direction,
        ['ASC', 'DESC'],
        true
    )) {

        $direction = 'ASC';
    }


    /*
    ========================================
    SUPER ADMIN
    ========================================
    */

    if ($rank === 'super_admin') {

        /*
        Get classes from ALL schools
        */

        $classes =
            $studentModel->getAllClasses(
                $search,
                $sort,
                $direction
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


        /*
        Get classes ONLY
        from this school
        */

        $classes =
            $studentModel->getClassesBySchool(
                $school_id,
                $search,
                $sort,
                $direction
            );

    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'classes',
        [
            'classes'   => $classes,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction
        ]
    );
}
}