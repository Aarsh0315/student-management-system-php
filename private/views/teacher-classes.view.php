<?php

$classes = $data['classes'] ?? [];

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
        Classes - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- TEACHER CLASSES CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-classes.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- TEACHER NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=2"
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
                Classes
            </h1>

            <p class="welcome-text">
                View classes and divisions
                assigned to you.
            </p>

        </div>

    </section>



    <!-- =========================
         CLASSES CARD
    ========================== -->

    <section class="classes-card">


        <!-- HEADER -->

        <div class="classes-header">

            <div>

                <h2>
                    My Classes
                </h2>

                <p>

                    <?= count($classes) ?>

                    class(es) assigned

                </p>

            </div>

        </div>



        <?php if (!empty($classes)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Class ID
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Students
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
                            $classes as $class
                        ): ?>


                            <tr>


                                <!-- CLASS ID -->

                                <td>

                                    <span class="class-id">

                                        <?= htmlspecialchars(
                                            $class->class_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- CLASS -->

                                <td>

                                    <strong class="class-name">

                                        <?= htmlspecialchars(
                                            $class->class
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <span class="class-division">

                                        <?= htmlspecialchars(
                                            $class->division
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STUDENTS -->

                                <td>

                                    <span class="student-count">

                                        <?= htmlspecialchars(
                                            $class->student_count
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($class->status ?? '')
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
                                        href="<?= ROOT ?>/teacherclasses/details/<?= urlencode($class->class_id ?? '') ?>"
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
                    No Classes Found
                </h3>

                <p>
                    There are currently no classes
                    assigned to you.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>