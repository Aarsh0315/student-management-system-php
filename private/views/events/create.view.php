<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = $data['error'] ?? '';
$schools = $data['schools'] ?? [];

$rank = $_SESSION['rank'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Create Event</title>

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
                    Create Event
                </h1>

                <p class="events-description">
                    Add a new event to the school calendar.
                </p>

            </div>

        </section>


        <!-- ERROR -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <!-- CREATE EVENT CARD -->

        <section class="events-card event-form-card">


            <div class="events-card-header">

                <div>

                    <h2>
                        Event Details
                    </h2>

                    <p>
                        Enter the information for the new school event.
                    </p>

                </div>

            </div>


            <div class="event-form-body">


                <form
                    method="POST"
                    action="<?= ROOT ?>/events/create"
                >

                    <?= CSRF::field() ?>


                    <!-- SCHOOL -->

<?php if ($rank === 'super_admin'): ?>

    <div class="form-group">

        <label for="school_id">
            School
        </label>

        <select
            id="school_id"
            name="school_id"
            required
        >

            <option value="">
                Select School
            </option>

            <?php foreach ($schools as $school): ?>

                <option
                    value="<?= (int) $school->id ?>"
                    <?= (
                        !empty($_POST['school_id']) &&
                        (int) $_POST['school_id'] === (int) $school->id
                    ) ? 'selected' : '' ?>
                >

                    <?= htmlspecialchars($school->school_name) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

<?php endif; ?>


                    <!-- EVENT TITLE -->

                    <div class="form-group">

                        <label for="title">
                            Event Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
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
                        ><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

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
                                value="<?= htmlspecialchars($_POST['event_date'] ?? '') ?>"
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
                                value="<?= htmlspecialchars($_POST['start_time'] ?? '') ?>"
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
                                value="<?= htmlspecialchars($_POST['end_time'] ?? '') ?>"
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
                                value="<?= htmlspecialchars($_POST['location'] ?? '') ?>"
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
                                    <?= ($_POST['status'] ?? 'active') === 'active'
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Active
                                </option>

                                <option
                                    value="cancelled"
                                    <?= ($_POST['status'] ?? '') === 'cancelled'
                                        ? 'selected'
                                        : '' ?>
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
                            Create Event
                        </button>

                    </div>


                </form>


            </div>

        </section>


    </div>

</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>