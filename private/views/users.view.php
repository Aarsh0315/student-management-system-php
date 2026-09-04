<?php

$users = $data['users'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

$role = $data['role'] ?? '';

$status = $data['status'] ?? '';

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

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/sidebar.view.css"
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

            user(s) found

            <?php if ($search !== ''): ?>

                for

                <strong>
                    "<?= htmlspecialchars($search) ?>"
                </strong>

            <?php endif; ?>

        </p>

    </div>


    <a
        href="<?= ROOT ?>/users/add"
        class="add-user-btn"
    >
        + Add User
    </a>

</div>


        <?php if (!empty($users)): ?>
          <!-- =================================================
     SEARCH + SORT
================================================== -->

<div class="users-toolbar">


    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/users"
        class="user-search-form"
    >

        <div class="user-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search user by name or email..."
                value="<?= htmlspecialchars($search) ?>"
            >

        </div>


        <!-- KEEP SORT -->

        <input
            type="hidden"
            name="sort"
            value="<?= htmlspecialchars($sort) ?>"
        >

        <input
            type="hidden"
            name="direction"
            value="<?= htmlspecialchars($direction) ?>"
        >

        <input
            type="hidden"
            name="role"
            value="<?= htmlspecialchars($role) ?>"
        >

        <input
            type="hidden"
            name="status"
            value="<?= htmlspecialchars($status) ?>"
        >


        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>


        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/users"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>


    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/users"
        class="user-sort-form"
    >

        <!-- KEEP SEARCH -->

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >

        <input
            type="hidden"
            name="role"
            value="<?= htmlspecialchars($role) ?>"
        >

        <input
            type="hidden"
            name="status"
            value="<?= htmlspecialchars($status) ?>"
        >


        <label for="user-sort">
            Sort by
        </label>


        <select
            name="sort"
            id="user-sort"
            onchange="this.form.submit()"
        >

            <option
                value="id"
                <?= $sort === 'id' ? 'selected' : '' ?>
            >
                ID
            </option>

            <option
                value="name"
                <?= $sort === 'name' ? 'selected' : '' ?>
            >
                Name
            </option>

            <option
                value="email"
                <?= $sort === 'email' ? 'selected' : '' ?>
            >
                Email
            </option>

            <option
                value="school"
                <?= $sort === 'school' ? 'selected' : '' ?>
            >
                School
            </option>

            <option
                value="role"
                <?= $sort === 'role' ? 'selected' : '' ?>
            >
                Role
            </option>

            <option
                value="gender"
                <?= $sort === 'gender' ? 'selected' : '' ?>
            >
                Gender
            </option>

            <option
                value="status"
                <?= $sort === 'status' ? 'selected' : '' ?>
            >
                Status
            </option>

        </select>


        <select
            name="direction"
            onchange="this.form.submit()"
        >

            <option
                value="ASC"
                <?= $direction === 'ASC' ? 'selected' : '' ?>
            >
                Ascending
            </option>

            <option
                value="DESC"
                <?= $direction === 'DESC' ? 'selected' : '' ?>
            >
                Descending
            </option>

        </select>


        <label for="user-role">
            Role
        </label>

        <select
            name="role"
            id="user-role"
            onchange="this.form.submit()"
        >

            <option
                value=""
                <?= $role === '' ? 'selected' : '' ?>
            >
                All Roles
            </option>

            <option
                value="super_admin"
                <?= $role === 'super_admin' ? 'selected' : '' ?>
            >
                Super Admin
            </option>

            <option
                value="admin"
                <?= $role === 'admin' ? 'selected' : '' ?>
            >
                School Admin
            </option>

            <option
                value="principal"
                <?= $role === 'principal' ? 'selected' : '' ?>
            >
                Principal
            </option>

            <option
                value="vice_principal"
                <?= $role === 'vice_principal' ? 'selected' : '' ?>
            >
                Vice Principal
            </option>

            <option
                value="teacher"
                <?= $role === 'teacher' ? 'selected' : '' ?>
            >
                Teacher
            </option>

            <option
                value="student"
                <?= $role === 'student' ? 'selected' : '' ?>
            >
                Student
            </option>

            <option
                value="parent"
                <?= $role === 'parent' ? 'selected' : '' ?>
            >
                Parent
            </option>

            <option
                value="staff"
                <?= $role === 'staff' ? 'selected' : '' ?>
            >
                Staff
            </option>

        </select>


        <label for="user-status">
            Status
        </label>

        <select
            name="status"
            id="user-status"
            onchange="this.form.submit()"
        >

            <option
                value=""
                <?= $status === '' ? 'selected' : '' ?>
            >
                All Status
            </option>

            <option
                value="active"
                <?= $status === 'active' ? 'selected' : '' ?>
            >
                Active
            </option>

            <option
                value="inactive"
                <?= $status === 'inactive' ? 'selected' : '' ?>
            >
                Inactive
            </option>

        </select>

    </form>

</div>


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

            <!-- =================================================
     EMPTY STATE
================================================== -->

<div class="empty-state">

    <h3>
        No users found
    </h3>

    <p>

        <?php if ($search !== ''): ?>

            No user matches
            <strong>
                "<?= htmlspecialchars($search) ?>"
            </strong>.

        <?php elseif ($role !== ''): ?>

            No users found for the selected role.

        <?php elseif ($status !== ''): ?>

            No <?= htmlspecialchars($status) ?> users found.

        <?php else: ?>

            There are currently no users
            registered in the system.

        <?php endif; ?>

    </p>


    <?php if (
        $search !== '' ||
        $role !== '' ||
        $status !== ''
    ): ?>

        <a
            href="<?= ROOT ?>/users"
            class="clear-search-btn"
        >
            View All Users
        </a>

    <?php endif; ?>

</div>


        <?php endif; ?>


    </section>


</main>


<!-- =========================
     FOOTER
========================== -->

<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
</body>

</html>