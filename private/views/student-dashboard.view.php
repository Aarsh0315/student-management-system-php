<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$student =
    $data['student'] ?? null;

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
        Student Dashboard - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- STUDENT DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-dashboard.view.css?v=1"
    >


    <!-- STUDENT NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-nav.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/student-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Student
            </p>


            <h1>
                Dashboard
            </h1>


            <p class="welcome-text">
                View your classes, tests, results
                and academic activities.
            </p>

        </div>

    </section>



    <!-- ========================================
         STUDENT PROFILE CARD
    ======================================== -->

    <section class="student-profile-card">


        <div class="student-profile-left">


            <!-- AVATAR -->

            <div class="student-large-avatar">

                <?php

                $firstname =
                    $student->firstname
                    ?? 'S';

                echo strtoupper(
                    substr(
                        $firstname,
                        0,
                        1
                    )
                );

                ?>

            </div>



            <!-- PROFILE INFORMATION -->

            <div class="student-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        $student->firstname
                        ?? 'Student'
                    ) ?>

                    <?= htmlspecialchars(
                        $student->lastname
                        ?? ''
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $student->email
                        ?? '-'
                    ) ?>

                </p>


                <span class="student-role-badge">
                    Student
                </span>

            </div>


        </div>



        <!-- VIEW PROFILE -->

        <a
            href="<?= ROOT ?>/profile"
            class="student-profile-btn"
        >
            View Profile
        </a>


    </section>



    <!-- ========================================
         DASHBOARD CARDS
    ======================================== -->

    <section class="student-dashboard-grid">


        <!-- ========================================
             MY CLASS
        ======================================== -->

        <div class="student-dashboard-card">

            <h2>
                My Class
            </h2>

            <p>
                View your class and division
                information.
            </p>

            <a
                href="<?= ROOT ?>/studentclasses"
                class="dashboard-card-link"
            >
                View Class →
            </a>

        </div>



        <!-- ========================================
             TESTS
        ======================================== -->

        <div class="student-dashboard-card">

            <h2>
                Tests
            </h2>

            <p>
                View available tests and
                assessments.
            </p>

            <a
                href="<?= ROOT ?>/studenttests"
                class="dashboard-card-link"
            >
                View Tests →
            </a>

        </div>



        <!-- ========================================
             RESULTS
        ======================================== -->

        <div class="student-dashboard-card">

            <h2>
                Results
            </h2>

            <p>
                View your test results and
                academic performance.
            </p>

            <a
                href="<?= ROOT ?>/studentresults"
                class="dashboard-card-link"
            >
                View Results →
            </a>

        </div>



        <!-- ========================================
             ATTENDANCE
        ======================================== -->

        <div class="student-dashboard-card">

            <h2>
                Attendance
            </h2>

            <p>
                View your attendance and
                attendance records.
            </p>

            <a
                href="<?= ROOT ?>/studentattendance"
                class="dashboard-card-link"
            >
                View Attendance →
            </a>

        </div>



        <!-- ========================================
             PARENTS
        ======================================== -->

        <div class="student-dashboard-card">

            <h2>
                Parents
            </h2>

            <p>
                View your parent and guardian
                information.
            </p>

            <a
                href="<?= ROOT ?>/studentparents"
                class="dashboard-card-link"
            >
                View Parents →
            </a>

        </div>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>