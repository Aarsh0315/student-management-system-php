<?php

$school = $data['school'] ?? null;
$counts = $data['counts'] ?? [];

if (!$school) {
    die("School not found.");
}

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
        <?= htmlspecialchars($school->school_name) ?>
        - School Details
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/school.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schools.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin / Schools
        </p>

        <h1>
            School Details
        </h1>

        <p class="welcome-text">
            View and manage school information.
        </p>

    </section>


    <!-- =========================
         SCHOOL HEADER
    ========================== -->

    <section class="school-details-card">

        <div class="school-details-header">

            <div class="school-avatar">

                <?= strtoupper(
                    substr(
                        $school->school_name,
                        0,
                        1
                    )
                ) ?>

            </div>


            <div>

                <h2>
                    <?= htmlspecialchars(
                        $school->school_name
                    ) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        $school->school_id
                    ) ?>
                </p>

            </div>


            <span
                class="status
                <?= $school->status === 'active'
                    ? 'active'
                    : 'inactive' ?>"
            >

                <?= htmlspecialchars(
                    ucfirst($school->status)
                ) ?>

            </span>

        </div>


        <!-- =========================
             SCHOOL INFORMATION
        ========================== -->

        <div class="details-section">

            <h3>
                School Information
            </h3>


            <div class="information-grid">


                <div class="information-item">

                    <span>
                        School Name
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->school_name
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        School ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->school_id
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        School Code
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->school_code ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Established Year
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->established_year ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Board
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->board ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Medium
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->medium ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        School Type
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->school_type ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Academic Year
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->academic_year ?? '-'
                        ) ?>
                    </strong>

                </div>


            </div>

        </div>


        <!-- =========================
             CONTACT INFORMATION
        ========================== -->

        <div class="details-section">

            <h3>
                Contact Information
            </h3>


            <div class="information-grid">


                <div class="information-item">

                    <span>
                        Email
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->email ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Phone
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->phone ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Emergency Contact
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->emergency_contact ?? '-'
                        ) ?>
                    </strong>

                </div>


                <div class="information-item">

                    <span>
                        Website
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $school->website ?? '-'
                        ) ?>
                    </strong>

                </div>


            </div>

        </div>


        <!-- =========================
             ADDRESS
        ========================== -->

        <div class="details-section">

            <h3>
                Address
            </h3>


            <div class="address-box">

                <?= htmlspecialchars(
                    $school->address ?? '-'
                ) ?>

            </div>

        </div>

    </section>

    <!-- =========================
         BACK
    ========================== -->

    <div class="school-actions">

        <a
            href="<?= ROOT ?>/schools"
            class="back-btn"
        >
            ← Back to Schools
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>

</body>

</html>