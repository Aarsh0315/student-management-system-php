<?php

$parents = $data['parents'] ?? [];

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
        Parents - My School
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


    <!-- TEACHER PARENTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-parents.view.css?v=2"
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
    ========================================= -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Parents
            </h1>

            <p class="welcome-text">
                View parents and guardians
                associated with your students.
            </p>

        </div>

    </section>



    <!-- ========================================
         PARENTS CARD
    ======================================== -->

    <section class="parents-card">


        <!-- ========================================
             HEADER
        ========================================= -->

        <div class="parents-header">

            <div>

                <h2>
                    My Students' Parents
                </h2>

                <p>

                    <?= count($parents) ?>

                    parent(s) registered

                </p>

            </div>

        </div>



        <!-- ========================================
             PARENTS TABLE
        ======================================== -->

        <?php if (!empty($parents)): ?>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Parent Name
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Students
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach (
                            $parents as $parent
                        ): ?>


                            <tr>


                                <!-- PARENT NAME -->

                                <td>

                                    <strong class="parent-name">

                                        <?= htmlspecialchars(
                                            $parent->parent_name
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->parent_phone
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->parent_email
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- STUDENTS -->

                                <td>

                                    <span class="student-count">

                                        <?= htmlspecialchars(
                                            $parent->student_count
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/teacherparents/details/<?= urlencode($parent->parent_name ?? '') ?>"
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
            ========================================= -->

            <div class="empty-state">

                <h3>
                    No Parents Found
                </h3>

                <p>
                    There are currently no parents
                    associated with your students.
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