<?php

/*
=====================================================
STUDENT DASHBOARD
=====================================================
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
=====================================================
STUDENT INFORMATION
=====================================================
*/

$firstname =
    $_SESSION['firstname'] ?? 'Student';

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

$student =
    $data['student'] ?? null;

$testCount =
    $data['testCount'] ?? 0;

$resultCount =
    $data['resultCount'] ?? 0;

$recentTests =
    $data['recentTests'] ?? [];


/*
=====================================================
EVENTS & ANNOUNCEMENTS
=====================================================
*/

$upcomingEvents =
    $data['upcomingEvents'] ?? [];

$recentAnnouncements =
    $data['recentAnnouncements'] ?? [];


/*
=====================================================
STUDENT CLASS INFORMATION
=====================================================
*/

$class =
    $student->class ?? '-';

$division =
    $student->division ?? '-';

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
        Student Dashboard - My School
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


    <!-- STUDENT DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-dashboard.view.css?v=4"
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
     STUDENT DASHBOARD
===================================================== -->

<main class="student-page">

    <div class="student-container">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    STUDENT OVERVIEW
                </p>

                <h1>
                    Welcome back,
                    <?= htmlspecialchars($firstname) ?>
                </h1>

                <p class="welcome-description">
                    View your class, tests, results
                    and academic activities.
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


            <!-- =================================================
                 MY CLASS
            ================================================== -->

            <a
                href="<?= ROOT ?>/studentclasses"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    CL
                </div>

                <div class="kpi-content">

                    <span class="kpi-label">
                        My Class
                    </span>

                    <strong class="kpi-value">

                        <?= htmlspecialchars($class) ?>

                        <?php if ($division !== '-'): ?>

                            -
                            <?= htmlspecialchars($division) ?>

                        <?php endif; ?>

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
                href="<?= ROOT ?>/studenttests"
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
                        <?= number_format($testCount) ?>
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
                href="<?= ROOT ?>/studentresults"
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
                        <?= number_format($resultCount) ?>
                    </strong>

                </div>

                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 ACADEMIC STATUS
            ================================================== -->

            <div class="kpi-card">

                <div class="kpi-icon">
                    AC
                </div>

                <div class="kpi-content">

                    <span class="kpi-label">
                        Academic Status
                    </span>

                    <strong class="kpi-value">
                        Active
                    </strong>

                </div>

            </div>


        </section>



        <!-- =================================================
             MAIN DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


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
                                        <?= htmlspecialchars(
                                            $event->title
                                        ) ?>
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
                 ANNOUNCEMENTS
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

                        <?php foreach (
                            $recentAnnouncements
                            as $announcement
                        ): ?>

                            <a
                                href="<?= ROOT ?>/announcements/details/<?= (int)$announcement->announcement_id ?>"
                                class="announcement-item"
                            >

                                <div class="announcement-date">

                                    <strong>
                                        <?= date(
                                            'd',
                                            strtotime(
                                                $announcement->announcement_date
                                            )
                                        ) ?>
                                    </strong>

                                    <span>
                                        <?= date(
                                            'M',
                                            strtotime(
                                                $announcement->announcement_date
                                            )
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
                                There are no recent announcements.
                            </span>

                        </div>

                    <?php endif; ?>

                </div>

            </section>



            <!-- =================================================
                 RECENT ACTIVITY
            ================================================== -->

            <section class="dashboard-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Recent Activity
                        </h2>

                        <p>
                            Your latest academic activities.
                        </p>

                    </div>

                    <a
                        href="<?= ROOT ?>/studenttests"
                        class="card-link"
                    >
                        View All →
                    </a>

                </div>


                <div class="activity-list">


                    <?php if (!empty($recentTests)): ?>


                        <?php foreach ($recentTests as $test): ?>

                            <a
                                href="<?= ROOT ?>/studenttests"
                                class="activity-item"
                            >

                                <div class="activity-icon">
                                    TS
                                </div>


                                <div class="activity-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? 'Test'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?php

                                        $testClass =
                                            $test->class ?? null;

                                        $testDivision =
                                            $test->division ?? null;

                                        $testSubject =
                                            $test->subject ?? null;

                                        ?>


                                        <?php if ($testClass): ?>

                                            Class
                                            <?= htmlspecialchars(
                                                $testClass
                                            ) ?>

                                            <?php if ($testDivision): ?>

                                                -
                                                <?= htmlspecialchars(
                                                    $testDivision
                                                ) ?>

                                            <?php endif; ?>


                                        <?php elseif ($testSubject): ?>

                                            <?= htmlspecialchars(
                                                $testSubject
                                            ) ?>


                                        <?php else: ?>

                                            Academic Test

                                        <?php endif; ?>

                                    </span>

                                </div>


                                <time>

                                    <?= !empty(
                                        $test->created_at
                                    )

                                        ? date(
                                            'd M Y',
                                            strtotime(
                                                $test->created_at
                                            )
                                        )

                                        : '-'
                                    ?>

                                </time>

                            </a>

                        <?php endforeach; ?>


                    <?php else: ?>


                        <div class="empty-state">

                            <strong>
                                No recent activity
                            </strong>

                            <span>
                                Your recent academic activity
                                will appear here.
                            </span>

                        </div>


                    <?php endif; ?>


                </div>

            </section>


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