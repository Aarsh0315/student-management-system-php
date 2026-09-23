<?php

class Subjects extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId = $_SESSION['school_id'] ?? null;

        if (!$schoolId) {
            die('School information not found.');
        }

        $subjectModel = $this->model('Subject');

        $subjects = $subjectModel->getAllBySchool(
            $schoolId
        );

        $this->view(
            'subjects',
            [
                'subjects' => $subjects
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Subject
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId = $_SESSION['school_id'] ?? null;

        if (!$schoolId) {
            die('School information not found.');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $name =
            trim(
                $_POST['name'] ?? ''
            );

        $code =
            trim(
                $_POST['code'] ?? ''
            );

        $description =
            trim(
                $_POST['description'] ?? ''
            );

        if ($name === '') {
            $_SESSION['subject_error'] =
                'Subject name is required.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $subjectModel =
            $this->model('Subject');

        if (
            $code !== '' &&
            $subjectModel->codeExists(
                $schoolId,
                $code
            )
        ) {
            $_SESSION['subject_error'] =
                'This subject code already exists.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $subjectModel->create([
            'school_id' => $schoolId,
            'name' => $name,
            'code' => $code !== ''
                ? $code
                : null,
            'description' =>
                $description !== ''
                    ? $description
                    : null,
            'status' => 1
        ]);

        $_SESSION['subject_success'] =
            'Subject created successfully.';

        header(
            'Location: ' .
            ROOT .
            '/subjects'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Update Subject
    |--------------------------------------------------------------------------
    */

    public function update($id = null)
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId =
            $_SESSION['school_id'] ?? null;

        if (!$schoolId || !$id) {
            die('Invalid subject request.');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $name =
            trim(
                $_POST['name'] ?? ''
            );

        $code =
            trim(
                $_POST['code'] ?? ''
            );

        $description =
            trim(
                $_POST['description'] ?? ''
            );

        $status =
            isset($_POST['status'])
                ? (int) $_POST['status']
                : 1;

        if ($name === '') {
            $_SESSION['subject_error'] =
                'Subject name is required.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $subjectModel =
            $this->model('Subject');

        $subject =
            $subjectModel->getById(
                $id,
                $schoolId
            );

        if (!$subject) {
            $_SESSION['subject_error'] =
                'Subject not found.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        if (
            $code !== '' &&
            $subjectModel->codeExists(
                $schoolId,
                $code,
                $id
            )
        ) {
            $_SESSION['subject_error'] =
                'This subject code already exists.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $subjectModel->updateSubject(
            $id,
            $schoolId,
            [
                'name' => $name,
                'code' => $code !== ''
                    ? $code
                    : null,
                'description' =>
                    $description !== ''
                        ? $description
                        : null,
                'status' =>
                    $status === 1
                        ? 1
                        : 0
            ]
        );

        $_SESSION['subject_success'] =
            'Subject updated successfully.';

        header(
            'Location: ' .
            ROOT .
            '/subjects'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Activate Subject
    |--------------------------------------------------------------------------
    */

    public function activate($id = null)
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId =
            $_SESSION['school_id'] ?? null;

        if (!$schoolId || !$id) {
            die('Invalid subject request.');
        }

        $subjectModel =
            $this->model('Subject');

        $subjectModel->activate(
            $id,
            $schoolId
        );

        $_SESSION['subject_success'] =
            'Subject activated successfully.';

        header(
            'Location: ' .
            ROOT .
            '/subjects'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Deactivate Subject
    |--------------------------------------------------------------------------
    */

    public function deactivate($id = null)
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId =
            $_SESSION['school_id'] ?? null;

        if (!$schoolId || !$id) {
            die('Invalid subject request.');
        }

        $subjectModel =
            $this->model('Subject');

        $subjectModel->deactivate(
            $id,
            $schoolId
        );

        $_SESSION['subject_success'] =
            'Subject deactivated successfully.';

        header(
            'Location: ' .
            ROOT .
            '/subjects'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Subject
    |--------------------------------------------------------------------------
    */

    public function delete($id = null)
    {
        $this->requireLogin();
        $this->requireRole('admin');

        $schoolId =
            $_SESSION['school_id'] ?? null;

        if (!$schoolId || !$id) {
            die('Invalid subject request.');
        }

        $subjectModel =
            $this->model('Subject');

        $subject =
            $subjectModel->getById(
                $id,
                $schoolId
            );

        if (!$subject) {
            $_SESSION['subject_error'] =
                'Subject not found.';

            header(
                'Location: ' .
                ROOT .
                '/subjects'
            );

            exit;
        }

        $subjectModel->delete(
            $id,
            $schoolId
        );

        $_SESSION['subject_success'] =
            'Subject deleted successfully.';

        header(
            'Location: ' .
            ROOT .
            '/subjects'
        );

        exit;
    }
}