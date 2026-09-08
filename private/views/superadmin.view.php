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

        <!-- =================================================
            DASHBOARD DATE
        ================================================== -->

        <section class="dashboard-date">

            <p>
                <?= date('l, d F Y') ?>
            </p>

        </section>

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


          <!-- =================================================
     QUICK ACTIONS
================================================== -->

<section class="quick-actions">

    <!-- ADD STUDENT -->

    <a
        href="<?= ROOT ?>/students/create"
        class="quick-action"
    >

        <span class="quick-action-icon">
            +
        </span>

        <span class="quick-action-content">

            <strong>
                Add Student
            </strong>

            <small>
                Register a new student
            </small>

        </span>

    </a>


    <!-- SEND ANNOUNCEMENT -->

    <a
        href="<?= ROOT ?>/announcements/create"
        class="quick-action"
    >

        <span class="quick-action-icon">
            +
        </span>

        <span class="quick-action-content">

            <strong>
                Send Announcement
            </strong>

            <small>
                Send an announcement
            </small>

        </span>

    </a>


    <!-- ADD EVENT -->

    <a
        href="<?= ROOT ?>/events/create"
        class="quick-action"
    >

        <span class="quick-action-icon">
            +
        </span>

        <span class="quick-action-content">

            <strong>
                Add Event
            </strong>

            <small>
                Create a new event
            </small>

        </span>

    </a>

</section>



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

        </section>



        <!-- =================================================
             DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">

      <!-- DAILY CALENDAR -->

<?php

$upcomingEvents = $data['upcomingEvents'] ?? [];

?>

<div class="dashboard-card calendar-card">

    <div class="card-header">

        <div>
            <h2>Daily Calendar</h2>

            <p>
                Upcoming scheduled events and activities.
            </p>
        </div>

        <a
            href="<?= ROOT ?>/events"
            class="card-action"
        >
            View All
        </a>

    </div>


    <div class="dashboard-card-body">

        <?php if (!empty($upcomingEvents)): ?>

            <div class="calendar-event-list">

                <?php foreach ($upcomingEvents as $event): ?>

                    <div class="calendar-event">

                        <div class="calendar-event-date">

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


                        <div class="calendar-event-info">

                            <h3>
                                <?= htmlspecialchars(
                                    $event->title
                                ) ?>
                            </h3>


                            <p>

                                <?= htmlspecialchars(
                                    $event->school_name ?? 'School'
                                ) ?>

                                <?php if (!empty($event->location)): ?>

                                    ·
                                    <?= htmlspecialchars(
                                        $event->location
                                    ) ?>

                                <?php endif; ?>

                            </p>


                            <?php if (!empty($event->start_time)): ?>

                                <span class="calendar-event-time">

                                    <?= date(
                                        'h:i A',
                                        strtotime($event->start_time)
                                    ) ?>

                                    <?php if (!empty($event->end_time)): ?>

                                        -
                                        <?= date(
                                            'h:i A',
                                            strtotime($event->end_time)
                                        ) ?>

                                    <?php endif; ?>

                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


        <?php else: ?>

            <div class="dashboard-empty">

                <h3>No upcoming events</h3>

                <p>
                    Upcoming school events will appear here.
                </p>

                <a href="<?= ROOT ?>/events/create">
                    Add Event
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>


    <!-- ANNOUNCEMENTS -->
    <div class="dashboard-card announcements-card">

        <div class="card-header">
            <div>
                <h2>Announcements</h2>
                <p>Latest school announcements.</p>
            </div>

            <a href="<?= ROOT ?>/announcements" class="card-action">
                View All
            </a>
        </div>

        <div class="dashboard-card-body">

            <div class="dashboard-empty">
                <h3>No announcements</h3>
                <p>Latest announcements will appear here.</p>
            </div>

        </div>

    </div>


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