<?php

$test = $data['test'] ?? null;

$questions = $data['questions'] ?? [];

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
        Test Details - My School
    </title>


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- TEST DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/test-details.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Test Details
            </h1>

            <p class="welcome-text">
                View complete test information and questions.
            </p>

        </div>


        <a
            href="<?= ROOT ?>/tests"
            class="back-btn"
        >
            ← Back to Tests
        </a>

    </section>



    <?php if ($test): ?>


        <!-- ========================================
             TEST PROFILE CARD
        ======================================== -->

        <section class="test-profile-card">


            <div class="test-profile-top">


                <div class="test-icon">

                    T

                </div>


                <div class="test-profile-info">

                    <h2>

                        <?= htmlspecialchars(
                            $test->title
                            ?? '-'
                        ) ?>

                    </h2>


                    <p>

                        Test ID:

                        <strong>

                            <?= htmlspecialchars(
                                $test->test_id
                                ?? '-'
                            ) ?>

                        </strong>

                    </p>


                    <?php if (
                        ($test->status ?? '') === 'active'
                    ): ?>

                        <span class="status active">
                            Active
                        </span>

                    <?php else: ?>

                        <span class="status draft">
                            <?= htmlspecialchars(
                                ucfirst(
                                    $test->status
                                    ?? 'Draft'
                                )
                            ) ?>
                        </span>

                    <?php endif; ?>

                </div>


            </div>


        </section>



        <!-- ========================================
             TEST INFORMATION
        ======================================== -->

        <section class="test-details-card">


            <div class="details-header">

                <h2>
                    Test Information
                </h2>

                <p>
                    Basic information about this test.
                </p>

            </div>


            <div class="details-grid">


                <div class="details-item">

                    <span>
                        School ID
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->school_id
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Teacher ID
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->teacher_id
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Class
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->class
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Division
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->division
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Total Marks
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->total_marks
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Duration
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->duration
                            ?? '-'
                        ) ?>

                        minutes

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        Start Date
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->start_date
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="details-item">

                    <span>
                        End Date
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $test->end_date
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


            </div>


            <?php if (
                !empty($test->description)
            ): ?>

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



        <!-- ========================================
             QUESTIONS
        ======================================== -->

        <section class="questions-card">


            <div class="questions-header">

                <div>

                    <h2>
                        Questions
                    </h2>

                    <p>

                        <?= count($questions) ?>

                        question(s) in this test.

                    </p>

                </div>

            </div>



            <?php if (!empty($questions)): ?>


                <div class="questions-list">


                    <?php

                    $questionNumber = 1;

                    foreach (
                        $questions as $question
                    ):

                    ?>


                        <div class="question-card">


                            <div class="question-top">

                                <span class="question-number">

                                    Question
                                    <?= $questionNumber ?>

                                </span>


                                <span class="question-marks">

                                    <?= htmlspecialchars(
                                        $question->marks
                                        ?? '0'
                                    ) ?>

                                    marks

                                </span>

                            </div>


                            <h3>

                                <?= htmlspecialchars(
                                    $question->question
                                    ?? '-'
                                ) ?>

                            </h3>



                            <?php if (
                                ($question->question_type ?? '')
                                === 'mcq'
                            ): ?>


                                <div class="options">


                                    <div class="option">

                                        <strong>
                                            A
                                        </strong>

                                        <span>

                                            <?= htmlspecialchars(
                                                $question->option_a
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </div>


                                    <div class="option">

                                        <strong>
                                            B
                                        </strong>

                                        <span>

                                            <?= htmlspecialchars(
                                                $question->option_b
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </div>


                                    <div class="option">

                                        <strong>
                                            C
                                        </strong>

                                        <span>

                                            <?= htmlspecialchars(
                                                $question->option_c
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </div>


                                    <div class="option">

                                        <strong>
                                            D
                                        </strong>

                                        <span>

                                            <?= htmlspecialchars(
                                                $question->option_d
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </div>


                                </div>


                                <div class="correct-answer">

                                    Correct Answer:

                                    <strong>

                                        <?= htmlspecialchars(
                                            $question->correct_answer
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>


                            <?php endif; ?>


                        </div>


                    <?php

                        $questionNumber++;

                    endforeach;

                    ?>


                </div>


            <?php else: ?>


                <div class="empty-state">

                    <h3>
                        No Questions Found
                    </h3>

                    <p>
                        This test does not have any questions yet.
                    </p>

                </div>


            <?php endif; ?>


        </section>



    <?php else: ?>


        <section class="empty-state">

            <h3>
                Test Not Found
            </h3>

            <p>
                The requested test could not be found.
            </p>

        </section>


    <?php endif; ?>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>