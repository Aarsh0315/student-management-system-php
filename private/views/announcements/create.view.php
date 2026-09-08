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

    <title>
        Create Announcement
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


    <!-- ANNOUNCEMENTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/announcements.view.css?v=1"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<main class="announcements-page">

    <div class="announcements-container">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <section class="announcements-header">

            <div class="announcements-header-content">

                <p class="announcements-label">
                    SCHOOL COMMUNICATION
                </p>

                <h1>
                    Create Announcement
                </h1>

                <p class="announcements-description">
                    Create a new announcement for your school.
                </p>

            </div>

        </section>


        <!-- =================================================
             ERROR
        ================================================== -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <!-- =================================================
             CREATE ANNOUNCEMENT CARD
        ================================================== -->

        <section class="announcements-card announcement-form-card">


            <div class="announcements-card-header">

                <div>

                    <h2>
                        Announcement Details
                    </h2>

                    <p>
                        Enter the information for the new announcement.
                    </p>

                </div>

            </div>


            <div class="announcement-form-body">


                <form
                    method="POST"
                    action="<?= ROOT ?>/announcements/store"
                >

                    <?= CSRF::field() ?>


                    <!-- =================================================
                         SCHOOL
                    ================================================== -->

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
                                            (int) $_POST['school_id'] ===
                                            (int) $school->id
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= htmlspecialchars(
                                            $school->school_name
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         TITLE
                    ================================================== -->

                    <div class="form-group">

                        <label for="title">
                            Announcement Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars(
                                $_POST['title'] ?? ''
                            ) ?>"
                            placeholder="Enter announcement title"
                            required
                        >

                    </div>


                    <!-- =================================================
                         DESCRIPTION
                    ================================================== -->

                    <div class="form-group">

                        <label for="description">
                            Announcement
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="7"
                            placeholder="Write your announcement here..."
                            required
                        ><?= htmlspecialchars(
                            $_POST['description'] ?? ''
                        ) ?></textarea>

                    </div>


                    <!-- =================================================
                         DATE + STATUS
                    ================================================== -->

                    <div class="form-row">


                        <div class="form-group">

                            <label for="announcement_date">
                                Announcement Date
                            </label>

                            <input
                                type="date"
                                id="announcement_date"
                                name="announcement_date"
                                value="<?= htmlspecialchars(
                                    $_POST['announcement_date']
                                    ?? date('Y-m-d')
                                ) ?>"
                                required
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
                                    <?= (
                                        $_POST['status'] ?? 'active'
                                    ) === 'active'
                                        ? 'selected'
                                        : ''
                                    ?>
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    <?= (
                                        $_POST['status'] ?? ''
                                    ) === 'inactive'
                                        ? 'selected'
                                        : ''
                                    ?>
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>


                    </div>


                    <!-- =================================================
                         ACTIONS
                    ================================================== -->

                    <div class="form-actions">

                        <a
                            href="<?= ROOT ?>/announcements"
                            class="form-cancel-button"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="form-submit-button"
                        >
                            Create Announcement
                        </button>

                    </div>


                </form>


            </div>

        </section>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>