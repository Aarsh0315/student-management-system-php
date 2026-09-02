<?php

/*
=====================================================
TEACHER DASHBOARD
=====================================================
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
=====================================================
USER INFORMATION
=====================================================
*/

$firstname =
    $_SESSION['firstname'] ?? 'Teacher';

$lastname =
    $_SESSION['lastname'] ?? '';

$initial =
    strtoupper(
        substr($firstname, 0, 1)
    );


/*
=====================================================
DASHBOARD DATA
=====================================================
*/

$studentCount =
    $data['studentCount'] ?? 0;

$classCount =
    $data['classCount'] ?? 0;

$testCount =
    $data['testCount'] ?? 0;

$resultCount =
    $data['resultCount'] ?? 0;

$parentCount =
    $data['parentCount'] ?? 0;

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
        Teacher Dashboard - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- TEACHER DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-dashboard.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<?php

require "../private/views/includes/nav.view.php";

?>


<?php

require "../private/views/includes/sidebar.view.php";

?>


<!-- =====================================================
     TEACHER DASHBOARD
===================================================== -->

<main class="teacher-page">

    <div class="teacher-container">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    TEACHER OVERVIEW
                </p>


                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?>

                </h1>


                <p class="welcome-description">

                    Manage your students, classes,
                    tests, results and academic activities.

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
                href="<?= ROOT ?>/teacherstudents"
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



            <!-- CLASSES -->

            <a
                href="<?= ROOT ?>/teacherclasses"
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



            <!-- TESTS -->

            <a
                href="<?= ROOT ?>/teachertests"
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



            <!-- RESULTS -->

            <a
                href="<?= ROOT ?>/teacherresults"
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



            <!-- PARENTS -->

            <a
                href="<?= ROOT ?>/teacherparents"
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


        </section>



        <!-- =================================================
             MAIN DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 RECENT ACTIVITY
            ================================================== -->

            <div class="activity-card">


                <div class="card-header">

                    <div>

                        <h2>
                            Recent Activity
                        </h2>

                        <p>
                            Your latest academic activities.
                        </p>

                    </div>


                    <span class="activity-count">
                        Teacher
                    </span>

                </div>


                <div class="activity-list">


                    <!-- STUDENTS -->

                    <div class="activity-item">

                        <div class="activity-icon">
                            ST
                        </div>


                        <div class="activity-info">

                            <strong>
                                Students
                            </strong>

                            <span>
                                Manage students assigned
                                to your school.
                            </span>

                        </div>


                        <time>
                            <?= number_format(
                                $studentCount
                            ) ?>
                        </time>

                    </div>



                    <!-- CLASSES -->

                    <div class="activity-item">

                        <div class="activity-icon">
                            CL
                        </div>


                        <div class="activity-info">

                            <strong>
                                Classes
                            </strong>

                            <span>
                                View your classes and
                                divisions.
                            </span>

                        </div>


                        <time>
                            <?= number_format(
                                $classCount
                            ) ?>
                        </time>

                    </div>



                    <!-- TESTS -->

                    <div class="activity-item">

                        <div class="activity-icon">
                            TS
                        </div>


                        <div class="activity-info">

                            <strong>
                                Tests
                            </strong>

                            <span>
                                Create and manage
                                academic tests.
                            </span>

                        </div>


                        <time>
                            <?= number_format(
                                $testCount
                            ) ?>
                        </time>

                    </div>



                    <!-- RESULTS -->

                    <div class="activity-item">

                        <div class="activity-icon">
                            RS
                        </div>


                        <div class="activity-info">

                            <strong>
                                Results
                            </strong>

                            <span>
                                View student academic
                                results.
                            </span>

                        </div>


                        <time>
                            <?= number_format(
                                $resultCount
                            ) ?>
                        </time>

                    </div>


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
                            Access your main teaching areas.
                        </p>

                    </div>

                </div>


                <div class="management-list">


                    <!-- STUDENTS -->

                    <a
                        href="<?= ROOT ?>/teacherstudents"
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
                                View assigned students
                            </small>

                        </div>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- CLASSES -->

                    <a
                        href="<?= ROOT ?>/teacherclasses"
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



                    <!-- TESTS -->

                    <a
                        href="<?= ROOT ?>/teachertests"
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
                                Create and manage tests
                            </small>

                        </div>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- RESULTS -->

                    <a
                        href="<?= ROOT ?>/teacherresults"
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



                    <!-- PARENTS -->

                    <a
                        href="<?= ROOT ?>/teacherparents"
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
                                View student parents
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
             SYSTEM SUMMARY
        ================================================== -->

        <section class="system-summary">


            <!-- STUDENTS -->

            <div class="summary-item">

                <span class="summary-label">
                    Total Students
                </span>

                <strong>
                    <?= number_format(
                        $studentCount
                    ) ?>
                </strong>

            </div>



            <div class="summary-divider"></div>



            <!-- CLASSES -->

            <div class="summary-item">

                <span class="summary-label">
                    Total Classes
                </span>

                <strong>
                    <?= number_format(
                        $classCount
                    ) ?>
                </strong>

            </div>



            <div class="summary-divider"></div>



            <!-- ACCOUNT -->

            <div class="summary-item">

                <span class="summary-label">
                    Your Account
                </span>

                <strong>
                    Teacher
                </strong>

            </div>


        </section>


    </div>

</main>



<?php

require "../private/views/includes/footer.view.php";

?>


<script src="<?= ROOT ?>/js/nav.js"></script>

<script src="<?= ROOT ?>/js/sidebar.js"></script>


</body>

</html>