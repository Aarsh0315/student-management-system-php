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

        if (!in_array(
            $rank,
            ['super_admin', 'admin', 'teacher', 'student','parent'],
            true
        )) {
            header("Location: " . ROOT . "/home");
            exit;
        }
    }


    /* =====================================================
       BLOCK STUDENTS FROM WRITE ACTIONS
    ===================================================== */

   private function checkWriteAccess()
{
    $rank = $_SESSION['rank'] ?? '';

    if (in_array($rank, ['student', 'parent'], true)) {
        header("Location: " . ROOT . "/announcements");
        exit;
    }
}


    /* =====================================================
       GET SCHOOL ID
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

        $announcementModel =
            $this->model('AnnouncementModel');

        $rank = $_SESSION['rank'] ?? '';

        /*
         * Super Admin:
         * Can see announcements from all schools.
         */

        if ($rank === 'super_admin') {

            $announcements =
                $announcementModel
                    ->getAllAnnouncements();

        } else {

            /*
             * Admin, Teacher and Student:
             * Can only see announcements
             * belonging to their own school.
             */

            $school_id =
                $_SESSION['school_id'] ?? null;

            if (!$school_id) {
                die("No school is assigned to this account.");
            }

            $announcements =
                $announcementModel
                    ->getAllAnnouncements($school_id);
        }


        $data = [
            'announcements' => $announcements
        ];


        $this->view(
            'announcements/index',
            $data
        );
    }


    /* =====================================================
       CREATE
    ===================================================== */

    public function create()
    {
        $this->checkAccess();

        // Students cannot create announcements.
        $this->checkWriteAccess();

        $rank = $_SESSION['rank'] ?? '';

        $schoolModel =
            $this->model('School');

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


        $this->view(
            'announcements/create',
            $data
        );
    }


    /* =====================================================
       STORE
    ===================================================== */

    public function store()
    {
        $this->checkAccess();

        // Students cannot store announcements.
        $this->checkWriteAccess();


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: " .
                ROOT .
                "/announcements"
            );

            exit;
        }


        if (!CSRF::verify(
            $_POST['csrf_token'] ?? ''
        )) {
            die("Invalid CSRF token.");
        }


        $rank = $_SESSION['rank'] ?? '';

        $user_id =
            $_SESSION['user_id'] ?? null;


        /*
         * Admin and Teacher:
         * Always use the school assigned
         * to the logged-in account.
         */

        if (
            $rank === 'admin' ||
            $rank === 'teacher'
        ) {

            $school_id =
                $_SESSION['school_id'] ?? null;


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


        /*
         * Super Admin:
         * Can view announcements from any school.
         */

        if ($rank === 'super_admin') {

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );

        } else {

            /*
             * Admin, Teacher and Student:
             * Can only view announcements
             * from their own school.
             */

            $school_id =
                $_SESSION['school_id'] ?? null;


            if (!$school_id) {
                die("No school is assigned to this account.");
            }


            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
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

        // Students cannot edit announcements.
        $this->checkWriteAccess();


        $announcementModel =
            $this->model('AnnouncementModel');


        $rank =
            $_SESSION['rank'] ?? '';


        $schools = [];


        if ($rank === 'super_admin') {

            /*
             * Super Admin can edit announcements
             * from any school.
             */

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );


            $schoolModel =
                $this->model('School');


            $schools =
                $schoolModel->getAllSchools();

        } else {

            /*
             * Admin and Teacher:
             * Can only access announcements
             * from their own school.
             */

            $school_id =
                $_SESSION['school_id'] ?? null;


            if (!$school_id) {
                die("No school is assigned to this account.");
            }


            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
                );
        }


        if (!$announcement) {
            die("Announcement not found.");
        }


        /*
         * Teacher can edit ONLY
         * their own announcement.
         */

        if (
            $rank === 'teacher' &&
            (int) $announcement->created_by !==
            (int) $_SESSION['user_id']
        ) {
            die(
                "You are not allowed to edit this announcement."
            );
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

        // Students cannot update announcements.
        $this->checkWriteAccess();


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: " .
                ROOT .
                "/announcements"
            );

            exit;
        }


        if (!CSRF::verify(
            $_POST['csrf_token'] ?? ''
        )) {
            die("Invalid CSRF token.");
        }


        $rank =
            $_SESSION['rank'] ?? '';


        $announcementModel =
            $this->model('AnnouncementModel');


        /*
         * Super Admin:
         * Can update announcements
         * across schools.
         */

        if ($rank === 'super_admin') {

            $existing =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );


            if (!$existing) {
                die("Announcement not found.");
            }


            $school_id =
                (int) $existing->school_id;

        } else {

            /*
             * Admin and Teacher:
             * Can only update announcements
             * from their own school.
             */

            $school_id =
                $_SESSION['school_id'] ?? null;


            if (!$school_id) {
                die("No school is assigned to this account.");
            }


            $existing =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
                );


            if (!$existing) {
                die("Announcement not found.");
            }


            /*
             * Teacher can update ONLY
             * their own announcement.
             */

            if (
                $rank === 'teacher' &&
                (int) $existing->created_by !==
                (int) $_SESSION['user_id']
            ) {
                die(
                    "You are not allowed to update this announcement."
                );
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

        // Students cannot delete announcements.
        $this->checkWriteAccess();


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                "Location: " .
                ROOT .
                "/announcements"
            );

            exit;
        }


        if (!CSRF::verify(
            $_POST['csrf_token'] ?? ''
        )) {
            die("Invalid CSRF token.");
        }


        $rank =
            $_SESSION['rank'] ?? '';


        $announcementModel =
            $this->model('AnnouncementModel');


        /*
         * Super Admin:
         * Can delete announcements
         * across schools.
         */

        if ($rank === 'super_admin') {

            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id
                );


            if (!$announcement) {
                die("Announcement not found.");
            }


            $school_id =
                (int) $announcement->school_id;

        } else {

            /*
             * Admin and Teacher:
             * Can only delete announcements
             * from their own school.
             */

            $school_id =
                $_SESSION['school_id'] ?? null;


            if (!$school_id) {
                die("No school is assigned to this account.");
            }


            $announcement =
                $announcementModel->getAnnouncementById(
                    $announcement_id,
                    $school_id
                );


            if (!$announcement) {
                die("Announcement not found.");
            }


            /*
             * Teacher can delete ONLY
             * their own announcement.
             */

            if (
                $rank === 'teacher' &&
                (int) $announcement->created_by !==
                (int) $_SESSION['user_id']
            ) {
                die(
                    "You are not allowed to delete this announcement."
                );
            }
        }


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