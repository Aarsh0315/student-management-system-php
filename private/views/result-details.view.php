<?php

$result = $data['result'] ?? null;

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


    <!-- NAV -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- HOME -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- RESULT DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/result-details.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <p class="welcome-small">
            Results
        </p>

        <h1>
            Result Details
        </h1>

        <p class="welcome-text">
            View the complete details of this student result.
        </p>

    </section>


    <?php if ($result): ?>


        <!-- ========================================
             RESULT SUMMARY
        ======================================== -->

        <section class="result-summary-card">


            <div class="result-summary-header">

                <div>

                    <h2>
                        <?= htmlspecialchars(
                            $result->test_title
                            ?? $result->title
                            ?? 'Test Result'
                        ) ?>
                    </h2>

                    <p>
                        Student result information
                    </p>

                </div>


                <?php

                $status =
                    strtolower(
                        $result->status ?? ''
                    );

                ?>


                <?php if ($status === 'passed'): ?>

                    <span class="result-status passed">
                        Passed
                    </span>

                <?php elseif ($status === 'failed'): ?>

                    <span class="result-status failed">
                        Failed
                    </span>

                <?php else: ?>

                    <span class="result-status">
                        <?= htmlspecialchars(
                            ucfirst(
                                $result->status ?? 'Completed'
                            )
                        ) ?>
                    </span>

                <?php endif; ?>


            </div>


            <!-- ========================================
                 RESULT INFORMATION
            ======================================== -->

            <div class="result-summary-grid">


                <div class="result-summary-item">

                    <span>Result ID</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->result_id ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Student</span>

                    <strong>
                        <?= htmlspecialchars(
                            trim(
                                ($result->firstname ?? '')
                                . ' '
                                . ($result->lastname ?? '')
                            ) ?: '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Student ID</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->student_id ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Test</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->test_title
                            ?? $result->title
                            ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Class</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->class ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Division</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->division ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Total Marks</span>

                    <strong>
                        <?= htmlspecialchars(
                            $result->total_marks ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Obtained Marks</span>

                    <strong class="obtained-marks">
                        <?= htmlspecialchars(
                            $result->obtained_marks ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>Percentage</span>

                    <strong class="percentage">
                        <?= htmlspecialchars(
                            $result->percentage ?? '-'
                        ) ?>%
                    </strong>

                </div>


            </div>


        </section>


        <!-- ========================================
             STUDENT INFORMATION
        ======================================== -->

        <section class="result-info-card">


            <div class="result-section-header">

                <h2>
                    Student Information
                </h2>

                <p>
                    Information about the student who attempted the test.
                </p>

            </div>


            <div class="result-information-grid">


                <div class="result-information-item">

                    <span>Student Name</span>

                    <strong>

                        <?= htmlspecialchars(
                            trim(
                                ($result->firstname ?? '')
                                . ' '
                                . ($result->lastname ?? '')
                            ) ?: '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Email</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->email ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Admission Number</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->admission_number
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Class</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->class ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Division</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->division ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Roll Number</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->roll_number ?? '-'
                        ) ?>

                    </strong>

                </div>


            </div>


        </section>


        <!-- ========================================
             TEST INFORMATION
        ======================================== -->

        <section class="result-info-card">


            <div class="result-section-header">

                <h2>
                    Test Information
                </h2>

                <p>
                    Details about the test associated with this result.
                </p>

            </div>


            <div class="result-information-grid">


                <div class="result-information-item">

                    <span>Test ID</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->test_id ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Test Title</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->test_title
                            ?? $result->title
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Duration</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->duration ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Total Marks</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->total_marks ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Result Status</span>

                    <strong>

                        <?= htmlspecialchars(
                            ucfirst(
                                $result->status ?? '-'
                            )
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>Result Date</span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->created_at ?? '-'
                        ) ?>

                    </strong>

                </div>


            </div>


        </section>


        <!-- ========================================
             ACTIONS
        ======================================== -->

        <div class="result-actions">

            <a
                href="<?= ROOT ?>/results"
                class="back-results-btn"
            >
                ← Back to Results
            </a>

        </div>


    <?php else: ?>


        <!-- ========================================
             EMPTY STATE
        ======================================== -->

        <section class="result-info-card">

            <div class="empty-state">

                <h3>
                    Result Not Found
                </h3>

                <p>
                    The requested result could not be found.
                </p>

                <div class="result-actions">

                    <a
                        href="<?= ROOT ?>/results"
                        class="back-results-btn"
                    >
                        ← Back to Results
                    </a>

                </div>

            </div>

        </section>


    <?php endif; ?>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>