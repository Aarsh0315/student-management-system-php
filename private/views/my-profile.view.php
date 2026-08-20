<?php

$profile = $data['profile'] ?? null;

if (!$profile) {
    die("User profile not found.");
}


/* =========================
   RANK NAME
========================= */

$rankNames = [

    'super_admin'     => 'Super Admin',
    'admin'           => 'School Admin',
    'principal'       => 'Principal',
    'vice_principal'  => 'Vice Principal',
    'teacher'         => 'Teacher',
    'student'         => 'Student',
    'parent'          => 'Parent',
    'staff'           => 'Staff'

];

$rank = $rankNames[$profile->rank]
    ?? ucfirst($profile->rank);


/* =========================
   STATUS
========================= */

$status = $profile->status ?? 'active';


/* =========================
   AVATAR
========================= */

$initial = strtoupper(
    substr(
        $profile->firstname ?? 'U',
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
        My Profile - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/home.view.css?v=2"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/profile.view.css?v=2"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css"
>

<link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 
</head>


<body>


<!-- =========================
     NAVBAR
========================= -->

<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Account
            </p>

            <h1>
                My Profile
            </h1>

            <p class="welcome-text">
                View your personal account information.
            </p>

        </div>

    </section>


    <!-- =========================
         PROFILE CARD
    ========================== -->

    <section class="profile-main-card">


        <div class="profile-main">


            <!-- AVATAR -->

            <div class="profile-large-avatar">

                <?= htmlspecialchars($initial) ?>

            </div>


            <!-- PROFILE DETAILS -->

            <div class="profile-main-info">

                <h2>

                    <?= htmlspecialchars(
                        ($profile->firstname ?? '')
                        . ' '
                        . ($profile->lastname ?? '')
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $profile->email ?? ''
                    ) ?>

                </p>


                <span class="profile-role">

                    <?= htmlspecialchars($rank) ?>

                </span>

            </div>

        </div>


        <!-- STATUS -->

        <div class="profile-status">

            <?php if ($status === 'active'): ?>

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


    <!-- =========================
         ACCOUNT INFORMATION
    ========================== -->

    <section class="profile-info-card">


        <div class="profile-section-header">

            <h2>
                Account Information
            </h2>

            <p>
                Your personal account details.
            </p>

        </div>


        <div class="profile-information-grid">


            <!-- USER ID -->

            <div class="profile-information-item">

                <span>
                    User ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $profile->user_id ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- FIRST NAME -->

            <div class="profile-information-item">

                <span>
                    First Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $profile->firstname ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- LAST NAME -->

            <div class="profile-information-item">

                <span>
                    Last Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $profile->lastname ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- EMAIL -->

            <div class="profile-information-item">

                <span>
                    Email
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $profile->email ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- GENDER -->

            <div class="profile-information-item">

                <span>
                    Gender
                </span>

                <strong>

                    <?= htmlspecialchars(
                        ucfirst(
                            $profile->gender ?? '-'
                        )
                    ) ?>

                </strong>

            </div>


            <!-- ROLE -->

            <div class="profile-information-item">

                <span>
                    Role
                </span>

                <strong>

                    <?= htmlspecialchars($rank) ?>

                </strong>

            </div>


            <!-- STATUS -->

            <div class="profile-information-item">
 
                <span>
                    Account Status
                </span>

                <strong>

                    <?= htmlspecialchars(
                        ucfirst($status)
                    ) ?>

                </strong>

            </div>


            <!-- SCHOOL -->

            <?php if (
                isset($profile->school_name)
            ): ?>

                <div class="profile-information-item">

                    <span>
                        School
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $profile->school_name
                        ) ?>

                    </strong>

                </div>

            <?php endif; ?>


        </div>


    </section>
</main>


<!-- =========================
     FOOTER
========================= -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>