<?php

$schools = $data['schools'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

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

    <title>Schools - My School</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schools.view.css?v=5"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php

require "../private/views/includes/sidebar.view.php";

?>


<main class="dashboard">


    <!-- =====================================================
         PAGE HEADER
    ===================================================== -->

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


    <!-- =====================================================
         SCHOOL TABLE
    ===================================================== -->

    <section class="schools-card">


        <!-- =================================================
             SCHOOL HEADER
        ================================================== -->

        <div class="schools-header">

            <div>

                <h2>
                    All Schools
                </h2>

                <p>

                    <?= count($schools) ?>

                    school(s) found

                    <?php if ($search !== ''): ?>

                        for

                        <strong>
                            "<?= htmlspecialchars($search) ?>"
                        </strong>

                    <?php endif; ?>

                </p>

            </div>


            <a
                href="<?= ROOT ?>/schools/add"
                class="add-school-btn"
            >
                + Add School
            </a>

        </div>


        <!-- =================================================
             SEARCH + SORT
        ================================================== -->

        <div class="schools-toolbar">


            <!-- SEARCH -->

            <form
                method="GET"
                action="<?= ROOT ?>/schools"
                class="school-search-form"
            >

                <div class="school-search-box">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        placeholder="Search school by name..."
                        value="<?= htmlspecialchars($search) ?>"
                    >

                </div>


                <!-- KEEP SORT WHEN SEARCHING -->

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
                        href="<?= ROOT ?>/schools"
                        class="clear-search-btn"
                    >
                        Clear
                    </a>

                <?php endif; ?>

            </form>


            <!-- SORT -->

            <form
                method="GET"
                action="<?= ROOT ?>/schools"
                class="school-sort-form"
            >


                <!-- KEEP SEARCH WHEN SORTING -->

                <input
                    type="hidden"
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                >


                <label for="school-sort">
                    Sort by
                </label>


                <select
                    name="sort"
                    id="school-sort"
                    onchange="this.form.submit()"
                >

                    <option
                        value="id"
                        <?= $sort === 'id' ? 'selected' : '' ?>
                    >
                        ID
                    </option>

                    <option
                        value="school_name"
                        <?= $sort === 'school_name' ? 'selected' : '' ?>
                    >
                        School Name
                    </option>

                    <option
                        value="school_id"
                        <?= $sort === 'school_id' ? 'selected' : '' ?>
                    >
                        School ID
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

                <label for="school-status">
                    Status
                </label>

                <select
                    name="status"
                    id="school-status"
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


        <!-- =================================================
             SCHOOL LIST
        ================================================== -->

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
                                        <?= htmlspecialchars($school->student_count ?? 0) ?>
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
    <div class="school-actions">

        <a href="<?= ROOT ?>/schools/details/<?= urlencode($school->school_id) ?>"
           class="view-btn">
            View
        </a>

        <a href="<?= ROOT ?>/schools/edit/<?= urlencode($school->school_id) ?>"
           class="edit-btn">
            Edit
        </a>

       <?php if ($school->status === 'active'): ?>

    <form method="POST"
          action="<?= ROOT ?>/schools/delete/<?= urlencode($school->school_id) ?>"
          onsubmit="return confirm('Are you sure you want to deactivate this school?');">

        <?= CSRF::field() ?>

        <button type="submit" class="delete-btn">
            Deactivate
        </button>

    </form>

<?php else: ?>

    <form method="POST"
          action="<?= ROOT ?>/schools/activate/<?= urlencode($school->school_id) ?>"
          onsubmit="return confirm('Are you sure you want to activate this school?');">

        <?= CSRF::field() ?>

        <button type="submit" class="activate-btn">
            Activate
        </button>

    </form>

<?php endif; ?>

    </div>
</td>


                            </tr>


                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="empty-state">

                <h3>
                    No schools found
                </h3>

                <p>

                    <?php if ($search !== ''): ?>

                        No school matches
                        "<?= htmlspecialchars($search) ?>".

                    <?php else: ?>

                        There are currently no schools
                        registered in the system.

                    <?php endif; ?>

                </p>


                <?php if ($search !== ''): ?>

                    <a
                        href="<?= ROOT ?>/schools"
                        class="clear-search-btn"
                    >
                        View All Schools
                    </a>

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