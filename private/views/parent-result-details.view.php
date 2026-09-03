<?php

$result = $data['result'] ?? null;
$questions = $data['questions'] ?? [];

$studentName = '-';

if ($result) {

    $studentName = trim(
        ($result->firstname ?? '') . ' ' .
        ($result->lastname ?? '')
    );

    if ($studentName === '') {
        $studentName = '-';
    }
}

$percentage = (float) ($result->percentage ?? 0);

$status = strtolower($result->status ?? '');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Result Details - My School
    </title>


    <link rel="stylesheet"
          href="<?= ROOT ?>/css/home.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/parent-result-details.view.css?v=1">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/footer.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/nav.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/sidebar.view.css">

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <section class="welcome">

        <p class="welcome-small">
            Parent
        </p>

        <h1>
            Result Details
        </h1>

        <p class="welcome-text">
            View your child's performance and question-wise result.
        </p>

    </section>



    <?php if ($result): ?>


        <!-- =========================================
             RESULT PROFILE
        ========================================== -->

        <section class="result-profile-card">

            <div class="result-profile-top">


                <!-- RESULT ICON -->

                <div class="result-icon">
                    RS
                </div>


                <!-- RESULT INFORMATION -->

                <div class="result-profile-info">

                    <h2>
                        <?= htmlspecialchars(
                            $result->title ?? '-'
                        ) ?>
                    </h2>


                    <p>

                        Test ID:

                        <span class="test-id-badge">

                            <?= htmlspecialchars(
                                $result->test_id ?? '-'
                            ) ?>

                        </span>

                    </p>


                    <p>

                        Child:

                        <strong>
                            <?= htmlspecialchars(
                                $studentName
                            ) ?>
                        </strong>

                    </p>


                    <?php if ($status === 'pass'): ?>

                        <span class="status pass">
                            Pass
                        </span>

                    <?php elseif ($status === 'fail'): ?>

                        <span class="status fail">
                            Fail
                        </span>

                    <?php else: ?>

                        <span class="status">

                            <?= htmlspecialchars(
                                ucfirst(
                                    $result->status ?? '-'
                                )
                            ) ?>

                        </span>

                    <?php endif; ?>


                </div>


                <!-- SCORE -->

                <div class="result-score">

                    <strong>
                        <?= number_format(
                            $percentage,
                            1
                        ) ?>%
                    </strong>

                    <span>
                        Score
                    </span>

                </div>


            </div>

        </section>



        <!-- =========================================
             RESULT INFORMATION
        ========================================== -->

        <section class="result-details-card">


            <div class="details-header">

                <h2>
                    Result Information
                </h2>

                <p>
                    Detailed performance information for this test.
                </p>

            </div>



            <div class="details-grid">


                <!-- TEST ID -->

                <div class="details-item">

                    <span>
                        Test ID
                    </span>

                    <strong class="test-id-value">

                        <?= htmlspecialchars(
                            $result->test_id ?? '-'
                        ) ?>

                    </strong>

                </div>



                <!-- CHILD -->

                <div class="details-item">

                    <span>
                        Child
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $studentName
                        ) ?>
                    </strong>

                </div>



                <!-- CLASS -->

                <div class="details-item">

                    <span>
                        Class
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->class ?? '-'
                        ) ?>
                    </strong>

                </div>



                <!-- DIVISION -->

                <div class="details-item">

                    <span>
                        Division
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->division ?? '-'
                        ) ?>
                    </strong>

                </div>



                <!-- OBTAINED MARKS -->

                <div class="details-item">

                    <span>
                        Obtained Marks
                    </span>

                    <strong class="obtained-marks">

                        <?= htmlspecialchars(
                            $result->obtained_marks ?? '0'
                        ) ?>

                    </strong>

                </div>



                <!-- TOTAL MARKS -->

                <div class="details-item">

                    <span>
                        Total Marks
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->total_marks ?? '0'
                        ) ?>

                    </strong>

                </div>



                <!-- PERCENTAGE -->

                <div class="details-item">

                    <span>
                        Percentage
                    </span>

                    <strong class="percentage-value">

                        <?= number_format(
                            $percentage,
                            1
                        ) ?>%

                    </strong>

                </div>



                <!-- STATUS -->

                <div class="details-item">

                    <span>
                        Result Status
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            ucfirst(
                                $result->status ?? '-'
                            )
                        ) ?>

                    </strong>

                </div>


            </div>



            <!-- =====================================
                 TEST DESCRIPTION
            ====================================== -->

            <?php if (!empty($result->description)): ?>

                <div class="description-box">

                    <span>
                        Test Description
                    </span>

                    <p>

                        <?= nl2br(
                            htmlspecialchars(
                                $result->description
                            )
                        ) ?>

                    </p>

                </div>

            <?php endif; ?>


        </section>



        <!-- =========================================
             QUESTION RESULTS
        ========================================== -->

        <section class="questions-card">


            <div class="questions-header">

                <h2>
                    Question-wise Result
                </h2>

                <p>

                    <?= count($questions) ?>

                    question(s) evaluated.

                </p>

            </div>



            <?php if (!empty($questions)): ?>


                <?php foreach ($questions as $index => $question): ?>


                    <?php

                    $studentAnswer =
                        trim(
                            (string) (
                                $question->student_answer
                                ?? ''
                            )
                        );

                    $correctAnswer =
                        trim(
                            (string) (
                                $question->correct_answer
                                ?? ''
                            )
                        );


                    $isCorrect =
                        $studentAnswer !== '' &&
                        $correctAnswer !== '' &&
                        strcasecmp(
                            $studentAnswer,
                            $correctAnswer
                        ) === 0;

                    ?>


                    <div class="question-card">


                        <!-- QUESTION TOP -->

                        <div class="question-top">

                            <span class="question-number">

                                Question
                                <?= $index + 1 ?>

                            </span>


                            <span class="question-marks">

                                <?= htmlspecialchars(
                                    $question->marks ?? '0'
                                ) ?>

                                Marks

                            </span>

                        </div>



                        <!-- QUESTION -->

                        <h3>

                            <?= nl2br(
                                htmlspecialchars(
                                    $question->question
                                    ?? '-'
                                )
                            ) ?>

                        </h3>



                        <!-- OPTIONS -->

                        <?php

                        $options = [

                            'A' => $question->option_a ?? null,

                            'B' => $question->option_b ?? null,

                            'C' => $question->option_c ?? null,

                            'D' => $question->option_d ?? null

                        ];

                        $hasOptions = false;

                        foreach ($options as $option) {

                            if (
                                $option !== null &&
                                trim((string) $option) !== ''
                            ) {

                                $hasOptions = true;

                                break;
                            }
                        }

                        ?>


                        <?php if ($hasOptions): ?>


                            <div class="options">


                                <?php foreach (
                                    $options as $letter => $option
                                ): ?>


                                    <?php if (
                                        $option !== null &&
                                        trim((string) $option) !== ''
                                    ): ?>


                                        <div class="option">

                                            <strong>

                                                <?= $letter ?>

                                            </strong>

                                            <span>

                                                <?= htmlspecialchars(
                                                    $option
                                                ) ?>

                                            </span>

                                        </div>


                                    <?php endif; ?>


                                <?php endforeach; ?>


                            </div>


                        <?php endif; ?>



                        <!-- ANSWER SECTION -->

                        <div class="answer-section">


                            <div class="answer-row">

                                <span class="answer-label">
                                    Your Answer
                                </span>

                                <?php if ($studentAnswer !== ''): ?>

                                    <strong
                                        class="<?= $isCorrect
                                            ? 'answer-correct'
                                            : 'answer-wrong' ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $studentAnswer
                                        ) ?>

                                    </strong>

                                <?php else: ?>

                                    <strong class="answer-not-attempted">

                                        Not Attempted

                                    </strong>

                                <?php endif; ?>

                            </div>



                            <div class="answer-row">

                                <span class="answer-label">
                                    Correct Answer
                                </span>

                                <strong class="correct-answer-text">

                                    <?= htmlspecialchars(
                                        $correctAnswer ?: '-'
                                    ) ?>

                                </strong>

                            </div>


                        </div>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <div class="empty-state">

                    <h3>
                        No Question Details
                    </h3>

                    <p>
                        Question-wise result details are not available.
                    </p>

                </div>


            <?php endif; ?>


        </section>



        <!-- =========================================
             BACK BUTTON
        ========================================== -->

        <a
            href="<?= ROOT ?>/parentresults"
            class="back-btn"
        >
            Back to Results
        </a>


    <?php else: ?>


        <!-- =========================================
             RESULT NOT FOUND
        ========================================== -->

        <section class="questions-card">

            <div class="empty-state">

                <h3>
                    Result Not Found
                </h3>

                <p>
                    The requested result could not be found.
                </p>

            </div>


            <br>


            <a
                href="<?= ROOT ?>/parentresults"
                class="back-btn"
            >
                Back to Results
            </a>

        </section>


    <?php endif; ?>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>