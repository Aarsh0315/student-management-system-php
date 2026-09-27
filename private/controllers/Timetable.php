<?php

require_once "../private/models/Timetable.php";
require_once "../private/models/Subject.php";
require_once "../private/models/StaffModel.php";
require_once "../private/models/StudentModel.php";


class Timetable extends Controller
{
    /* =====================================================
       ADMIN ACCESS
    ===================================================== */

    private function checkAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if (($_SESSION['rank'] ?? '') !== 'admin') {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $school_id = $_SESSION['school_id'] ?? null;

        if (!$school_id) {
            die("No school is assigned to this account.");
        }

        return $school_id;
    }


    /* =====================================================
       TIMETABLE LIST
    ===================================================== */

    public function index()
    {
        $school_id = $this->checkAdmin();

        $timetableModel = new TimetableModel();

        $entries = $timetableModel->getAllBySchool(
            $school_id
        );

        $this->view('timetable', [
            'entries' => $entries
        ]);
    }


    /* =====================================================
       ADD TIMETABLE
    ===================================================== */

    public function add()
    {
        $school_id = $this->checkAdmin();

        $subjectModel = new Subject();
        $staffModel   = new StaffModel();
        $studentModel = new StudentModel();

        $subjects = $subjectModel->getActiveBySchool(
            $school_id
        );

        $teachers = $staffModel->getTeachersBySchool(
            $school_id
        );

        $classes = $studentModel->getClassesBySchool(
            $school_id
        );

        $this->view('timetable-add', [
            'subjects' => $subjects,
            'teachers' => $teachers,
            'classes'  => $classes,
            'error'    => ''
        ]);
    }


    /* =====================================================
       CREATE TIMETABLE
    ===================================================== */

