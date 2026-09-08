<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$event = $data['event'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Event Details</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/events.view.css?v=3"
    >

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

    <section class="welcome">

        <p class="welcome-small">
            SCHOOL MANAGEMENT
        </p>

        <h1>
            Event Details
        </h1>

        <p class="welcome-text">
            View the details of this school event.
        </p>

    </section>


    <?php if ($event): ?>


        <!-- EVENT PROFILE CARD -->

        <section class="event-profile-card">


            <div class="event-profile-left">


                <div class="event-profile-icon">
                    EV
                </div>


                <div>

                    <p class="event-profile-label">
                        EVENT
                    </p>

                    <h2>
                        <?= htmlspecialchars($event->title) ?>
                    </h2>


                    <?php if (!empty($event->school_name)): ?>

                        <p class="event-profile-school">

                            <?= htmlspecialchars(
                                $event->school_name
                            ) ?>

                        </p>

                    <?php endif; ?>

                </div>


            </div>


            <span
                class="event-profile-status
                <?= ($event->status ?? '') === 'active'
                    ? 'active'
                    : 'cancelled'
                ?>"
            >

                <?= htmlspecialchars(
                    ucfirst($event->status ?? '')
                ) ?>

            </span>


        </section>


        <!-- EVENT DETAILS CARD -->

        <section class="event-details-card">


            <!-- DETAILS HEADER -->

            <div class="event-details-header">

                <h2>
                    Event Information
                </h2>

                <p>
                    Complete information about this event.
                </p>

            </div>


            <!-- DETAILS GRID -->

            <div class="event-details-grid">


                <!-- EVENT ID -->

                <div class="event-details-item">

                    <span>
                        Event ID
                    </span>

                    <strong>
                        #<?= (int) $event->event_id ?>
                    </strong>

                </div>


                <!-- DATE -->

                <div class="event-details-item">

                    <span>
                        Date
                    </span>

                    <strong>

                        <?php if (!empty($event->event_date)): ?>

                            <?= date(
                                'd F Y',
                                strtotime($event->event_date)
                            ) ?>

                        <?php else: ?>

                            —

                        <?php endif; ?>

                    </strong>

                </div>


                <!-- TIME -->

                <div class="event-details-item">

                    <span>
                        Time
                    </span>

                    <strong>

                        <?php if (!empty($event->start_time)): ?>

                            <?= date(
                                'h:i A',
                                strtotime($event->start_time)
                            ) ?>

                            <?php if (!empty($event->end_time)): ?>

                                <span class="event-time-separator">
                                    -
                                </span>

                                <?= date(
                                    'h:i A',
                                    strtotime($event->end_time)
                                ) ?>

                            <?php endif; ?>

                        <?php else: ?>

                            —

                        <?php endif; ?>

                    </strong>

                </div>


                <!-- LOCATION -->

                <div class="event-details-item">

                    <span>
                        Location
                    </span>

                    <strong>

                        <?= !empty($event->location)
                            ? htmlspecialchars($event->location)
                            : '—'
                        ?>

                    </strong>

                </div>


                <!-- CREATED BY -->

                <div class="event-details-item">

                    <span>
                        Created By
                    </span>

                    <strong>

                        <?php

                        $createdBy = trim(
                            ($event->firstname ?? '') . ' ' .
                            ($event->lastname ?? '')
                        );

                        ?>

                        <?= htmlspecialchars(
                            $createdBy ?: '—'
                        ) ?>

                    </strong>

                </div>


                <!-- STATUS -->

                <div class="event-details-item">

                    <span>
                        Status
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            ucfirst($event->status ?? '')
                        ) ?>

                    </strong>

                </div>


                <!-- CREATED DATE -->

                <div class="event-details-item">

                    <span>
                        Created At
                    </span>

                    <strong>

                        <?php if (!empty($event->created_at)): ?>

                            <?= date(
                                'd M Y, h:i A',
                                strtotime($event->created_at)
                            ) ?>

                        <?php else: ?>

                            —

                        <?php endif; ?>

                    </strong>

                </div>


            </div>


            <!-- DESCRIPTION -->

            <div class="event-description-section">

                <div class="event-description-header">

                    <span>
                        Description
                    </span>

                </div>


                <div class="event-description-content">

                    <?php if (!empty($event->description)): ?>

                        <?= nl2br(
                            htmlspecialchars(
                                $event->description
                            )
                        ) ?>

                    <?php else: ?>

                        No description provided.

                    <?php endif; ?>

                </div>

            </div>


        </section>


        <!-- ACTIONS -->

        <div class="event-actions-bottom">

            <a
                href="<?= ROOT ?>/events"
                class="event-back-btn"
            >
                ← Back to Events
            </a>

        </div>


    <?php else: ?>


        <!-- NOT FOUND -->

        <section class="event-details-card">

            <div class="event-empty-state">

                <div class="event-empty-icon">
                    EV
                </div>

                <h2>
                    Event Not Found
                </h2>

                <p>
                    The requested event could not be found.
                </p>

                <a
                    href="<?= ROOT ?>/events"
                    class="event-back-btn"
                >
                    ← Back to Events
                </a>

            </div>

        </section>


    <?php endif; ?>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>