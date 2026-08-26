<?php

$teacher = $data['teacher'] ?? null;


if (!$teacher) {

    die("Teacher not found.");

}


/*
========================================
FULL NAME
========================================
*/

$fullName =
    ($teacher->firstname ?? '')
    . ' '
    . ($teacher->lastname ?? '');


/*
========================================
INITIAL
========================================
*/

$initial = strtoupper(

    substr(

        $teacher->firstname ?? 'T',

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
        Teacher Details - My School
    </title>


    <!-- ========================================
         HOME CSS
    ======================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=3"
    >


    <!-- ========================================
         NAVBAR CSS
    ======================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- ========================================
         TEACHER DETAILS CSS
    ======================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-details.view.css?v=1"
    >


    <!-- ========================================
         FOOTER CSS
    ======================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                School Admin
            </p>


            <h1>
                Teacher Details
            </h1>


            <p class="welcome-text">
                View complete information about this teacher.
            </p>

        </div>

    </section>



    <!-- ========================================
         TEACHER PROFILE CARD
    ======================================== -->

    <section class="teacher-profile-card">


        <div class="teacher-profile-left">


            <!-- ========================================
                 TEACHER AVATAR
            ======================================== -->

            <div class="teacher-large-avatar">

                <?= htmlspecialchars(
                    $initial
                ) ?>

            </div>



            <!-- ========================================
                 TEACHER PROFILE INFO
            ======================================== -->

            <div class="teacher-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        trim($fullName)
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $teacher->email
                        ?? '-'
                    ) ?>

                </p>


                <span class="teacher-designation-badge">

                    <?= htmlspecialchars(
                        $teacher->designation
                        ?? 'Teacher'
                    ) ?>

                </span>

            </div>


        </div>



        <!-- ========================================
             STATUS
        ======================================== -->

        <?php if (
            ($teacher->status ?? 'active')
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



    <!-- ========================================
         PERSONAL INFORMATION
    ======================================== -->

    <section class="teacher-details-card">


        <div class="details-header">

            <h2>
                Personal Information
            </h2>


            <p>
                Basic personal and contact information about the teacher.
            </p>

        </div>



        <div class="details-grid">


            <!-- TEACHER ID -->

            <div class="details-item">

                <span>
                    Teacher ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->staff_id
                        ?? '-'
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
                        $teacher->user_id
                        ?? '-'
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
                        $teacher->firstname
                        ?? '-'
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
                        $teacher->lastname
                        ?? '-'
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
                        $teacher->email
                        ?? '-'
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
                        $teacher->gender
                        ?? '-'
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
                        $teacher->phone
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

                            $teacher->status
                            ?? 'active'

                        )

                    ) ?>

                </strong>

            </div>


        </div>


    </section>



    <!-- ========================================
         PROFESSIONAL INFORMATION
    ======================================== -->

    <section class="teacher-details-card">


        <div class="details-header">

            <h2>
                Professional Information
            </h2>


            <p>
                Employment and professional information about the teacher.
            </p>

        </div>



        <div class="details-grid">


            <!-- DEPARTMENT -->

            <div class="details-item">

                <span>
                    Department
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->department
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- DESIGNATION -->

            <div class="details-item">

                <span>
                    Designation
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->designation
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- QUALIFICATION -->

            <div class="details-item">

                <span>
                    Qualification
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->qualification
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- JOINING DATE -->

            <div class="details-item">

                <span>
                    Joining Date
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->joining_date
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- EMPLOYMENT TYPE -->

            <div class="details-item">

                <span>
                    Employment Type
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->employment_type
                        ?? '-'
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
                        $teacher->school_id
                        ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- RANK -->

            <div class="details-item">

                <span>
                    Rank
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $teacher->rank
                        ?? 'staff'
                    ) ?>

                </strong>

            </div>


        </div>


    </section>



    <!-- ========================================
         ADDRESS
    ======================================== -->

    <section class="teacher-details-card">


        <div class="details-header">

            <h2>
                Address
            </h2>


            <p>
                Residential address of the teacher.
            </p>

        </div>


        <div class="address-box">

            <?= nl2br(
                htmlspecialchars(
                    $teacher->address
                    ?? '-'
                )
            ) ?>

        </div>


    </section>



    <!-- ========================================
         ACTIONS
    ======================================== -->

    <div class="teacher-actions">

        <a
            href="<?= ROOT ?>/teachers"
            class="back-btn"
        >

            ← Back to Teachers

        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>