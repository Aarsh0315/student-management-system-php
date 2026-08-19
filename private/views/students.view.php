<?php

$students = $data['students'] ?? [];

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
        Students - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/home.view.css"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/students.view.css?v=2"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css"
>

<link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    > 

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Students
            </h1>

            <p class="welcome-text">
                Manage all students across
                the schools.
            </p>

        </div>

    </section>


    <!-- =========================
         STUDENTS CARD
    ========================== -->

    <section class="students-card">


        <!-- HEADER -->

        <div class="students-header">

            <div>

                <h2>
                    All Students
                </h2>

                <p>

                    <?= count($students) ?>

                    student(s) registered

                </p>

            </div>


            <!-- ADD STUDENT -->

            <a
                href="<?= ROOT ?>/students/add"
                class="add-student-btn"
            >
                + Add Student
            </a>

        </div>


        <?php if (!empty($students)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

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
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                Parent
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
                                            ($student->firstname ?? '')
                                            . ' '
                                            . ($student->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- CLASS -->

                                <td>

                                    <span class="student-class">

                                        <?= htmlspecialchars(
                                            $student->class
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DIVISION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->division
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- SCHOOL -->

                                <td>

                                    <?php if (
                                        !empty(
                                            $student->school_name
                                        )
                                    ): ?>

                                        <span class="student-school">

                                            <?= htmlspecialchars(
                                                $student->school_name
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="no-school">
                                            No School
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- PARENT -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->parent_name
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


            <!-- =========================
                 EMPTY STATE
            ========================== -->

            <div class="empty-state">

                <h3>
                    No students found
                </h3>

                <p>
                    There are currently no students
                    registered in the system.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>