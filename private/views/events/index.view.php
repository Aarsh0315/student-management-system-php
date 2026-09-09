<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$events = $data['events'] ?? [];

$rank = $_SESSION['rank'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;

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
        Events - My School
    </title>


    <!-- NAV -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- EVENTS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/events.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                SCHOOL MANAGEMENT
            </p>

            <h1>
                Events
            </h1>

            <p class="welcome-text">
                View upcoming and past school events.
            </p>

        </div>


        <div class="welcome-actions">

            <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                <a
                    href="<?= ROOT ?>/events/create"
                    class="add-event-button"
                >
                    + Add Event
                </a>

            <?php endif; ?>

        </div>

    </section>


    <!-- =====================================================
         EVENTS CARD
    ====================================================== -->

    <section class="events-card">


        <!-- CARD HEADER -->

        <div class="events-card-header">

            <div>

                <h2>
                    All Events
                </h2>

                <p>

                    <?= count($events) ?>

                    event(s) found

                </p>

            </div>


            <span class="event-count">

                <?= count($events) ?>

                Event<?= count($events) !== 1 ? 's' : '' ?>

            </span>

        </div>


        <!-- =================================================
             EVENTS TABLE
        ================================================== -->

        <?php if (!empty($events)): ?>


            <div class="events-table-wrapper">

                <table class="events-table">


                    <thead>

                        <tr>

                            <th>
                                Event
                            </th>


                            <?php if ($rank === 'super_admin'): ?>

                                <th>
                                    School
                                </th>

                            <?php endif; ?>


                            <th>
                                Date
                            </th>


                            <th>
                                Time
                            </th>


                            <th>
                                Location
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Created By
                            </th>


                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach ($events as $event): ?>

                        <?php

                        /*
                         * EVENT MANAGEMENT PERMISSION
                         *
                         * Super Admin  -> Can manage
                         * Admin        -> Can manage
                         * Teacher      -> Can manage own events only
                         * Student      -> View only
                         */

                        $canManageEvent =
    in_array($rank, ['super_admin', 'admin'], true) ||
    (
        $rank === 'teacher' &&
        (int) $event->created_by === (int) $user_id
    );

                        ?>


                        <tr>


                            <!-- =================================
                                 EVENT
                            ================================== -->

                            <td>

                                <div class="event-title-cell">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $event->title ?? '—'
                                        ) ?>

                                    </strong>


                                    <?php if (!empty($event->description)): ?>

                                        <span>

                                            <?= htmlspecialchars(
                                                $event->description
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span>
                                            No description
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </td>


                            <!-- =================================
                                 SCHOOL
                            ================================== -->

                            <?php if ($rank === 'super_admin'): ?>

                                <td>

                                    <?php if (!empty($event->school_name)): ?>

                                        <span class="school-name">

                                            <?= htmlspecialchars(
                                                $event->school_name
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        —

                                    <?php endif; ?>

                                </td>

                            <?php endif; ?>


                            <!-- =================================
                                 DATE
                            ================================== -->

                            <td>

                                <span class="date-cell">

                                    <?php if (!empty($event->event_date)): ?>

                                        <?= date(
                                            'd M Y',
                                            strtotime(
                                                $event->event_date
                                            )
                                        ) ?>

                                    <?php else: ?>

                                        —

                                    <?php endif; ?>

                                </span>

                            </td>


                            <!-- =================================
                                 TIME
                            ================================== -->

                            <td>

                                <?php if (!empty($event->start_time)): ?>


                                    <?= date(
                                        'h:i A',
                                        strtotime(
                                            $event->start_time
                                        )
                                    ) ?>


                                    <?php if (!empty($event->end_time)): ?>

                                        <span class="time-separator">
                                            -
                                        </span>

                                        <?= date(
                                            'h:i A',
                                            strtotime(
                                                $event->end_time
                                            )
                                        ) ?>

                                    <?php endif; ?>


                                <?php else: ?>

                                    —

                                <?php endif; ?>

                            </td>


                            <!-- =================================
                                 LOCATION
                            ================================== -->

                            <td>

                                <?php if (!empty($event->location)): ?>

                                    <?= htmlspecialchars(
                                        $event->location
                                    ) ?>

                                <?php else: ?>

                                    —

                                <?php endif; ?>

                            </td>


                            <!-- =================================
                                 STATUS
                            ================================== -->

                            <td>

                                <?php if (
                                    ($event->status ?? '') === 'active'
                                ): ?>

                                    <span class="event-status status-active">

                                        Active

                                    </span>

                                <?php else: ?>

                                    <span class="event-status status-cancelled">

                                        <?= htmlspecialchars(
                                            ucfirst(
                                                $event->status ?? 'Cancelled'
                                            )
                                        ) ?>

                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- =================================
                                 CREATED BY
                            ================================== -->

                            <td>

                                <?php

                                $createdBy = trim(
                                    ($event->firstname ?? '') .
                                    ' ' .
                                    ($event->lastname ?? '')
                                );

                                ?>

                                <?= htmlspecialchars(
                                    $createdBy ?: '—'
                                ) ?>

                            </td>


                            <!-- =================================
                                 ACTION
                            ================================== -->

                            <td>

                                <div class="event-actions">


                                    <!-- VIEW -->

                                    <a
                                        href="<?= ROOT ?>/events/details/<?= urlencode($event->event_id) ?>"
                                        class="action-view"
                                    >
                                        View
                                    </a>


                                    <?php if ($canManageEvent): ?>


                                        <!-- EDIT -->

                                        <a
                                            href="<?= ROOT ?>/events/edit/<?= urlencode($event->event_id) ?>"
                                            class="action-edit"
                                        >
                                            Edit
                                        </a>


                                        <!-- DELETE -->

                                        <form
                                            method="POST"
                                            action="<?= ROOT ?>/events/delete/<?= urlencode($event->event_id) ?>"
                                            onsubmit="return confirm('Are you sure you want to delete this event?');"
                                        >

                                            <?= CSRF::field() ?>

                                            <button
                                                type="submit"
                                                class="action-delete"
                                            >
                                                Delete
                                            </button>

                                        </form>


                                    <?php endif; ?>


                                </div>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>

            </div>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="events-empty">


                <div class="empty-event-icon">
                    EV
                </div>


                <h2>
                    No Events Found
                </h2>


                <p>

                    There are currently no events registered.

                </p>


                <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                    <a
                        href="<?= ROOT ?>/events/create"
                        class="add-event-button"
                    >
                        + Create Event
                    </a>

                <?php endif; ?>


            </div>


        <?php endif; ?>


    </section>


</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>