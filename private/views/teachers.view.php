<?php

$teachers = $data['teachers'] ?? [];

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
        Teachers - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- HOME / COMMON -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=3"
    >


    <!-- TEACHERS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teachers.view.css?v=1"
    >


    <!-- FOOTER -->

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
                Teachers
            </h1>


            <p class="welcome-text">
                Manage teachers and staff
                members in your school.
            </p>

        </div>

    </section>



    <!-- ========================================
         TEACHERS CARD
    ======================================== -->

    <section class="teachers-card">


        <!-- ========================================
             HEADER
        ======================================== -->

        <div class="teachers-header">

            <div>

                <h2>
                    All Teachers
                </h2>

                <p>

                    <?= count($teachers) ?>

                    teacher(s) registered

                </p>

            </div>


            <!-- ADD TEACHER -->

            <a
                href="<?= ROOT ?>/teachers/add"
                class="add-teacher-btn"
            >
                + Add Teacher
            </a>

        </div>



        <?php if (!empty($teachers)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Teacher ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Designation
                            </th>

                            <th>
                                Phone
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
                            $teachers as $teacher
                        ): ?>


                            <tr>


                                <!-- TEACHER ID -->

                                <td>

                                    <span class="teacher-id">

                                        <?= htmlspecialchars(
                                            $teacher->staff_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- NAME -->

                                <td>

                                    <strong class="teacher-name">

                                        <?= htmlspecialchars(
                                            ($teacher->firstname ?? '')
                                            . ' '
                                            . ($teacher->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->email
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- DEPARTMENT -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->department
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- DESIGNATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->designation
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->phone
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($teacher->status ?? '')
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
                                        href="<?= ROOT ?>/teachers/details/<?= urlencode(
                                            $teacher->staff_id ?? ''
                                        ) ?>"
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
                    No teachers found
                </h3>

                <p>
                    There are currently no teachers
                    registered in your school.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>