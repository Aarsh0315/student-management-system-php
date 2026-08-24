<?php

$teacher = $data['teacher'] ?? null;

if (!$teacher) {
    die("Teacher not found.");
}


/* =========================
   AVATAR
========================= */

$initial = strtoupper(
    substr(
        $teacher->firstname ?? 'T',
        0,
        1
    )
);


/* =========================
   STATUS
========================= */

$status = $teacher->status ?? 'active';

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
        Teacher Details - My School
    </title>


    <!-- NAV -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- TEACHER DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-details.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
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
                School Admin
            </p>

            <h1>
                Teacher Details
            </h1>

            <p class="welcome-text">
                View detailed information about
                this teacher.
            </p>

        </div>

    </section>


    <!-- =========================
         TEACHER PROFILE
    ========================== -->

    <section class="teacher-profile-card">


        <!-- LEFT SIDE -->

        <div class="teacher-profile-left">


            <!-- AVATAR -->

            <div class="teacher-large-avatar">

                <?= htmlspecialchars($initial) ?>

            </div>


            <!-- PROFILE INFORMATION -->

            <div class="teacher-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        ($teacher->firstname ?? '')
                        . ' '
                        . ($teacher->lastname ?? '')
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $teacher->email ?? '-'
                    ) ?>

                </p>


                <span class="teacher-role-badge">

                    <?= htmlspecialchars(
                        $teacher->designation ?? 'Teacher'
                    ) ?>

                </span>

            </div>


        </div>


        <!-- STATUS -->

        <div class="teacher-profile-status">

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
         PROFESSIONAL INFORMATION
    ========================== -->

    <section class="teacher-details-card">


        <div class="details-header">

            <h2>
                Professional Information
            </h2>

            <p>
                Teacher professional and account details.
            </p>

        </div>


        <div class="details-grid">


            <!-- STAFF ID -->

            <div class="details-item">

                <span>
                    Staff ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->staff_id ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- DEPARTMENT -->

            <div class="details-item">

                <span>
                    Department
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->department ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- DESIGNATION -->

            <div class="details-item">

                <span>
                    Designation
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->designation ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- QUALIFICATION -->

            <div class="details-item">

                <span>
                    Qualification
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->qualification ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- JOINING DATE -->

            <div class="details-item">

                <span>
                    Joining Date
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->joining_date ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- EMPLOYMENT TYPE -->

            <div class="details-item">

                <span>
                    Employment Type
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->employment_type ?? '-'
                    ) ?>

                </strong>

            </div>


            <!-- PHONE -->

            <div class="details-item">

                <span>
                    Phone
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->phone ?? '-'
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
                        $teacher->email ?? '-'
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
                        ucfirst($status)
                    ) ?>

                </strong>

            </div>


        </div>


    </section>


    <!-- =========================
         ACTION
    ========================== -->

    <div class="teacher-actions">

        <a
            href="<?= ROOT ?>/teachers"
            class="back-btn"
        >
            ← Back to Teachers
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>