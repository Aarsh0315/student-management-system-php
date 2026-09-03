<?php

$result = $data['result'] ?? null;

$integrity = $data['integrity'] ?? null;

$riskLevel = strtoupper(
    $data['riskLevel'] ?? 'LOW'
);

$events = $data['events'] ?? [];

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


    <!-- TEACHER RESULT DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-result-details.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
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

        <p class="welcome-small">
            Teacher
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
        ========================================= -->

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

                $status = strtolower(
                    trim($result->status ?? '')
                );

                ?>


                <?php if (
                    $status === 'pass' ||
                    $status === 'passed'
                ): ?>

                    <span class="result-status passed">
                        Passed
                    </span>


                <?php elseif (
                    $status === 'fail' ||
                    $status === 'failed'
                ): ?>

                    <span class="result-status failed">
                        Failed
                    </span>


                <?php elseif (
                    $status === 'pending'
                ): ?>

                    <span class="result-status pending">
                        Pending
                    </span>


                <?php else: ?>

                    <span class="result-status">

                        <?= htmlspecialchars(
                            ucfirst(
                                $result->status
                                ?? 'Completed'
                            )
                        ) ?>

                    </span>

                <?php endif; ?>


            </div>


            <!-- ========================================
                 RESULT INFORMATION
            ========================================= -->

            <div class="result-summary-grid">


                <div class="result-summary-item">

                    <span>
                        Result ID
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->result_id ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Student
                    </span>

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

                    <span>
                        Student ID
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->student_id ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Test
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->test_title
                            ?? $result->title
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Class
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->class ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Division
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->division ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Total Marks
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->total_marks ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Obtained Marks
                    </span>

                    <strong class="obtained-marks">

                        <?= htmlspecialchars(
                            $result->obtained_marks ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-summary-item">

                    <span>
                        Percentage
                    </span>

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
        ========================================= -->

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

                    <span>
                        Student Name
                    </span>

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

                    <span>
                        Email
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->email ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Admission Number
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->admission_number ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Class
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->class ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Division
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->division ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Roll Number
                    </span>

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
        ========================================= -->

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

                    <span>
                        Test ID
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->test_id ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Test Title
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->test_title
                            ?? $result->title
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Duration
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->duration ?? '-'
                        ) ?>

                        <?php if (
                            !empty($result->duration)
                        ): ?>

                            minutes

                        <?php endif; ?>

                    </strong>

                </div>


                <div class="result-information-item">

                    <span>
                        Total Marks
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->total_marks ?? '-'
                        ) ?>

                    </strong>

                </div>


                <div class="result-information-item">

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


                <div class="result-information-item">

                    <span>
                        Result Date
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $result->created_at ?? '-'
                        ) ?>

                    </strong>

                </div>


            </div>


        </section>



        <!-- ========================================
             EXAM INTEGRITY
        ========================================= -->

        <section class="result-info-card exam-integrity-card">


            <div class="result-section-header">

                <h2>
                    Exam Integrity
                </h2>

                <p>
                    Activity recorded during the student's examination.
                </p>

            </div>


            <?php

            $riskClass =
                strtolower($riskLevel);

            ?>


            <!-- ========================================
                 INTEGRITY STATUS
            ========================================= -->

            <div class="integrity-status-row">

                <div>

                    <span class="integrity-label">
                        Integrity Status
                    </span>

                    <p class="integrity-description">
                        Based on recorded examination activity.
                    </p>

                </div>


                <span
                    class="integrity-risk <?= htmlspecialchars(
                        $riskClass
                    ) ?>"
                >

                    <?= htmlspecialchars(
                        $riskLevel
                    ) ?>

                    RISK

                </span>

            </div>



            <!-- ========================================
                 INTEGRITY COUNTS
            ========================================= -->

            <div class="integrity-grid">


                <div class="integrity-item">

                    <span>
                        Tab Switches
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->tab_switches
                            ?? 0
                        ) ?>

                    </strong>

                </div>


                <div class="integrity-item">

                    <span>
                        Fullscreen Exits
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->fullscreen_exits
                            ?? 0
                        ) ?>

                    </strong>

                </div>


                <div class="integrity-item">

                    <span>
                        Copy Attempts
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->copy_attempts
                            ?? 0
                        ) ?>

                    </strong>

                </div>


                <div class="integrity-item">

                    <span>
                        Paste Attempts
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->paste_attempts
                            ?? 0
                        ) ?>

                    </strong>

                </div>


                <div class="integrity-item">

                    <span>
                        Right Click Attempts
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->right_click_attempts
                            ?? 0
                        ) ?>

                    </strong>

                </div>


                <div class="integrity-item">

                    <span>
                        Camera Disconnects
                    </span>

                    <strong>

                        <?= (int) (
                            $integrity->camera_disconnects
                            ?? 0
                        ) ?>

                    </strong>

                </div>


            </div>



            <!-- ========================================
                 ACTIVITY TIMELINE
            ========================================= -->

            <div class="integrity-timeline-section">

                <h3>
                    Activity Timeline
                </h3>


                <?php if (!empty($events)): ?>


                    <div class="integrity-timeline">


                        <?php foreach (
                            $events as $event
                        ): ?>


                            <?php

                            $eventName =
                                str_replace(
                                    '_',
                                    ' ',
                                    $event->event_type
                                    ?? ''
                                );

                            $eventName =
                                ucwords(
                                    $eventName
                                );

                            ?>


                            <div class="integrity-event">


                                <div class="integrity-event-time">

                                    <?= htmlspecialchars(
                                        $event->created_at
                                        ?? '-'
                                    ) ?>

                                </div>


                                <div class="integrity-event-content">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $eventName
                                        ) ?>

                                    </strong>


                                    <?php if (
                                        !empty(
                                            $event->event_details
                                        )
                                    ): ?>

                                        <p>

                                            <?= htmlspecialchars(
                                                $event->event_details
                                            ) ?>

                                        </p>

                                    <?php endif; ?>


                                </div>


                            </div>


                        <?php endforeach; ?>


                    </div>


                <?php else: ?>


                    <div class="integrity-empty">

                        <strong>
                            No integrity events recorded
                        </strong>

                        <p>
                            No examination activity has been recorded for this attempt.
                        </p>

                    </div>


                <?php endif; ?>


            </div>



            <!-- ========================================
                 INTEGRITY NOTE
            ========================================= -->

            <div class="integrity-note">

                <strong>
                    Integrity Notice
                </strong>

                <p>
                    The integrity status is an activity-based risk indicator.
                    It does not by itself prove that cheating occurred or did not occur.
                </p>

            </div>


        </section>



        <!-- ========================================
             ACTION
        ======================================== -->

        <div class="result-actions">

            <a
                href="<?= ROOT ?>/teacherresults"
                class="back-results-btn"
            >
                ← Back to Results
            </a>

        </div>


    <?php else: ?>


        <!-- ========================================
             RESULT NOT FOUND
        ========================================= -->

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
                        href="<?= ROOT ?>/teacherresults"
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