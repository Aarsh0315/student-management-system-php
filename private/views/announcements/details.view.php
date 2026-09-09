<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$announcement = $data['announcement'] ?? null;

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
        Announcement Details - My School
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
        href="<?= ROOT ?>/css/announcements.view.css?v=2"
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
                        Announcement Details
                    </h1>

                    <p class="announcements-description">
                        View the complete announcement information.
                    </p>

                </div>


                <div class="announcements-header-actions">

                    <!-- EDIT
                         Students cannot see this button.
                    -->

                    <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                        <a
                            href="<?= ROOT ?>/announcements/edit/<?= urlencode($announcement->announcement_id) ?>"
                            class="edit-announcement-button"
                        >
                            Edit Announcement
                        </a>

                    <?php endif; ?>

                </div>

            </section>


            <!-- =================================================
                 ANNOUNCEMENT DETAILS CARD
            ================================================== -->

            <section class="announcement-details-card">


                <!-- HEADER -->

                <div class="announcement-details-header">

                    <div>

                        <p class="announcement-details-label">
                            ANNOUNCEMENT
                        </p>

                        <h2>

                            <?= htmlspecialchars(
                                $announcement->title ?? '—'
                            ) ?>

                        </h2>

                    </div>


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
                                $announcement->status ?? 'Inactive'
                            )
                        ) ?>

                    </span>

                </div>


                <!-- INFORMATION -->

                <div class="announcement-details-info">


                    <!-- ANNOUNCEMENT ID -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            Announcement ID
                        </span>

                        <strong>
                            #<?= (int) $announcement->announcement_id ?>
                        </strong>

                    </div>


                    <!-- SCHOOL -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            School
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $announcement->school_name ?? '—'
                            ) ?>

                        </strong>

                    </div>


                    <!-- ANNOUNCEMENT DATE -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            Announcement Date
                        </span>

                        <strong>

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

                        </strong>

                    </div>


                    <!-- CREATED BY -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            Created By
                        </span>

                        <strong>

                            <?php

                            $createdBy = trim(
                                ($announcement->firstname ?? '')
                                . ' '
                                .
                                ($announcement->lastname ?? '')
                            );

                            ?>

                            <?= htmlspecialchars(
                                $createdBy ?: '—'
                            ) ?>

                        </strong>

                    </div>


                    <!-- CREATED AT -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            Created At
                        </span>

                        <strong>

                            <?= !empty(
                                $announcement->created_at
                            )
                                ? date(
                                    'd M Y, h:i A',
                                    strtotime(
                                        $announcement->created_at
                                    )
                                )
                                : '—'
                            ?>

                        </strong>

                    </div>


                    <!-- LAST UPDATED -->

                    <div class="announcement-detail-item">

                        <span class="detail-label">
                            Last Updated
                        </span>

                        <strong>

                            <?= !empty(
                                $announcement->updated_at
                            )
                                ? date(
                                    'd M Y, h:i A',
                                    strtotime(
                                        $announcement->updated_at
                                    )
                                )
                                : '—'
                            ?>

                        </strong>

                    </div>


                </div>


                <!-- DESCRIPTION -->

                <div class="announcement-description-section">

                    <span class="detail-label">
                        Announcement
                    </span>


                    <div class="announcement-description">

                        <?= nl2br(
                            htmlspecialchars(
                                $announcement->description ?? ''
                            )
                        ) ?>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="announcement-details-actions">


                    <!-- BACK -->

                    <a
                        href="<?= ROOT ?>/announcements"
                        class="form-cancel-button"
                    >
                        Back
                    </a>


                    <!-- EDIT
                         Students cannot see this button.
                    -->

                    <?php if (!in_array($rank, ['student', 'parent'], true)): ?>

                        <a
                            href="<?= ROOT ?>/announcements/edit/<?= urlencode($announcement->announcement_id) ?>"
                            class="form-submit-button"
                        >
                            Edit Announcement
                        </a>

                    <?php endif; ?>


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

                    The announcement you are looking for
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