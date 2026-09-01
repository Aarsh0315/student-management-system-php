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

$lastname =
    $_SESSION['lastname'] ?? '';

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
         NAVBAR
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- =================================================
         SCHOOL ADMIN DASHBOARD
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=1"
    >


    <!-- =================================================
         SIDEBAR
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- =================================================
         FOOTER
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
                    SCHOOL ADMINISTRATION
                </p>


                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?>

                </h1>


                <p class="welcome-description">

                    Here's an overview of your school's
                    students, staff, parents and academic activity.

                </p>

            </div>


            <!-- STATUS -->

            <div class="dashboard-status">

                <span class="status-dot"></span>

                <span>
                    Active
                </span>

            </div>

        </section>



        <!-- =================================================
             KPI CARDS
        ================================================== -->

        <section class="kpi-grid">


            <!-- STUDENTS -->

            <a
                href="<?= ROOT ?>/students"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    🎓
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



            <!-- STAFF -->

            <a
                href="<?= ROOT ?>/staff"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    🧑‍🏫
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



            <!-- PARENTS -->

            <a
                href="<?= ROOT ?>/parents"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    👨‍👩‍👧
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



            <!-- CLASSES -->

            <a
                href="<?= ROOT ?>/classes"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    🏫
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



            <!-- TESTS -->

            <a
                href="<?= ROOT ?>/tests"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    📝
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



            <!-- RESULTS -->

            <a
                href="<?= ROOT ?>/results"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    📊
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



        <!-- =================================================
             MAIN DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 SCHOOL OVERVIEW
            ================================================== -->

            <div class="activity-card">


                <div class="card-header">

                    <div>

                        <h2>
                            School Overview
                        </h2>

                        <p>
                            Quick overview of your school's
                            management areas.
                        </p>

                    </div>


                    <span class="activity-count">
                        Overview
                    </span>

                </div>



                <div class="activity-list">


                    <!-- STUDENTS -->

                    <a
                        href="<?= ROOT ?>/students"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            🎓
                        </div>


                        <div class="overview-info">

                            <strong>
                                Students
                            </strong>

                            <span>
                                Registered students
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $studentCount
                            ) ?>

                        </strong>

                    </a>



                    <!-- STAFF -->

                    <a
                        href="<?= ROOT ?>/staff"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            🧑‍🏫
                        </div>


                        <div class="overview-info">

                            <strong>
                                Staff
                            </strong>

                            <span>
                                Teachers and staff members
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $staffCount
                            ) ?>

                        </strong>

                    </a>



                    <!-- PARENTS -->

                    <a
                        href="<?= ROOT ?>/parents"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            👨‍👩‍👧
                        </div>


                        <div class="overview-info">

                            <strong>
                                Parents
                            </strong>

                            <span>
                                Parents associated with students
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $parentCount
                            ) ?>

                        </strong>

                    </a>



                    <!-- CLASSES -->

                    <a
                        href="<?= ROOT ?>/classes"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            🏫
                        </div>


                        <div class="overview-info">

                            <strong>
                                Classes
                            </strong>

                            <span>
                                Classes and divisions
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $classCount
                            ) ?>

                        </strong>

                    </a>



                    <!-- TESTS -->

                    <a
                        href="<?= ROOT ?>/tests"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            📝
                        </div>


                        <div class="overview-info">

                            <strong>
                                Tests
                            </strong>

                            <span>
                                Academic assessments
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $testCount
                            ) ?>

                        </strong>

                    </a>



                    <!-- RESULTS -->

                    <a
                        href="<?= ROOT ?>/results"
                        class="overview-item"
                    >

                        <div class="overview-icon">
                            📊
                        </div>


                        <div class="overview-info">

                            <strong>
                                Results
                            </strong>

                            <span>
                                Student academic results
                            </span>

                        </div>


                        <strong class="overview-count">

                            <?= number_format(
                                $resultCount
                            ) ?>

                        </strong>

                    </a>


                </div>

            </div>



            <!-- =================================================
                 QUICK MANAGEMENT
            ================================================== -->

            <div class="management-card">


                <div class="card-header">

                    <div>

                        <h2>
                            Quick Management
                        </h2>

                        <p>
                            Frequently used school areas.
                        </p>

                    </div>

                </div>



                <div class="management-list">


                    <!-- STUDENTS -->

                    <a
                        href="<?= ROOT ?>/students"
                        class="management-item"
                    >

                        <span class="management-icon">
                            🎓
                        </span>


                        <span class="management-info">

                            <strong>
                                Students
                            </strong>

                            <small>
                                Manage student records
                            </small>

                        </span>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- STAFF -->

                    <a
                        href="<?= ROOT ?>/staff"
                        class="management-item"
                    >

                        <span class="management-icon">
                            🧑‍🏫
                        </span>


                        <span class="management-info">

                            <strong>
                                Staff
                            </strong>

                            <small>
                                Manage teachers and staff
                            </small>

                        </span>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- PARENTS -->

                    <a
                        href="<?= ROOT ?>/parents"
                        class="management-item"
                    >

                        <span class="management-icon">
                            👨‍👩‍👧
                        </span>


                        <span class="management-info">

                            <strong>
                                Parents
                            </strong>

                            <small>
                                Manage parent records
                            </small>

                        </span>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- CLASSES -->

                    <a
                        href="<?= ROOT ?>/classes"
                        class="management-item"
                    >

                        <span class="management-icon">
                            🏫
                        </span>


                        <span class="management-info">

                            <strong>
                                Classes
                            </strong>

                            <small>
                                Manage classes and divisions
                            </small>

                        </span>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- TESTS -->

                    <a
                        href="<?= ROOT ?>/tests"
                        class="management-item"
                    >

                        <span class="management-icon">
                            📝
                        </span>


                        <span class="management-info">

                            <strong>
                                Tests
                            </strong>

                            <small>
                                View academic assessments
                            </small>

                        </span>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- RESULTS -->

                    <a
                        href="<?= ROOT ?>/results"
                        class="management-item"
                    >

                        <span class="management-icon">
                            📊
                        </span>


                        <span class="management-info">

                            <strong>
                                Results
                            </strong>

                            <small>
                                View student results
                            </small>

                        </span>


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



            <div class="summary-divider"></div>



            <!-- TOTAL PARENTS -->

            <div class="summary-item">

                <span>
                    Total Parents
                </span>

                <strong>
                    <?= number_format(
                        $parentCount
                    ) ?>
                </strong>

            </div>



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