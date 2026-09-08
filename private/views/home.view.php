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

$inactiveStudentCount = $data['inactive_student_count'] ?? 0;

$staffCount =
    $data['staff_count'] ?? 0;

$inactiveStaffCount =
    $data['inactive_staff_count'] ?? 0;

$parentCount =
    $data['parent_count'] ?? 0;

$classCount =
    $data['class_count'] ?? 0;


/* =====================================================
   UPCOMING EVENTS
===================================================== */

$upcomingEvents =
    $data['upcomingEvents'] ?? [];


/* =====================================================
   RECENT ACTIVITY
===================================================== */

$recent_activities =
    $data['recent_activities'] ?? [];

$recentAnnouncements =
    $data['recentAnnouncements'] ?? [];

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
                    <?= htmlspecialchars($firstname) ?> Admin
                </h1>

                <p class="welcome-description">
                    Here's an overview of your school
                    management system and recent activity.
                </p>

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


        </section>



        <!-- =================================================
             MAIN DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 UPCOMING EVENTS
            ================================================== -->

            <div class="events-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Upcoming Events
                        </h2>

                        <p>
                            Events scheduled for your school
                        </p>

                    </div>

                    <a
                        href="<?= ROOT ?>/events"
                        class="card-link"
                    >
                        View All →
                    </a>

                </div>


                <div class="events-list">

                    <?php if (!empty($upcomingEvents)): ?>

                        <?php foreach (
                            $upcomingEvents
                            as $event
                        ): ?>

                            <div class="event-item">


                                <!-- EVENT DATE -->

                                <div class="event-date">

                                    <strong>
                                        <?= date(
                                            'd',
                                            strtotime(
                                                $event->event_date
                                            )
                                        ) ?>
                                    </strong>

                                    <span>
                                        <?= date(
                                            'M',
                                            strtotime(
                                                $event->event_date
                                            )
                                        ) ?>
                                    </span>

                                </div>



                                <!-- EVENT INFORMATION -->

                                <div class="event-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $event->title
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?php
                                        if (
                                            !empty(
                                                $event->start_time
                                            )
                                        ):
                                        ?>

                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $event->start_time
                                                )
                                            ) ?>

                                        <?php endif; ?>


                                        <?php
                                        if (
                                            !empty(
                                                $event->location
                                            )
                                        ):
                                        ?>

                                            ·

                                            <?= htmlspecialchars(
                                                $event->location
                                            ) ?>

                                        <?php endif; ?>

                                    </span>

                                </div>



                                <!-- EVENT LINK -->

                                <a
                                    href="<?= ROOT ?>/events/details/<?= $event->event_id ?>"
                                    class="event-arrow"
                                >
                                    →
                                </a>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>


                        <!-- EMPTY EVENT STATE -->

                        <div class="events-empty">

                            <div class="empty-icon">
                                EV
                            </div>

                            <h3>
                                No Upcoming Events
                            </h3>

                            <p>
                                There are no upcoming events
                                scheduled.
                            </p>

                            <a
                                href="<?= ROOT ?>/events/create"
                                class="empty-action"
                            >
                                Create Event
                            </a>

                        </div>


                    <?php endif; ?>

                </div>

            </div>


            <!-- =================================================
                 NEEDS ATTENTION
            ================================================== -->

            <div class="attention-card">

    <div class="card-header">
        <div>
            <h2>Needs Attention</h2>
            <p>Items that may require your attention</p>
        </div>
    </div>

    <div class="attention-list">

        <?php if ($inactiveStudentCount > 0): ?>

            <a href="<?= ROOT ?>/students?status=inactive"
               class="attention-item">

                <div class="attention-icon">ST</div>

                <div class="attention-info">
                    <strong>Inactive Students</strong>

                    <span>
                        <?= number_format($inactiveStudentCount) ?>
                        student(s) currently inactive
                    </span>
                </div>

                <span class="attention-arrow">→</span>

            </a>

        <?php endif; ?>


        <?php if ($inactiveStaffCount > 0): ?>

            <a href="<?= ROOT ?>/staff?status=inactive"
               class="attention-item">

                <div class="attention-icon">SF</div>

                <div class="attention-info">
                    <strong>Inactive Staff</strong>

                    <span>
                        <?= number_format($inactiveStaffCount) ?>
                        staff member(s) currently inactive
                    </span>
                </div>

                <span class="attention-arrow">→</span>

            </a>

        <?php endif; ?>


        <?php if (
            $inactiveStudentCount <= 0 &&
            $inactiveStaffCount <= 0
        ): ?>

            <div class="attention-empty">

                <div class="attention-empty-icon">✓</div>

                <h3>Everything Looks Good</h3>

                <p>
                    There are no items requiring attention.
                </p>

            </div>

        <?php endif; ?>

    </div>

            </div>


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
                    Recent activity in your school
                </p>

            </div>

        </div>


        <?php if (!empty($recent_activities)): ?>

            <div class="activity-list">

                <?php foreach (
                    $recent_activities
                    as $activity
                ): ?>

                    <div class="activity-item">

                        <div class="activity-icon">

                            <?= htmlspecialchars(
                                $activity['icon'] ?? 'AC'
                            ) ?>

                        </div>


                        <div class="activity-info">

                            <strong>
                                <?= htmlspecialchars(
                                    $activity['title'] ?? ''
                                ) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars(
                                    $activity['description'] ?? ''
                                ) ?>
                            </span>

                        </div>


                        <time>
                            <?= htmlspecialchars(
                                $activity['time'] ?? ''
                            ) ?>
                        </time>

                    </div>

                <?php endforeach; ?>

            </div>


        <?php else: ?>

            <div class="activity-empty">

                <div class="empty-icon">
                    AC
                </div>

                <h3>
                    No Recent Activity
                </h3>

                <p>
                    There is no recent activity to display.
                </p>

            </div>

        <?php endif; ?>

    </div>


    <!-- =================================================
         ANNOUNCEMENTS
    ================================================== -->

    <div class="announcements-dashboard-card">

        <div class="card-header">

            <div>

                <h2>
                    Announcements
                </h2>

                <p>
                    Latest school announcements
                </p>

            </div>


            <a
                href="<?= ROOT ?>/announcements"
                class="card-link"
            >
                View All →
            </a>

        </div>


        <?php if (!empty($recentAnnouncements)): ?>

            <div class="dashboard-announcement-list">

                <?php foreach (
                    $recentAnnouncements
                    as $announcement
                ): ?>

                    <a
                        href="<?= ROOT ?>/announcements/details/<?= (int) $announcement->announcement_id ?>"
                        class="dashboard-announcement-item"
                    >

                        <div class="dashboard-announcement-date">

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


                        <div class="dashboard-announcement-info">

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


                        <span class="dashboard-announcement-arrow">
                            →
                        </span>

                    </a>

                <?php endforeach; ?>

            </div>


        <?php else: ?>

            <div class="announcement-dashboard-empty">

                <div class="empty-icon">
                    AN
                </div>

                <h3>
                    No Announcements
                </h3>

                <p>
                    There are currently no active announcements.
                </p>

                <a
                    href="<?= ROOT ?>/announcements/create"
                    class="empty-action"
                >
                    Create Announcement
                </a>

            </div>

        <?php endif; ?>

    </div>



