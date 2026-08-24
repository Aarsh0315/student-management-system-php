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


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parents.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                School Admin
            </p>

            <h1>
                Parents
            </h1>

            <p class="welcome-text">
                Manage parents associated
                with your students.
            </p>

        </div>

    </section>


    <!-- PARENTS CARD -->

    <section class="parents-card">


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


            <a
                href="<?= ROOT ?>/parents/add"
                class="add-parent-btn"
            >
                + Add Parent
            </a>

        </div>


        <?php if (!empty($parents)): ?>


            <div class="table-wrapper">

                <table class="parents-table">

                    <thead>

                        <tr>

                            <th>
                                Parent ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Gender
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
                                            $parent->user_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- NAME -->

                                <td>

                                    <strong class="parent-name">

                                        <?= htmlspecialchars(
                                            ($parent->firstname ?? '')
                                            . ' '
                                            . ($parent->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->email
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- GENDER -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->gender
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
                                        href="<?= ROOT ?>/parents/details/<?= urlencode($parent->user_id) ?>"
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


            <div class="empty-state">

                <h3>
                    No parents found
                </h3>

                <p>
                    There are currently no parents
                    registered in your school.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>