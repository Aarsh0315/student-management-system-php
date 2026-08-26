<?php

class StudentTests extends Controller
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
        CHECK STUDENT
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'student'
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
        GET STUDENT DETAILS
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


                    /*
            ========================================
            GET STUDENT DETAILS
            ========================================
            */

            $testModel =
                $this->model('StudentTestsModel');


            $studentQuery = "SELECT
                                student_id,
                                class,
                                division

                            FROM students

                            WHERE user_id = :user_id

                            AND school_id = :school_id

                            LIMIT 1";


            $studentResult =
                $testModel->query(
                    $studentQuery,
                    [
                        'user_id'   => $_SESSION['user_id'],
                        'school_id' => $school_id
                    ]
                );


            $student =
                $studentResult[0] ?? null;


            if (!$student) {

                die(
                    "Student record not found."
                );
            }


            $student_id =
                $student->student_id;

            $class =
                $student->class;

            $division =
                $student->division;

        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('StudentTestsModel');

                /*
        ========================================
        GET STUDENT ID
        ========================================
        */

        $studentQuery = "SELECT
                            student_id

                        FROM students

                        WHERE user_id = :user_id

                        LIMIT 1";

        $studentResult =
            $testModel->query(
                $studentQuery,
                [
                    'user_id' => $_SESSION['user_id']
                ]
            );

        $student_id =
            $studentResult[0]->student_id
            ?? null;


        if (!$student_id) {

            die(
                "Student record not found."
            );
        }


        /*
        ========================================
        GET ACTIVE TESTS
        ========================================
        */

        $tests =
            $testModel->getAvailableTests(
                $school_id,
                $class,
                $division
            );

        /*
            ========================================
            CHECK SUBMITTED TESTS
            ========================================
            */

            foreach ($tests as $test) {

                $test->result =
                    $testModel->getStudentResult(
                        $test->test_id,
                        $student_id
                    );
            }

        


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

       $this->view(
    'student-tests',
    [
        'tests'      => $tests,
        'student_id' => $student_id
    ]
        );
    }


    /*
========================================
START TEST
========================================
*/

public function start($test_id = null)
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
    CHECK STUDENT
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'student'
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
            "/studenttests"
        );

        exit;
    }


    /*
    ========================================
    GET STUDENT ID
    ========================================
    */

    $testModel =
        $this->model('StudentTestsModel');


    $studentQuery = "SELECT
                        student_id

                     FROM students

                     WHERE user_id = :user_id

                     LIMIT 1";


    $studentResult =
        $testModel->query(
            $studentQuery,
            [
                'user_id' => $_SESSION['user_id']
            ]
        );


    $student_id =
        $studentResult[0]->student_id
        ?? null;


    if (!$student_id) {

        die(
            "Student record not found."
        );
    }


    /*
    ========================================
    CHECK IF ALREADY SUBMITTED
    ========================================
    */

    $existingResult =
        $testModel->getStudentResult(
            $test_id,
            $student_id
        );


    if ($existingResult) {

        header(
            "Location: " .
            ROOT .
            "/studenttests"
        );

        exit;
    }


    /*
    ========================================
    GET TEST
    ========================================
    */

    $testQuery = "SELECT
                    test_id,
                    teacher_id,
                    school_id,
                    title,
                    description,
                    class,
                    division,
                    total_marks,
                    duration,
                    start_date,
                    end_date,
                    status

                  FROM tests

                  WHERE test_id = :test_id

                  AND school_id = :school_id

                  AND status = 'active'

                  LIMIT 1";


    $testResult =
        $testModel->query(
            $testQuery,
            [
                'test_id'   => $test_id,
                'school_id' => $_SESSION['school_id']
            ]
        );


    $test =
        $testResult[0] ?? null;


    /*
    ========================================
    TEST NOT FOUND
    ========================================
    */

    if (!$test) {

        die(
            "Test not found or is not available."
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
    LOAD START TEST VIEW
    ========================================
    */

    $this->view(
        'student-test-start',
        [
            'test'       => $test,
            'questions'  => $questions,
            'student_id' => $student_id
        ]
    );
}

/*
========================================
CAMERA CHECK
========================================
*/

public function camera($test_id = null)
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
    CHECK STUDENT
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'student'
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
            "/studenttests"
        );

        exit;
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('StudentTestsModel');


    /*
    ========================================
    CHECK SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this student."
        );
    }


    /*
    ========================================
    GET TEST
    ========================================
    */

    $testQuery = "SELECT
                    test_id,
                    title,
                    description,
                    class,
                    division,
                    total_marks,
                    duration,
                    start_date,
                    end_date,
                    status

                  FROM tests

                  WHERE test_id = :test_id

                  AND school_id = :school_id

                  AND status = 'active'

                  LIMIT 1";


    $testResult =
        $testModel->query(
            $testQuery,
            [
                'test_id'   => $test_id,
                'school_id' => $school_id
            ]
        );


    $test =
        $testResult[0] ?? null;


    /*
    ========================================
    TEST NOT FOUND
    ========================================
    */

    if (!$test) {

        die(
            "Test not found or is not available."
        );
    }


    /*
    ========================================
    LOAD CAMERA VIEW
    ========================================
    */

    $this->view(
        'student-test-camera',
        [
            'test' => $test
        ]
    );
}

