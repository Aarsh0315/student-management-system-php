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

public function download($result_id = null)
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

    if (!$result_id) {

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

                    WHERE r.result_id = :result_id

                    AND r.student_id = :student_id

                    LIMIT 1";


    $resultData =
        $resultModel->query(
            $resultQuery,
            [
                'result_id'  => $result_id,
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

    /*
    ========================================
    GET QUESTIONS WITH UPLOADED IMAGES
    ========================================
    */

    $questionQuery = "SELECT
                        tq.question_id,
                        tq.question,
                        tq.question_type,
                        tq.option_a,
                        tq.option_b,
                        tq.option_c,
                        tq.option_d,
                        tq.correct_answer,
                        tq.correct_answers,
                        tq.question_image,
                        tq.marks,
                        sa.answer AS student_answer

                      FROM test_questions tq

                      LEFT JOIN student_answers sa
                        ON sa.question_id = tq.question_id
                        AND sa.test_id = tq.test_id
                        AND sa.student_id = :student_id

                      WHERE tq.test_id = :test_id

                      ORDER BY
                        tq.question_order ASC,
                        tq.question_id ASC";

    $questions =
        $resultModel->query(
            $questionQuery,
            [
                'test_id'    => $result->test_id,
                'student_id' => $student_id
            ]
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

            .question-image {
                margin: 10px 0 12px;
                text-align: left;
            }

            .question-image img {
                max-width: 460px;
                max-height: 280px;
                width: auto;
                height: auto;
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

                $rawStudentAnswer = $question->student_answer ?? '';

                if (is_array($rawStudentAnswer)) {
                    $studentParts = [];
                    foreach ($rawStudentAnswer as $answerPart) {
                        if (is_scalar($answerPart)) {
                            $answerPart = strtoupper(trim((string) $answerPart));
                            if ($answerPart !== '') {
                                $studentParts[] = $answerPart;
                            }
                        }
                    }
                    $studentParts = array_values(array_unique($studentParts));
                    sort($studentParts);
                    $studentAnswer = implode(', ', $studentParts);
                } else {
                    $studentAnswer = strtoupper(trim((string) $rawStudentAnswer));
                }

                $rawCorrectAnswers = $question->correct_answers ?? null;

                if (is_string($rawCorrectAnswers) && $rawCorrectAnswers !== '') {
                    $decodedCorrect = json_decode($rawCorrectAnswers, true);
                    if (is_array($decodedCorrect)) {
                        $rawCorrectAnswers = $decodedCorrect;
                    }
                }

                if (is_array($rawCorrectAnswers) && !empty($rawCorrectAnswers)) {
                    $correctParts = [];
                    foreach ($rawCorrectAnswers as $answerPart) {
                        if (is_scalar($answerPart)) {
                            $answerPart = strtoupper(trim((string) $answerPart));
                            if ($answerPart !== '') {
                                $correctParts[] = $answerPart;
                            }
                        }
                    }
                    $correctParts = array_values(array_unique($correctParts));
                    sort($correctParts);
                    $correctAnswer = implode(', ', $correctParts);
                } else {
                    $correctAnswer = strtoupper(trim((string) ($question->correct_answer ?? '')));
                }


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


                    <?php if (!empty($question->question_image)): ?>

                        <?php
                        /*
                        ========================================
                        QUESTION IMAGE
                        ========================================
                        */

                        $questionImage =
                            ltrim(
                                (string) $question->question_image,
                                '/\\'
                            );

                        /*
                         * Images uploaded by the teacher are stored
                         * inside public/uploads/questions/.
                         *
                         * Use a local file URI for Dompdf so the image
                         * is embedded in the generated PDF reliably.
                         */
                        $questionImageFile =
                            dirname(__DIR__, 2) .
                            '/public/' .
                            $questionImage;

                        if (
                            file_exists($questionImageFile) &&
                            is_file($questionImageFile)
                        ):
                        ?>

                            <?php
                            $imageMime =
                                function_exists('mime_content_type')
                                    ? mime_content_type($questionImageFile)
                                    : '';

                            $allowedImageMimes = [
                                'image/jpeg',
                                'image/png',
                                'image/webp'
                            ];

                            if (
                                !in_array(
                                    $imageMime,
                                    $allowedImageMimes,
                                    true
                                )
                            ) {
                                $imageMime = 'image/jpeg';
                            }

                            $imageData =
                                base64_encode(
                                    file_get_contents(
                                        $questionImageFile
                                    )
                                );

                            $imageSrc =
                                'data:' .
                                $imageMime .
                                ';base64,' .
                                $imageData;
                            ?>

                            <div class="question-image">

                                <img
                                    src="<?= $imageSrc ?>"
                                    alt="Question Image"
                                >

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>


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