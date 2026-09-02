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


    <!-- SHARED NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- SHARED SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- STUDENT CLASS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-class.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- ========================================
     SHARED NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SHARED SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="student-class-page">

    <div class="student-class-container">


        <!-- ========================================
             PAGE HEADER
        ======================================== -->

        <section class="class-welcome">

            <div class="class-welcome-content">

                <p class="class-welcome-label">
                    STUDENT ACADEMICS
                </p>

                <h1>
                    My Class
                </h1>

                <p class="class-welcome-description">
                    View your class information and classmates.
                </p>

            </div>


            <div class="class-status">

                <span class="status-dot"></span>

                <span>
                    Active
                </span>

            </div>

        </section>



        <!-- ========================================
             CLASS OVERVIEW
        ======================================== -->

        <section class="class-overview-card">

            <div class="class-overview-left">

                <div class="class-icon">
                    CL
                </div>


                <div class="class-overview-info">

                    <span class="class-label">
                        CURRENT CLASS
                    </span>

                    <h2>

                        Class
                        <?= htmlspecialchars(
                            $student->class ?? '-'
                        ) ?>

                        <?php if (!empty($student->division)): ?>

                            <span class="class-divider">
                                -
                            </span>

                            <?= htmlspecialchars(
                                $student->division
                            ) ?>

                        <?php endif; ?>

                    </h2>

                    <p>

                        <?= count($classmates) ?>

                        student(s) in your class and division.

                    </p>

                </div>

            </div>


            <span class="active-badge">
                <span class="badge-dot"></span>
                Active
            </span>

        </section>



        <!-- ========================================
             MY INFORMATION
        ======================================== -->

        <section class="class-card">

            <div class="class-section-header">

                <div>

                    <h2>
                        My Information
                    </h2>

                    <p>
                        Your information in this class.
                    </p>

                </div>

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

        <section class="class-card">

            <div class="class-section-header">

                <div>

                    <h2>
                        Classmates
                    </h2>

                    <p>
                        Students in your class and division.
                    </p>

                </div>


                <span class="student-count">

                    <?= count($classmates) ?>

                    Students

                </span>

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

                                        <div class="student-name-cell">

                                            <div class="student-avatar">

                                                <?= strtoupper(
                                                    substr(
                                                        $classmate->firstname ?? 'S',
                                                        0,
                                                        1
                                                    )
                                                ) ?>

                                            </div>


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

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <div class="empty-state">

                    <div class="empty-icon">
                        CL
                    </div>

                    <h3>
                        No Classmates Found
                    </h3>

                    <p>
                        There are currently no other students
                        in your class.
                    </p>

                </div>


            <?php endif; ?>


        </section>


    </div>

</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     SHARED JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>