<?php

class Announcements extends Controller
{
    /* =====================================================
       ACCESS CONTROL
    ===================================================== */

    private function checkAccess()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        $rank = $_SESSION['rank'] ?? '';

        if (!in_array($rank, ['super_admin', 'admin'], true)) {
            die("Access Denied");
        }
    }


    /* =====================================================
       GET SCHOOL ID FOR SCHOOL ADMIN
    ===================================================== */

    private function getAdminSchoolId()
    {
        return $_SESSION['school_id'] ?? null;
    }


    /* =====================================================
       INDEX
    ===================================================== */

    public function index()
    {
        $this->checkAccess();

        $announcementModel = $this->model('AnnouncementModel');

        $rank = $_SESSION['rank'] ?? '';

        if ($rank === 'admin') {

            $school_id = $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

            $announcements =
                $announcementModel
                    ->getAllAnnouncements($school_id);

        } else {

            // Super Admin can see announcements
            // from all schools.

            $announcements =
                $announcementModel
                    ->getAllAnnouncements();

        }

        $data = [
            'announcements' => $announcements
        ];

        $this->view('announcements/index', $data);
    }


    /* =====================================================
       CREATE
    ===================================================== */

    public function create()
    {
        $this->checkAccess();

        $rank = $_SESSION['rank'] ?? '';

        $schoolModel =
            $this->model('SchoolModel');

        $schools = [];

        /*
         * Super Admin needs the school list
         * because an announcement can belong
         * to any school.
         */

        if ($rank === 'super_admin') {

            $schools =
                $schoolModel->getAllSchools();

        }

        $data = [
            'schools' => $schools
        ];

        $this->view('announcements/create', $data);
    }


    /* =====================================================
       STORE
    ===================================================== */

    public function store()
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/announcements");
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid CSRF token.");
        }

        $rank = $_SESSION['rank'] ?? '';

        $user_id =
            $_SESSION['user_id'] ?? null;

        /*
         * School Admin:
         * Always use the school assigned
         * to the logged-in account.
         */

        if ($rank === 'admin') {

            $school_id =
                $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

        } else {

            /*
             * Super Admin:
             * School comes from the form.
             */

            $school_id =
                (int) ($_POST['school_id'] ?? 0);

            if ($school_id <= 0) {
                die("Please select a school.");
            }
        }


        $title =
            trim($_POST['title'] ?? '');

        $description =
            trim($_POST['description'] ?? '');

        $announcement_date =
            $_POST['announcement_date'] ?? '';

        $status =
            $_POST['status'] ?? 'active';


        /* =================================================
           VALIDATION
        ================================================= */

        if ($title === '') {
            die("Announcement title is required.");
        }

        if ($description === '') {
            die("Announcement description is required.");
        }

        if ($announcement_date === '') {
            die("Announcement date is required.");
        }

        if (!in_array(
            $status,
            ['active', 'inactive'],
            true
        )) {
            $status = 'active';
        }


        $announcementModel =
            $this->model('AnnouncementModel');


        $announcementModel->createAnnouncement([
            'school_id' =>
                $school_id,

            'title' =>
                $title,

            'description' =>
                $description,

            'announcement_date' =>
                $announcement_date,

            'status' =>
                $status,

            'created_by' =>
                $user_id
        ]);


        header(
            "Location: " .
            ROOT .
            "/announcements"
        );

        exit;
    }


    /* =====================================================
       DETAILS
    ===================================================== */

    public function details($announcement_id)
    {
        $this->checkAccess();

        $announcementModel =
            $this->model('AnnouncementModel');

        $rank =
            $_SESSION['rank'] ?? '';

        if ($rank === 'admin') {

            $school_id =
                $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
                );

        } else {

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );
        }


        if (!$announcement) {
            die("Announcement not found.");
        }


        $data = [
            'announcement' =>
                $announcement
        ];

        $this->view(
            'announcements/details',
            $data
        );
    }


    /* =====================================================
       EDIT
    ===================================================== */

    public function edit($announcement_id)
    {
        $this->checkAccess();

        $announcementModel =
            $this->model('AnnouncementModel');

        $rank =
            $_SESSION['rank'] ?? '';

        $schools = [];


        if ($rank === 'admin') {

            $school_id =
                $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
                );

        } else {

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );

            $schoolModel =
                $this->model('SchoolModel');

            $schools =
                $schoolModel->getAllSchools();
        }


        if (!$announcement) {
            die("Announcement not found.");
        }


        $data = [
            'announcement' =>
                $announcement,

            'schools' =>
                $schools
        ];


        $this->view(
            'announcements/edit',
            $data
        );
    }


    /* =====================================================
       UPDATE
    ===================================================== */

    public function update($announcement_id)
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                "Location: " .
                ROOT .
                "/announcements"
            );
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid CSRF token.");
        }

        $rank =
            $_SESSION['rank'] ?? '';


        /*
         * School Admin can only update
         * announcements belonging to
         * their own school.
         */

        if ($rank === 'admin') {

            $school_id =
                $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

        } else {

            /*
             * Super Admin can update announcements
             * across schools.
             */

            $announcementModel =
                $this->model('AnnouncementModel');

            $existing =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );

            if (!$existing) {
                die("Announcement not found.");
            }

            $school_id =
                (int) $existing->school_id;
        }


        $title =
            trim($_POST['title'] ?? '');

        $description =
            trim($_POST['description'] ?? '');

        $announcement_date =
            $_POST['announcement_date'] ?? '';

        $status =
            $_POST['status'] ?? 'active';


        if ($title === '') {
            die("Announcement title is required.");
        }

        if ($description === '') {
            die("Announcement description is required.");
        }

        if ($announcement_date === '') {
            die("Announcement date is required.");
        }

        if (!in_array(
            $status,
            ['active', 'inactive'],
            true
        )) {
            $status = 'active';
        }


        $announcementModel =
            $this->model('AnnouncementModel');


        $announcementModel->updateAnnouncement(
            $announcement_id,
            $school_id,
            [
                'title' =>
                    $title,

                'description' =>
                    $description,

                'announcement_date' =>
                    $announcement_date,

                'status' =>
                    $status
            ]
        );


        header(
            "Location: " .
            ROOT .
            "/announcements"
        );

        exit;
    }


    /* =====================================================
       DELETE
    ===================================================== */

    public function delete($announcement_id)
    {
        $this->checkAccess();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                "Location: " .
                ROOT .
                "/announcements"
            );
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid CSRF token.");
        }


        $rank =
            $_SESSION['rank'] ?? '';


        if ($rank === 'admin') {

            $school_id =
                $this->getAdminSchoolId();

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

        } else {

            /*
             * Super Admin:
             * Find the announcement's school
             * before deleting it.
             */

            $announcementModel =
                $this->model('AnnouncementModel');

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );

            if (!$announcement) {
                die("Announcement not found.");
            }

            $school_id =
                (int) $announcement->school_id;
        }


        $announcementModel =
            $this->model('AnnouncementModel');


        $announcementModel->deleteAnnouncement(
            $announcement_id,
            $school_id
        );


        header(
            "Location: " .
            ROOT .
            "/announcements"
        );

        exit;
    }
}