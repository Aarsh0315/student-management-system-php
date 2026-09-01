<?php

$admins = $data['admins'] ?? [];

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
        School Admins - My School
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
        href="<?= ROOT ?>/css/school-admins.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


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
                School Admins
            </h1>

            <p class="welcome-text">
                Manage administrators assigned
                to schools.
            </p>

        </div>

    </section>


    <!-- =========================
         ADMINS TABLE
    ========================== -->

    <section class="admins-card">


        <div class="admins-header">

            <div>

                <h2>
                    All School Admins
                </h2>

                <p>

                    <?= count($admins) ?>

                    school admin(s) registered

                </p>

            </div>


            <!-- ADD ADMIN -->

            <a
                href="<?= ROOT ?>/schooladmins/add"
                class="add-admin-btn"
            >
                + Add School Admin
            </a>

        </div>


        <?php if (!empty($admins)): ?>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Admin ID
                            </th>

                            <th>
                                Name
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
                            $admins as $admin
                        ): ?>


                            <tr>


                                <!-- ADMIN ID -->

                                <td>

                                    <span class="admin-id">

                                        <?= htmlspecialchars(
                                            $admin->user_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- NAME -->

                                <td>

                                    <strong class="admin-name">

                                        <?= htmlspecialchars(
                                            ($admin->firstname ?? '')
                                            . ' '
                                            . ($admin->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- SCHOOL -->

                                <td>

                                    <?php if (
                                        !empty(
                                            $admin->school_name
                                        )
                                    ): ?>

                                        <span class="admin-school">

                                            <?= htmlspecialchars(
                                                $admin->school_name
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="no-school">
                                            No School
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- SCHOOL ID -->

                                <td>

                                    <span class="school-code">

                                        <?= htmlspecialchars(
                                            $admin->school_code
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $admin->email
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- GENDER -->

                                <td>

                                    <?= htmlspecialchars(
                                        $admin->gender
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($admin->status ?? '')
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
                                        href="<?= ROOT ?>/schooladmins/details/<?= urlencode($admin->user_id) ?>"
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
                    No school admins found
                </h3>

                <p>
                    There are currently no school
                    administrators registered.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>   

</body>

</html>