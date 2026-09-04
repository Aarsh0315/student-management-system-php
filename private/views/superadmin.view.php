<?php

/* =====================================================
   SUPER ADMIN DASHBOARD
===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =====================================================
   USER INFORMATION
===================================================== */

$firstname = $_SESSION['firstname'] ?? 'Super Admin';

$initial = strtoupper(
    substr($firstname, 0, 1)
);


/* =====================================================
   KPI DATA
===================================================== */

$schoolCount =
    $data['schoolCount'] ?? 0;

$userCount =
    $data['userCount'] ?? 0;

$studentCount =
    $data['studentCount'] ?? 0;

$staffCount =
    $data['staffCount'] ?? 0;

$parentCount =
    $data['parentCount'] ?? 0;

$testCount =
    $data['testCount'] ?? 0;

$resultCount =
    $data['resultCount'] ?? 0;


/* =====================================================
   RECENT ACTIVITY
===================================================== */

$recentActivities =
    $data['recentActivities'] ?? [];

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
        Super Admin Dashboard - My School
    </title>


    <!-- =================================================
         NAVBAR CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- =================================================
         SUPER ADMIN CSS
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css?v=6"
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

<main class="superadmin-page">

    <div class="superadmin-container">


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
                    <?= htmlspecialchars($firstname) ?> Admin

                </h1>


                <p class="welcome-description">

                    Here's an overview of your school
                    management system and recent activity.

                </p>


            </div>



            <!-- SYSTEM STATUS -->

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
                 SCHOOLS
            ================================================== -->

            <a
                href="<?= ROOT ?>/schools"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    SC
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Schools
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $schoolCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 USERS
            ================================================== -->

            <a
                href="<?= ROOT ?>/users"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    US
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Users
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $userCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



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



        <!-- =================================================
             DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 RECENT ACTIVITY
            ================================================== -->

            <div class="activity-card">


                <!-- CARD HEADER -->

                <div class="card-header">


                    <div>

                        <h2>
                            Recent Activity
                        </h2>


                        <p>
                            Latest updates across your
                            school system.
                        </p>

                    </div>


                    <span class="activity-count">
                        Recent
                    </span>


                </div>



                <!-- ACTIVITY LIST -->

                <div class="activity-list">


                    <?php if (
                        !empty($recentActivities)
                    ): ?>


                        <?php foreach (
                            $recentActivities
                            as $activity
                        ): ?>


                            <div
                                class="activity-item"
                            >


                                <!-- ACTIVITY ICON -->

                                <div
                                    class="activity-icon"
                                >

                                    <?= htmlspecialchars(
                                        $activity['initials']
                                        ?? 'MS'
                                    ) ?>

                                </div>



                                <!-- ACTIVITY INFORMATION -->

                                <div
                                    class="activity-info"
                                >


                                    <strong>

                                        <?= htmlspecialchars(
                                            $activity['title']
                                            ?? 'System activity'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?= htmlspecialchars(
                                            $activity['description']
                                            ?? 'A system update was recorded.'
                                        ) ?>

                                    </span>


                                </div>



                                <!-- TIME -->

                                <time>

                                    <?= htmlspecialchars(
                                        $activity['time']
                                        ?? ''
                                    ) ?>

                                </time>


                            </div>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- =================================================
                             EMPTY ACTIVITY
                        ================================================== -->

                        <div
                            class="activity-empty"
                        >


                            <div
                                class="empty-icon"
                            >
                                ✓
                            </div>


                            <h3>
                                No recent activity
                            </h3>


                            <p>
                                Recent system activity
                                will appear here.
                            </p>


                        </div>


                    <?php endif; ?>


                </div>


            </div>



            <!-- =================================================
                 QUICK MANAGEMENT
            ================================================== -->

            <div class="management-card">


                <!-- CARD HEADER -->

                <div class="card-header">


                    <div>

                        <h2>
                            Quick Management
                        </h2>


                        <p>
                            Frequently used system areas.
                        </p>

                    </div>


                </div>



                <!-- MANAGEMENT LIST -->

                <div class="management-list">


                    <!-- SCHOOLS -->

                    <a
                        href="<?= ROOT ?>/schools"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            SC
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Schools
                            </strong>

                            <small>
                                Manage schools
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- USERS -->

                    <a
                        href="<?= ROOT ?>/users"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            US
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Users
                            </strong>

                            <small>
                                Manage system users
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- STUDENTS -->

                    <a
                        href="<?= ROOT ?>/students"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            ST
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Students
                            </strong>

                            <small>
                                Manage student records
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- STAFF -->

                    <a
                        href="<?= ROOT ?>/staff"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            SF
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Staff
                            </strong>

                            <small>
                                Manage staff records
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- PARENTS -->

                    <a
                        href="<?= ROOT ?>/parents"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            PR
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Parents
                            </strong>

                            <small>
                                Manage parent records
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- TESTS -->

                    <a
                        href="<?= ROOT ?>/tests"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            TS
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Tests
                            </strong>

                            <small>
                                Manage assessments
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
                            →
                        </span>

                    </a>



                    <!-- RESULTS -->

                    <a
                        href="<?= ROOT ?>/results"
                        class="management-item"
                    >

                        <span
                            class="management-icon"
                        >
                            RS
                        </span>


                        <span
                            class="management-info"
                        >

                            <strong>
                                Results
                            </strong>

                            <small>
                                Manage academic results
                            </small>

                        </span>


                        <span
                            class="management-arrow"
                        >
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


            <!-- TOTAL USERS -->

            <div class="summary-item">


                <span>
                    Total Users
                </span>


                <strong>

                    <?= number_format(
                        $userCount
                    ) ?>

                </strong>


            </div>



            <!-- DIVIDER -->

            <div class="summary-divider"></div>



            <!-- SCHOOL ADMINS -->

            <div class="summary-item">


                <span>
                    School Admins
                </span>


                <strong>

                    <a
                        href="<?= ROOT ?>/schooladmins"
                    >
                        Manage
                    </a>

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



<!-- =====================================================
     SIDEBAR JAVASCRIPT
===================================================== -->
<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>