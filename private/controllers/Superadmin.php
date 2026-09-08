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
           SYSTEM COUNTS
        ======================================== */

        $schoolCount =
            $schoolModel->getTotalSchoolCount();

        $studentCount =
            $studentModel->getTotalStudentCount();

        $adminCount =
            $userModel->getTotalAdminCount();

        $parentCount =
            $parentModel->getTotalParentCount();

        


        /* ========================================
           SCHOOL OVERVIEW
        ======================================== */

        $schoolOverview =
            $schoolModel->getSchoolOverview();


        /* ========================================
           RECENT SCHOOLS
        ======================================== */

        $recentSchools =
            $schoolModel->getRecentSchools(3);


        /* ========================================
           RECENT USERS
        ======================================== */

        $recentUsers =
            $userModel->getRecentUsers(3);


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


        /* ========================================
           DASHBOARD DATA
        ======================================== */

        $data = [

            'schoolCount' =>
                $schoolCount,

            'studentCount' =>
                $studentCount,

            'adminCount' =>
                $adminCount,

            'parentCount' =>
                $parentCount,

            'schoolOverview' =>
                $schoolOverview,

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