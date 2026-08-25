<?php

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
        Teacher Dashboard
    </title>


    <!-- TEACHER NAVBAR CSS -->

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/teacher-nav.view.css?v=2"
>


<!-- TEACHER DASHBOARD CSS -->

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/teacher-dashboard.view.css?v=2"
>


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=4"
    >

</head>


<body>


<?php require "../private/views/includes/teacher-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         WELCOME
    ========================================= -->

    <section class="welcome">

        <p class="welcome-small">
            Teacher
        </p>

        <h1>
            Dashboard
        </h1>

        <p class="welcome-text">
            Manage your students, classes,
            tests and academic activities.
        </p>

    </section>



    <!-- ========================================
         PROFILE CARD
    ========================================= -->

    <section class="profile-card">

        <div class="profile-left">


            <!-- PROFILE AVATAR -->

            <div class="profile-avatar">

                <?php

                $firstname =
                    $_SESSION['firstname'] ?? 'T';

                echo strtoupper(
                    substr(
                        $firstname,
                        0,
                        1
                    )
                );

                ?>

            </div>


            <!-- PROFILE DETAILS -->

            <div class="profile-details">

                <h2>

                    <?= htmlspecialchars(
                        $_SESSION['firstname']
                        ?? 'Teacher'
                    ) ?>

                    <?= htmlspecialchars(
                        $_SESSION['lastname']
                        ?? ''
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $_SESSION['email']
                        ?? '-'
                    ) ?>

                </p>


                <span>
                    Teacher
                </span>

            </div>

        </div>


        <!-- PROFILE BUTTON -->

        <a
            href="<?= ROOT ?>/profile"
            class="profile-btn"
        >
            View Profile
        </a>

    </section>



    <!-- ========================================
         DASHBOARD CARDS
    ========================================= -->

    <section class="dashboard-cards">


        <!-- ========================================
             STUDENTS
        ========================================= -->

        <div class="dashboard-card">

            <h3>
                Students
            </h3>

            <p>
                View students assigned
                to your classes.
            </p>


            <a href="<?= ROOT ?>/teacherstudents">
                View Students →
            </a>

        </div>



        <!-- ========================================
             CLASSES
        ========================================= -->

        <div class="dashboard-card">

            <h3>
                Classes
            </h3>

            <p>
                View your assigned
                classes and divisions.
            </p>

            <a href="<?= ROOT ?>/teacherclasses">
                View Classes →
            </a>

        </div>



        <!-- ========================================
             TESTS
        ========================================= -->

        <div class="dashboard-card">

            <h3>
                Tests
            </h3>

            <p>
                Create and manage tests
                for your students.
            </p>


            <a href="<?= ROOT ?>/teachertests">
                Manage Tests →
            </a>

        </div>



        <!-- ========================================
             RESULTS
        ========================================= -->

        <div class="dashboard-card">



            <h3>
                Results
            </h3>

            <p>
                View student test results
                and performance.
            </p>

            <a href="<?= ROOT ?>/teacherresults">
                View Results →
            </a>

        </div>


        <!-- ========================================
             PARENTS
        ========================================= -->

        <div class="dashboard-card">

            <h3>
                Parents
            </h3>

            <p>
                View parents associated
                with your students.
            </p>

            <a href="<?= ROOT ?>/teacherparents">
                View Parents →
            </a>

        </div>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>