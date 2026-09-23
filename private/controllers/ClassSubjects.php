<?php

require_once "../private/models/ClassSubject.php";
require_once "../private/models/Subject.php";
require_once "../private/models/StaffModel.php";
require_once "../private/models/StudentModel.php";

class ClassSubjects extends Controller
{
    /*
    =====================================================
    SCHOOL ADMIN ACCESS
    =====================================================
    */

    private function checkAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }

        if (
            ($_SESSION['rank'] ?? '') !== 'admin'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }

        $school_id =
            $_SESSION['school_id'] ?? null;

        if (!$school_id) {

            die(
                "No school is assigned to this account."
            );
        }

        return $school_id;
    }


    /*
    =====================================================
    LIST ASSIGNMENTS
    =====================================================
    */

    public function index()
    {
        $school_id =
            $this->checkAdmin();

        $classSubjectModel =
            new ClassSubject();

        $assignments =
            $classSubjectModel->getAllBySchool(
                $school_id
            );

        $this->view(
            'class-subjects',
            [
                'assignments' => $assignments
            ]
        );
    }


    /*
    =====================================================
    ADD ASSIGNMENT FORM
    =====================================================
    */

    public function add()
    {
        $school_id =
            $this->checkAdmin();

        $subjectModel =
            new Subject();

        $staffModel =
            new StaffModel();

        $studentModel =
            new StudentModel();

        /*
        -----------------------------------------
        GET SUBJECTS
        -----------------------------------------
        */

        $subjects =
            $subjectModel->getActiveBySchool(
                $school_id
            );

        /*
        -----------------------------------------
        GET TEACHERS
        -----------------------------------------
        */

        $teachers =
            $staffModel->getTeachersBySchool(
                $school_id
            );

        /*
        -----------------------------------------
        GET CLASSES
        -----------------------------------------
        */

        $classes =
            $studentModel->getClassesBySchool(
                $school_id
            );

        $this->view(
            'class-subject-add',
            [
                'subjects' => $subjects,
                'teachers' => $teachers,
                'classes'  => $classes
            ]
        );
    }


    /*
    =====================================================
    CREATE ASSIGNMENT
    =====================================================
    */

    public function create()
    {
        $school_id =
            $this->checkAdmin();

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST'
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects/add"
            );

            exit;
        }

        /*
        -----------------------------------------
        CSRF
        -----------------------------------------
        */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }

        /*
        -----------------------------------------
        FORM DATA
        -----------------------------------------
        */

        $class =
            trim(
                $_POST['class'] ?? ''
            );

        $division =
            trim(
                $_POST['division'] ?? ''
            );

        $subject_id =
            (int) (
                $_POST['subject_id'] ?? 0
            );

        $teacher_id =
            trim(
                $_POST['teacher_id'] ?? ''
            );


        /*
        -----------------------------------------
        VALIDATION
        -----------------------------------------
        */

        if (
            $class === '' ||
            $division === '' ||
            $subject_id <= 0 ||
            $teacher_id === ''
        ) {

            die(
                "Please select class, division, subject and teacher."
            );
        }


        $classSubjectModel =
            new ClassSubject();


        /*
        -----------------------------------------
        CHECK DUPLICATE
        -----------------------------------------
        */

        if (
            $classSubjectModel->assignmentExists(
                $school_id,
                $class,
                $division,
                $subject_id
            )
        ) {

            die(
                "This subject is already assigned to this class and division."
            );
        }


        /*
        -----------------------------------------
        CREATE
        -----------------------------------------
        */

        $created =
            $classSubjectModel->createAssignment(
                $school_id,
                $class,
                $division,
                $subject_id,
                $teacher_id
            );


        if (!$created) {

            die(
                "Unable to create class subject assignment."
            );
        }


        /*
        -----------------------------------------
        SUCCESS
        -----------------------------------------
        */

        header(
            "Location: " .
            ROOT .
            "/classsubjects"
        );

        exit;
    }


    /*
    =====================================================
    EDIT ASSIGNMENT
    =====================================================
    */

    public function edit($id = null)
    {
        $school_id =
            $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }

        $classSubjectModel =
            new ClassSubject();

        $subjectModel =
            new Subject();

        $staffModel =
            new StaffModel();

        $studentModel =
            new StudentModel();


        /*
        -----------------------------------------
        GET ASSIGNMENT
        -----------------------------------------
        */

        $assignment =
            $classSubjectModel->getById(
                $id,
                $school_id
            );

        if (!$assignment) {

            die(
                "Assignment not found or you do not have permission to edit it."
            );
        }


        /*
        -----------------------------------------
        GET FORM DATA
        -----------------------------------------
        */

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


        $this->view(
            'class-subject-edit',
            [
                'assignment' => $assignment,
                'subjects'   => $subjects,
                'teachers'   => $teachers,
                'classes'    => $classes
            ]
        );
    }


    /*
    =====================================================
    UPDATE ASSIGNMENT
    =====================================================
    */

    public function update($id = null)
    {
        $school_id =
            $this->checkAdmin();

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST'
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }

        if (
            $id === null ||
            $id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }


        $class =
            trim(
                $_POST['class'] ?? ''
            );

        $division =
            trim(
                $_POST['division'] ?? ''
            );

        $subject_id =
            (int) (
                $_POST['subject_id'] ?? 0
            );

        $teacher_id =
            trim(
                $_POST['teacher_id'] ?? ''
            );


        if (
            $class === '' ||
            $division === '' ||
            $subject_id <= 0 ||
            $teacher_id === ''
        ) {

            die(
                "Please select class, division, subject and teacher."
            );
        }


        $classSubjectModel =
            new ClassSubject();


        /*
        -----------------------------------------
        CHECK ASSIGNMENT EXISTS
        -----------------------------------------
        */

        $current =
            $classSubjectModel->getById(
                $id,
                $school_id
            );

        if (!$current) {

            die(
                "Assignment not found."
            );
        }


        /*
        -----------------------------------------
        CHECK DUPLICATE
        -----------------------------------------
        */

        if (
            $classSubjectModel->assignmentExists(
                $school_id,
                $class,
                $division,
                $subject_id,
                $id
            )
        ) {

            die(
                "This subject is already assigned to this class and division."
            );
        }


        /*
        -----------------------------------------
        UPDATE
        -----------------------------------------
        */

        $updated =
            $classSubjectModel->updateAssignment(
                $id,
                $school_id,
                $class,
                $division,
                $subject_id,
                $teacher_id
            );


        if (!$updated) {

            die(
                "Unable to update assignment."
            );
        }


        header(
            "Location: " .
            ROOT .
            "/classsubjects"
        );

        exit;
    }


    /*
    =====================================================
    ACTIVATE
    =====================================================
    */

    public function activate($id = null)
    {
        $school_id =
            $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }

        $model =
            new ClassSubject();

        $model->activate(
            $id,
            $school_id
        );

        header(
            "Location: " .
            ROOT .
            "/classsubjects"
        );

        exit;
    }


    /*
    =====================================================
    DEACTIVATE
    =====================================================
    */

    public function deactivate($id = null)
    {
        $school_id =
            $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }

        $model =
            new ClassSubject();

        $model->deactivate(
            $id,
            $school_id
        );

        header(
            "Location: " .
            ROOT .
            "/classsubjects"
        );

        exit;
    }


    /*
    =====================================================
    DELETE
    =====================================================
    */

    public function delete($id = null)
    {
        $school_id =
            $this->checkAdmin();

        if (
            $id === null ||
            $id === ''
        ) {

            header(
                "Location: " .
                ROOT .
                "/classsubjects"
            );

            exit;
        }

        $model =
            new ClassSubject();

        $model->deleteAssignment(
            $id,
            $school_id
        );

        header(
            "Location: " .
            ROOT .
            "/classsubjects"
        );

        exit;
    }
}