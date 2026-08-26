<?php

$student_count =
    $data['student_count'] ?? 0;

$staff_count =
    $data['staff_count'] ?? 0;

$parent_count =
    $data['parent_count'] ?? 0;

$class_count =
    $data['class_count'] ?? 0;

$test_count =
    $data['test_count'] ?? 0;

$result_count =
    $data['result_count'] ?? 0;

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
        School Admin Dashboard - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- HOME CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         WELCOME
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            School Admin
        </p>


        <h1>
            Dashboard
        </h1>


        <p class="welcome-text">
            Manage your school's students,
            teachers and parents.
        </p>

    </section>



    <!-- =========================
         PROFILE CARD
    ========================== -->

    <section class="profile-card">

        <div class="profile-left">


            <!-- AVATAR -->

            <div class="profile-avatar">

                <?php

                $firstname =
                    $_SESSION['firstname']
                    ?? 'A';

                echo strtoupper(
                    substr(
                        $firstname,
                        0,
                        1
                    )
                );

                ?>

            </div>



            <!-- DETAILS -->

            <div class="profile-details">

                <h2>

                    <?= htmlspecialchars(
                        $_SESSION['firstname']
                        ?? 'School Admin'
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
                    School Admin
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
         DASHBOARD CARDS
    ========================== -->

    <!-- =========================
     DASHBOARD CARDS
========================= -->

<section class="dashboard-cards">


    <!-- =========================
         STUDENTS
    ========================== -->

    <div class="dashboard-card">

        <h3>
            Students
        </h3>


        <p>
            Manage students registered
            in your school.
        </p>


        <strong class="dashboard-count">

            <?= htmlspecialchars(
                $student_count
            ) ?>

        </strong>


        <a href="<?= ROOT ?>/students">
            Manage Students →
        </a>

    </div>



    <!-- =========================
         TEACHERS
    ========================== -->

    <div class="dashboard-card">

        <h3>
            Teachers
        </h3>


        <p>
            Manage teachers and staff
            members in your school.
        </p>


        <strong class="dashboard-count">

            <?= htmlspecialchars(
                $staff_count
            ) ?>

        </strong>


        <a href="<?= ROOT ?>/teachers">
            Manage Teachers →
        </a>

    </div>



    <!-- =========================
         PARENTS
    ========================== -->

    <div class="dashboard-card">

        <h3>
            Parents
        </h3>


        <p>
            Manage parents associated
            with your students.
        </p>


        <strong class="dashboard-count">

            <?= htmlspecialchars(
                $parent_count
            ) ?>

        </strong>


        <a href="<?= ROOT ?>/parents">
            Manage Parents →
        </a>

    </div>



    <!-- =========================
         CLASSES
    ========================== -->

    <div class="dashboard-card">


        <h3>
            Classes
        </h3>


        <p>
            Manage classes and divisions
            in your school.
        </p>


        <strong class="dashboard-count">
            <?= htmlspecialchars(
                $class_count
            ) ?>
        </strong>


        <a href="<?= ROOT ?>/classes">
            Manage Classes →
        </a>

    </div>

    <!-- =========================
     TESTS
========================= -->

<div class="dashboard-card">

    <h3>
        Tests
    </h3>


    <p>
        View tests created
        for your school.
    </p>


    <strong class="dashboard-count">

        <?= htmlspecialchars(
            $test_count
        ) ?>

    </strong>


    <a href="<?= ROOT ?>/tests">
        View Tests →
    </a>

</div>

<!-- =========================
     RESULTS
========================= -->

<div class="dashboard-card">

    <h3>
        Results
    </h3>


    <p>
        View student results
        from your school.
    </p>


    <strong class="dashboard-count">

        <?= htmlspecialchars(
            $result_count
        ) ?>

    </strong>


    <a href="<?= ROOT ?>/results">
        View Results →
    </a>

</div>


</section>

</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>