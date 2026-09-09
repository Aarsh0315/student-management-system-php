<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$announcement = $data['announcement'] ?? null;
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
        Edit Announcement - My School
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
        href="<?= ROOT ?>/css/announcements.view.css?v=3"
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


        <?php if ($announcement): ?>


            <!-- =================================================
                 PAGE HEADER
            ================================================== -->

            <section class="announcements-header">

                <div class="announcements-header-content">

                    <p class="announcements-label">
                        SCHOOL COMMUNICATION
                    </p>

                    <h1>
                        Edit Announcement
                    </h1>

                    <p class="announcements-description">
                        Update the announcement information.
                    </p>

                </div>


                <div class="announcements-header-actions">

                    <a
                        href="<?= ROOT ?>/announcements"
                        class="back-announcement-button"
                    >
                        ← Back to Announcements
                    </a>

                    <a
                        href="<?= ROOT ?>/announcements/details/<?= (int) $announcement->announcement_id ?>"
                        class="edit-announcement-button secondary"
                    >
                        View Announcement
                    </a>

                </div>

            </section>


            <!-- =================================================
                 EDIT ANNOUNCEMENT CARD
            ================================================== -->

            <section class="announcements-card announcement-form-card">

                <div class="announcements-card-header">

                    <div>

                        <h2>
                            Announcement Details
                        </h2>

                        <p>
                            Update the information below and save your changes.
                        </p>

                    </div>

                </div>


                <div class="announcement-form-body">

                    <form
                        method="POST"
                        action="<?= ROOT ?>/announcements/update/<?= (int) $announcement->announcement_id ?>"
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
                                >

                                    <?php foreach ($schools as $school): ?>

                                        <option
                                            value="<?= (int) $school->id ?>"
                                            <?= (
                                                (int) $announcement->school_id ===
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
                                    $announcement->title
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
                                rows="8"
                                placeholder="Write your announcement here..."
                                required
                            ><?= htmlspecialchars(
                                $announcement->description
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
                                        $announcement->announcement_date
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
                                        <?= $announcement->status === 'active'
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="inactive"
                                        <?= $announcement->status === 'inactive'
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
                                Save Changes
                            </button>

                        </div>


                    </form>

                </div>

            </section>


        <?php else: ?>


            <!-- =================================================
                 NOT FOUND
            ================================================== -->

            <section class="announcements-empty">

                <div class="empty-announcement-icon">
                    AN
                </div>

                <h2>
                    Announcement Not Found
                </h2>

                <p>
                    The announcement you are trying to edit
                    could not be found.
                </p>

                <a
                    href="<?= ROOT ?>/announcements"
                    class="add-announcement-button"
                >
                    ← Back to Announcements
                </a>

            </section>


        <?php endif; ?>


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