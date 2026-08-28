<?php

require_once "../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

class StudentResults extends Controller
{
    /*
    ========================================
    STUDENT RESULTS
    ========================================
    */

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
        GET SCHOOL ID
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
        LOAD MODEL
        ========================================
        */

        $resultModel =
            $this->model(
                'StudentResultsModel'
            );


        /*
        ========================================
        FIND ACTUAL STUDENT RECORD
        ========================================
        */

        $studentQuery = "SELECT
                            student_id

                         FROM students

                         WHERE user_id = :user_id

                         AND school_id = :school_id

                         LIMIT 1";


        $studentResult =
            $resultModel->query(
                $studentQuery,
                [
                    'user_id'   => $_SESSION['user_id'],
                    'school_id' => $school_id
                ]
            );


        $student =
            $studentResult[0] ?? null;


        /*
        ========================================
        STUDENT NOT FOUND
        ========================================
        */

        if (!$student) {

            die(
                "Student record not found."
            );
        }


        /*
        ========================================
        ACTUAL STUDENT ID
        ========================================
        */

        $student_id =
            $student->student_id;


        /*
        ========================================
        GET RESULTS
        ========================================
        */

        $results =
            $resultModel->getStudentResults(
                $student_id
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'student-results',
            [
                'results' => $results
            ]
        );
    }

    /*
========================================
VIEW RESULT DETAILS
========================================
*/

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
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    GET SCHOOL ID
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
    LOAD MODEL
    ========================================
    */

    $resultModel =
        $this->model(
            'StudentResultsModel'
        );


    /*
    ========================================
    FIND STUDENT
    ========================================
    */

    $studentQuery = "SELECT
                        student_id

                     FROM students

                     WHERE user_id = :user_id

                     AND school_id = :school_id

                     LIMIT 1";


    $studentResult =
        $resultModel->query(
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
    GET RESULT
    ========================================
    */

    $resultQuery = "SELECT
                        r.result_id,
                        r.test_id,
                        r.total_marks,
                        r.obtained_marks,
                        r.percentage,
                        r.status,
                        r.created_at,

                        t.title,
                        t.class,
                        t.division

                    FROM results r

                    INNER JOIN tests t
                    ON r.test_id = t.test_id

                    WHERE r.test_id = :test_id

                    AND r.student_id = :student_id

                    LIMIT 1";


    $resultData =
        $resultModel->query(
            $resultQuery,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );


    $result =
        $resultData[0] ?? null;


    /*
    ========================================
    RESULT NOT FOUND
    ========================================
    */

    if (!$result) {

        header(
            "Location: " .
            ROOT .
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    GET QUESTION DETAILS
    ========================================
    */

    $questions =
        $resultModel->getResultDetails(
            $test_id,
            $student_id
        );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'student-result-details',
        [
            'result'    => $result,
            'questions' => $questions
        ]
    );

    
}


/*
========================================
DOWNLOAD RESULT PDF
========================================
*/

public function download($test_id = null)
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

        header("Location: " . ROOT . "/login");
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

        header("Location: " . ROOT . "/home");
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
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    SCHOOL
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$school_id) {
        die("No school is assigned to this student.");
    }


    /*
    ========================================
    MODEL
    ========================================
    */

    $resultModel =
        $this->model(
            'StudentResultsModel'
        );


    /*
    ========================================
    FIND STUDENT
    ========================================
    */

    $studentQuery = "SELECT
                        student_id
                     FROM students
                     WHERE user_id = :user_id
                     AND school_id = :school_id
                     LIMIT 1";


    $studentResult =
        $resultModel->query(
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


    /*
    ========================================
    GET RESULT
    ========================================
    */

    $resultQuery = "SELECT
                        r.result_id,
                        r.test_id,
                        r.total_marks,
                        r.obtained_marks,
                        r.percentage,
                        r.status,
                        r.created_at,

                        t.title,
                        t.class,
                        t.division

                    FROM results r

                    INNER JOIN tests t
                    ON r.test_id = t.test_id

                    WHERE r.test_id = :test_id

                    AND r.student_id = :student_id

                    LIMIT 1";


    $resultData =
        $resultModel->query(
            $resultQuery,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );


    $result =
        $resultData[0] ?? null;


    if (!$result) {

        header(
            "Location: " .
            ROOT .
            "/studentresults"
        );

        exit;
    }


    /*
    ========================================
    GET QUESTIONS
    ========================================
    */

    $questions =
        $resultModel->getResultDetails(
            $test_id,
            $student_id
        );


    /*
    ========================================
    PDF HTML
    ========================================
    */

    ob_start();

    ?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">

        <style>

            body {
                font-family: DejaVu Sans, sans-serif;
                color: #172033;
                font-size: 12px;
            }

            .header {
                text-align: center;
                margin-bottom: 25px;
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            .header p {
                margin: 5px 0;
                color: #64748b;
            }

            .summary {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 25px;
            }

            .summary td {
                border: 1px solid #dbe2ea;
                padding: 10px;
            }

            .label {
                font-weight: bold;
                width: 30%;
                background: #f4f7fb;
            }

            .question {
                border: 1px solid #dbe2ea;
                padding: 12px;
                margin-bottom: 15px;
            }

            .question-title {
                font-weight: bold;
                font-size: 13px;
                margin-bottom: 10px;
            }

            .option {
                padding: 5px 0;
            }

            .correct {
                font-weight: bold;
            }

            .wrong {
                font-weight: bold;
            }

            .status {
                margin-top: 10px;
                padding: 6px;
                font-weight: bold;
            }

            .footer {
                margin-top: 30px;
                text-align: center;
                color: #64748b;
                font-size: 10px;
            }

        </style>

    </head>

    <body>


        <div class="header">

            <h1>
                Result Report
            </h1>

            <p>
                <?= htmlspecialchars(
                    $result->title ?? 'Test Result'
                ) ?>
            </p>

        </div>


        <table class="summary">

            <tr>

                <td class="label">
                    Test
                </td>

                <td>
                    <?= htmlspecialchars(
                        $result->title ?? '-'
                    ) ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Class
                </td>

                <td>
                    <?= htmlspecialchars(
                        $result->class ?? '-'
                    ) ?>

                    -

                    <?= htmlspecialchars(
                        $result->division ?? '-'
                    ) ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Total Marks
                </td>

                <td>
                    <?= htmlspecialchars(
                        $result->total_marks ?? '0'
                    ) ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Obtained Marks
                </td>

                <td>
                    <?= htmlspecialchars(
                        $result->obtained_marks ?? '0'
                    ) ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Percentage
                </td>

                <td>
                    <?= htmlspecialchars(
                        $result->percentage ?? '0'
                    ) ?>%
                </td>

            </tr>


            <tr>

                <td class="label">
                    Submitted On
                </td>

                <td>

                    <?php

                    if (!empty($result->created_at)) {

                        echo htmlspecialchars(
                            date(
                                'd M Y',
                                strtotime(
                                    $result->created_at
                                )
                            )
                        );

                    } else {

                        echo '-';

                    }

                    ?>

                </td>

            </tr>

        </table>


        <h2>
            Question Review
        </h2>


        <?php if (!empty($questions)): ?>


            <?php foreach (
                $questions as $index => $question
            ): ?>


                <?php

                $studentAnswer =
                    strtoupper(
                        trim(
                            $question->student_answer ?? ''
                        )
                    );


                $correctAnswer =
                    strtoupper(
                        trim(
                            $question->correct_answer ?? ''
                        )
                    );


                if ($studentAnswer === '') {

                    $answerStatus =
                        'Not Answered';

                } elseif (
                    $studentAnswer ===
                    $correctAnswer
                ) {

                    $answerStatus =
                        'Correct';

                } else {

                    $answerStatus =
                        'Wrong';
                }

                ?>


                <div class="question">

                    <div class="question-title">

                        Question <?= $index + 1 ?>:

                        <?= htmlspecialchars(
                            $question->question ?? ''
                        ) ?>

                    </div>


                    <div class="option">

                        A.
                        <?= htmlspecialchars(
                            $question->option_a ?? ''
                        ) ?>

                    </div>


                    <div class="option">

                        B.
                        <?= htmlspecialchars(
                            $question->option_b ?? ''
                        ) ?>

                    </div>


                    <div class="option">

                        C.
                        <?= htmlspecialchars(
                            $question->option_c ?? ''
                        ) ?>

                    </div>


                    <div class="option">

                        D.
                        <?= htmlspecialchars(
                            $question->option_d ?? ''
                        ) ?>

                    </div>


                    <div class="status">

                        Your Answer:

                        <?= $studentAnswer !== ''
                            ? htmlspecialchars($studentAnswer)
                            : 'Not Answered'
                        ?>

                        <br>

                        Correct Answer:

                        <?= htmlspecialchars(
                            $correctAnswer
                        ) ?>

                        <br>

                        Status:

                        <?= htmlspecialchars(
                            $answerStatus
                        ) ?>

                    </div>

                </div>


            <?php endforeach; ?>


        <?php else: ?>

            <p>
                No question details available.
            </p>

        <?php endif; ?>


        <div class="footer">

            Generated by My School

        </div>


    </body>

    </html>

    <?php

    $html =
        ob_get_clean();


    /*
    ========================================
    DOMPDF
    ========================================
    */

    $options =
        new Options();

    $options->set(
        'isRemoteEnabled',
        true
    );


    $dompdf =
        new Dompdf($options);


    $dompdf->loadHtml(
        $html
    );


    $dompdf->setPaper(
        'A4',
        'portrait'
    );


    $dompdf->render();


    /*
    ========================================
    DOWNLOAD
    ========================================
    */

    $filename =
        'Result_' .
        preg_replace(
            '/[^A-Za-z0-9_-]/',
            '_',
            $result->test_id
        ) .
        '.pdf';


    $dompdf->stream(
        $filename,
        [
            'Attachment' => true
        ]
    );


    exit;
}
}