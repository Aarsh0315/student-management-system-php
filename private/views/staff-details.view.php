<?php

$staff = $data['staff'] ?? null;

if (!$staff) {
    die("Staff not found.");
}


/* =========================
   FULL NAME
========================= */

$fullName =
    ($staff->firstname ?? '')
    . ' '
    . ($staff->lastname ?? '');


/* =========================
   INITIAL
========================= */

$initial = strtoupper(
    substr(
        $staff->firstname ?? 'S',
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
        Staff Details - My School
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/staff-details.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    > 

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Staff Details
            </h1>

            <p class="welcome-text">
                View complete information about this staff member.
            </p>

        </div>

    </section>


    <!-- =========================
         STAFF PROFILE
    ========================== -->

    <section class="staff-profile-card">


        <div class="staff-profile-left">


            <!-- AVATAR -->

            <div class="staff-large-avatar">

    <?php if (!empty($staff->profile_image)): ?>

        <img
            src="<?= ROOT ?>/uploads/users/<?= htmlspecialchars($staff->profile_image) ?>"
            alt="<?= htmlspecialchars(trim($fullName)) ?>"
        >

    <?php else: ?>

        <?= htmlspecialchars($initial) ?>

    <?php endif; ?>

</div>


            <!-- BASIC DETAILS -->

            <div class="staff-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        trim($fullName)
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $staff->email ?? '-'
                    ) ?>

                </p>


                <span class="staff-role-badge">

                    <?= htmlspecialchars(
                        $staff->designation ?? '-'
                    ) ?>

                </span>

            </div>

        </div>


        <!-- STATUS -->

        <?php if (
            ($staff->status ?? 'active')
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


    <!-- =========================
         PERSONAL INFORMATION
    ========================== -->

    <section class="staff-details-card">

        <div class="details-header">

            <h2>
                Personal Information
            </h2>

            <p>
                Basic information about the staff member.
            </p>

        </div>


        <div class="details-grid">


            <div class="details-item">

                <span>
                    Staff ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->staff_id
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    User ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->user_id
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    First Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->firstname
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Last Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->lastname
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->email
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Gender
                </span>

                <strong>
                    <?= htmlspecialchars(
                        ucfirst(
                            $staff->gender ?? '-'
                        )
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Phone
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->phone ?? '-'
                    ) ?>
                </strong>

            </div>


        </div>

    </section>


    <!-- =========================
         PROFESSIONAL INFORMATION
    ========================== -->

    <section class="staff-details-card">

        <div class="details-header">

            <h2>
                Professional Information
            </h2>

            <p>
                Employment and professional details.
            </p>

        </div>


        <div class="details-grid">


            <div class="details-item">

                <span>
                    Designation
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->designation ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Department
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->department ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Qualification
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->qualification ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Joining Date
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->joining_date ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Employment Type
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $staff->employment_type ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Status
                </span>

                <strong>
                    <?= htmlspecialchars(
                        ucfirst(
                            $staff->status ?? 'active'
                        )
                    ) ?>
                </strong>

            </div>


        </div>

    </section>


    <!-- =========================
         SCHOOL INFORMATION
    ========================== -->

    <section class="staff-details-card">

        <div class="details-header">

            <h2>
                School Information
            </h2>

            <p>
                School assigned to this staff member.
            </p>

        </div>


        <div class="details-grid">


            <div class="details-item">

                <span>
                    School
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $staff->school_name
                        ?? 'No School'
                    ) ?>

                </strong>

            </div>


            <div class="details-item">

                <span>
                    School ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $staff->school_code
                        ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>


    <!-- =========================
         ADDRESS
    ========================== -->

    <section class="staff-details-card">

        <div class="details-header">

            <h2>
                Address
            </h2>

        </div>


        <div class="address-box">

            <?= nl2br(
                htmlspecialchars(
                    $staff->address ?? 'No address provided.'
                )
            ) ?>

        </div>

    </section>


    <!-- =========================
         BACK BUTTON
    ========================== -->

    <div class="staff-actions">

        <a
            href="<?= ROOT ?>/staff"
            class="back-btn"
        >
            ← Back to Staff
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>