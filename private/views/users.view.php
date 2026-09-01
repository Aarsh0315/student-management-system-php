<?php

$users = $data['users'] ?? [];

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
        Users - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/home.view.css"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/users.view.css?v=2"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css"
>

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php

require "../private/views/includes/sidebar.view.php";

?>

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
                Users
            </h1>

            <p class="welcome-text">
                Manage all users registered in the system.
            </p>

        </div>

    </section>


    <!-- =========================
         USERS TABLE
    ========================== -->

    <section class="users-card">


        <!-- HEADER -->

        <div class="users-header">

            <div>

                <h2>
                    All Users
                </h2>

                <p>

                    <?= count($users) ?>

                    user(s) registered

                </p>

            </div>


            <!-- ADD USER -->

            <a
                href="<?= ROOT ?>/users/add"
                class="add-user-btn"
            >
                + Add User
            </a>

        </div>


        <?php if (!empty($users)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                Rank
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


                        <?php foreach ($users as $user): ?>


                            <tr>


                                <!-- =========================
                                     USER ID
                                ========================== -->

                                <td>

                                    <?= htmlspecialchars(
                                        $user->user_id ?? '-'
                                    ) ?>

                                </td>


                                <!-- =========================
                                     NAME
                                ========================== -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            ($user->firstname ?? '')
                                            . ' '
                                            . ($user->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- =========================
                                     EMAIL
                                ========================== -->

                                <td>

                                    <?= htmlspecialchars(
                                        $user->email ?? '-'
                                    ) ?>

                                </td>


                                <!-- =========================
                                     SCHOOL
                                ========================== -->

                                <td>

                                    <?php if (
                                        !empty(
                                            $user->school_name
                                        )
                                    ): ?>

                                        <?= htmlspecialchars(
                                            $user->school_name
                                        ) ?>

                                    <?php else: ?>

                                        <span class="no-school">

                                            No School

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- =========================
                                     RANK
                                ========================== -->

                                <td>

                                    <span class="rank-badge">

                                        <?php

                                        $rankNames = [

                                            'super_admin'
                                                => 'Super Admin',

                                            'admin'
                                                => 'School Admin',

                                            'principal'
                                                => 'Principal',

                                            'vice_principal'
                                                => 'Vice Principal',

                                            'teacher'
                                                => 'Teacher',

                                            'student'
                                                => 'Student',

                                            'parent'
                                                => 'Parent',

                                            'staff'
                                                => 'Staff'

                                        ];

                                        echo htmlspecialchars(

                                            $rankNames[
                                                $user->rank
                                                ?? ''
                                            ]

                                            ?? ucfirst(
                                                $user->rank
                                                ?? ''
                                            )

                                        );

                                        ?>

                                    </span>

                                </td>


                                <!-- =========================
                                     GENDER
                                ========================== -->

                                <td>

                                    <?= htmlspecialchars(
                                        $user->gender ?? '-'
                                    ) ?>

                                </td>


                                <!-- =========================
                                     STATUS
                                ========================== -->

                                <td>

                                    <?php if (
                                        ($user->status ?? '')
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


                                <!-- =========================
                                     ACTION
                                ========================== -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/users/details/<?= urlencode($user->user_id) ?>"
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
                    No users found
                </h3>

                <p>
                    There are currently no users
                    registered in the system.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<!-- =========================
     FOOTER
========================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>