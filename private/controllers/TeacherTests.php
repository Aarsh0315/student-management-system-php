<?php

class TeacherTests extends Controller
{
    public function index()
    {
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        CHECK LOGIN
        ========================================
        */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        CHECK TEACHER
        ========================================
        */

        if (
            !in_array(
                $_SESSION['rank'] ?? '',
                ['teacher', 'staff']
            )
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        GET SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this teacher."
            );
        }


        /*
        ========================================
        TEMPORARY TEST DATA
        ========================================
        
        We will connect the database
        after the page structure works.
        */

        $testModel =
    $this->model('TeacherTestsModel');

        $tests =
            $testModel->getTestsBySchool(
                $school_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-tests',
            [
                'tests' => $tests
            ]
        );
    }

    public function create()
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }

    


    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'teacher'
    ) {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this teacher."
        );
    }


    /*
    ========================================
    GET TEACHER ID
    ========================================
    */

    $teacher_id =
        $_SESSION['user_id'] ?? null;


    /*
    ========================================
    HANDLE FORM SUBMISSION
    ========================================
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token. Please refresh the page and try again.");
        }  


        /*
        ====================================
        GET FORM DATA
        ====================================
        */

        $title =
            trim($_POST['title'] ?? '');

        $description =
            trim($_POST['description'] ?? '');

        $class =
            trim($_POST['class'] ?? '');

        $division =
            trim($_POST['division'] ?? '');

        $total_marks =
            (int) ($_POST['total_marks'] ?? 0);

        $duration =
            (int) ($_POST['duration'] ?? 0);

        $start_date =
            !empty($_POST['start_date'])
                ? $_POST['start_date']
                : null;

        $end_date =
            !empty($_POST['end_date'])
                ? $_POST['end_date']
                : null;


        /*
        ====================================
        VALIDATION
        ====================================
        */

        if (
            $title === '' ||
            $class === '' ||
            $division === '' ||
            $total_marks <= 0 ||
            $duration <= 0
        ) {

            die(
                "Please fill all required fields correctly."
            );
        }


        /*
        ====================================
        GENERATE TEST ID
        ====================================
        */

        $test_id =
            'TEST' .
            strtoupper(
                substr(
                    md5(
                        uniqid(
                            mt_rand(),
                            true
                        )
                    ),
                    0,
                    8
                )
            );


        /*
        ====================================
        LOAD MODEL
        ====================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ====================================
        PREPARE DATA
        ====================================
        */

        $testData = [

            'test_id' =>
                $test_id,

            'teacher_id' =>
                $teacher_id,

            'school_id' =>
                $school_id,

            'title' =>
                $title,

            'description' =>
                $description,

            'class' =>
                $class,

            'division' =>
                $division,

            'total_marks' =>
                $total_marks,

            'duration' =>
                $duration,

            'start_date' =>
                $start_date,

            'end_date' =>
                $end_date
        ];


        /*
        ====================================
        CREATE TEST
        ====================================
        */

        $created =
            $testModel->createTest(
                $testData
            );


        /*
        ====================================
        CHECK RESULT
        ====================================
        */

        if (!$created) {

            die(
                "Failed to create test."
            );
        }


        /*
        ====================================
        REDIRECT
        ====================================
        */

        header(
            "Location: " .
            ROOT .
            "/teachertests"
        );

        exit;
    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-test-create',
        [
            'school_id' => $school_id
        ]
    );
}

public function details($test_id = null)
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'teacher'
    ) {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEST ID
    ========================================
    */

    if (!$test_id) {

        header(
            "Location: " .
            ROOT .
            "/teachertests"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this teacher."
        );
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    GET TEST
    ========================================
    */

    $test =
        $testModel->getTestById(
            $test_id,
            $school_id
        );


    /*
    ========================================
    TEST NOT FOUND
    ========================================
    */

    if (!$test) {

        die(
            "Test not found."
        );
    }


    /*
    ========================================
    LOAD QUESTIONS
    ========================================
    */

    $questions =
        $testModel->getQuestionsByTest(
            $test_id
        );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-test-details',
        [
            'test'      => $test,
            'questions' => $questions
        ]
    );
}