/*
========================================
START ACTUAL EXAM
========================================
*/

public function exam($test_id = null)
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
    CHECK STUDENT
    ========================================
    */

    if (
        ($_SESSION['rank'] ?? '') !== 'student'
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
            "/studenttests"
        );

        exit;
    }


    /*
    ========================================
    LOAD MODEL
    ========================================
    */

    $testModel =
        $this->model('StudentTestsModel');


    /*
    ========================================
    GET SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {

        die(
            "No school is assigned to this student."
        );
    }


    /*
    ========================================
    GET STUDENT
    ========================================
    */

    $studentQuery = "SELECT
                        student_id,
                        class,
                        division

                     FROM students

                     WHERE user_id = :user_id

                     AND school_id = :school_id

                     LIMIT 1";


    $studentResult =
        $testModel->query(
            $studentQuery,
            [
                'user_id'   => $_SESSION['user_id'],
                'school_id' => $school_id
            ]
        );


    $student =
        $studentResult[0] ?? null;


    if (!$student) {

        die(
            "Student record not found."
        );
    }


    /*
    ========================================
    CHECK PREVIOUS RESULT
    ========================================
    */

    $existingResult =
        $testModel->getStudentResult(
            $test_id,
            $student->student_id
        );


    if ($existingResult) {

        header(
            "Location: " .
            ROOT .
            "/studenttests"
        );

        exit;
    }


    /*
    ========================================
    GET TEST
    ========================================
    */

    $testQuery = "SELECT
                    test_id,
                    title,
                    description,
                    class,
                    division,
                    total_marks,
                    duration,
                    start_date,
                    end_date,
                    status

                  FROM tests

                  WHERE test_id = :test_id

                  AND school_id = :school_id

                  AND class = :class

                  AND division = :division

                  AND status = 'active'

                  LIMIT 1";


    $testResult =
        $testModel->query(
            $testQuery,
            [
                'test_id'   => $test_id,
                'school_id' => $school_id,
                'class'     => $student->class,
                'division'  => $student->division
            ]
        );


    $test =
        $testResult[0] ?? null;


    if (!$test) {

        die(
            "Test is not available for your class."
        );
    }


    /*
    ========================================
    GET QUESTIONS
    ========================================
    */

    $questions =
        $testModel->getQuestionsByTest(
            $test_id
        );


    if (empty($questions)) {

        die(
            "This test does not contain any questions yet."
        );
    }


    /*
    ========================================
    LOAD EXAM VIEW
    ========================================
    */

    $this->view(
        'student-test-exam',
        [
            'test'       => $test,
            'questions'  => $questions,
            'student_id' => $student->student_id
        ]
    );
}
}