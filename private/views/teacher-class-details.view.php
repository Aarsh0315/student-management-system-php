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
        - <?= htmlspecialchars($division) ?>
    </title>


    <!-- TEACHER NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=4"
    >


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- CLASS DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-class-details.view.css?v=1"
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

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Class <?= htmlspecialchars($class) ?>
            </h1>

            <p class="welcome-text">
                Division <?= htmlspecialchars($division) ?>
                ·
                <?= count($students) ?> student(s)
            </p>

        </div>

    </section>



    <!-- ========================================
         STUDENTS CARD
    ======================================== -->

    <section class="class-students-card">


        <!-- HEADER -->

        <div class="class-students-header">

            <div>

                <h2>
                    Students
                </h2>

                <p>
                    Students enrolled in
                    Class <?= htmlspecialchars($class) ?>
                    -
                    <?= htmlspecialchars($division) ?>.
                </p>

            </div>

        </div>



        <?php if (!empty($students)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

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
                                            $student->firstname
                                            ?? ''
                                        ) ?>

                                        <?= htmlspecialchars(
                                            $student->lastname
                                            ?? ''
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ROLL NUMBER -->

                                <td>

                                    <span class="roll-number">

                                        <?= htmlspecialchars(
                                            $student->roll_number
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->email
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
                                        href="<?= ROOT ?>/teacherstudents/details/<?= urlencode($student->student_id ?? '') ?>"
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
                    in this class and division.
                </p>

            </div>


        <?php endif; ?>


    </section>



    <!-- ========================================
         BACK BUTTON
    ======================================== -->

    <div class="class-actions">

        <a
            href="<?= ROOT ?>/teacherclasses"
            class="back-btn"
        >
            ← Back to Classes
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>