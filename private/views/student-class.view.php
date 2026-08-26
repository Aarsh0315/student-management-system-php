<?php

$student =
    $data['student'] ?? null;

$classmates =
    $data['classmates'] ?? [];

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
        My Class - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- STUDENT CLASS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-class.view.css?v=1"
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
                My Class
            </h1>

            <p class="welcome-text">
                View your class information and classmates.
            </p>

        </div>

    </section>



    <!-- ========================================
         CLASS CARD
    ======================================== -->

    <section class="student-class-card">


        <div>

            <h2>

                Class
                <?= htmlspecialchars(
                    $student->class ?? '-'
                ) ?>

                -

                <?= htmlspecialchars(
                    $student->division ?? '-'
                ) ?>

            </h2>


            <p>

                <?= count($classmates) ?>

                student(s) in your class.

            </p>

        </div>


        <span class="status active">
            Active
        </span>


    </section>



    <!-- ========================================
         MY INFORMATION
    ======================================== -->

    <section class="student-class-card">


        <div class="class-section-header">

            <h2>
                My Information
            </h2>

            <p>
                Your information in this class.
            </p>

        </div>


        <div class="class-details-grid">


            <div class="class-detail-item">

                <span>
                    Student ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $student->student_id ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="class-detail-item">

                <span>
                    Roll Number
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $student->roll_number ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="class-detail-item">

                <span>
                    Class
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $student->class ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="class-detail-item">

                <span>
                    Division
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $student->division ?? '-'
                    ) ?>
                </strong>

            </div>


        </div>


    </section>



    <!-- ========================================
         CLASSMATES
    ======================================== -->

    <section class="student-class-card">


        <div class="class-section-header">

            <h2>
                Classmates
            </h2>

            <p>
                Students in your class and division.
            </p>

        </div>


        <?php if (!empty($classmates)): ?>


            <div class="classmates-table-wrapper">

                <table class="classmates-table">

                    <thead>

                        <tr>

                            <th>
                                Roll No.
                            </th>

                            <th>
                                Student Name
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach (
                            $classmates as $classmate
                        ): ?>

                            <tr>

                                <td>

                                    <span class="roll-number">

                                        <?= htmlspecialchars(
                                            $classmate->roll_number
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $classmate->firstname
                                            ?? ''
                                        ) ?>

                                        <?= htmlspecialchars(
                                            $classmate->lastname
                                            ?? ''
                                        ) ?>

                                    </strong>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="empty-state">

                <h3>
                    No Classmates Found
                </h3>

                <p>
                    There are currently no students
                    in your class.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>