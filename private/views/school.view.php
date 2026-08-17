<?php

$school = $data['school'] ?? null;

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
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/school.view.css"
    >
    
</head>

<body>

<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">

    <section class="welcome">

        <p class="welcome-small">
            Super Admin / Schools
        </p>

        <h1>
            <?= htmlspecialchars($school->school_name) ?>
        </h1>

        <p class="welcome-text">
            School information and management
        </p>

    </section>


    <section class="profile-card">

        <div class="profile-left">

            <div class="profile-avatar">

                <?= strtoupper(
                    substr(
                        $school->school_name,
                        0,
                        1
                    )
                ) ?>

            </div>


            <div class="profile-details">

                <h2>
                    <?= htmlspecialchars(
                        $school->school_name
                    ) ?>
                </h2>

                <p>
                    School ID:
                    <?= htmlspecialchars(
                        $school->school_id
                    ) ?>
                </p>

                <span>
                    <?= htmlspecialchars(
                        $school->status
                    ) ?>
                </span>

            </div>

        </div>

    </section>


    <!-- SCHOOL INFORMATION -->

    <section class="dashboard-card">

        <h3>
            School Information
        </h3>

        <p>
            <strong>School ID:</strong>
            <?= htmlspecialchars($school->school_id) ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= htmlspecialchars($school->email ?? '-') ?>
        </p>

        <p>
            <strong>Phone:</strong>
            <?= htmlspecialchars($school->phone ?? '-') ?>
        </p>

        <p>
            <strong>Address:</strong>
            <?= htmlspecialchars($school->address ?? '-') ?>
        </p>

        <p>
            <strong>Status:</strong>
            <?= htmlspecialchars($school->status) ?>
        </p>

    </section>


    <!-- BACK -->

    <!-- SCHOOL OVERVIEW -->

<section class="school-overview">

    <div class="overview-header">

        <h2>
            School Overview
        </h2>

        <p>
            Users and staff associated with this school.
        </p>

    </div>


    <div class="overview-grid">


        <div class="overview-card">

            <span>
                Students
            </span>

            <strong>
                <?= $data['counts']['student'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                Teachers
            </span>

            <strong>
                <?= $data['counts']['teacher'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                School Admins
            </span>

            <strong>
                <?= $data['counts']['admin'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                Principals
            </span>

            <strong>
                <?= $data['counts']['principal'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                Vice Principals
            </span>

            <strong>
                <?= $data['counts']['vice_principal'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                Parents
            </span>

            <strong>
                <?= $data['counts']['parent'] ?? 0 ?>
            </strong>

        </div>


        <div class="overview-card">

            <span>
                Staff
            </span>

            <strong>
                <?= $data['counts']['staff'] ?? 0 ?>
            </strong>

        </div>


    </div>

</section>

    <br>

    <a
        href="<?= ROOT ?>/schools"
        class="profile-btn"
    >
        ← Back to Schools
    </a>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>

</body>

</html>