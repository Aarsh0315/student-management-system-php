<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$events = $data['events'] ?? [];

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


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >


    <!-- EVENTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/events.view.css?v=1"
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
     MAIN CONTENT
===================================================== -->

<main class="events-page">

    <div class="events-container">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <section class="events-header">

            <div class="events-header-content">

                <p class="events-label">
                    SCHOOL MANAGEMENT
                </p>

                <h1>
                    Events
                </h1>

                <p class="events-description">
                    Manage upcoming and past school events.
                </p>

            </div>


            <div class="events-header-actions">

                <a
                    href="<?= ROOT ?>/superadmin"
                    class="back-dashboard"
                >
                    ← Back to Dashboard
                </a>

                <a
                    href="<?= ROOT ?>/events/create"
                    class="add-event-button"
                >
                    + Add Event
                </a>

            </div>

        </section>


        <!-- =================================================
             EVENTS TABLE
        ================================================== -->

        <?php if (!empty($events)): ?>

            <section class="events-card">

                <div class="events-card-header">

                    <div>

                        <h2>
                            All Events
                        </h2>

                        <p>
                            View and manage school events.
                        </p>

                    </div>


                    <span class="event-count">

                        <?= count($events) ?>

                        <?= count($events) === 1
                            ? 'Event'
                            : 'Events'
                        ?>

                    </span>

                </div>


                <div class="events-table-wrapper">

                    <table class="events-table">

                        <thead>

                            <tr>

                                <th>Event</th>

                                <th>School</th>

                                <th>Date</th>

                                <th>Time</th>

                                <th>Location</th>

                                <th>Status</th>

                                <th>Created By</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($events as $event): ?>

                                <tr>


                                    <!-- EVENT -->

                                    <td class="event-title-cell">

                                        <strong>
                                            <?= htmlspecialchars(
                                                $event->title
                                            ) ?>
                                        </strong>


                                        <?php if (
                                            !empty($event->description)
                                        ): ?>

                                            <span>
                                                <?= htmlspecialchars(
                                                    $event->description
                                                ) ?>
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- SCHOOL -->

                                    <td>

                                        <span class="school-name">

                                            <?= !empty(
                                                $event->school_name
                                            )
                                                ? htmlspecialchars(
                                                    $event->school_name
                                                )
                                                : '—'
                                            ?>

                                        </span>

                                    </td>


                                    <!-- DATE -->

                                    <td class="date-cell">

                                        <?= date(
                                            'd M Y',
                                            strtotime(
                                                $event->event_date
                                            )
                                        ) ?>

                                    </td>


                                    <!-- TIME -->

                                    <td>

                                        <?php if (
                                            !empty($event->start_time)
                                        ): ?>

                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $event->start_time
                                                )
                                            ) ?>


                                            <?php if (
                                                !empty($event->end_time)
                                            ): ?>

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


                                    <!-- LOCATION -->

                                    <td>

                                        <?= !empty(
                                            $event->location
                                        )
                                            ? htmlspecialchars(
                                                $event->location
                                            )
                                            : '—'
                                        ?>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <?php

                                        $statusClass =
                                            $event->status === 'active'
                                                ? 'status-active'
                                                : 'status-cancelled';

                                        ?>

                                        <span
                                            class="event-status <?= $statusClass ?>"
                                        >

                                            <?= htmlspecialchars(
                                                ucfirst(
                                                    $event->status
                                                )
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- CREATED BY -->

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


                                    <!-- ACTION -->

                                    <td>

                                        <div class="event-actions">


                                            <a
                                                href="<?= ROOT ?>/events/details/<?= $event->event_id ?>"
                                                class="action-view"
                                            >
                                                View
                                            </a>


                                            <a
                                                href="<?= ROOT ?>/events/edit/<?= $event->event_id ?>"
                                                class="action-edit"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                method="POST"
                                                action="<?= ROOT ?>/events/delete/<?= $event->event_id ?>"
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

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </section>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <section class="events-empty">

                <div class="empty-event-icon">
                    EV
                </div>

                <h2>
                    No Events Found
                </h2>

                <p>
                    There are currently no events available.
                </p>

                <a
                    href="<?= ROOT ?>/events/create"
                    class="add-event-button"
                >
                    + Create Your First Event
                </a>

            </section>

        <?php endif; ?>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php

require "../private/views/includes/footer.view.php";

?>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>