public function addquestion($test_id = null)
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

        header(
            "Location: " .
            ROOT .
            "/login"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'teacher'
    ) {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEST ID
    ========================================
    */

    if (!$test_id) {

        header(
            "Location: " .
            ROOT .
            "/teachertests"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this teacher."
        );
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    CHECK TEST
    ========================================
    */

    $test =
        $testModel->getTestById(
            $test_id,
            $school_id
        );


    if (!$test) {

        die(
            "Test not found."
        );
    }


    /*
    ========================================
    HANDLE FORM
    ========================================
    */

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
        die("Invalid security token. Please refresh the page and try again.");
    }


        /*
        ====================================
        GET DATA
        ====================================
        */

        $question =
            trim(
                $_POST['question'] ?? ''
            );

        $option_a =
            trim(
                $_POST['option_a'] ?? ''
            );

        $option_b =
            trim(
                $_POST['option_b'] ?? ''
            );

        $option_c =
            trim(
                $_POST['option_c'] ?? ''
            );

        $option_d =
            trim(
                $_POST['option_d'] ?? ''
            );

        $correct_answer =
            trim(
                $_POST['correct_answer'] ?? ''
            );

        $marks =
            (int) (
                $_POST['marks'] ?? 0
            );


        /*
        ====================================
        VALIDATION
        ====================================
        */

        if (
            $question === '' ||
            $option_a === '' ||
            $option_b === '' ||
            $option_c === '' ||
            $option_d === '' ||
            !in_array(
                $correct_answer,
                ['A', 'B', 'C', 'D']
            ) ||
            $marks <= 0
        ) {

            die(
                "Please fill all question fields correctly."
            );
        }


        /*
        ====================================
        GENERATE QUESTION ID
        ====================================
        */

        $question_id =
            'Q' .
            strtoupper(
                substr(
                    md5(
                        uniqid(
                            mt_rand(),
                            true
                        )
                    ),
                    0,
                    8
                )
            );


        /*
        ====================================
        ADD QUESTION
        ====================================
        */

        $created =
            $testModel->createQuestion(
                [
                    'question_id' =>
                        $question_id,

                    'test_id' =>
                        $test_id,

                    'question' =>
                        $question,

                    'question_type' =>
                        'mcq',

                    'option_a' =>
                        $option_a,

                    'option_b' =>
                        $option_b,

                    'option_c' =>
                        $option_c,

                    'option_d' =>
                        $option_d,

                    'correct_answer' =>
                        $correct_answer,

                    'marks' =>
                        $marks
                ]
            );


        /*
        ====================================
        CHECK RESULT
        ====================================
        */

        if (!$created) {

            die(
                "Failed to create question."
            );
        }


        /*
        ====================================
        REDIRECT
        ====================================
        */

        header(
            "Location: " .
            ROOT .
            "/teachertests/details/" .
            urlencode($test_id)
        );

        exit;
    }


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'teacher-test-addquestion',
        [
            'test' => $test
        ]
    );
}

public function publish($test_id = null)
{
    /*
    ========================================
    START SESSION
    ========================================
    */

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (!isset($_SESSION['user_id'])) {

    header(
        "Location: " .
        ROOT .
        "/login"
    );

    exit;
}


/*
========================================
CHECK POST REQUEST
========================================
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        "Location: " .
        ROOT .
        "/teachertests"
    );

    exit;
}


/*
========================================
CHECK CSRF TOKEN
========================================
*/

if (!CSRF::verify($_POST['csrf_token'] ?? '')) {

    die(
        "Invalid security token. Please refresh the page and try again."
    );

}


    /*
    ========================================
    CHECK TEACHER
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'teacher'
    ) {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEST ID
    ========================================
    */

    if (!$test_id) {

        header(
            "Location: " .
            ROOT .
            "/teachertests"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this teacher."
        );
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    CHECK TEST
    ========================================
    */

    $test =
        $testModel->getTestById(
            $test_id,
            $school_id
        );


    if (!$test) {

        die(
            "Test not found."
        );
    }


    /*
    ========================================
    CHECK STATUS
    ========================================
    */

    if (
        ($test->status ?? '') !== 'draft'
    ) {

        die(
            "This test has already been published or closed."
        );
    }


    /*
    ========================================
    CHECK QUESTIONS
    ========================================
    */

    $questions =
        $testModel->getQuestionsByTest(
            $test_id
        );


    if (empty($questions)) {

        die(
            "You cannot publish a test without questions."
        );
    }


    /*
    ========================================
    CALCULATE QUESTION MARKS
    ========================================
    */

    $questionMarks = 0;

    foreach ($questions as $question) {

        $questionMarks +=
            (int) (
                $question->marks ?? 0
            );
    }


    /*
    ========================================
    CHECK TOTAL MARKS
    ========================================
    */

    if (
        $questionMarks !=
        (int) $test->total_marks
    ) {

        die(
            "Question marks must equal the test total marks before publishing."
        );
    }


    /*
    ========================================
    PUBLISH TEST
    ========================================
    */

    $updated =
        $testModel->publishTest(
            $test_id,
            $school_id
        );


    if (!$updated) {

        die(
            "Failed to publish test."
        );
    }

   /*
=====================================================
CREATE STUDENT NOTIFICATIONS
=====================================================
*/

$notificationModel = $this->model('NotificationModel');


/*
=====================================================
GET STUDENTS FOR TEST
=====================================================
*/

$studentQuery = "SELECT
                    s.user_id
                 FROM students s
                 WHERE s.school_id = :school_id
                 AND s.class = :class
                 AND s.division = :division";

$students = $testModel->query(
    $studentQuery,
    [
        'school_id' => $school_id,
        'class'     => $test->class,
        'division'  => $test->division
    ]
);


/*
=====================================================
CREATE NOTIFICATION FOR EACH STUDENT
=====================================================
*/

foreach ($students as $student) {

    if (empty($student->user_id)) {
        continue;
    }

    $notificationModel->createNotification(
        $student->user_id,
        $school_id,
        'New Test Available',
        'A new test "' . $test->title . '" has been published for your class. You can now view and take the test.',
        'test',
        $test_id
    );
}


/*
=====================================================
REDIRECT
=====================================================
*/

header(
    "Location: " .
    ROOT .
    "/teachertests/details/" .
    urlencode($test_id)
);

exit;

}
}