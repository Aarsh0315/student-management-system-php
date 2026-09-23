<?php

class Reports extends Controller
{
    public function index()
    {

    
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /* =====================================================
           SUPER ADMIN ACCESS
        ===================================================== */

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header('Location: ' . ROOT . '/home');
            exit;
        }

        /* =====================================================
        REPORT FILTERS
        ===================================================== */

        $selectedSchool = $_GET['school'] ?? '';
        $selectedStatus = $_GET['status'] ?? '';

        $allowedStatuses = [
            'active',
            'inactive'
        ];

        if (!in_array($selectedStatus, $allowedStatuses, true)) {
            $selectedStatus = '';
        }

        /* =====================================================
   EXPORT SCHOOL REPORT
===================================================== */

if (isset($_GET['export']) && $_GET['export'] === 'schools') {

    $schoolModel = $this->model('School');

    $schoolOverview = $schoolModel->getSchoolOverview();

    header('Content-Type: text/csv; charset=utf-8');
    header(
        'Content-Disposition: attachment; filename="school-report.csv"'
    );

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'School',
        'Students',
        'Staff',
        'Admin',
        'Status'
    ]);

    foreach ($schoolOverview as $school) {

        fputcsv($output, [
            $school->school_name ?? '',
            $school->student_count ?? 0,
            $school->staff_count ?? 0,
            $school->admin_count ?? 0,
            $school->status ?? ''
        ]);
    }

    fclose($output);
    exit;
}
        /* =====================================================
           LOAD MODELS
        ===================================================== */

        $schoolModel = $this->model('School');
        $userModel = $this->model('User');
        $schools = $schoolModel->getAllSchools();


        /* =====================================================
           PLATFORM REPORT DATA
        ===================================================== */

        $totalSchools =
            $schoolModel->getTotalSchoolCount();

        $activeSchools =
            $schoolModel->getActiveSchoolCount();

        $inactiveSchools =
            $schoolModel->getInactiveSchoolCount();

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

        $schoolOverview =
    $schoolModel->getSchoolOverview(
        $selectedSchool,
        $selectedStatus
    );

        


        /* =====================================================
           DATA
        ===================================================== */

        $data = [

            'totalSchools' =>
                $totalSchools,

            'activeSchools' =>
                $activeSchools,

            'inactiveSchools' =>
                $inactiveSchools,

            'totalUsers' =>
                $totalUsers,

            'studentCount' =>
                $studentCount,

            'teacherCount' =>
                $teacherCount,

            'parentCount' =>
                $parentCount,

            'adminCount' =>
                $adminCount,

            'schoolOverview' =>
                $schoolOverview,

            'schools' =>
                $schools,

            'selectedSchool' =>
                $selectedSchool,

            'selectedStatus' =>
                $selectedStatus

        ];


        /* =====================================================
           VIEW
        ===================================================== */

        $this->view('reports/index', $data);
    }
}