<?php

$students = $data['students'] ?? [];

$class =
    $data['class'] ?? '-';

$division =
    $data['division'] ?? '-';

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
        Class <?= htmlspecialchars($class) ?>
        - My School
    </title>


    <!-- HOME CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=3"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- CLASS DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/class-details.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

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

                Class
                <?= htmlspecialchars($class) ?>

            </h1>


            <p class="welcome-text">

                Division
                <?= htmlspecialchars($division) ?>

                ·

                <?= count($students) ?>

                student(s)

            </p>

        </div>

    </section>



    <!-- ========================================
         CLASS PROFILE CARD
    ======================================== -->

    <section class="class-profile-card">


        <div class="class-profile-left">


            <!-- CLASS AVATAR -->

            <div class="class-large-avatar">

                <?= htmlspecialchars($class) ?>

            </div>


            <!-- CLASS INFO -->

            <div class="class-profile-info">


                <h2>

                    Class
                    <?= htmlspecialchars($class) ?>

                </h2>


                <p>

                    Division
                    <?= htmlspecialchars($division) ?>

                </p>


                <span class="class-division-badge">

                    Division
                    <?= htmlspecialchars($division) ?>

                </span>


            </div>


        </div>


        <!-- STATUS -->

        <span class="status active">

            Active

        </span>


    </section>



    <!-- ========================================
         STUDENTS CARD
    ======================================== -->

    <section class="class-details-card">


        <!-- HEADER -->

        <div class="details-header">

            <h2>
                Students in this Class
            </h2>


            <p>

                <?= count($students) ?>

                student(s) registered in

                Class
                <?= htmlspecialchars($class) ?>

                -

                Division
                <?= htmlspecialchars($division) ?>

            </p>

        </div>



        <?php if (!empty($students)): ?>


            <!-- ========================================
                 STUDENTS TABLE
            ======================================== -->

            <div class="class-students-table-wrapper">

                <table class="class-students-table">


                    <thead>

                        <tr>

                            <th>
                                Student ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Roll Number
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Parent
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach (
                            $students as $student
                        ): ?>


                            <tr>


                                <!-- STUDENT ID -->

                                <td>

                                    <span class="student-id">

                                        <?= htmlspecialchars(
                                            $student->student_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- NAME -->

                                <td>

                                    <strong class="student-name">

                                        <?= htmlspecialchars(
                                            ($student->firstname ?? '')
                                            . ' '
                                            . ($student->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- ROLL NUMBER -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->roll_number
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->email
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- PARENT -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->parent_name
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($student->status ?? '')
                                        === 'active'
                                    ): ?>

                                        <span
                                            class="status active"
                                        >
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status inactive"
                                        >
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/students/details/<?= urlencode($student->student_id) ?>"
                                        class="view-btn"
                                    >
                                        View
                                    </a>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>


                </table>

            </div>


        <?php else: ?>


            <!-- ========================================
                 EMPTY STATE
            ======================================== -->

            <div class="empty-state">

                <h3>
                    No Students Found
                </h3>


                <p>

                    There are currently no students
                    in this class.

                </p>

            </div>


        <?php endif; ?>


    </section>



    <!-- ========================================
         BACK BUTTON
    ======================================== -->

    <div class="class-actions">

        <a
            href="<?= ROOT ?>/classes"
            class="back-btn"
        >
            ← Back to Classes
        </a>

    </div>


</main>



<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>