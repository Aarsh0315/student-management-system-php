<?php

$result =
    $data['result'] ?? null;

$questions =
    $data['questions'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Result Details - My School
    </title>


    <!-- DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- STUDENT RESULT DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-result-details.view.css?v=5"
    >


    <!-- STUDENT NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-nav.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/student-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Student
            </p>

            <h1>
                Result Details
            </h1>

            <p class="welcome-text">

                <?= htmlspecialchars(
                    $result->title ?? 'Test Result'
                ) ?>

            </p>

        </div>

    </section>



    <!-- ========================================
         RESULT SUMMARY
    ======================================== -->

    <section class="result-summary-card">


        <div class="result-summary-header">

            <div>

                <h2>

                    <?= htmlspecialchars(
                        $result->title
                        ?? 'Test'
                    ) ?>

                </h2>

                <p>

                    Class
                    <?= htmlspecialchars(
                        $result->class ?? '-'
                    ) ?>

                    -

                    Division
                    <?= htmlspecialchars(
                        $result->division ?? '-'
                    ) ?>

                </p>

            </div>


            <span class="result-status submitted">

                <span class="status-dot"></span>

                Submitted

            </span>

        </div>



        <!-- SUMMARY GRID -->

        <div class="result-summary-grid">


            <div class="result-summary-item">

                <span>
                    Obtained Marks
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $result->obtained_marks
                        ?? '0'
                    ) ?>

                    /

                    <?= htmlspecialchars(
                        $result->total_marks
                        ?? '0'
                    ) ?>

                </strong>

            </div>


            <div class="result-summary-item">

                <span>
                    Percentage
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $result->percentage
                        ?? '0'
                    ) ?>%

                </strong>

            </div>


            <div class="result-summary-item">

                <span>
                    Submitted On
                </span>

                <strong>

                    <?php

                    if (
                        !empty(
                            $result->created_at
                        )
                    ) {

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

                </strong>

            </div>


        </div>


    </section>



    <!-- ========================================
         QUESTION REVIEW
    ======================================== -->

    <section class="result-review-card">


        <div class="result-review-header">

            <div>

                <h2>
                    Question Review
                </h2>

                <p>
                    Review your answers and
                    correct answers.
                </p>

            </div>

        </div>



        <?php if (!empty($questions)): ?>


            <div class="result-questions">


                <?php foreach (
                    $questions as $index => $question
                ): ?>


                    <?php

                    $studentAnswer =
                        strtoupper(
                            trim(
                                $question->student_answer
                                ?? ''
                            )
                        );

                    $correctAnswer =
                        strtoupper(
                            trim(
                                $question->correct_answer
                                ?? ''
                            )
                        );


                    if (
                        $studentAnswer === ''
                    ) {

                        $answerStatus =
                            'unanswered';

                    } elseif (
                        $studentAnswer ===
                        $correctAnswer
                    ) {

                        $answerStatus =
                            'correct';

                    } else {

                        $answerStatus =
                            'wrong';

                    }

                    ?>


                    <div
                        class="result-question
                        <?= $answerStatus ?>"
                    >


                        <!-- QUESTION HEADER -->

                        <div class="result-question-header">


                            <div>

                                <span class="question-number">

                                    Question
                                    <?= $index + 1 ?>

                                </span>

                                <span class="question-marks">

                                    <?= htmlspecialchars(
                                        $question->marks
                                        ?? '0'
                                    ) ?>

                                    mark(s)

                                </span>

                            </div>


                            <?php if (
                                $answerStatus ===
                                'correct'
                            ): ?>

                                <span class="answer-status correct-status">

                                    ✓ Correct

                                </span>

                            <?php elseif (
                                $answerStatus ===
                                'wrong'
                            ): ?>

                                <span class="answer-status wrong-status">

                                    ✕ Wrong

                                </span>

                            <?php else: ?>

                                <span class="answer-status unanswered-status">

                                    — Not Answered

                                </span>

                            <?php endif; ?>


                        </div>



                        <!-- QUESTION -->

                        <h3>

                            <?= htmlspecialchars(
                                $question->question
                                ?? ''
                            ) ?>

                        </h3>



                        <!-- OPTIONS -->

                        <div class="result-options">


                            <?php

                            $options = [
                                'A' =>
                                    $question->option_a
                                    ?? '',

                                'B' =>
                                    $question->option_b
                                    ?? '',

                                'C' =>
                                    $question->option_c
                                    ?? '',

                                'D' =>
                                    $question->option_d
                                    ?? ''
                            ];

                            ?>


                            <?php foreach (
                                $options as $letter => $option
                            ): ?>


                                <?php

                                $isStudentAnswer =
                                    $studentAnswer ===
                                    $letter;

                                $isCorrectAnswer =
                                    $correctAnswer ===
                                    $letter;

                                ?>


                                <div
                                    class="result-option

                                    <?php

                                    /* ========================================
                                    CORRECT ANSWER
                                    ======================================== */

                                    if ($isCorrectAnswer) {
                                        echo ' correct-option';
                                    }


                                    /* ========================================
                                    STUDENT SELECTED WRONG ANSWER
                                    ======================================== */

                                    if (
                                        $isStudentAnswer
                                        &&
                                        !$isCorrectAnswer
                                    ) {
                                        echo ' wrong-option';
                                    }


                                    /* ========================================
                                    STUDENT SELECTED CORRECT ANSWER
                                    ======================================== */

                                    if (
                                        $isStudentAnswer
                                        &&
                                        $isCorrectAnswer
                                    ) {
                                        echo ' selected-correct-option';
                                    }

                                    ?>"
                                >


                                    <span class="option-letter">

                                        <?= $letter ?>

                                    </span>


                                    <span class="option-text">

                                        <?= htmlspecialchars(
                                            $option
                                        ) ?>

                                    </span>


                                    <?php if (
                                        $isStudentAnswer
                                    ): ?>

                                        <span class="your-answer-label">

                                            Your Answer

                                        </span>

                                    <?php endif; ?>


                                    <?php if (
                                        $isCorrectAnswer
                                    ): ?>

                                        <span class="correct-answer-label">

                                            Correct Answer

                                        </span>

                                    <?php endif; ?>


                                </div>


                            <?php endforeach; ?>


                        </div>



                        <!-- ANSWER SUMMARY -->

                        <div class="answer-summary">


                            <div>

                                <span>
                                    Your Answer
                                </span>

                                <strong
                                    class="<?= $answerStatus ?>"
                                >

                                    <?= $studentAnswer !== ''
                                        ? htmlspecialchars(
                                            $studentAnswer
                                        )
                                        : 'Not Answered'
                                    ?>

                                </strong>

                            </div>


                            <div>

                                <span>
                                    Correct Answer
                                </span>

                                <strong class="correct">

                                    <?= htmlspecialchars(
                                        $correctAnswer
                                    ) ?>

                                </strong>

                            </div>


                        </div>


                    </div>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <div class="empty-state">

                <h3>
                    No Question Details
                </h3>

                <p>
                    Question details are not
                    available for this result.
                </p>

            </div>


        <?php endif; ?>


    </section>



    <!-- ========================================
         BACK BUTTON
    ======================================== -->

    <div class="result-back">

        <a
            href="<?= ROOT ?>/studentresults"
            class="back-results-btn"
        >
            ← Back to Results
        </a>

         <a
        href="<?= ROOT ?>/studentresults/download/<?= urlencode($result->test_id) ?>"
        class="download-result-btn"
    >
        ↓ Download Result PDF
    </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>