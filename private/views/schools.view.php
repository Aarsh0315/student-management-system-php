<?php

$schools = $data['schools'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Schools - My School</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/schools.view.css?v=4"
>

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css>v=2"
>

<link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 



</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Schools
            </h1>

            <p class="welcome-text">
                Manage all schools registered in the system.
            </p>

        </div>

    </section>


    <!-- SCHOOL TABLE -->

    <section class="schools-card">

        <div class="schools-header">

            <div>

                <h2>
                    All Schools
                </h2>

                <p>
                    <?= count($schools) ?>
                    school(s) registered
                </p>

            </div>


            <a
                href="<?= ROOT ?>/schools/add"
                class="add-school-btn"
            >
                + Add School
            </a>

        </div>


        <?php if (!empty($schools)): ?>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                School ID
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
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

                        <?php foreach ($schools as $school): ?>

                            <tr>


                                <!-- DATABASE ID -->

                                <td>
                                    <?= htmlspecialchars(
                                        $school->id
                                    ) ?>
                                </td>


                                <!-- SCHOOL NAME -->

                                <td>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $school->school_name
                                        ) ?>
                                    </strong>

                                </td>


                                <!-- SCHOOL ID -->

                                <td>

                                    <span class="school-code">

                                        <?= htmlspecialchars(
                                            $school->school_id
                                        ) ?>

                                    </span>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $school->email ?? '-'
                                    ) ?>

                                </td>


                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $school->phone ?? '-'
                                    ) ?>

                                </td>


                                <!-- STUDENT COUNT -->

                                <td>

                                    <span class="student-count">

                                        <?= htmlspecialchars(
                                            $school->student_count ?? 0
                                        ) ?>

                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        $school->status === 'active'
                                    ): ?>

                                        <span class="status active">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="status inactive">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>

                                    <div class="table-actions">

                                        <!-- VIEW SCHOOL -->

                                        <a
                                            href="<?= ROOT ?>/schools/details/<?= urlencode($school->school_id) ?>"
                                            class="view-btn"
                                        >
                                            View
                                        </a>


                                    </div>

                                </td>


                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="empty-state">

                <h3>
                    No schools found
                </h3>

                <p>
                    There are currently no schools
                    registered in the system.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>