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


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-details.view.css?v=1"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/teacher-nav.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

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



    <!-- TEST CARD -->

    <section class="test-details-card">


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


            <span
                class="status <?= htmlspecialchars(
                    $test->status ?? 'draft'
                ) ?>"
            >
                <?= htmlspecialchars(
                    ucfirst(
                        $test->status ?? 'Draft'
                    )
                ) ?>
            </span>

            <?php if (
                ($test->status ?? 'draft') === 'draft'
            ): ?>

                <a
                    href="<?= ROOT ?>/teachertests/publish/<?= urlencode($test->test_id) ?>"
                    class="publish-test-btn"
                    onclick="return confirm('Are you sure you want to publish this test?');"
                >
                    Publish Test
                </a>

            <?php endif; ?>

        </div>



        <!-- TEST INFORMATION -->

        <div class="test-info-grid">


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


            <div class="test-info-item">

                <span>
                    Question Marks
                </span>

                <strong>
                    <?= $totalQuestionMarks ?>
                </strong>

            </div>


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



        <!-- QUESTIONS -->

        <div class="questions-section">

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


                <a
                    href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id) ?>"
                    class="add-question-btn"
                >
                    + Add Question
                </a>

            </div>


            <?php if (!empty($questions)): ?>

                <?php foreach (
                    $questions as $index => $question
                ): ?>

                    <div class="question-card">

                        <div class="question-number">

                            Question <?= $index + 1 ?>

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

                <div class="empty-state">

                    <h3>
                        No Questions Yet
                    </h3>

                    <p>
                        Add questions to this test
                        before publishing it.
                    </p>

                    <a
                        href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id) ?>"
                        class="add-question-btn"
                    >
                        + Add First Question
                    </a>

                </div>

            <?php endif; ?>

        </div>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>