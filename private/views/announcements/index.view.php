<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$announcements = $data['announcements'] ?? [];

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
        Announcements - My School
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
                    Announcements
                </h1>

                <p class="announcements-description">

                    View important announcements and
                    information for your school.

                </p>

            </div>


            <div class="announcements-header-actions">

                <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                    <a
                        href="<?= ROOT ?>/announcements/create"
                        class="add-announcement-button"
                    >
                        + Add Announcement
                    </a>

                <?php endif; ?>

            </div>

        </section>


        <!-- =================================================
             ANNOUNCEMENTS CARD
        ================================================== -->

        <?php if (!empty($announcements)): ?>

            <section class="announcements-card">

                <div class="announcements-card-header">

                    <div>

                        <h2>
                            All Announcements
                        </h2>

                        <p>
                            View important school announcements.
                        </p>

                    </div>


                    <span class="announcement-count">

                        <?= count($announcements) ?>

                        <?= count($announcements) === 1
                            ? 'Announcement'
                            : 'Announcements'
                        ?>

                    </span>

                </div>


                <!-- =================================================
                     ANNOUNCEMENTS TABLE
                ================================================== -->

                <div class="announcements-table-wrapper">

                    <table class="announcements-table">

                        <thead>

                            <tr>

                                <th>
                                    Announcement
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


                        <?php foreach (
                            $announcements
                            as $announcement
                        ): ?>


                            <?php

                            /*
                             * ANNOUNCEMENT MANAGEMENT PERMISSION
                             *
                             * Super Admin -> Can manage
                             * Admin       -> Can manage
                             * Teacher     -> Can manage own announcements
                             * Student     -> View only
                             */

                            $canManageAnnouncement =
                                in_array(
                                    $rank,
                                    ['super_admin', 'admin'],
                                    true
                                )
                                ||
                                (
                                    $rank === 'teacher'
                                    &&
                                    (int)($announcement->created_by ?? 0)
                                    ===
                                    (int)$user_id
                                );

                            ?>


                            <tr>


                                <!-- =================================
                                     ANNOUNCEMENT
                                ================================== -->

                                <td class="announcement-title-cell">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $announcement->title ?? '—'
                                        ) ?>

                                    </strong>


                                    <?php if (
                                        !empty(
                                            $announcement->description
                                        )
                                    ): ?>

                                        <span>

                                            <?= htmlspecialchars(
                                                $announcement->description
                                            ) ?>

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- =================================
                                     SCHOOL
                                ================================== -->

                                <?php if ($rank === 'super_admin'): ?>

                                    <td>

                                        <span class="school-name">

                                            <?= !empty(
                                                $announcement->school_name
                                            )
                                                ? htmlspecialchars(
                                                    $announcement->school_name
                                                )
                                                : '—'
                                            ?>

                                        </span>

                                    </td>

                                <?php endif; ?>


                                <!-- =================================
                                     DATE
                                ================================== -->

                                <td class="date-cell">

                                    <?php if (
                                        !empty(
                                            $announcement->announcement_date
                                        )
                                    ): ?>

                                        <?= date(
                                            'd M Y',
                                            strtotime(
                                                $announcement->announcement_date
                                            )
                                        ) ?>

                                    <?php else: ?>

                                        —

                                    <?php endif; ?>

                                </td>


                                <!-- =================================
                                     STATUS
                                ================================== -->

                                <td>

                                    <?php

                                    $statusClass =
                                        ($announcement->status ?? '') === 'active'
                                            ? 'status-active'
                                            : 'status-inactive';

                                    ?>

                                    <span
                                        class="announcement-status <?= $statusClass ?>"
                                    >

                                        <?= htmlspecialchars(
                                            ucfirst(
                                                $announcement->status
                                                ?? 'Inactive'
                                            )
                                        ) ?>

                                    </span>

                                </td>


                                <!-- =================================
                                     CREATED BY
                                ================================== -->

                                <td>

                                    <?php

                                    $createdBy = trim(
                                        ($announcement->firstname ?? '')
                                        . ' ' .
                                        ($announcement->lastname ?? '')
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

                                    <div class="announcement-actions">


                                        <!-- VIEW -->

                                        <a
                                            href="<?= ROOT ?>/announcements/details/<?= urlencode($announcement->announcement_id) ?>"
                                            class="action-view"
                                        >
                                            View
                                        </a>


                                        <?php if ($canManageAnnouncement): ?>


                                            <!-- EDIT -->

                                            <a
                                                href="<?= ROOT ?>/announcements/edit/<?= urlencode($announcement->announcement_id) ?>"
                                                class="action-edit"
                                            >
                                                Edit
                                            </a>


                                            <!-- DELETE -->

                                            <form
                                                method="POST"
                                                action="<?= ROOT ?>/announcements/delete/<?= urlencode($announcement->announcement_id) ?>"
                                                onsubmit="return confirm('Are you sure you want to delete this announcement?');"
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


            </section>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <section class="announcements-empty">

                <div class="empty-announcement-icon">
                    AN
                </div>


                <h2>
                    No Announcements Found
                </h2>


                <p>
                    There are currently no announcements available.
                </p>


                <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                    <a
                        href="<?= ROOT ?>/announcements/create"
                        class="add-announcement-button"
                    >
                        + Create Your First Announcement
                    </a>

                <?php endif; ?>


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