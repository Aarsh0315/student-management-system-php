
<?php

$admin = $data['admin'] ?? $data['user'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>School Admin Details - My School</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

     <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/profile.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >
</head>

<body>

<?php require "../private/views/includes/nav.view.php"; ?>

<main class="dashboard">

    <section class="welcome">

        <p class="welcome-small">
            Super Admin 
        </p>

        <h1>
            School Admin Details
        </h1>

        <p class="welcome-text">
            View the complete information of this school administrator.
        </p>

    </section>


    <?php if ($admin): ?>

        <section class="profile-main-card">

            <div class="profile-main">

                <div class="profile-large-avatar">

                    <?= strtoupper(
                        substr(
                            $admin->firstname ?? 'A',
                            0,
                            1
                        )
                    ) ?>

                </div>


                <div class="profile-main-info">

                    <h2>
                        <?= htmlspecialchars(
                            ($admin->firstname ?? '')
                            . ' '
                            . ($admin->lastname ?? '')
                        ) ?>
                    </h2>

                    <p>
                        <?= htmlspecialchars(
                            $admin->email ?? '-'
                        ) ?>
                    </p>

                    <span class="profile-role">
                        <?= htmlspecialchars(
                            $admin->rank
                            ?? $admin->role
                            ?? 'School Admin'
                        ) ?>
                    </span>

                </div>

            </div>


            <div class="profile-status">

                <?php if (($admin->status ?? '') === 'active'): ?>

                    <span class="status active">
                        Active
                    </span>

                <?php else: ?>

                    <span class="status inactive">
                        Inactive
                    </span>

                <?php endif; ?>

            </div>

        </section>


        <section class="profile-info-card">

            <div class="profile-section-header">

                <h2>
                    Account Information
                </h2>

                <p>
                    Personal and school assignment details.
                </p>

            </div>


            <div class="profile-information-grid">

                <div class="profile-information-item">
                    <span>User ID</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->user_id
                            ?? $admin->id
                            ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>First Name</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->firstname ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>Last Name</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->lastname ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>Email</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->email ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>Gender</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->gender ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>Role</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->rank
                            ?? $admin->role
                            ?? 'School Admin'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>School</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->school_name
                            ?? 'No School'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>School ID</span>
                    <strong>
                        <?= htmlspecialchars(
                            $admin->school_id ?? '-'
                        ) ?>
                    </strong>
                </div>


                <div class="profile-information-item">
                    <span>Status</span>
                    <strong>
                        <?= htmlspecialchars(
                            ucfirst(
                                $admin->status
                                ?? 'inactive'
                            )
                        ) ?>
                    </strong>
                </div>

            </div>


            <div class="profile-actions">

                <a
                    href="<?= ROOT ?>/school-admins"
                    class="back-btn"
                >
                    ← Back to School Admins
                </a>

            </div>

        </section>


    <?php else: ?>

        <section class="profile-info-card">

            <div class="empty-state">

                <h3>
                    School Admin Not Found
                </h3>

                <p>
                    The requested school administrator could not be found.
                </p>

                <div class="profile-actions">

                    <a
                        href="<?= ROOT ?>/school-admins"
                        class="back-btn"
                    >
                        ← Back to School Admins
                    </a>

                </div>

            </div>

        </section>

    <?php endif; ?>

</main>

<?php require "../private/views/includes/footer.view.php"; ?>

</body>

</html>