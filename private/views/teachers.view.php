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


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- TEACHERS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teachers.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
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



    <!-- =========================
         TEACHERS TABLE
    ========================== -->

    <section class="teachers-card">


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


            <div class="table-wrapper">

                <table class="teachers-table">

                    <thead>

                        <tr>

                            <th>
                                Staff ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Designation
                            </th>

                            <th>
                                Qualification
                            </th>

                            <th>
                                Employment
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


                                <!-- STAFF ID -->

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



                                <!-- QUALIFICATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->qualification
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- EMPLOYMENT TYPE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $teacher->employment_type
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
                                        href="<?= ROOT ?>/teachers/details/<?= urlencode($teacher->staff_id) ?>"
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


            <!-- EMPTY STATE -->

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