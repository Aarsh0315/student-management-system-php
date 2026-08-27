<?php

$test =
    $data['test'] ?? null;

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
        <?= htmlspecialchars(
            $test->title ?? 'Test'
        ) ?>
        - My School
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-test-start.view.css?v=1"
    >


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-nav.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/student-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         TEST HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Student
            </p>

            <h1>

                <?= htmlspecialchars(
                    $test->title ?? 'Test'
                ) ?>

            </h1>

            <p class="welcome-text">

                Prepare yourself before
                starting the examination.

            </p>

        </div>

    </section>



    <!-- ========================================
         TEST INFORMATION
    ======================================== -->

    <section class="test-start-card">


        <div class="test-start-header">

            <h2>
                Test Information
            </h2>

            <span class="status active">
                Ready
            </span>

        </div>


        <div class="test-info-grid">


            <div class="test-info-item">

                <span>
                    Test
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $test->title ?? '-'
                    ) ?>

                </strong>

            </div>


            <div class="test-info-item">

                <span>
                    Class
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $test->class ?? '-'
                    ) ?>

                    -

                    <?= htmlspecialchars(
                        $test->division ?? '-'
                    ) ?>

                </strong>

            </div>


            <div class="test-info-item">

                <span>
                    Total Marks
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $test->total_marks ?? '0'
                    ) ?>

                </strong>

            </div>


            <div class="test-info-item">

                <span>
                    Questions
                </span>

                <strong>

                    <?= count($questions) ?>

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


    </section>



    <!-- ========================================
         INSTRUCTIONS
    ======================================== -->

    <section class="test-start-card">


        <div class="test-start-header">

            <h2>
                Test Instructions
            </h2>

        </div>


        <div class="test-instructions">


            <div class="instruction-item">

                <span class="instruction-number">
                    1
                </span>

                <p>
                    Make sure you have a stable
                    internet connection before
                    starting the test.
                </p>

            </div>


            <div class="instruction-item">

                <span class="instruction-number">
                    2
                </span>

                <p>
                    Your camera will be required
                    before the examination starts.
                </p>

            </div>


            <div class="instruction-item">

                <span class="instruction-number">
                    3
                </span>

                <p>
                    The examination will use
                    fullscreen mode.
                </p>

            </div>


            <div class="instruction-item">

                <span class="instruction-number">
                    4
                </span>

                <p>
                    Do not leave the examination
                    window while the test is running.
                </p>

            </div>


            <div class="instruction-item">

                <span class="instruction-number">
                    5
                </span>

                <p>
                    The test will be automatically
                    submitted when the timer expires.
                </p>

            </div>


        </div>


    </section>



    <!-- ========================================
         START AREA
    ======================================== -->

    <section class="test-start-action">

    <p>
        By clicking <strong>Continue</strong>,
        you agree to the test instructions.
    </p>

    <a
        href="<?= ROOT ?>/studenttests/camera/<?= urlencode($test->test_id) ?>"
        class="continue-test-btn"
    >
        Continue
    </a>

</section>

</main>


</body>

</html>