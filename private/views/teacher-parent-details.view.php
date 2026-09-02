<?php

$students = $data['students'] ?? [];

$parent_name =
    $data['parent_name'] ?? '-';

$firstStudent =
    $students[0] ?? null;

$parent_phone =
    $firstStudent->parent_phone ?? '-';

$parent_email =
    $firstStudent->parent_email ?? '-';

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
        Parent Details - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- PARENT DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-parent-details.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Parent Details
            </h1>

            <p class="welcome-text">
                View parent information and
                associated students.
            </p>

        </div>

    </section>



    <!-- ========================================
         PARENT PROFILE CARD
    ======================================== -->

    <section class="parent-profile-card">


        <div class="parent-profile-left">


            <!-- AVATAR -->

            <div class="parent-large-avatar">

                <?= strtoupper(
                    substr(
                        $parent_name,
                        0,
                        1
                    )
                ) ?>

            </div>



            <!-- DETAILS -->

            <div class="parent-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        $parent_name
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $parent_phone
                    ) ?>

                </p>


                <span class="parent-role-badge">

                    Parent / Guardian

                </span>

            </div>


        </div>


    </section>



    <!-- ========================================
         CONTACT DETAILS
    ======================================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Contact Information
            </h2>

            <p>
                Parent contact details.
            </p>

        </div>


        <div class="details-grid">


            <!-- PARENT NAME -->

            <div class="details-item">

                <span>
                    Parent Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent_name
                    ) ?>

                </strong>

            </div>



            <!-- PHONE -->

            <div class="details-item">

                <span>
                    Phone
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent_phone
                    ) ?>

                </strong>

            </div>



            <!-- EMAIL -->

            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent_email
                    ) ?>

                </strong>

            </div>


        </div>


    </section>



    <!-- ========================================
         ASSOCIATED STUDENTS
    ======================================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Associated Students
            </h2>

            <p>

                <?= count($students) ?>

                student(s) associated with this parent.

            </p>

        </div>



        <?php if (!empty($students)): ?>


            <div class="details-grid">


                <?php foreach (
                    $students as $student
                ): ?>


                    <!-- STUDENT -->

                    <div class="details-item">

                        <span>
                            Student
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                ($student->firstname ?? '')
                                . ' '
                                . ($student->lastname ?? '')
                            ) ?>

                        </strong>

                    </div>



                    <!-- STUDENT ID -->

                    <div class="details-item">

                        <span>
                            Student ID
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $student->student_id
                                ?? '-'
                            ) ?>

                        </strong>

                    </div>



                    <!-- CLASS -->

                    <div class="details-item">

                        <span>
                            Class
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $student->class
                                ?? '-'
                            ) ?>

                        </strong>

                    </div>



                    <!-- DIVISION -->

                    <div class="details-item">

                        <span>
                            Division
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $student->division
                                ?? '-'
                            ) ?>

                        </strong>

                    </div>



                    <!-- ROLL NUMBER -->

                    <div class="details-item">

                        <span>
                            Roll Number
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $student->roll_number
                                ?? '-'
                            ) ?>

                        </strong>

                    </div>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="empty-state">

                <h3>
                    No Students Found
                </h3>

                <p>
                    No students are associated
                    with this parent.
                </p>

            </div>


        <?php endif; ?>


    </section>



    <!-- ========================================
         ACTIONS
    ======================================== -->

    <div class="parent-actions">

        <a
            href="<?= ROOT ?>/teacherparents"
            class="back-btn"
        >
            ← Back to Parents
        </a>

    </div>


</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>