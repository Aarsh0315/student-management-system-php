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

    <link rel="stylesheet" href="../public/css/profile.view.css">
    
    <link rel="stylesheet" href="../public/css/nav.view.css">

</head>

<body>


    <!-- Navigation Bar -->

    <nav class="navbar">

        <div class="nav-container">


            <!-- Logo -->

            <a href="<?= ROOT ?>/home" class="logo">
                My School
            </a>


            <!-- Navigation Links -->

            <div class="nav-links">

                <a href="<?= ROOT ?>/home">
                    Dashboard
                </a>

                <a href="<?= ROOT ?>/profile">
                    Profile
                </a>

                <a href="<?= ROOT ?>/logout">
                    Logout
                </a>

            </div>


        </div>

    </nav>



    <!-- Main Dashboard -->

    <main class="dashboard">


        <!-- Welcome Section -->

        <section class="welcome-section">

            <h1>
                Welcome,
                <?= htmlspecialchars($_SESSION['firstname'] ?? '') ?>
                <?= htmlspecialchars($_SESSION['lastname'] ?? '') ?>
            </h1>

            <p>
                Welcome to your school management dashboard.
            </p>

        </section>



        <!-- User Information -->

        <section class="dashboard-card">


            <h2>
                Account Information
            </h2>


            <div class="user-info">


                <!-- First Name -->

                <div class="info-item">

                    <span class="info-label">
                        First Name
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($_SESSION['firstname'] ?? '') ?>
                    </span>

                </div>


                <!-- Last Name -->

                <div class="info-item">

                    <span class="info-label">
                        Last Name
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($_SESSION['lastname'] ?? '') ?>
                    </span>

                </div>


                <!-- Email -->

                <div class="info-item">

                    <span class="info-label">
                        Email
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($_SESSION['email'] ?? '') ?>
                    </span>

                </div>


                <!-- Rank -->

                <div class="info-item">

                    <span class="info-label">
                        Rank
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($_SESSION['rank'] ?? '') ?>
                    </span>

                </div>


            </div>


        </section>



        <!-- Dashboard Cards -->

        <section class="dashboard-grid">


            <!-- Profile -->

            <div class="dashboard-item">

                <h3>
                    My Profile
                </h3>

                <p>
                    View and manage your profile information.
                </p>

                <a href="<?= ROOT ?>/profile">
                    View Profile
                </a>

            </div>


            <!-- Students -->

            <div class="dashboard-item">

                <h3>
                    Students
                </h3>

                <p>
                    Manage student information and records.
                </p>

                <a href="<?= ROOT ?>/students">
                    View Students
                </a>

            </div>


            <!-- Teachers -->

            <div class="dashboard-item">

                <h3>
                    Teachers
                </h3>

                <p>
                    Manage teacher information.
                </p>

                <a href="<?= ROOT ?>/teachers">
                    View Teachers
                </a>

            </div>


            <!-- Settings -->

            <div class="dashboard-item">

                <h3>
                    Settings
                </h3>

                <p>
                    Manage your account settings.
                </p>

                <a href="<?= ROOT ?>/settings">
                    Settings
                </a>

            </div>


        </section>


    </main>



    <!-- Footer -->

    <footer class="footer">

        <p>
            &copy; <?= date('Y') ?> My School.
            All rights reserved.
        </p>

    </footer>


</body>

</html>