    public function create()
    {
        $school_id = $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                "Location: " .
                ROOT .
                "/timetable/add"
            );
            exit;
        }


        /* =================================================
           CSRF
        ================================================= */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {
            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        /* =================================================
           FORM DATA
        ================================================= */

        $class = trim(
            $_POST['class'] ?? ''
        );

        $division = trim(
            $_POST['division'] ?? ''
        );

        $day = trim(
            $_POST['day'] ?? ''
        );

        $period = (int) (
            $_POST['period'] ?? 0
        );

        $subject_id = (int) (
            $_POST['subject_id'] ?? 0
        );

        $teacher_id = trim(
            $_POST['teacher_id'] ?? ''
        );

        $room = trim(
            $_POST['room'] ?? ''
        );


        /* =================================================
           VALIDATION
        ================================================= */

        $allowedDays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];


        if (
            $class === '' ||
            $division === '' ||
            $day === '' ||
            $period <= 0 ||
            $subject_id <= 0 ||
            $teacher_id === ''
        ) {
            die(
                "Please fill all required timetable fields."
            );
        }


        if (
            !in_array(
                $day,
                $allowedDays,
                true
            )
        ) {
            die("Invalid day selected.");
        }


        if ($period > 12) {
            die("Invalid period selected.");
        }


        /* =================================================
           MODEL
        ================================================= */

        $timetableModel = new TimetableModel();


        /* =================================================
           CLASS SLOT DUPLICATE
        ================================================= */

        if (
            $timetableModel->slotExists(
                $school_id,
                $class,
                $division,
                $day,
                $period
            )
        ) {
            die(
                "This class already has a timetable entry for this day and period."
            );
        }


        /* =================================================
           TEACHER CONFLICT
        ================================================= */

        if (
            $timetableModel->teacherConflict(
                $school_id,
                $teacher_id,
                $day,
                $period
            )
        ) {
            die(
                "This teacher is already assigned to another class during this period."
            );
        }


        /* =================================================
           CREATE
        ================================================= */

        $created =
            $timetableModel->createEntry(
                $school_id,
                $class,
                $division,
                $day,
                $period,
                $subject_id,
                $teacher_id,
                $room !== ''
                    ? $room
                    : null
            );


        if ($created) {

            header(
                "Location: " .
                ROOT .
                "/timetable"
            );

            exit;
        }


        die(
            "Unable to create timetable entry."
        );
    }


    /* =====================================================
       EDIT TIMETABLE
    ===================================================== */

    public function edit($id = null)
    {
        $school_id = $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {
            header(
                "Location: " .
                ROOT .
                "/timetable"
            );
            exit;
        }


        $timetableModel = new TimetableModel();

        $entry =
            $timetableModel->getById(
                $id,
                $school_id
            );


        if (!$entry) {
            die(
                "Timetable entry not found."
            );
        }


        $subjectModel = new Subject();
        $staffModel   = new StaffModel();
        $studentModel = new StudentModel();


        $subjects =
            $subjectModel->getActiveBySchool(
                $school_id
            );


        $teachers =
            $staffModel->getTeachersBySchool(
                $school_id
            );


        $classes =
            $studentModel->getClassesBySchool(
                $school_id
            );


        $this->view('timetable-edit', [
            'entry'    => $entry,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'classes'  => $classes,
            'error'    => ''
        ]);
    }


    /* =====================================================
       UPDATE TIMETABLE
    ===================================================== */

    public function update($id = null)
    {
        $school_id = $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {
            header(
                "Location: " .
                ROOT .
                "/timetable"
            );
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                "Location: " .
                ROOT .
                "/timetable/edit/" .
                urlencode($id)
            );
            exit;
        }


        /* =================================================
           CSRF
        ================================================= */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {
            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        /* =================================================
           FORM DATA
        ================================================= */

        $class = trim(
            $_POST['class'] ?? ''
        );

        $division = trim(
            $_POST['division'] ?? ''
        );

        $day = trim(
            $_POST['day'] ?? ''
        );

        $period = (int) (
            $_POST['period'] ?? 0
        );

        $subject_id = (int) (
            $_POST['subject_id'] ?? 0
        );

        $teacher_id = trim(
            $_POST['teacher_id'] ?? ''
        );

        $room = trim(
            $_POST['room'] ?? ''
        );


        /* =================================================
           VALIDATION
        ================================================= */

        $allowedDays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];


        if (
            $class === '' ||
            $division === '' ||
            $day === '' ||
            $period <= 0 ||
            $subject_id <= 0 ||
            $teacher_id === ''
        ) {
            die(
                "Please fill all required timetable fields."
            );
        }


        if (
            !in_array(
                $day,
                $allowedDays,
                true
            )
        ) {
            die("Invalid day selected.");
        }


        if ($period > 12) {
            die("Invalid period selected.");
        }


        $timetableModel = new TimetableModel();


        /* =================================================
           CLASS SLOT DUPLICATE
        ================================================= */

        if (
            $timetableModel->slotExists(
                $school_id,
                $class,
                $division,
                $day,
                $period,
                $id
            )
        ) {
            die(
                "This class already has a timetable entry for this day and period."
            );
        }


        /* =================================================
           TEACHER CONFLICT
        ================================================= */

        if (
            $timetableModel->teacherConflict(
                $school_id,
                $teacher_id,
                $day,
                $period,
                $id
            )
        ) {
            die(
                "This teacher is already assigned to another class during this period."
            );
        }


        /* =================================================
           UPDATE
        ================================================= */

        $updated =
            $timetableModel->updateEntry(
                $id,
                $school_id,
                $class,
                $division,
                $day,
                $period,
                $subject_id,
                $teacher_id,
                $room !== ''
                    ? $room
                    : null
            );


        if ($updated) {

            header(
                "Location: " .
                ROOT .
                "/timetable"
            );

            exit;
        }


        die(
            "Unable to update timetable entry."
        );
    }


    /* =====================================================
       ACTIVATE
    ===================================================== */

    public function activate($id = null)
    {
        $school_id = $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {
            header(
                "Location: " .
                ROOT .
                "/timetable"
            );
            exit;
        }


        $timetableModel = new TimetableModel();

        $timetableModel->activate(
            $id,
            $school_id
        );


        header(
            "Location: " .
            ROOT .
            "/timetable"
        );

        exit;
    }


    /* =====================================================
       DEACTIVATE
    ===================================================== */

    public function deactivate($id = null)
    {
        $school_id = $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {
            header(
                "Location: " .
                ROOT .
                "/timetable"
            );
            exit;
        }


        $timetableModel =new TimetableModel();

        $timetableModel->deactivate(
            $id,
            $school_id
        );


        header(
            "Location: " .
            ROOT .
            "/timetable"
        );

        exit;
    }


    /* =====================================================
       DELETE
    ===================================================== */

    public function delete($id = null)
    {
        $school_id = $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {
            header(
                "Location: " .
                ROOT .
                "/timetable"
            );
            exit;
        }


        $timetableModel = new TimetableModel();

        $timetableModel->deleteEntry(
            $id,
            $school_id
        );


        header(
            "Location: " .
            ROOT .
            "/timetable"
        );

        exit;
    }
}