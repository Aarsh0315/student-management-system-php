<?php

$student = $data['student'] ?? null;

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
        Student Details
    </title>


    <!-- NAVBAR -->

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/teacher-nav.view.css?v=2"
>


    <!-- STUDENT DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-student-details.view.css?v=1"
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
         PAGE HEADER
    ======================================== -->

    <section class="page-header">

        <div>

            <p class="page-small">
                Teacher
            </p>

            <h1>
                Student Details
            </h1>

            <p class="page-description">
                View complete student information.
            </p>

        </div>


        <a
            href="<?= ROOT ?>/teacherstudents"
            class="back-btn"
        >
            ← Back to Students
        </a>

    </section>



    <!-- ========================================
         STUDENT PROFILE CARD
    ======================================== -->

    <section class="student-profile-card">


        <!-- ========================================
             PROFILE TOP
        ======================================== -->

        <div class="student-profile-top">


            <!-- PROFILE IMAGE -->
            
            <div class="student-profile-image">

                <?php if (
                    !empty($student->profile_image)
                ): ?>

                    <img
                        src="<?= ROOT ?>/uploads/users/<?= htmlspecialchars(
                            $student->profile_image
                        ) ?>"
                        alt="Student"
                    >

                <?php else: ?>

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

                <?php endif; ?>

            </div>



            <!-- STUDENT NAME -->

            <div class="student-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        $student->firstname
                        ?? ''
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


                <span class="student-status">

                    <?= htmlspecialchars(
                        ucfirst(
                            $student->status
                            ?? 'Unknown'
                        )
                    ) ?>

                </span>

            </div>

        </div>



        <!-- ========================================
             BASIC INFORMATION
        ======================================== -->

        <div class="details-section">

            <h3>
                Student Information
            </h3>


            <div class="details-grid">


                <div class="detail-item">

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



                <div class="detail-item">

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



                <div class="detail-item">

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



                <div class="detail-item">

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



                <div class="detail-item">

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



                <div class="detail-item">

                    <span>
                        Gender
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $student->gender
                            ?? '-'
                        ) ?>

                    </strong>

                </div>



                <div class="detail-item">

                    <span>
                        Date of Birth
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $student->date_of_birth
                            ?? '-'
                        ) ?>

                    </strong>

                </div>



                <div class="detail-item">

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


            </div>

        </div>



        <!-- ========================================
             PARENT INFORMATION
        ======================================== -->

        <div class="details-section">

            <h3>
                Parent Information
            </h3>


            <div class="details-grid">


                <div class="detail-item">

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



                <div class="detail-item">

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



                <div class="detail-item">

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

        </div>



        <!-- ========================================
             CONTACT INFORMATION
        ======================================== -->

        <div class="details-section">

            <h3>
                Contact Information
            </h3>


            <div class="details-grid">


                <div class="detail-item detail-full">

                    <span>
                        Address
                    </span>

                    <strong>

                        <?= htmlspecialchars(
                            $student->address
                            ?? '-'
                        ) ?>

                    </strong>

                </div>


            </div>

        </div>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>