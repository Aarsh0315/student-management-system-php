<?php

$admins = $data['admins'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

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
            Super Admin
        </p>

        <h1>
            School Admin
        </h1>

        <p class="welcome-text">
            Manage and monitor administrators assigned
            to schools across the system.
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

            <!-- ========================================
     SEARCH + SORT
======================================== -->

<div class="admins-toolbar">


    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/schooladmins"
        class="admin-search-form"
    >

        <div class="admin-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search admin by name, email, school..."
                value="<?= htmlspecialchars($search) ?>"
            >

        </div>

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

        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>

        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/schooladmins"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>


    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/schooladmins"
        class="admin-sort-form"
    >

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >

        <label for="admin-sort">
            Sort by
        </label>

        <select
            name="sort"
            id="admin-sort"
            onchange="this.form.submit()"
        >

            <option value="id" <?= $sort === 'id' ? 'selected' : '' ?>>
                Admin ID
            </option>

            <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>
                Name
            </option>

            <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>
                Email
            </option>

            <option value="school" <?= $sort === 'school' ? 'selected' : '' ?>>
                School
            </option>

            <option value="status" <?= $sort === 'status' ? 'selected' : '' ?>>
                Status
            </option>

        </select>


        <select
            name="direction"
            onchange="this.form.submit()"
        >

            <option value="ASC" <?= $direction === 'ASC' ? 'selected' : '' ?>>
                Ascending
            </option>

            <option value="DESC" <?= $direction === 'DESC' ? 'selected' : '' ?>>
                Descending
            </option>

        </select>

    </form>

</div>


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

                                    <a
            href="<?= ROOT ?>/schooladmins/edit/<?= urlencode($admin->user_id) ?>"
            class="edit-btn"
        >
            Edit
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
        No School Admins Found
    </h3>

    <?php if ($search !== ''): ?>

        <p>
            No school admin matches
            <strong>
                "<?= htmlspecialchars($search) ?>"
            </strong>.
        </p>

        <a
            href="<?= ROOT ?>/schooladmins"
            class="view-all-admins-btn"
        >
            View All School Admins
        </a>

    <?php else: ?>

        <p>
            There are currently no school
            administrators registered.
        </p>

    <?php endif; ?>

</div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>   

</body>

</html>