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
        href="<?= ROOT ?>/css/teacher-classes.view.css?v=2"
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
                Classes
            </h1>

            <p class="welcome-text">
                View classes and divisions
                assigned to you.
            </p>

        </div>

    </section>



    <!-- ========================================
         CLASSES CARD
    ======================================== -->

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


            <!-- ========================================
                 TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

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

                                    <span class="status active">
                                        Active
                                    </span>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/teacherclasses/details/<?= urlencode($class->class ?? '') ?>/<?= urlencode($class->division ?? '') ?>"
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