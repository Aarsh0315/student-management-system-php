<?php

$test = $data['test'] ?? null;
$questions = $data['questions'] ?? [];
$child = $data['child'] ?? null;

$childName = '-';

if ($child) {
    $childName = trim(
        ($child->firstname ?? '') . ' ' . ($child->lastname ?? '')
    );

    if ($childName === '') {
        $childName = '-';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Parent Test Details - My School
    </title>

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/home.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/parent-test-details.view.css?v=1">

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
            Test Details
        </h1>

        <p class="welcome-text">
            View test information and questions assigned to your child.
        </p>

    </section>



    <?php if ($test): ?>


        <!-- =========================================
             TEST PROFILE CARD
        ========================================== -->

        <section class="test-profile-card">

            <div class="test-profile-top">


                <!-- TEST ICON -->

                <div class="test-icon">
                    T
                </div>


                <!-- TEST INFORMATION -->

                <div class="test-profile-info">

                    <h2>
                        <?= htmlspecialchars(
                            $test->title ?? '-'
                        ) ?>
                    </h2>


                    <p>

                        Test ID:

                        <strong>
                            <?= htmlspecialchars(
                                $test->test_id ?? '-'
                            ) ?>
                        </strong>

                    </p>


                    <p>

                        Child:

                        <strong>
                            <?= htmlspecialchars($childName) ?>
                        </strong>

                    </p>


                    <?php

                    $status = strtolower(
                        $test->status ?? ''
                    );

                    ?>

                    <span class="status <?= htmlspecialchars($status) ?>">

                        <?= htmlspecialchars(
                            ucfirst($test->status ?? '-')
                        ) ?>

                    </span>

                </div>

            </div>

        </section>



        <!-- =========================================
             TEST DETAILS
        ========================================== -->

        <section class="test-details-card">


            <div class="details-header">

                <h2>
                    Test Information
                </h2>

                <p>
                    Detailed information about this test.
                </p>

            </div>



            <div class="details-grid">


                <!-- CHILD -->

                <div class="details-item">

                    <span>
                        Child
                    </span>

                    <strong>
                        <?= htmlspecialchars($childName) ?>
                    </strong>

                </div>



                <!-- CLASS -->

                <div class="details-item">

                    <span>
                        Class
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->class ?? '-'
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
                            $test->division ?? '-'
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
                            $test->total_marks ?? '-'
                        ) ?>
                    </strong>

                </div>



                <!-- DURATION -->

                <div class="details-item">

                    <span>
                        Duration
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->duration ?? '-'
                        ) ?>

                        min

                    </strong>

                </div>



                <!-- START DATE -->

                <div class="details-item">

                    <span>
                        Start Date
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->start_date ?? '-'
                        ) ?>
                    </strong>

                </div>



                <!-- END DATE -->

                <div class="details-item">

                    <span>
                        End Date
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->end_date ?? '-'
                        ) ?>
                    </strong>

                </div>



                <!-- TEST ID -->

                <div class="details-item">

                    <span>
                        Test ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->test_id ?? '-'
                        ) ?>
                    </strong>

                </div>


            </div>



            <!-- =====================================
                 DESCRIPTION
            ====================================== -->

            <?php if (!empty($test->description)): ?>

                <div class="description-box">

                    <span>
                        Description
                    </span>

                    <p>
                        <?= nl2br(
                            htmlspecialchars(
                                $test->description
                            )
                        ) ?>
                    </p>

                </div>

            <?php endif; ?>


        </section>



        <!-- =========================================
             QUESTIONS
        ========================================== -->

        <section class="questions-card">


            <div class="questions-header">

                <h2>
                    Questions
                </h2>

                <p>
                    <?= count($questions) ?>
                    question(s) in this test.
                </p>

            </div>



            <?php if (!empty($questions)): ?>


                <?php foreach ($questions as $index => $question): ?>


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
                                    ?? $question->question_text
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
                                trim((string)$option) !== ''
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
                                        trim((string)$option) !== ''
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



                        <!-- CORRECT ANSWER -->

                        <?php

                        $correctAnswer =
                            $question->correct_answer
                            ?? $question->answer
                            ?? null;

                        ?>


                        <?php if (
                            $correctAnswer !== null &&
                            trim((string)$correctAnswer) !== ''
                        ): ?>

                            <div class="correct-answer">

                                <strong>
                                    Correct Answer:
                                </strong>

                                &nbsp;

                                <?= htmlspecialchars(
                                    $correctAnswer
                                ) ?>

                            </div>

                        <?php endif; ?>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <div class="empty-state">

                    <h3>
                        No Questions Found
                    </h3>

                    <p>
                        There are currently no questions
                        available for this test.
                    </p>

                </div>


            <?php endif; ?>


        </section>



        <!-- =========================================
             BACK BUTTON
        ========================================== -->

        <a href="<?= ROOT ?>/parenttests"
           class="back-btn">

            ← Back to Tests

        </a>


    <?php else: ?>


        <!-- =========================================
             TEST NOT FOUND
        ========================================== -->

        <section class="questions-card">

            <div class="empty-state">

                <h3>
                    Test Not Found
                </h3>

                <p>
                    The requested test could not be found.
                </p>

            </div>

            <br>

            <a href="<?= ROOT ?>/parenttests"
               class="back-btn">

                ← Back to Tests

            </a>

        </section>


    <?php endif; ?>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>