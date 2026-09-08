<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$event = $data['event'] ?? null;
$error = $data['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Event</title>

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
        href="<?= ROOT ?>/css/events.view.css?v=1"
    >

</head>

<body>

<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="events-page">

    <div class="events-container">


        <!-- PAGE HEADER -->

        <section class="events-header">

            <div class="events-header-content">

                <p class="events-label">
                    SCHOOL MANAGEMENT
                </p>

                <h1>
                    Edit Event
                </h1>

                <p class="events-description">
                    Update the details of this school event.
                </p>

            </div>


            <div class="events-header-actions">

                <a
                    href="<?= ROOT ?>/events"
                    class="back-dashboard"
                >
                    ← Back to Events
                </a>

            </div>

        </section>


        <!-- ERROR -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <?php if ($event): ?>


            <!-- EDIT EVENT CARD -->

            <section class="events-card event-form-card">

                <div class="events-card-header">

                    <div>

                        <h2>
                            Event Details
                        </h2>

                        <p>
                            Update the information below.
                        </p>

                    </div>

                </div>


                <div class="event-form-body">

                    <form
                        method="POST"
                        action="<?= ROOT ?>/events/edit/<?= (int)$event->event_id ?>"
                    >

                        <?= CSRF::field() ?>


                        <!-- EVENT TITLE -->

                        <div class="form-group">

                            <label for="title">
                                Event Title
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="<?= htmlspecialchars($event->title ?? '') ?>"
                                placeholder="Enter event title"
                                required
                            >

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="form-group">

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Enter event description"
                            ><?= htmlspecialchars($event->description ?? '') ?></textarea>

                        </div>


                        <!-- DATE + TIME -->

                        <div class="form-row">


                            <div class="form-group">

                                <label for="event_date">
                                    Event Date
                                </label>

                                <input
                                    type="date"
                                    id="event_date"
                                    name="event_date"
                                    value="<?= htmlspecialchars($event->event_date ?? '') ?>"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="start_time">
                                    Start Time
                                </label>

                                <input
                                    type="time"
                                    id="start_time"
                                    name="start_time"
                                    value="<?= htmlspecialchars($event->start_time ?? '') ?>"
                                >

                            </div>


                            <div class="form-group">

                                <label for="end_time">
                                    End Time
                                </label>

                                <input
                                    type="time"
                                    id="end_time"
                                    name="end_time"
                                    value="<?= htmlspecialchars($event->end_time ?? '') ?>"
                                >

                            </div>


                        </div>


                        <!-- LOCATION + STATUS -->

                        <div class="form-row">


                            <div class="form-group">

                                <label for="location">
                                    Location
                                </label>

                                <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    value="<?= htmlspecialchars($event->location ?? '') ?>"
                                    placeholder="e.g. School Auditorium"
                                >

                            </div>


                            <div class="form-group">

                                <label for="status">
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                >

                                    <option
                                        value="active"
                                        <?= ($event->status ?? '') === 'active' ? 'selected' : '' ?>
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="cancelled"
                                        <?= ($event->status ?? '') === 'cancelled' ? 'selected' : '' ?>
                                    >
                                        Cancelled
                                    </option>

                                </select>

                            </div>


                        </div>


                        <!-- ACTIONS -->

                        <div class="form-actions">

                            <a
                                href="<?= ROOT ?>/events"
                                class="form-cancel-button"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="form-submit-button"
                            >
                                Update Event
                            </button>

                        </div>


                    </form>

                </div>

            </section>


        <?php else: ?>


            <!-- EVENT NOT FOUND -->

            <section class="events-empty">

                <h2>
                    Event Not Found
                </h2>

                <p>
                    The requested event could not be found.
                </p>

                <a
                    href="<?= ROOT ?>/events"
                    class="add-event-button"
                >
                    Back to Events
                </a>

            </section>


        <?php endif; ?>


    </div>

</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>