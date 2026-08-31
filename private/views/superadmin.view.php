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

    <title>
        Super Admin Dashboard - My School
    </title>


    <!-- =================================================
         NAVBAR
    ================================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- =================================================
         SUPER ADMIN DASHBOARD
    ================================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css?v=4"
    >


    <!-- =================================================
         FOOTER
    ================================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>



<!-- =====================================================
     MAIN DASHBOARD
===================================================== -->

<main class="dashboard">


    <!-- =================================================
         WELCOME SECTION
    ================================================= -->

    <section class="welcome">

        <p class="welcome-small">
            Welcome back 👋
        </p>


        <h1>
            System Admin
        </h1>


        <p class="welcome-text">
            Manage schools, users and the entire system
            from one place.
        </p>

    </section>



    <!-- =================================================
         PROFILE / ACCOUNT OVERVIEW
    ================================================= -->

    <section class="profile-card">


        <!-- PROFILE INFORMATION -->

        <div class="profile-left">


            <!-- AVATAR -->

            <div class="profile-avatar">

                <?= strtoupper(
                    substr(
                        $_SESSION['firstname'] ?? 'S',
                        0,
                        1
                    )
                ) ?>

            </div>


            <!-- DETAILS -->

            <div class="profile-details">

                <p class="profile-label">
                    ACCOUNT OVERVIEW
                </p>


                <h2>

                    <?= htmlspecialchars(
                        ($_SESSION['firstname'] ?? 'System')
                        . ' '
                        . ($_SESSION['lastname'] ?? 'Admin')
                    ) ?>

                </h2>


                <p class="profile-email">

                    <?= htmlspecialchars(
                        $_SESSION['email']
                        ?? 'superadmin@myschool.com'
                    ) ?>

                </p>


                <span class="profile-role">
                    Super Admin
                </span>

            </div>

        </div>



        <!-- PROFILE ACTION -->

        <a
            href="<?= ROOT ?>/profile"
            class="profile-btn"
        >

            View Profile

            <span>
                →
            </span>

        </a>


    </section>



    <!-- =================================================
         MANAGEMENT SECTION
    ================================================= -->

    <section class="management-section">


        <!-- SECTION HEADER -->

        <div class="section-header">

            <div>

                <p class="section-label">
                    ADMINISTRATION
                </p>

                <h2>
                    Management Overview
                </h2>

            </div>


            <p class="section-description">
                Manage and monitor the different areas
                of your school management system.
            </p>

        </div>



        <!-- =================================================
             DASHBOARD CARDS
        ================================================= -->

        <div class="dashboard-cards">



            <!-- =================================================
                 SCHOOLS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    🏫
                </div>


                <div class="card-content">

                    <h3>
                        Schools
                    </h3>


                    <p>
                        Create and manage schools
                        registered in the system.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/schools"
                    class="card-action"
                >

                    Manage Schools

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 USERS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    👥
                </div>


                <div class="card-content">

                    <h3>
                        Users
                    </h3>


                    <p>
                        View and manage all users
                        across the schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/users"
                    class="card-action"
                >

                    Manage Users

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 STUDENTS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    🎓
                </div>


                <div class="card-content">

                    <h3>
                        Students
                    </h3>


                    <p>
                        View and manage students
                        across all schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/students"
                    class="card-action"
                >

                    Manage Students

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 STAFF
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    👨‍🏫
                </div>


                <div class="card-content">

                    <h3>
                        Staff
                    </h3>


                    <p>
                        View and manage staff members
                        across schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/staff"
                    class="card-action"
                >

                    Manage Staff

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 PARENTS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    👨‍👩‍👧
                </div>


                <div class="card-content">

                    <h3>
                        Parents
                    </h3>


                    <p>
                        View and manage parents
                        across all schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/parents"
                    class="card-action"
                >

                    Manage Parents

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 TESTS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    📝
                </div>


                <div class="card-content">

                    <h3>
                        Tests
                    </h3>


                    <p>
                        View and manage tests
                        across schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/tests"
                    class="card-action"
                >

                    Manage Tests

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 RESULTS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    📊
                </div>


                <div class="card-content">

                    <h3>
                        Results
                    </h3>


                    <p>
                        View and manage student marks
                        and academic results.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/results"
                    class="card-action"
                >

                    Manage Results

                    <span>
                        →
                    </span>

                </a>

            </article>



            <!-- =================================================
                 SCHOOL ADMINS
            ================================================= -->

            <article class="dashboard-card">

                <div class="card-icon">
                    🛡️
                </div>


                <div class="card-content">

                    <h3>
                        School Admins
                    </h3>


                    <p>
                        Manage administrators
                        assigned to schools.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/schooladmins"
                    class="card-action"
                >

                    Manage Admins

                    <span>
                        →
                    </span>

                </a>

            </article>


        </div>

    </section>


</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>