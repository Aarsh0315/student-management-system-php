<?php

$test = $data['test'] ?? null;

$questions = $data['questions'] ?? [];

$totalQuestionMarks = 0;

foreach ($questions as $question) {

    $totalQuestionMarks +=
        (int) ($question->marks ?? 0);

}

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


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- TEST DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-details.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Test Details
            </h1>

            <p class="welcome-text">
                Manage your test and questions.
            </p>

        </div>

    </section>



    <!-- ========================================
         TEST DETAILS CARD
    ======================================== -->

    <section class="test-details-card">


        <!-- ========================================
             TEST HEADER
        ======================================== -->

        <div class="test-details-header">

            <div>

                <h2>

                    <?= htmlspecialchars(
                        $test->title ?? '-'
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $test->description ?? ''
                    ) ?>

                </p>

            </div>


            <!-- STATUS + ACTION -->

            <div class="test-header-actions">


                <?php

                $status = strtolower(
                    $test->status ?? 'draft'
                );

                ?>


                <!-- STATUS -->

                <?php if ($status === 'active'): ?>

                    <span class="status active">
                        Active
                    </span>


                <?php elseif ($status === 'closed'): ?>

                    <span class="status closed">
                        Closed
                    </span>


                <?php else: ?>

                    <span class="status draft">
                        Draft
                    </span>

                <?php endif; ?>



                <!-- PUBLISH -->

                <?php if ($status === 'draft'): ?>

                    <a
                        href="<?= ROOT ?>/teachertests/publish/<?= urlencode($test->test_id ?? '') ?>"
                        class="publish-test-btn"
                        onclick="return confirm('Are you sure you want to publish this test?');"
                    >
                        Publish Test
                    </a>

                <?php endif; ?>


            </div>

        </div>



        <!-- ========================================
             TEST INFORMATION
        ======================================== -->

        <div class="test-info-grid">


            <!-- CLASS -->

            <div class="test-info-item">

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

            <div class="test-info-item">

                <span>
                    Division
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $test->division ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- QUESTION MARKS -->

            <div class="test-info-item">

                <span>
                    Question Marks
                </span>

                <strong>

                    <?= $totalQuestionMarks ?>

                    marks

                </strong>

            </div>



            <!-- DURATION -->

            <div class="test-info-item">

                <span>
                    Duration
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $test->duration ?? '0'
                    ) ?>

                    minutes

                </strong>

            </div>


        </div>



        <!-- ========================================
             QUESTIONS SECTION
        ======================================== -->

        <div class="questions-section">


            <!-- QUESTIONS HEADER -->

            <div class="questions-header">

                <div>

                    <h2>
                        Questions
                    </h2>

                    <p>

                        <?= count($questions) ?>

                        question(s)

                    </p>

                </div>


                <!-- ADD QUESTION -->

                <a
                    href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id ?? '') ?>"
                    class="add-question-btn"
                >
                    + Add Question
                </a>

            </div>



            <!-- ========================================
                 QUESTIONS
            ======================================== -->

            <?php if (!empty($questions)): ?>


                <?php foreach (
                    $questions as $index => $question
                ): ?>


                    <div class="question-card">


                        <!-- QUESTION NUMBER -->

                        <div class="question-number">

                            Question
                            <?= $index + 1 ?>

                        </div>



                        <!-- QUESTION -->

                        <h3>

                            <?= htmlspecialchars(
                                $question->question
                                ?? '-'
                            ) ?>

                        </h3>



                        <!-- MCQ OPTIONS -->

                        <?php if (
                            ($question->question_type ?? '')
                            === 'mcq'
                        ): ?>


                            <div class="options">


                                <div>

                                    A.

                                    <?= htmlspecialchars(
                                        $question->option_a
                                        ?? '-'
                                    ) ?>

                                </div>


                                <div>

                                    B.

                                    <?= htmlspecialchars(
                                        $question->option_b
                                        ?? '-'
                                    ) ?>

                                </div>


                                <div>

                                    C.

                                    <?= htmlspecialchars(
                                        $question->option_c
                                        ?? '-'
                                    ) ?>

                                </div>


                                <div>

                                    D.

                                    <?= htmlspecialchars(
                                        $question->option_d
                                        ?? '-'
                                    ) ?>

                                </div>


                            </div>


                        <?php endif; ?>



                        <!-- QUESTION FOOTER -->

                        <div class="question-footer">


                            <span>

                                Type:

                                <?= htmlspecialchars(
                                    strtoupper(
                                        $question->question_type
                                        ?? '-'
                                    )
                                ) ?>

                            </span>


                            <strong>

                                <?= htmlspecialchars(
                                    $question->marks ?? '0'
                                ) ?>

                                marks

                            </strong>


                        </div>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <!-- ========================================
                     EMPTY QUESTIONS
                ======================================== -->

                <div class="empty-state">

                    <h3>
                        No Questions Yet
                    </h3>

                    <p>
                        Add questions to this test
                        before publishing it.
                    </p>


                    <a
                        href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id ?? '') ?>"
                        class="add-question-btn"
                    >
                        + Add First Question
                    </a>

                </div>


            <?php endif; ?>


        </div>


    </section>



    <!-- ========================================
         BACK BUTTON
    ======================================== -->

    <div class="test-back-actions">

        <a
            href="<?= ROOT ?>/teachertests"
            class="back-btn"
        >
            ← Back to Tests
        </a>

    </div>


</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>