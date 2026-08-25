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


    <!-- TEACHER PARENTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-parents.view.css?v=1"
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
                Parents
            </h1>

            <p class="welcome-text">
                View parents and guardians
                associated with your students.
            </p>

        </div>

    </section>



    <!-- =========================
         PARENTS CARD
    ========================== -->

    <section class="parents-card">


        <!-- HEADER -->

        <div class="parents-header">

            <div>

                <h2>
                    All Parents
                </h2>

                <p>

                    <?= count($parents) ?>

                    parent(s) registered

                </p>

            </div>

        </div>



        <?php if (!empty($parents)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Parent ID
                            </th>

                            <th>
                                Parent Name
                            </th>

                            <th>
                                Student
                            </th>

                            <th>
                                Relationship
                            </th>

                            <th>
                                Phone
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
                            $parents as $parent
                        ): ?>


                            <tr>


                                <!-- PARENT ID -->

                                <td>

                                    <span class="parent-id">

                                        <?= htmlspecialchars(
                                            $parent->parent_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- PARENT NAME -->

                                <td>

                                    <strong class="parent-name">

                                        <?= htmlspecialchars(
                                            ($parent->firstname ?? '')
                                            . ' '
                                            . ($parent->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- STUDENT -->

                                <td>

                                    <span class="parent-student">

                                        <?= htmlspecialchars(
                                            $parent->student_name
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- RELATIONSHIP -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->relationship
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->phone
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->email
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($parent->status ?? '')
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
                                        href="<?= ROOT ?>/teacherparents/details/<?= urlencode($parent->parent_id ?? '') ?>"
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


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>