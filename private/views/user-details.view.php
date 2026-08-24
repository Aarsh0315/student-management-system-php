<?php

$user = $data['user'] ?? null;

if (!$user) {
    die("User not found.");
}


/* =========================
   RANK
========================= */

$rankNames = [

    'super_admin'    => 'Super Admin',
    'admin'          => 'School Admin',
    'principal'      => 'Principal',
    'vice_principal' => 'Vice Principal',
    'teacher'        => 'Teacher',
    'student'        => 'Student',
    'parent'         => 'Parent',
    'staff'          => 'Staff'

];

$rank = $rankNames[$user->rank]
    ?? ucfirst($user->rank);


/* =========================
   AVATAR
========================= */

$initial = strtoupper(
    substr(
        $user->firstname ?? 'U',
        0,
        1
    )
);

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
        User Details - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/user-details.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- HEADER -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin
        </p>

        <h1>
            User Details
        </h1>

        <p class="welcome-text">
            View information about this user.
        </p>

    </section>


    <!-- PROFILE HEADER -->

    <section class="user-profile-card">


        <div class="user-profile-left">


            <div class="user-profile-image">

    <?php if (!empty($user->profile_image)): ?>

        <img
            src="<?= ROOT ?>/uploads/users/<?= htmlspecialchars($user->profile_image) ?>"
            alt="Profile Image"
        >

    <?php else: ?>

        <div class="user-avatar-fallback">

            <?= strtoupper(
                substr(
                    $user->firstname ?? 'U',
                    0,
                    1
                )
            ) ?>

        </div>

    <?php endif; ?>

</div>


            <div>

                <h2>

                    <?= htmlspecialchars(
                        $user->firstname
                        . ' '
                        . $user->lastname
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $user->email
                    ) ?>

                </p>


                <span class="rank-badge">

                    <?= htmlspecialchars($rank) ?>

                </span>

            </div>

        </div>


        <!-- STATUS -->

        <?php if (
            ($user->status ?? 'active')
            === 'active'
        ): ?>

            <span class="status active">
                Active
            </span>

        <?php else: ?>

            <span class="status inactive">
                Inactive
            </span>

        <?php endif; ?>


    </section>


    <!-- ACCOUNT INFORMATION -->

    <section class="user-details-card">

        <div class="details-header">

            <h2>
                Account Information
            </h2>

            <p>
                User account details
            </p>

        </div>


        <div class="details-grid">


            <!-- USER ID -->

            <div class="details-item">

                <span>
                    User ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $user->user_id
                    ) ?>
                </strong>

            </div>


            <!-- FIRST NAME -->

            <div class="details-item">

                <span>
                    First Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $user->firstname
                    ) ?>
                </strong>

            </div>


            <!-- LAST NAME -->

            <div class="details-item">

                <span>
                    Last Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $user->lastname
                    ) ?>
                </strong>

            </div>


            <!-- EMAIL -->

            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $user->email
                    ) ?>
                </strong>

            </div>


            <!-- GENDER -->

            <div class="details-item">

                <span>
                    Gender
                </span>

                <strong>
                    <?= htmlspecialchars(
                        ucfirst(
                            $user->gender ?? '-'
                        )
                    ) ?>
                </strong>

            </div>


            <!-- RANK -->

            <div class="details-item">

                <span>
                    Role
                </span>

                <strong>
                    <?= htmlspecialchars($rank) ?>
                </strong>

            </div>


            <!-- SCHOOL -->

            <div class="details-item">

                <span>
                    School
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $user->school_name
                        ?? 'No School'
                    ) ?>

                </strong>

            </div>


            <!-- SCHOOL ID -->

            <div class="details-item">

                <span>
                    School ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $user->school_code
                        ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- STATUS -->

            <div class="details-item">

                <span>
                    Account Status
                </span>

                <strong>

                    <?= htmlspecialchars(
                        ucfirst(
                            $user->status
                            ?? 'active'
                        )
                    ) ?>

                </strong>

            </div>


        </div>

    </section>


    <!-- ACTIONS -->

    <section class="user-actions">

        <a
            href="<?= ROOT ?>/users"
            class="back-btn"
        >
            ← Back to Users
        </a>

    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>