</section>

<!-- =================================================
     QUICK ACTIONS
================================================== -->

<section class="quick-actions-section">

    <div class="section-heading">
        <div>
            <h2>Quick Actions</h2>
            <p>Frequently used school management actions</p>
        </div>
    </div>


    <div class="quick-actions-grid">

        <a href="<?= ROOT ?>/students/create"
           class="quick-action-card">

            <div class="quick-action-icon">
                ST
            </div>

            <div class="quick-action-info">
                <strong>Add Student</strong>
                <span>Register a new student</span>
            </div>

            <span class="quick-action-arrow">→</span>

        </a>


        <a href="<?= ROOT ?>/staff/create"
           class="quick-action-card">

            <div class="quick-action-icon">
                TC
            </div>

            <div class="quick-action-info">
                <strong>Add Staff</strong>
                <span>Add a teacher or staff member</span>
            </div>

            <span class="quick-action-arrow">→</span>

        </a>


        <a href="<?= ROOT ?>/parents/create"
           class="quick-action-card">

            <div class="quick-action-icon">
                PR
            </div>

            <div class="quick-action-info">
                <strong>Add Parent</strong>
                <span>Register a parent account</span>
            </div>

            <span class="quick-action-arrow">→</span>

        </a>


        <a href="<?= ROOT ?>/events/create"
           class="quick-action-card">

            <div class="quick-action-icon">
                EV
            </div>

            <div class="quick-action-info">
                <strong>Create Event</strong>
                <span>Add a school event</span>
            </div>

            <span class="quick-action-arrow">→</span>

        </a>

    </div>

</section>

        <!-- =================================================
             SCHOOL MANAGEMENT
        ================================================== -->

        <section class="management-section">

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


                    <!-- STUDENTS -->

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



                    <!-- TEACHERS -->

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



                    <!-- PARENTS -->

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



                    <!-- CLASSES -->

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



                    <!-- TESTS -->

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



                    <!-- RESULTS -->

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



                    <!-- EVENTS -->

                    <a
                        href="<?= ROOT ?>/events"
                        class="management-item"
                    >

                        <div class="management-icon">
                            EV
                        </div>

                        <div class="management-info">

                            <strong>
                                Events
                            </strong>

                            <small>
                                Manage school events
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