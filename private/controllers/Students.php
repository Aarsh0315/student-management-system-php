<?php

require_once "../private/models/StudentModel.php";

class Students extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only Super Admin
        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $studentModel = new StudentModel();

        $students = $studentModel->getAllStudents();

        $this->view('students', [
            'students' => $students
        ]);
    }

	public function details($student_id = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Only Super Admin
    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }

    // Student ID missing
    if ($student_id === null || $student_id === '') {
        header("Location: " . ROOT . "/students");
        exit;
    }

    $studentModel = new StudentModel();

    // Get selected student
    $studentData =
        $studentModel->getStudentDetails(
            $student_id
        );

    if (!$studentData) {
        die(
            "Student not found. Student ID: "
            . htmlspecialchars($student_id)
        );
    }

    $this->view('student-details', [
        'student' => $studentData
    ]);
}

public function add()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Only Super Admin
    if (
        !isset($_SESSION['rank']) ||
        $_SESSION['rank'] !== 'super_admin'
    ) {
        header("Location: " . ROOT . "/home");
        exit;
    }

    $this->view('student-add');
}
}