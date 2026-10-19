
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

        $schoolModel = $this->model('School');
        $userModel = $this->model('User');

        /* ========================================
           PLATFORM COUNTS
        ======================================== */

        $totalSchools = $schoolModel->getTotalSchoolCount();
        $activeSchools = $schoolModel->getActiveSchoolCount();
        $inactiveSchools = $schoolModel->getInactiveSchoolCount();

        $attentionSchools = $schoolModel->getInactiveSchools(5);

        $totalUsers = $userModel->getTotalUserCount();
        $studentCount = $userModel->getTotalStudentCount();
        $teacherCount = $userModel->getTotalTeacherCount();
        $parentCount = $userModel->getTotalParentCount();
        $adminCount = $userModel->getTotalAdminCount();

        /* ========================================
           SCHOOL OVERVIEW
        ======================================== */

        $schoolOverview = $schoolModel->getSchoolOverview();

        if (!is_array($schoolOverview)) {
            $schoolOverview = [];
        }

        /* ========================================
           PLATFORM HEALTH
        ======================================== */

        $platformHealth = [
            'status' => $inactiveSchools > 0
                ? 'Attention Required'
                : 'Healthy',

            'activeSchools' => $activeSchools,
            'inactiveSchools' => $inactiveSchools,
            'totalUsers' => $totalUsers
        ];

        /* ========================================
           RECENT ACTIVITY DATA
        ======================================== */

        $recentSchools = $schoolModel->getRecentSchools(3);
        $recentUsers = $userModel->getRecentUsers(3);

        $recentActivities = [];

        foreach ($recentSchools as $school) {
            $recentActivities[] = [
                'type' => 'school',
                'initials' => 'SC',
                'title' => 'New school registered',
                'description' =>
                    ($school->school_name ?? 'School')
                    . ' was added to the system.',
                'time' => 'Recently'
            ];
        }

        foreach ($recentUsers as $user) {
            $name = trim(
                ($user->firstname ?? '') . ' ' .
                ($user->lastname ?? '')
            );

            $recentActivities[] = [
                'type' => 'user',
                'initials' => strtoupper(
                    substr($name ?: 'US', 0, 2)
                ),
                'title' => 'New user registered',
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
                'time' => 'Recently'
            ];
        }

        $recentActivities = array_slice(
            $recentActivities,
            0,
            6
        );

        /* ========================================
           SECURITY OVERVIEW
        ======================================== */

        $settingsModel = $this->model('SettingsModel');
        $securitySettings = $settingsModel->getAllAsArray();

        $securityOverview = [
            'superAdminOtp' =>
                ($securitySettings['super_admin_otp'] ?? '1') === '1',

            'loginProtection' =>
                ($securitySettings['login_protection'] ?? '1') === '1',

            'captchaProtection' =>
                ($securitySettings['captcha_protection'] ?? '1') === '1'
        ];

        /* ========================================
           PLATFORM GROWTH CHART DATA
        ======================================== */

        $growthData = [
            'schools' => $this->getMonthlyRegistrationData(
                'schools',
                'date_created'
            ),

            'students' => $this->getMonthlyRegistrationData(
                'students',
                'created_at'
            ),

            'users' => $this->getMonthlyRegistrationData(
                'users',
                'date'
            )
        ];

        /* ========================================
           DASHBOARD DATA
        ======================================== */

        $data = [
            'totalSchools' => $totalSchools,
            'platformHealth' => $platformHealth,
            'activeSchools' => $activeSchools,
            'inactiveSchools' => $inactiveSchools,
            'totalUsers' => $totalUsers,
            'schoolOverview' => $schoolOverview,
            'attentionSchools' => $attentionSchools,
            'recentActivities' => $recentActivities,
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'parentCount' => $parentCount,
            'adminCount' => $adminCount,
            'securityOverview' => $securityOverview,

            // New data for Platform Growth charts
            'growthData' => $growthData
        ];

        /* ========================================
           LOAD VIEW
        ======================================== */

        $this->view('superadmin', $data);
    }

    /* ========================================
       MONTHLY REGISTRATION DATA
    ======================================== */

    private function getMonthlyRegistrationData(
        $table,
        $dateColumn
    ) {
        $allowedColumns = [
            'schools' => 'date_created',
            'students' => 'created_at',
            'users' => 'date'
        ];

        if (
            !isset($allowedColumns[$table]) ||
            $allowedColumns[$table] !== $dateColumn
        ) {
            return [];
        }

        $query = "
            SELECT
                DATE_FORMAT(`{$dateColumn}`, '%Y-%m') AS month_key,
                COUNT(*) AS total
            FROM `{$table}`
            WHERE `{$dateColumn}` >= DATE_SUB(
                DATE_FORMAT(CURDATE(), '%Y-%m-01'),
                INTERVAL 11 MONTH
            )
            AND `{$dateColumn}` < DATE_ADD(
                DATE_FORMAT(CURDATE(), '%Y-%m-01'),
                INTERVAL 1 MONTH
            )
            GROUP BY DATE_FORMAT(`{$dateColumn}`, '%Y-%m')
            ORDER BY month_key ASC
        ";

        $results = $this->model('User')->query($query);

        $monthlyCounts = [];

        foreach ($results as $row) {
            $monthlyCounts[$row->month_key] = (int) $row->total;
        }

        $monthlyData = [];
        $startMonth = new DateTime('first day of this month');
        $startMonth->modify('-11 months');

        for ($i = 0; $i < 12; $i++) {
            $monthKey = $startMonth->format('Y-m');

            $monthlyData[] = [
                'month_key' => $monthKey,
                'label' => $startMonth->format('M'),
                'total' => $monthlyCounts[$monthKey] ?? 0
            ];

            $startMonth->modify('+1 month');
        }

        return $monthlyData;
    }
}
