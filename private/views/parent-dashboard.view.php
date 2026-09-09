<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$parent =
    $data['parent'] ?? null;

$children =
    $data['children'] ?? [];

$childCount =
    $data['childCount'] ?? 0;

$testCount =
    $data['testCount'] ?? 0;

$resultCount =
    $data['resultCount'] ?? 0;


/*
|--------------------------------------------------------------------------
| EVENTS
|--------------------------------------------------------------------------
*/

$upcomingEvents =
    $data['upcomingEvents'] ?? [];


/*
|--------------------------------------------------------------------------
| ANNOUNCEMENTS
|--------------------------------------------------------------------------
*/

$recentAnnouncements =
    $data['recentAnnouncements'] ?? [];


/*
|--------------------------------------------------------------------------
| RECENT ACTIVITY
|--------------------------------------------------------------------------
*/

$recentActivity =
    $data['recentActivity'] ?? [];

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
        Parent Dashboard - My School
    </title>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=3"
    >


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >


    <!-- =====================================================
         PARENT DASHBOARD
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-dashboard.view.css?v=4"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php require __DIR__ . "/includes/nav.view.php"; ?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php require __DIR__ . "/includes/sidebar.view.php"; ?>


<!-- =====================================================
     PARENT DASHBOARD
===================================================== -->

