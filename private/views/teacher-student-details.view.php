<?php

$student = $data['student'] ?? null;

if (!$student) {
    die("Student not found.");
}


/* =========================
   FULL NAME
========================= */

$fullName =
    ($student->firstname ?? '')
    . ' '
    . ($student->lastname ?? '');


/* =========================
   INITIAL
========================= */

$initial = strtoupper(
    substr(
        $student->firstname ?? 'S',
        0,
        1
    )
);

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
        Student Details - My School
    </title>


    <!-- TEACHER NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=4"
    >


    <!-- STUDENT DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-student-details.view.css?v=2"
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


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Student Details
            </h1>

            <p class="welcome-text">
                View complete information about this student.
            </p>

        </div>

    </section>



    <!-- =========================
         STUDENT PROFILE
    ========================== -->

    <section class="student-profile-card">


        <div class="student-profile-left">


            <!-- =========================
                 AVATAR
            ========================== -->

            <div class="student-large-avatar">

                <?php if (
                    !empty($student->profile_image)
                ): ?>

                    <img
                        src="<?= ROOT ?>/uploads/users/<?= htmlspecialchars(
                            $student->profile_image
                        ) ?>"
                        alt="<?= htmlspecialchars($fullName) ?>"
                    >

                <?php else: ?>

                    <?= htmlspecialchars($initial) ?>

                <?php endif; ?>

            </div>



            <!-- =========================
                 BASIC DETAILS
            ========================== -->

            <div class="student-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        trim($fullName)
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $student->email ?? '-'
                    ) ?>

                </p>


                <span class="student-class-badge">

                    Class

                    <?= htmlspecialchars(
                        $student->class ?? '-'
                    ) ?>

                    -

                    <?= htmlspecialchars(
                        $student->division ?? '-'
                    ) ?>

                </span>

            </div>

        </div>



        <!-- =========================
             STATUS
        ========================== -->

        <?php if (
            ($student->status ?? 'active')
            === 'active'
        ): ?>

            <span class="status active">
                Active
            </span>

        <?php else: ?>

            <span class="status inactive">
                Inactive
            </span>

        <?php endif; ?>


    </section>



    <!-- =========================
         PERSONAL INFORMATION
    ========================== -->

    <section class="student-details-card">

        <div class="details-header">

            <h2>
                Personal Information
            </h2>

            <p>
                Basic information about the student.
            </p>

        </div>


        <div class="details-grid">


            <!-- STUDENT ID -->

            <div class="details-item">

                <span>
                    Student ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->student_id ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- USER ID -->

            <div class="details-item">

                <span>
                    User ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->user_id ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- FIRST NAME -->

            <div class="details-item">

                <span>
                    First Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->firstname ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- LAST NAME -->

            <div class="details-item">

                <span>
                    Last Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->lastname ?? '-'
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
                        $student->email ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- GENDER -->

            <div class="details-item">

                <span>
                    Gender
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->gender ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- DATE OF BIRTH -->

            <div class="details-item">

                <span>
                    Date of Birth
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->date_of_birth ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         ACADEMIC INFORMATION
    ========================== -->

    <section class="student-details-card">

        <div class="details-header">

            <h2>
                Academic Information
            </h2>

            <p>
                Student's school and academic information.
            </p>

        </div>


        <div class="details-grid">


            <!-- ADMISSION NUMBER -->

            <div class="details-item">

                <span>
                    Admission Number
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->admission_number
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



            <!-- CLASS -->

            <div class="details-item">

                <span>
                    Class
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->class ?? '-'
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
                        $student->division ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- ADMISSION DATE -->

            <div class="details-item">

                <span>
                    Admission Date
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->admission_date
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- STATUS -->

            <div class="details-item">

                <span>
                    Status
                </span>

                <strong>

                    <?= htmlspecialchars(
                        ucfirst(
                            $student->status
                            ?? 'active'
                        )
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         SCHOOL INFORMATION
    ========================== -->

    <section class="student-details-card">

        <div class="details-header">

            <h2>
                School Information
            </h2>

            <p>
                School assigned to this student.
            </p>

        </div>


        <div class="details-grid">


            <!-- SCHOOL -->

            <div class="details-item">

                <span>
                    School
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->school_name
                        ?? 'No School'
                    ) ?>

                </strong>

            </div>



            <!-- SCHOOL ID -->

            <div class="details-item">

                <span>
                    School ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->school_code
                        ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         PARENT INFORMATION
    ========================== -->

    <section class="student-details-card">

        <div class="details-header">

            <h2>
                Parent / Guardian Information
            </h2>

            <p>
                Parent or guardian contact information.
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
                        $student->parent_name
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- PARENT PHONE -->

            <div class="details-item">

                <span>
                    Parent Phone
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->parent_phone
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- PARENT EMAIL -->

            <div class="details-item">

                <span>
                    Parent Email
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $student->parent_email
                        ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         ADDRESS
    ========================== -->

    <section class="student-details-card">

        <div class="details-header">

            <h2>
                Address
            </h2>

        </div>


        <div class="address-box">

            <?= nl2br(
                htmlspecialchars(
                    $student->address
                    ?? 'No address provided.'
                )
            ) ?>

        </div>

    </section>



    <!-- =========================
         BACK BUTTON
    ========================== -->

    <div class="student-actions">

        <a
            href="<?= ROOT ?>/teacherstudents"
            class="back-btn"
        >
            ← Back to Students
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>