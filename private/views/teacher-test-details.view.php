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
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- TEST DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-details.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ========================================= -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Test Details
            </h1>

            <p class="welcome-text">
                View complete test information, settings and questions.
            </p>

        </div>

    </section>



    <?php if ($test): ?>


        <?php

        /*
        ========================================
        TEST STATUS
        ========================================
        */

        $status =
            strtolower(
                $test->status ?? 'draft'
            );


        /*
        ========================================
        TEST TYPE
        ========================================
        */

        $testType =
            strtolower(
                $test->test_type ?? 'quiz'
            );


        $testTypeLabel =
            ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $testType
                )
            );


        /*
        ========================================
        NEGATIVE MARKING
        ========================================
        */

        $negativeMarking =
            !empty(
                $test->negative_marking
            );


        /*
        ========================================
        SHUFFLE SETTINGS
        ========================================
        */

        $shuffleQuestions =
            !empty(
                $test->shuffle_questions
            );


        $shuffleOptions =
            !empty(
                $test->shuffle_options
            );

        ?>


        <!-- ========================================
             TEST PROFILE CARD
        ========================================= -->

        <section class="test-profile-card">

            <div class="test-profile-top">


                <div class="test-icon">
                    T
                </div>


                <div class="test-profile-info">

                    <div class="test-title-row">

                        <div>

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

                        </div>


                        <div class="test-status-area">

                            <?php if ($status === 'active'): ?>

                                <span class="status active">
                                    Active
                                </span>

                            <?php elseif ($status === 'published'): ?>

                                <span class="status active">
                                    Published
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

                        </div>

                    </div>


                    <?php if (!empty($test->subject)): ?>

                        <div class="test-subject">

                            Subject:

                            <strong>
                                <?= htmlspecialchars(
                                    $test->subject
                                ) ?>
                            </strong>

                        </div>

                    <?php endif; ?>


                </div>


            </div>

        </section>



        <!-- ========================================
             TEST OVERVIEW
        ========================================= -->

        <section class="test-overview-grid">


            <!-- TOTAL MARKS -->

            <div class="overview-card">

                <span class="overview-label">
                    Total Marks
                </span>

                <strong class="overview-value">

                    <?= htmlspecialchars(
                        $test->total_marks ?? '0'
                    ) ?>

                </strong>

            </div>


            <!-- PASSING MARKS -->

            <div class="overview-card">

                <span class="overview-label">
                    Passing Marks
                </span>

                <strong class="overview-value">

                    <?= htmlspecialchars(
                        $test->passing_marks ?? '0'
                    ) ?>

                </strong>

            </div>


            <!-- DURATION -->

            <div class="overview-card">

                <span class="overview-label">
                    Duration
                </span>

                <strong class="overview-value">

                    <?= htmlspecialchars(
                        $test->duration ?? '0'
                    ) ?>

                    <small>
                        min
                    </small>

                </strong>

            </div>


            <!-- TEST TYPE -->

            <div class="overview-card">

                <span class="overview-label">
                    Test Type
                </span>

                <strong class="overview-value overview-type">

                    <?= htmlspecialchars(
                        $testTypeLabel
                    ) ?>

                </strong>

            </div>


        </section>



        <!-- ========================================
             TEST INFORMATION
        ========================================= -->

        <section class="test-details-card">


            <div class="details-header">

                <div>

                    <h2>
                        Test Information
                    </h2>

                    <p>
                        Basic information about this test.
                    </p>

                </div>

            </div>


            <div class="details-grid">


                <!-- SCHOOL -->

                <div class="details-item">

                    <span>
                        School ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->school_id ?? '-'
                        ) ?>
                    </strong>

                </div>


                <!-- TEACHER -->

                <div class="details-item">

                    <span>
                        Teacher ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->teacher_id ?? '-'
                        ) ?>
                    </strong>

                </div>


                <!-- SUBJECT -->

                <div class="details-item">

                    <span>
                        Subject
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->subject ?? '-'
                        ) ?>
                    </strong>

                </div>


                <!-- TEST TYPE -->

                <div class="details-item">

                    <span>
                        Test Type
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $testTypeLabel
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


                <!-- PASSING MARKS -->

                <div class="details-item">

                    <span>
                        Passing Marks
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $test->passing_marks ?? '-'
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

                        minutes

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


                <!-- NEGATIVE MARKING -->

                <div class="details-item">

                    <span>
                        Negative Marking
                    </span>

                    <strong>

                        <?php if ($negativeMarking): ?>

                            <span class="setting-enabled">
                                Enabled
                            </span>

                        <?php else: ?>

                            <span class="setting-disabled">
                                Disabled
                            </span>

                        <?php endif; ?>

                    </strong>

                </div>


                <!-- NEGATIVE MARKS -->

                <?php if ($negativeMarking): ?>

                    <div class="details-item">

                        <span>
                            Negative Marks
                        </span>

                        <strong>
                            <?= htmlspecialchars(
                                $test->negative_marks ?? '0'
                            ) ?>
                        </strong>

                    </div>

                <?php endif; ?>


                <!-- SHUFFLE QUESTIONS -->

                <div class="details-item">

                    <span>
                        Shuffle Questions
                    </span>

                    <strong>

                        <?php if ($shuffleQuestions): ?>

                            <span class="setting-enabled">
                                Enabled
                            </span>

                        <?php else: ?>

                            <span class="setting-disabled">
                                Disabled
                            </span>

                        <?php endif; ?>

                    </strong>

                </div>


                <!-- SHUFFLE OPTIONS -->

                <div class="details-item">

                    <span>
                        Shuffle Options
                    </span>

                    <strong>

                        <?php if ($shuffleOptions): ?>

                            <span class="setting-enabled">
                                Enabled
                            </span>

                        <?php else: ?>

                            <span class="setting-disabled">
                                Disabled
                            </span>

                        <?php endif; ?>

                    </strong>

                </div>


            </div>



            <!-- ========================================
                 INSTRUCTIONS
            ========================================= -->

            <?php if (!empty($test->instructions)): ?>

                <div class="description-box">

                    <span>
                        Instructions
                    </span>

                    <p>

                        <?= nl2br(
                            htmlspecialchars(
                                $test->instructions
                            )
                        ) ?>

                    </p>

                </div>

            <?php endif; ?>



            <!-- ========================================
                 DESCRIPTION
            ========================================= -->

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



        <!-- ========================================
             QUESTIONS
        ========================================= -->

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


                <div class="test-header-actions">

                    <?php if ($status === 'draft'): ?>

                        <a
                            href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id ?? '') ?>"
                            class="add-question-btn"
                        >
                            + Add Question
                        </a>

                    <?php endif; ?>

                </div>


            </div>



            <?php if (!empty($questions)): ?>


                <div class="questions-list">


                    <?php

                    $questionNumber = 1;

                    foreach (
                        $questions
                        as $question
                    ):

                        $questionType =
                            strtolower(
                                $question->question_type ?? 'mcq'
                            );


                        $difficulty =
                            strtolower(
                                $question->difficulty ?? 'medium'
                            );


                        $questionTypeLabel =
                            match ($questionType) {

                                'mcq' =>
                                    'MCQ',

                                'msq' =>
                                    'MSQ',

                                'true_false' =>
                                    'True / False',

                                'fill_blank' =>
                                    'Fill in the Blank',

                                'short_answer' =>
                                    'Short Answer',

                                'long_answer' =>
                                    'Descriptive',

                                default =>
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $questionType
                                        )
                                    )

                            };

                    ?>


                        <!-- ========================================
                             QUESTION CARD
                        ========================================= -->

                        <div class="question-card">


                            <div class="question-top">


                                <div class="question-heading">

                                    <span class="question-number">

                                        Question
                                        <?= $questionNumber ?>

                                    </span>


                                    <span class="question-type-badge">

                                        <?= htmlspecialchars(
                                            $questionTypeLabel
                                        ) ?>

                                    </span>


                                    <span
                                        class="difficulty-badge difficulty-<?= htmlspecialchars($difficulty) ?>"
                                    >

                                        <?= htmlspecialchars(
                                            ucfirst($difficulty)
                                        ) ?>

                                    </span>

                                </div>


                                <span class="question-marks">

                                    <?= htmlspecialchars(
                                        $question->marks ?? '0'
                                    ) ?>

                                    marks

                                </span>


                            </div>



                            <!-- ====================================
                                 QUESTION IMAGE
                            ===================================== -->

                            <?php if (
                                !empty(
                                    $question->question_image
                                )
                            ): ?>

                                <div class="question-image">

                                    <img
                                        src="<?= ROOT ?>/<?= htmlspecialchars($question->question_image) ?>"
                                        alt="Question Image"
                                    >

                                </div>

                            <?php endif; ?>



                            <!-- ====================================
                                 QUESTION TEXT
                            ===================================== -->

                            <?php if (
                                !empty(
                                    $question->question
                                )
                            ): ?>

                                <h3>

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $question->question
                                        )
                                    ) ?>

                                </h3>

                            <?php endif; ?>



                            <!-- ====================================
                                 MCQ OPTIONS
                            ===================================== -->

                            <?php if (
                                $questionType === 'mcq'
                            ): ?>


                                <div class="options">


                                    <?php

                                    $options = [

                                        'A' =>
                                            $question->option_a ?? '',

                                        'B' =>
                                            $question->option_b ?? '',

                                        'C' =>
                                            $question->option_c ?? '',

                                        'D' =>
                                            $question->option_d ?? ''

                                    ];


                                    $correctAnswer =
                                        strtoupper(
                                            $question->correct_answer ?? ''
                                        );


                                    foreach (
                                        $options
                                        as $letter => $option
                                    ):

                                        $isCorrect =
                                            $correctAnswer ===
                                            $letter;

                                    ?>


                                        <div
                                            class="option <?= $isCorrect ? 'correct-option' : '' ?>"
                                        >

                                            <strong>
                                                <?= $letter ?>
                                            </strong>

                                            <span>

                                                <?= htmlspecialchars(
                                                    $option ?: '-'
                                                ) ?>

                                            </span>


                                            <?php if ($isCorrect): ?>

                                                <span class="answer-badge">
                                                    Correct
                                                </span>

                                            <?php endif; ?>

                                        </div>


                                    <?php endforeach; ?>


                                </div>


                            <?php endif; ?>



                            <!-- ====================================
                                 MSQ OPTIONS
                            ===================================== -->

                            <?php if (
                                $questionType === 'msq'
                            ): ?>


                                <?php

                                $correctAnswers = [];

                                if (
                                    isset(
                                        $question->correct_answers
                                    )
                                ) {

                                    if (
                                        is_array(
                                            $question->correct_answers
                                        )
                                    ) {

                                        $correctAnswers =
                                            $question->correct_answers;

                                    } else {

                                        $decoded =
                                            json_decode(
                                                $question->correct_answers,
                                                true
                                            );

                                        if (
                                            is_array($decoded)
                                        ) {

                                            $correctAnswers =
                                                $decoded;
                                        }
                                    }
                                }


                                $correctAnswers =
                                    array_map(
                                        'strtoupper',
                                        $correctAnswers
                                    );


                                $options = [

                                    'A' =>
                                        $question->option_a ?? '',

                                    'B' =>
                                        $question->option_b ?? '',

                                    'C' =>
                                        $question->option_c ?? '',

                                    'D' =>
                                        $question->option_d ?? ''

                                ];

                                ?>


                                <div class="options">


                                    <?php foreach (
                                        $options
                                        as $letter => $option
                                    ):

                                        $isCorrect =
                                            in_array(
                                                $letter,
                                                $correctAnswers,
                                                true
                                            );

                                    ?>


                                        <div
                                            class="option <?= $isCorrect ? 'correct-option' : '' ?>"
                                        >

                                            <strong>
                                                <?= $letter ?>
                                            </strong>

                                            <span>

                                                <?= htmlspecialchars(
                                                    $option ?: '-'
                                                ) ?>

                                            </span>


                                            <?php if ($isCorrect): ?>

                                                <span class="answer-badge">
                                                    Correct
                                                </span>

                                            <?php endif; ?>

                                        </div>


                                    <?php endforeach; ?>


                                </div>


                                <div class="correct-answer">

                                    <span class="answer-label">
                                        Correct Answers
                                    </span>

                                    <strong>

                                        <?= htmlspecialchars(
                                            implode(
                                                ', ',
                                                $correctAnswers
                                            )
                                        ) ?>

                                    </strong>

                                </div>


                            <?php endif; ?>



                            <!-- ====================================
                                 TRUE / FALSE
                            ===================================== -->

                            <?php if (
                                $questionType === 'true_false'
                            ): ?>


                                <div class="true-false-answer">

                                    <span class="answer-label">
                                        Correct Answer
                                    </span>

                                    <strong>

                                        <?= htmlspecialchars(
                                            ucfirst(
                                                strtolower(
                                                    $question->correct_answer ?? '-'
                                                )
                                            )
                                        ) ?>

                                    </strong>

                                </div>


                            <?php endif; ?>



                            <!-- ====================================
                                 FILL IN BLANK
                            ===================================== -->

                            <?php if (
                                $questionType === 'fill_blank'
                            ): ?>


                                <div class="correct-answer">

                                    <span class="answer-label">
                                        Correct Answer
                                    </span>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $question->correct_answer ?? '-'
                                        ) ?>

                                    </strong>

                                </div>


                            <?php endif; ?>



                            <!-- ====================================
                                 SHORT / LONG ANSWER
                            ===================================== -->

                            <?php if (
                                $questionType === 'short_answer' ||
                                $questionType === 'long_answer'
                            ): ?>


                                <div class="manual-grading-note">

                                    <strong>
                                        Manual Evaluation
                                    </strong>

                                    <span>
                                        This question requires teacher evaluation.
                                    </span>

                                </div>


                                <?php if (
                                    !empty(
                                        $question->correct_answer
                                    )
                                ): ?>

                                    <div class="correct-answer">

                                        <span class="answer-label">
                                            Reference Answer
                                        </span>

                                        <strong>

                                            <?= nl2br(
                                                htmlspecialchars(
                                                    $question->correct_answer
                                                )
                                            ) ?>

                                        </strong>

                                    </div>

                                <?php endif; ?>


                            <?php endif; ?>



                            <!-- ====================================
                                 EXPLANATION
                            ===================================== -->

                            <?php if (
                                !empty(
                                    $question->explanation
                                )
                            ): ?>


                                <div class="question-explanation">

                                    <span>
                                        Explanation
                                    </span>

                                    <p>

                                        <?= nl2br(
                                            htmlspecialchars(
                                                $question->explanation
                                            )
                                        ) ?>

                                    </p>

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


                    <a
                        href="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id ?? '') ?>"
                        class="empty-create-btn"
                    >
                        Add First Question
                    </a>

                </div>


            <?php endif; ?>


        </section>



        <!-- ========================================
             ACTIONS
        ========================================= -->

        <div class="test-actions">


            <?php if (
                $status === 'draft' &&
                !empty($questions)
            ): ?>

                <form
                    method="POST"
                    action="<?= ROOT ?>/teachertests/publish/<?= urlencode($test->test_id ?? '') ?>"
                    onsubmit="return confirm('Are you sure you want to publish this test?')"
                    class="publish-test-form"
                >

                    <?= CSRF::field() ?>


                    <button
                        type="submit"
                        class="publish-test-btn"
                    >
                        Publish Test
                    </button>

                </form>

            <?php endif; ?>


            <a
                href="<?= ROOT ?>/teachertests"
                class="back-btn"
            >
                ← Back to Tests
            </a>


        </div>


    <?php else: ?>


        <section class="empty-state">

            <h3>
                Test Not Found
            </h3>

            <p>
                The requested test could not be found.
            </p>

            <a
                href="<?= ROOT ?>/teachertests"
                class="back-btn"
            >
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