<main class="parent-page">

    <div class="parent-container">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    PARENT DASHBOARD
                </p>


                <h1>

                    Welcome back,

                    <?= htmlspecialchars(
                        $parent->firstname ?? 'Parent'
                    ) ?>

                </h1>


                <p class="welcome-description">

                    Keep track of your children's academic
                    progress and school activities.

                </p>

            </div>


            <div class="dashboard-status">

                <span class="status-dot"></span>

                Account Active

            </div>

        </section>


        <!-- =================================================
             KPI CARDS
        ================================================== -->

        <section class="kpi-grid">


            <!-- =============================================
                 CHILDREN
            ============================================== -->

            <a
                href="<?= ROOT ?>/parentchildren"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    CH
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        My Children
                    </span>

                    <strong class="kpi-value">
                        <?= (int) $childCount ?>
                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>


            <!-- =============================================
                 TESTS
            ============================================== -->

            <a
                href="<?= ROOT ?>/parenttests"
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
                        <?= (int) $testCount ?>
                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>


            <!-- =============================================
                 RESULTS
            ============================================== -->

            <a
                href="<?= ROOT ?>/parentresults"
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
                        <?= (int) $resultCount ?>
                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>


            <!-- =============================================
                 SCHOOL
            ============================================== -->

            <div class="kpi-card">

                <div class="kpi-icon">
                    SC
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        School
                    </span>

                    <strong
                        class="kpi-value"
                        style="font-size: 16px;"
                    >

                        <?= htmlspecialchars(
                            $parent->school_name ?? '-'
                        ) ?>

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

            <div class="dashboard-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Upcoming Events
                        </h2>

                        <p>
                            School events and activities
                        </p>

                    </div>


                    <a
                        href="<?= ROOT ?>/events"
                        class="card-view-all"
                    >
                        View All →
                    </a>

                </div>


                <div class="event-list">


                    <?php if (!empty($upcomingEvents)): ?>


                        <?php foreach (
                            $upcomingEvents
                            as $event
                        ): ?>


                            <a
                                href="<?= ROOT ?>/events/details/<?= urlencode($event->event_id) ?>"
                                class="event-item"
                            >


                                <!-- DATE -->

                                <div class="event-date">

                                    <strong>

                                        <?= !empty(
                                            $event->event_date
                                        )
                                            ? date(
                                                'd',
                                                strtotime(
                                                    $event->event_date
                                                )
                                            )
                                            : '--'
                                        ?>

                                    </strong>


                                    <span>

                                        <?= !empty(
                                            $event->event_date
                                        )
                                            ? date(
                                                'M',
                                                strtotime(
                                                    $event->event_date
                                                )
                                            )
                                            : ''
                                        ?>

                                    </span>

                                </div>


                                <!-- EVENT INFORMATION -->

                                <div class="event-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $event->title ?? 'Untitled Event'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?php if (
                                            !empty(
                                                $event->start_time
                                            )
                                        ): ?>

                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $event->start_time
                                                )
                                            ) ?>

                                        <?php else: ?>

                                            Time not specified

                                        <?php endif; ?>


                                        <?php if (
                                            !empty(
                                                $event->location
                                            )
                                        ): ?>

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

                            <div class="empty-icon">
                                EV
                            </div>

                            <h3>
                                No Upcoming Events
                            </h3>

                            <p>
                                There are no upcoming school events.
                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </div>



            <!-- =================================================
                 ANNOUNCEMENTS
            ================================================== -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Announcements
                        </h2>

                        <p>
                            Important school updates
                        </p>

                    </div>


                    <a
                        href="<?= ROOT ?>/announcements"
                        class="card-view-all"
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
                                href="<?= ROOT ?>/announcements/details/<?= urlencode($announcement->announcement_id) ?>"
                                class="announcement-item"
                            >


                                <!-- DATE -->

                                <div class="announcement-date">

                                    <strong>

                                        <?= !empty(
                                            $announcement->announcement_date
                                        )
                                            ? date(
                                                'd',
                                                strtotime(
                                                    $announcement->announcement_date
                                                )
                                            )
                                            : '--'
                                        ?>

                                    </strong>


                                    <span>

                                        <?= !empty(
                                            $announcement->announcement_date
                                        )
                                            ? date(
                                                'M',
                                                strtotime(
                                                    $announcement->announcement_date
                                                )
                                            )
                                            : ''
                                        ?>

                                    </span>

                                </div>


                                <!-- ANNOUNCEMENT INFORMATION -->

                                <div class="announcement-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $announcement->title
                                            ?? 'Announcement'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                $announcement->description
                                                ?? '',
                                                0,
                                                80,
                                                '...'
                                            )
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

                            <div class="empty-icon">
                                AN
                            </div>

                            <h3>
                                No Announcements
                            </h3>

                            <p>
                                There are no announcements available.
                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </div>



            <!-- =================================================
                 RECENT ACTIVITY
            ================================================== -->

            <div class="dashboard-card recent-activity-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Recent Activity
                        </h2>

                        <p>
                            Recent academic activity of your children
                        </p>

                    </div>

                </div>


                <div class="activity-list">


                    <?php if (!empty($recentActivity)): ?>


                        <?php foreach (
                            $recentActivity
                            as $activity
                        ): ?>


                            <div class="activity-item">


                                <div class="activity-icon">

                                    <?= htmlspecialchars(
                                        $activity->icon
                                        ?? 'AC'
                                    ) ?>

                                </div>


                                <div class="activity-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $activity->title
                                            ?? 'Activity'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?= htmlspecialchars(
                                            $activity->description
                                            ?? ''
                                        ) ?>

                                    </span>

                                </div>


                                <time>

                                    <?= htmlspecialchars(
                                        $activity->time
                                        ?? ''
                                    ) ?>

                                </time>


                            </div>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!--
                            Fallback activity based on
                            available parent data.
                        -->

                        <?php if (!empty($children)): ?>


                            <?php foreach (
                                array_slice(
                                    $children,
                                    0,
                                    5
                                )
                                as $child
                            ): ?>


                                <a
                                    href="<?= ROOT ?>/parentchildren/details/<?= urlencode($child->student_id) ?>"
                                    class="activity-item"
                                >


                                    <div class="activity-icon">
                                        ST
                                    </div>


                                    <div class="activity-info">

                                        <strong>

                                            <?= htmlspecialchars(
                                                trim(
                                                    ($child->firstname ?? '')
                                                    . ' '
                                                    .
                                                    ($child->lastname ?? '')
                                                )
                                            ) ?>

                                        </strong>


                                        <span>

                                            Class

                                            <?= htmlspecialchars(
                                                $child->class ?? '-'
                                            ) ?>

                                            -

                                            <?= htmlspecialchars(
                                                $child->division ?? '-'
                                            ) ?>

                                        </span>

                                    </div>


                                    <time>
                                        →
                                    </time>


                                </a>


                            <?php endforeach; ?>


                        <?php else: ?>


                            <div class="empty-state">

                                <div class="empty-icon">
                                    AC
                                </div>

                                <h3>
                                    No Recent Activity
                                </h3>

                                <p>
                                    Recent academic activity will appear here.
                                </p>

                            </div>


                        <?php endif; ?>


                    <?php endif; ?>


                </div>

            </div>


        </section>


        <!-- =================================================
             ACCOUNT SUMMARY
        ================================================== -->

        <section class="system-summary">


            <!-- PARENT -->

            <div class="summary-item">

                <span>
                    Parent
                </span>


                <strong>

                    <?= htmlspecialchars(
                        trim(
                            ($parent->firstname ?? '')
                            . ' '
                            .
                            ($parent->lastname ?? '')
                        )
                    ) ?>

                </strong>

            </div>


            <div class="summary-divider"></div>


            <!-- CHILDREN -->

            <div class="summary-item">

                <span>
                    Children
                </span>

                <strong>
                    <?= (int) $childCount ?>
                </strong>

            </div>


            <div class="summary-divider"></div>


            <!-- SCHOOL -->

            <div class="summary-item">

                <span>
                    School
                </span>


                <strong>

                    <?= htmlspecialchars(
                        $parent->school_name ?? '-'
                    ) ?>

                </strong>

            </div>


        </section>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php require __DIR__ . "/includes/footer.view.php"; ?>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="<?= ROOT ?>/js/nav.js"></script>

<script src="<?= ROOT ?>/js/sidebar.js"></script>


</body>

</html>