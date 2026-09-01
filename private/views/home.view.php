<?php

/* =====================================================
   SCHOOL ADMIN DASHBOARD
===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =====================================================
   USER INFORMATION
===================================================== */

$firstname =
    $_SESSION['firstname'] ?? 'School Admin';


$initial =
    strtoupper(
        substr($firstname, 0, 1)
    );


/* =====================================================
   KPI DATA
===================================================== */

$studentCount =
    $data['student_count'] ?? 0;


$staffCount =
    $data['staff_count'] ?? 0;


$parentCount =
    $data['parent_count'] ?? 0;


$classCount =
    $data['class_count'] ?? 0;


$testCount =
    $data['test_count'] ?? 0;


$resultCount =
    $data['result_count'] ?? 0;


/* =====================================================
   RECENT ACTIVITY
===================================================== */

$recentActivities =
    $data['recentActivities'] ?? [];

/* ========================================
   RECENT ACTIVITIES
======================================== */

$recent_activities =
    $data['recent_activities'] ?? [];

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
        School Admin Dashboard - My School
    </title>


    <!-- =================================================
         NAVBAR CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- =================================================
         SCHOOL ADMIN CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=1"
    >


    <!-- =================================================
         SIDEBAR CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- =================================================
         FOOTER CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php

require "../private/views/includes/nav.view.php";

?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php

require "../private/views/includes/sidebar.view.php";

?>


<!-- =====================================================
     MAIN DASHBOARD
===================================================== -->

<main class="schooladmin-page">

    <div class="schooladmin-container">


        <!-- =================================================
             WELCOME SECTION
        ================================================== -->

        <section class="dashboard-welcome">


            <div class="welcome-content">


                <p class="welcome-label">
                    SCHOOL OVERVIEW
                </p>


                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?>
                    Admin

                </h1>


                <p class="welcome-description">

                    Here's an overview of your school
                    management system and recent activity.

                </p>


            </div>


            <!-- =================================================
                 SYSTEM STATUS
            ================================================== -->

            <div class="dashboard-status">

                <span class="status-dot"></span>

                <span>
                    System Active
                </span>

            </div>


        </section>



        <!-- =================================================
             KPI CARDS
        ================================================== -->

        <section class="kpi-grid">


            <!-- =================================================
                 STUDENTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/students"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    ST
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Students
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $studentCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 STAFF
            ================================================== -->

            <a
                href="<?= ROOT ?>/staff"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    SF
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Staff
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $staffCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 PARENTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/parents"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    PR
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Parents
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $parentCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 CLASSES
            ================================================== -->

            <a
                href="<?= ROOT ?>/classes"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    CL
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Classes
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $classCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 TESTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/tests"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    TS
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Tests
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $testCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 RESULTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/results"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    RS
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Results
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $resultCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>


        </section>



        <!-- ========================================
     MAIN DASHBOARD GRID
======================================== -->

<section class="dashboard-grid">


    <!-- ========================================
         RECENT ACTIVITY
    ======================================== -->

    <div class="activity-card">

        <div class="card-header">

            <div>

                <h2>
                    Recent Activity
                </h2>

                <p>
                    Recent activity from your school
                </p>

            </div>

            <span class="activity-count">
                <?= count($recent_activities) ?>
            </span>

        </div>


        <div class="activity-list">


            <?php if (!empty($recent_activities)): ?>


                <?php foreach (
                    $recent_activities
                    as $activity
                ): ?>


                    <div class="activity-item">


                        <div class="activity-icon">

                            <?= htmlspecialchars(
                                $activity['icon']
                            ) ?>

                        </div>


                        <div class="activity-info">

                            <strong>

                                <?= htmlspecialchars(
                                    $activity['title']
                                ) ?>

                            </strong>


                            <span>

                                <?= htmlspecialchars(
                                    $activity['description']
                                ) ?>

                            </span>

                        </div>


                        <time>

                            <?= htmlspecialchars(
                                $activity['time']
                            ) ?>

                        </time>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <div class="activity-empty">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h3>
                        No Recent Activity
                    </h3>

                    <p>
                        There is no recent activity
                        to display.
                    </p>

                </div>


            <?php endif; ?>


        </div>

    </div>



    <!-- ========================================
         SCHOOL MANAGEMENT
    ======================================== -->

    <div class="management-card">

        <div class="card-header">

            <div>

                <h2>
                    School Management
                </h2>

                <p>
                    Manage your school
                </p>

            </div>

        </div>


        <div class="management-list">


            <a
                href="<?= ROOT ?>/students"
                class="management-item"
            >

                <div class="management-icon">
                    ST
                </div>

                <div class="management-info">

                    <strong>
                        Students
                    </strong>

                    <small>
                        Manage school students
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


            <a
                href="<?= ROOT ?>/teachers"
                class="management-item"
            >

                <div class="management-icon">
                    TC
                </div>

                <div class="management-info">

                    <strong>
                        Teachers
                    </strong>

                    <small>
                        Manage teachers and staff
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


            <a
                href="<?= ROOT ?>/parents"
                class="management-item"
            >

                <div class="management-icon">
                    PR
                </div>

                <div class="management-info">

                    <strong>
                        Parents
                    </strong>

                    <small>
                        Manage student parents
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


            <a
                href="<?= ROOT ?>/classes"
                class="management-item"
            >

                <div class="management-icon">
                    CL
                </div>

                <div class="management-info">

                    <strong>
                        Classes
                    </strong>

                    <small>
                        View classes and divisions
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


            <a
                href="<?= ROOT ?>/tests"
                class="management-item"
            >

                <div class="management-icon">
                    TS
                </div>

                <div class="management-info">

                    <strong>
                        Tests
                    </strong>

                    <small>
                        View school tests
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


            <a
                href="<?= ROOT ?>/results"
                class="management-item"
            >

                <div class="management-icon">
                    RS
                </div>

                <div class="management-info">

                    <strong>
                        Results
                    </strong>

                    <small>
                        View student results
                    </small>

                </div>

                <span class="management-arrow">
                    →
                </span>

            </a>


        </div>

    </div>

</section>



        <!-- =================================================
             SCHOOL SUMMARY
        ================================================== -->

        <section class="system-summary">


            <!-- TOTAL STUDENTS -->

            <div class="summary-item">

                <span>
                    Total Students
                </span>


                <strong>

                    <?= number_format(
                        $studentCount
                    ) ?>

                </strong>

            </div>



            <!-- DIVIDER -->

            <div class="summary-divider"></div>



            <!-- TOTAL STAFF -->

            <div class="summary-item">

                <span>
                    Total Staff
                </span>


                <strong>

                    <?= number_format(
                        $staffCount
                    ) ?>

                </strong>

            </div>



            <!-- DIVIDER -->

            <div class="summary-divider"></div>



            <!-- PROFILE -->

            <div class="summary-item">

                <span>
                    Your Account
                </span>


                <strong>

                    <a
                        href="<?= ROOT ?>/profile"
                    >
                        View Profile →
                    </a>

                </strong>

            </div>


        </section>


    </div>

</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<?php

require "../private/views/includes/footer.view.php";

?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>