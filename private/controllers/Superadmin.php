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

        $parentModel =
            $this->model('ParentModel');


       /* ========================================
   PLATFORM COUNTS
======================================== */

$totalSchools =
    $schoolModel->getTotalSchoolCount();

$activeSchools =
    $schoolModel->getActiveSchoolCount();

$inactiveSchools =
    $schoolModel->getInactiveSchoolCount();

/* =====================================================
   SCHOOLS REQUIRING ATTENTION
===================================================== */

$attentionSchools = $schoolModel->getInactiveSchools(5);

$totalUsers =
    $userModel->getTotalUserCount();

$studentCount =
    $userModel->getTotalStudentCount();

$teacherCount =
    $userModel->getTotalTeacherCount();

$parentCount =
    $userModel->getTotalParentCount();

$adminCount =
    $userModel->getTotalAdminCount();

$schoolOverview = $schoolModel->getSchoolOverview();

    /* =====================================================
   PLATFORM HEALTH
===================================================== */

$platformHealth = [
    'status' => $inactiveSchools > 0
        ? 'Attention Required'
        : 'Healthy',

    'activeSchools' => $activeSchools,
    'inactiveSchools' => $inactiveSchools,
    'totalUsers' => $totalUsers
];

/* =====================================================
   SECURITY OVERVIEW
===================================================== */

$securityOverview = [
    'superAdminOtp' => true,
    'loginProtection' => true,
    'captchaProtection' => true
];

        /* =====================================================
   SCHOOL OVERVIEW
===================================================== */

$schoolOverview = $schoolModel->getSchoolOverview();

if (!is_array($schoolOverview)) {
    $schoolOverview = [];
}


/* =====================================================
   RECENT ACTIVITY DATA
===================================================== */

$recentSchools = $schoolModel->getRecentSchools(3);
$recentUsers = $userModel->getRecentUsers(3);


        /* ========================================
           BUILD RECENT ACTIVITY
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

            /*
|--------------------------------------------------------------------------
| SECURITY OVERVIEW
|--------------------------------------------------------------------------
*/

$settingsModel = $this->model('SettingsModel');

$securitySettings =
    $settingsModel->getAllAsArray();

$securityOverview = [
    'superAdminOtp' =>
        ($securitySettings['super_admin_otp'] ?? '1') === '1',

    'loginProtection' =>
        ($securitySettings['login_protection'] ?? '1') === '1',

    'captchaProtection' =>
        ($securitySettings['captcha_protection'] ?? '1') === '1'
];


        /* ========================================
   DASHBOARD DATA
======================================== */

$data = [

    'totalSchools' =>
        $totalSchools,

    'platformHealth' => 
        $platformHealth,

    'activeSchools' =>
        $activeSchools,

    'inactiveSchools' =>
        $inactiveSchools,

    'totalUsers' =>
        $totalUsers,

    'schoolOverview' =>
        $schoolOverview,
    
    'attentionSchools' => 
        $attentionSchools,

    'recentActivities' =>
        $recentActivities,

    'studentCount' =>
        $studentCount,

    'teacherCount' =>
        $teacherCount,

    'parentCount' =>
        $parentCount,

    'securityOverview' => 
        $securityOverview,

    'adminCount' =>
        $adminCount,
    
    'schoolOverview' => 
        $schoolOverview,

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