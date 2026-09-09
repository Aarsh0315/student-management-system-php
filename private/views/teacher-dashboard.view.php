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

$inactiveStudentCount =
    $data['inactiveStudentCount'] ?? 0;

$recentAnnouncements =
    $data['recentAnnouncements'] ?? [];

$upcomingEvents =
    $data['upcomingEvents'] ?? [];

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

        <!-- =================================================
     WELCOME SECTION
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
            Here's an overview of your classes, students,
            tests, results and academic activities.
        </p>

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
     UPCOMING EVENTS
================================================== -->

<section class="dashboard-card">

    <div class="card-header">

        <div>
            <h2>
                Upcoming Events
            </h2>

            <p>
                Events happening in your school.
            </p>
        </div>

        <a
            href="<?= ROOT ?>/events"
            class="card-link"
        >
            View All →
        </a>

    </div>


    <div class="event-list">

        <?php if (!empty($upcomingEvents)): ?>

            <?php foreach ($upcomingEvents as $event): ?>

                <a
                    href="<?= ROOT ?>/events/details/<?= (int)$event->event_id ?>"
                    class="event-item"
                >

                    <div class="event-date">

                        <strong>
                            <?= date(
                                'd',
                                strtotime($event->event_date)
                            ) ?>
                        </strong>

                        <span>
                            <?= date(
                                'M',
                                strtotime($event->event_date)
                            ) ?>
                        </span>

                    </div>


                    <div class="event-info">

                        <strong>
                            <?= htmlspecialchars($event->title) ?>
                        </strong>

                        <span>
                            <?= htmlspecialchars(
                                $event->start_time ?? ''
                            ) ?>

                            <?php if (!empty($event->location)): ?>

                                ·
                                <?= htmlspecialchars(
                                    $event->location
                                ) ?>

                            <?php endif; ?>

                        </span>

                    </div>


                    <span class="event-arrow">
                        →
                    </span>

                </a>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-state">

                <strong>
                    No upcoming events
                </strong>

                <span>
                    There are no upcoming school events.
                </span>

            </div>

        <?php endif; ?>

    </div>

</section>


<!-- =================================================
     RECENT ANNOUNCEMENTS
================================================== -->

<section class="dashboard-card">

    <div class="card-header">

        <div>
            <h2>
                Announcements
            </h2>

            <p>
                Recent announcements from your school.
            </p>
        </div>

        <a
            href="<?= ROOT ?>/announcements"
            class="card-link"
        >
            View All →
        </a>

    </div>


    <div class="announcement-list">

        <?php if (!empty($recentAnnouncements)): ?>

            <?php foreach ($recentAnnouncements as $announcement): ?>

                <a
                    href="<?= ROOT ?>/announcements/details/<?= (int)$announcement->announcement_id ?>"
                    class="announcement-item"
                >

                    <div class="announcement-date">

                        <strong>
                            <?= date(
                                'd',
                                strtotime($announcement->announcement_date)
                            ) ?>
                        </strong>

                        <span>
                            <?= date(
                                'M',
                                strtotime($announcement->announcement_date)
                            ) ?>
                        </span>

                    </div>


                    <div class="announcement-info">

                        <strong>
                            <?= htmlspecialchars(
                                $announcement->title
                            ) ?>
                        </strong>

                        <span>
                            <?= htmlspecialchars(
                                $announcement->description
                            ) ?>
                        </span>

                    </div>


                    <span class="announcement-arrow">
                        →
                    </span>

                </a>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-state">

                <strong>
                    No announcements
                </strong>

                <span>
                    There are no recent school announcements.
                </span>

            </div>

        <?php endif; ?>

    </div>

</section>

<!-- =================================================
     NEEDS ATTENTION
================================================== -->

<section class="dashboard-card">

    <div class="card-header">

        <div>
            <h2>
                Needs Attention
            </h2>

            <p>
                Items that may require your attention.
            </p>
        </div>

    </div>


    <div class="attention-list">

        <?php if ($inactiveStudentCount > 0): ?>

            <a
                href="<?= ROOT ?>/teacherstudents?status=inactive"
                class="attention-item"
            >

                <div class="attention-icon">
                    ST
                </div>

                <div class="attention-info">

                    <strong>
                        Inactive Students
                    </strong>

                    <span>
                        <?= number_format($inactiveStudentCount) ?>
                        student(s) are currently inactive.
                    </span>

                </div>

                <span class="attention-arrow">
                    →
                </span>

            </a>

        <?php else: ?>

            <div class="empty-state">

                <strong>
                    Everything looks good
                </strong>

                <span>
                    No inactive students require attention.
                </span>

            </div>

        <?php endif; ?>

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