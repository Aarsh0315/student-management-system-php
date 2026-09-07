<?php

$parents = $data['parents'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'parent_id';

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

            <!-- SEARCH & SORT TOOLBAR -->
<div class="parents-toolbar">

    <!-- SEARCH -->
    <form
        method="GET"
        action="<?= ROOT ?>/teacherparents"
        class="parent-search-form"
    >

        <div class="parent-search-box">

            <span class="search-icon">⌕</span>

            <input
                type="text"
                name="search"
                placeholder="Search parents..."
                value="<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            >

        </div>

        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>

        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/teacherparents"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>


    <!-- SORT -->
    <form
        method="GET"
        action="<?= ROOT ?>/teacherparents"
        class="parent-sort-form"
    >

        <?php if ($search !== ''): ?>

            <input
                type="hidden"
                name="search"
                value="<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            >

        <?php endif; ?>


        <label for="parent-sort">
            Sort By
        </label>

        <select
            id="parent-sort"
            name="sort"
            onchange="this.form.submit()"
        >

            <option
                value="parent_id"
                <?= $sort === 'parent_id' ? 'selected' : '' ?>
            >
                Parent ID
            </option>

            <option
                value="parent_name"
                <?= $sort === 'parent_name' ? 'selected' : '' ?>
            >
                Parent Name
            </option>

            <option
                value="student_name"
                <?= $sort === 'student_name' ? 'selected' : '' ?>
            >
                Student Name
            </option>

            <option
                value="email"
                <?= $sort === 'email' ? 'selected' : '' ?>
            >
                Email
            </option>

            <option
                value="phone"
                <?= $sort === 'phone' ? 'selected' : '' ?>
            >
                Phone
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

    </form>

</div>


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

<div class="empty-state">

    <?php if ($search !== ''): ?>

        <h3>No Parents Found</h3>

        <p>
            No parents match
            <strong>
                "<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            </strong>.
        </p>

        <a
            href="<?= ROOT ?>/teacherparents"
            class="empty-action-btn"
        >
            View All Parents
        </a>

    <?php else: ?>

        <h3>No Parents Found</h3>

        <p>
            There are currently no parents available.
        </p>

    <?php endif; ?>

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