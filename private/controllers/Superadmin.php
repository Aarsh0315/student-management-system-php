<?php

class Superadmin extends Controller
{
    public function index()
    {
        /* ========================================
           START SESSION
        ======================================== */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /* ========================================
           SECURITY CHECK
        ======================================== */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }


        /* ========================================
           LOAD MODELS
        ======================================== */

        $schoolModel =
            $this->model('School');

        $userModel =
            $this->model('User');

        $studentModel =
            $this->model('StudentModel');

        $staffModel =
            $this->model('StaffModel');

        $parentModel =
            $this->model('ParentModel');

        $testModel =
            $this->model('StudentTestsModel');

        $resultModel =
            $this->model('StudentResultsModel');


        /* ========================================
           GET KPI COUNTS
        ======================================== */

        $schoolCount =
            $schoolModel->getTotalSchoolCount();

        $userCount =
            $userModel->getTotalUserCount();

        $studentCount =
            $studentModel->getTotalStudentCount();

        $staffCount =
            $staffModel->getTotalStaffCount();

        $parentCount =
            $parentModel->getTotalParentCount();

        $testCount =
            $testModel->getTotalTestCount();

        $resultCount =
            $resultModel->getTotalResultCount();


        /* ========================================
           RECENT ACTIVITY
        ======================================== */

        $recentSchools =
            $schoolModel->getRecentSchools(3);

        $recentUsers =
            $userModel->getRecentUsers(3);


        /* ========================================
           BUILD ACTIVITY LIST
        ======================================== */

        $recentActivities = [];


        /* ========================================
           RECENT SCHOOLS
        ======================================== */

        foreach ($recentSchools as $school) {

            $recentActivities[] = [

                'type' =>
                    'school',

                'initials' =>
                    'SC',

                'title' =>
                    'New school registered',

                'description' =>
                    ($school->school_name ?? 'School')
                    . ' was added to the system.',

                'time' =>
    ''

            ];
        }


        /* ========================================
   RECENT ACTIVITY
======================================== */

$recentSchools =
    $schoolModel->getRecentSchools(3);

$recentUsers =
    $userModel->getRecentUsers(3);


/* ========================================
   BUILD ACTIVITY LIST
======================================== */

$recentActivities = [];


/* ========================================
   RECENT SCHOOLS
======================================== */

foreach ($recentSchools as $school) {

    $recentActivities[] = [

        'type' =>
            'school',

        'initials' =>
            'SC',

        'title' =>
            'New school registered',

        'description' =>
            ($school->school_name ?? 'School')
            . ' was added to the system.',

        'time' =>
            'Recently'

    ];
}


/* ========================================
   RECENT USERS
======================================== */

foreach ($recentUsers as $user) {

    $name =
        trim(
            ($user->firstname ?? '')
            . ' '
            . ($user->lastname ?? '')
        );


    $recentActivities[] = [

        'type' =>
            'user',

        'initials' =>
            strtoupper(
                substr(
                    $name ?: 'US',
                    0,
                    2
                )
            ),

        'title' =>
            'New user registered',

        'description' =>
            ($name ?: 'A user')
            . ' joined as '
            . ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $user->rank ?? 'user'
                )
            )
            . '.',

        'time' =>
            'Recently'

    ];
}


/* ========================================
   SHOW LATEST 6
======================================== */

$recentActivities =
    array_slice(
        $recentActivities,
        0,
        6
    );


        /* ========================================
           DASHBOARD DATA
        ======================================== */

        $data = [

            'schoolCount' =>
                $schoolCount,

            'userCount' =>
                $userCount,

            'studentCount' =>
                $studentCount,

            'staffCount' =>
                $staffCount,

            'parentCount' =>
                $parentCount,

            'testCount' =>
                $testCount,

            'resultCount' =>
                $resultCount,

            'recentActivities' =>
                $recentActivities

        ];


        /* ========================================
           LOAD VIEW
        ======================================== */

        $this->view(
            'superadmin',
            $data
        );
    }
}