<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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

    <title>My School - Dashboard</title>

    <link rel="stylesheet" href="../public/css/home.view.css">

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Welcome back 👋
            </p>

            <h1>
                <?= htmlspecialchars($_SESSION['firstname'] ?? '') ?>
                <?= htmlspecialchars($_SESSION['lastname'] ?? '') ?>
            </h1>

            <p class="welcome-text">
                Manage your school information from your dashboard.
            </p>

        </div>

    </section>


    <!-- PROFILE COMPONENT -->

    <?php require "../private/views/profile.view.php"; ?>


    <!-- Dashboard content -->

    <section class="dashboard-cards">

        <div class="dashboard-card">

            <h3>Students</h3>

            <p>
                View and manage student records.
            </p>

            <a href="<?= ROOT ?>/students">
                Manage Students →
            </a>

        </div>


        <div class="dashboard-card">

            <h3>Teachers</h3>

            <p>
                View and manage teacher information.
            </p>

            <a href="<?= ROOT ?>/teachers">
                Manage Teachers →
            </a>

        </div>


        <div class="dashboard-card">

            <h3>My Profile</h3>

            <p>
                View your personal account information.
            </p>

            <a href="<?= ROOT ?>/profile">
                View Profile →
            </a>

        </div>


    </section>

</main>


<footer class="footer">

    <p>
        © <?= date('Y') ?> My School. All rights reserved.
    </p>

</footer>


</body>

</html>