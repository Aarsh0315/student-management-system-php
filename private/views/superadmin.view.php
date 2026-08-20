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

    <title>Super Admin Dashboard</title>

    <!-- SAME NAVBAR CSS -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css?v=2"
    > 

    <!-- DASHBOARD CSS -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css?v=2"
>

</head>


<body>


<!-- NAVBAR -->

<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         WELCOME
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            Welcome back 👋
        </p>

        <h1>
            System Admin
        </h1>

        <p class="welcome-text">
            Manage schools, users and the entire system.
        </p>

    </section>


    <!-- =========================
         PROFILE CARD
    ========================== -->

    <section class="profile-card">

        <div class="profile-left">

            <div class="profile-avatar">

                <?= strtoupper(
                    substr(
                        $_SESSION['firstname'] ?? 'S',
                        0,
                        1
                    )
                ) ?>

            </div>


            <div class="profile-details">

                <h2>

                    <?= htmlspecialchars(
                        ($_SESSION['firstname'] ?? 'System')
                        . ' '
                        . ($_SESSION['lastname'] ?? 'Admin')
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $_SESSION['email']
                        ?? 'superadmin@myschool.com'
                    ) ?>

                </p>


                <span>
                    Super Admin
                </span>

            </div>

        </div>


        <a
            href="<?= ROOT ?>/profile"
            class="profile-btn"
        >
            View Profile
        </a>

    </section>



    <!-- =========================
         SUPER ADMIN CARDS
    ========================== -->

    <section class="dashboard-cards">


        <!-- SCHOOLS -->

        <div class="dashboard-card">

            <h3>
                Schools
            </h3>

            <p>
                Create and manage schools
                registered in the system.
            </p>

            <a href="<?= ROOT ?>/schools">
                Manage Schools →
            </a>

        </div>
        



        <!-- USERS -->

        <div class="dashboard-card">

            <h3>
                Users
            </h3>

            <p>
                View and manage all users
                across the schools.
            </p>

            <a href="<?= ROOT ?>/users">
                Manage Users →
            </a>

        </div>



        <!-- STUDENTS -->

        <div class="dashboard-card">

    <h3>
        Students
    </h3>

    <p>
        View and manage all students
        across the schools.
    </p>

    <a href="<?= ROOT ?>/students">
        Manage Students →
    </a>

</div>

         <!-- STAFF -->

        <div class="dashboard-card">

    <h3>
        Staff
    </h3>

    <p>
        View and manage all staff
        members across schools.
    </p>

    <a href="<?= ROOT ?>/staff">
        Manage Staff →
    </a>

</div>

<!-- SCHOOL ADMINS -->
<div class="dashboard-card">

    <h3>
        School Admins
    </h3>

    <p>
        Manage administrators
        assigned to schools.
    </p>

    <a href="<?= ROOT ?>/schooladmins">
        Manage Admins →
    </a>

</div>



        <!-- REPORTS -->

        <div class="dashboard-card">

            <h3>
                Reports
            </h3>

            <p>
                View system-wide reports
                and school statistics.
            </p>

            <a href="<?= ROOT ?>/reports">
                View Reports →
            </a>

        </div>


    </section>


</main>


<!-- FOOTER -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>