<?php

class StudentTests extends Controller
{
    /*
    ========================================
    INDEX
    ========================================
    */

    public function index()
    {
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
                "Location: " . ROOT . "/login"
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
                "Location: " . ROOT . "/home"
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


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('StudentTestsModel');


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

            die("Student record not found.");
        }


        $student_id =
            $student->student_id;

        $class =
            $student->class;

        $division =
            $student->division;



        /*
        ========================================
        CLEAR CAMERA FLOW MARKER
        ========================================
        */

        unset($_SESSION['student_test_pending_camera']);

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
        CHECK TEST STATUS
        ========================================
        */

        foreach ($tests as $test) {

            /*
            Check final result
            */

            $test->result =
                $testModel->getStudentResult(
                    $test->test_id,
                    $student_id
                );


            /*
            Check attempt
            */

            $test->attempt =
                $testModel->getStudentAttempt(
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
                "Location: " . ROOT . "/login"
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
                "Location: " . ROOT . "/home"
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
                "Location: " . ROOT . "/studenttests"
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


        $student_id =
            $student->student_id;


        /*
        ========================================
        CHECK FINAL RESULT
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
        CHECK EXISTING RESULT
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
        MARK CAMERA FLOW AS PENDING
        ========================================

        IMPORTANT:
        Do NOT create the database attempt here.

        The student has only clicked "Start Test".
        The actual attempt is created only after
        the student successfully reaches the MCQ
        exam page.
        */

        $_SESSION['student_test_pending_camera'] =
            (string) $test_id;


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
LOAD CAMERA CHECK
========================================
*/

header(
    "Location: " .
    ROOT .
    "/studenttests/camera/" .
    urlencode($test_id)
);

exit;


        /*
        ========================================
        LOAD CAMERA CHECK
        ========================================
        */

        header(
            "Location: " .
            ROOT .
            "/studenttests/camera/" .
            urlencode($test_id)
        );

        exit;
    }


    /*
    ========================================
    CAMERA CHECK
    ========================================
    */

    public function camera($test_id = null)
    {
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
                "Location: " . ROOT . "/login"
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
                "Location: " . ROOT . "/home"
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
                'test'    => $test
            ]
        );
    }


    /*
    ========================================
    ACTUAL EXAM
    ========================================
    */

    public function exam($test_id = null)
    {
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
        CHECK FINAL RESULT
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
CHECK ATTEMPT
========================================
*/



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
                'student_id' => $student->student_id,
            ]
        );
    }


    /*
    ========================================
    SUBMIT TEST
    ========================================
    */

    public function submit($test_id = null)
    {
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
        GET ANSWERS
        ========================================
        */

        $answers =
            $_POST['answers'] ?? [];


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
                "School information not found."
            );
        }


        /*
        ========================================
        GET STUDENT
        ========================================
        */

        $studentQuery = "SELECT
                            student_id

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
                "Student record not found for this user."
            );
        }


        $student_id =
            (string) $student->student_id;


        /*
        ========================================
        VERIFY CAMERA FLOW
        ========================================

        The exam page can only be reached through
        the Start Test -> Camera flow.

        The marker is cleared after the exam attempt
        is created/reused.
        */

        if (
            (string) ($_SESSION['student_test_pending_camera'] ?? '')
            !== (string) $test_id
        ) {

            header(
                "Location: " .
                ROOT .
                "/studenttests"
            );

            exit;
        }


        /*
        ========================================
        CHECK / CREATE ATTEMPT
        ========================================
        */

        $attempt =
            $testModel->getStudentAttempt(
                $test_id,
                $student->student_id
            );


        if (!$attempt) {

            $attempt =
                $testModel->startAttempt(
                    $test_id,
                    $student->student_id
                );

        }


        if (
            !$attempt ||
            $attempt->status !== 'in_progress'
        ) {

            unset(
                $_SESSION['student_test_pending_camera']
            );

            header(
                "Location: " .
                ROOT .
                "/studenttests"
            );

            exit;
        }


        /*
        ========================================
        CLEAR CAMERA FLOW MARKER
        ========================================
        */

        unset(
            $_SESSION['student_test_pending_camera']
        );



        $attempt =
            $testModel->getStudentAttempt(
                $test_id,
                $student_id
            );


        if (!$attempt) {

            header(
                "Location: " .
                ROOT .
                "/studenttests"
            );

            exit;
        }


        /*
        ========================================
        ONLY ACTIVE ATTEMPT CAN SUBMIT
        ========================================
        */

        if (
            $attempt->status !== 'in_progress'
        ) {

            header(
                "Location: " .
                ROOT .
                "/studenttests"
            );

            exit;
        }


        /*
        ========================================
        PREVENT DUPLICATE RESULT
        ========================================
        */

        $existingResult =
            $testModel->getStudentResult(
                $test_id,
                $student_id
            );


        if ($existingResult) {

            /*
            Make sure attempt is also submitted
            */

            $testModel->submitAttempt(
                $test_id,
                $student_id
            );


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
                        school_id,
                        total_marks

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


        if (!$test) {

            die(
                "Test not found."
            );
        }


        /*
        ========================================
        GET QUESTIONS
        ========================================
        */

        $questionQuery = "SELECT
                            question_id,
                            correct_answer,
                            marks

                          FROM test_questions

                          WHERE test_id = :test_id

                          ORDER BY question_id ASC";


        $questions =
            $testModel->query(
                $questionQuery,
                [
                    'test_id' => $test_id
                ]
            );


        if (empty($questions)) {

            die(
                "This test does not contain any questions."
            );
        }


        /*
        ========================================
        CALCULATE SCORE
        ========================================
        */

        $obtained_marks = 0;


        foreach ($questions as $question) {

            $question_id =
                (string) $question->question_id;


            $student_answer =
                strtoupper(
                    trim(
                        $answers[$question_id] ?? ''
                    )
                );


            $correct_answer =
                strtoupper(
                    trim(
                        $question->correct_answer ?? ''
                    )
                );


            /*
            ========================================
            MARK CORRECT ANSWER
            ========================================
            */

            if (
                $student_answer !== '' &&
                $student_answer === $correct_answer
            ) {

                $obtained_marks +=
                    (int) (
                        $question->marks ?? 0
                    );
            }


            /*
            ========================================
            SAVE STUDENT ANSWER
            ========================================
            */

            $answerQuery = "INSERT INTO student_answers
                            (
                                test_id,
                                student_id,
                                question_id,
                                answer
                            )

                            VALUES
                            (
                                :test_id,
                                :student_id,
                                :question_id,
                                :answer
                            )

                            ON DUPLICATE KEY UPDATE
                                answer = VALUES(answer)";


            $testModel->query(
                $answerQuery,
                [
                    'test_id'     => $test_id,
                    'student_id'  => $student_id,
                    'question_id' => $question_id,
                    'answer'      => $student_answer
                ]
            );
        }


        /*
        ========================================
        TOTAL MARKS
        ========================================
        */

        $total_marks =
            (int) (
                $test->total_marks ?? 0
            );


        /*
        ========================================
        PERCENTAGE
        ========================================
        */

        $percentage = 0;


        if ($total_marks > 0) {

            $percentage =
                round(
                    (
                        $obtained_marks /
                        $total_marks
                    ) * 100,
                    2
                );
        }


        /*
        ========================================
        PASS / FAIL
        ========================================
        */

        $result_status =
            ($percentage >= 40)
            ? 'pass'
            : 'fail';


        /*
        ========================================
        GENERATE RESULT ID
        ========================================
        */

        $result_id =
            'RES' .
            strtoupper(
                bin2hex(
                    random_bytes(5)
                )
            );


        /*
        ========================================
        SAVE RESULT
        ========================================
        */

        $insertQuery = "INSERT INTO results
                        (
                            result_id,
                            test_id,
                            student_id,
                            school_id,
                            total_marks,
                            obtained_marks,
                            percentage,
                            status
                        )

                        VALUES
                        (
                            :result_id,
                            :test_id,
                            :student_id,
                            :school_id,
                            :total_marks,
                            :obtained_marks,
                            :percentage,
                            :status
                        )";


        $testModel->query(
            $insertQuery,
            [
                'result_id'      => $result_id,
                'test_id'        => $test_id,
                'student_id'     => $student_id,
                'school_id'      => $school_id,
                'total_marks'    => $total_marks,
                'obtained_marks' => $obtained_marks,
                'percentage'     => $percentage,
                'status'         => $result_status
            ]
        );


        /*
        ========================================
        MARK ATTEMPT AS SUBMITTED
        ========================================
        */

        $testModel->submitAttempt(
            $test_id,
            $student_id
        );


        /*
        ========================================
        REDIRECT
        ========================================
        */

        header(
            "Location: " .
            ROOT .
            "/studenttests"
        );

        exit;
    }
}