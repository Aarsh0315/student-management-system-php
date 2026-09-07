<?php

$staff = $data['staff'] ?? [];
$schools = $data['schools'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'staff_id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

$status = $data['status'] ?? '';

$school_id = $data['school_id'] ?? '';

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
        Staff - My School
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
        href="<?= ROOT ?>/css/staff.view.css?v=3"
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
                Staff
            </h1>

            <p class="welcome-text">
                Manage all staff members registered in the system.
            </p>

        </div>

    </section>


    <!-- =========================
         STAFF TABLE
    ========================== -->

    <section class="staff-card">


        <!-- =========================
             HEADER
        ========================== -->

        <div class="staff-header">

            <div>

                <h2>
                    All Staff
                </h2>

                <p>

                    <?= count($staff) ?>

                    staff member(s) found

                    <?php if ($search !== ''): ?>

                        for

                        <strong>
                            "<?= htmlspecialchars($search) ?>"
                        </strong>

                    <?php endif; ?>

                </p>

            </div>


            <a
                href="<?= ROOT ?>/staff/add"
                class="add-staff-btn"
            >
                + Add Staff
            </a>

        </div>


        <!-- =================================================
             SEARCH + FILTER + SORT
        ================================================== -->

        <div class="staff-toolbar">


            <!-- =========================
                 SEARCH
            ========================== -->

            <form
                method="GET"
                action="<?= ROOT ?>/staff"
                class="staff-search-form"
            >

                <div class="staff-search-box">

                 <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        placeholder="Search staff by name, ID or email..."
                        value="<?= htmlspecialchars($search) ?>"
                    >

                </div>


                <!-- KEEP CURRENT SORT -->

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

                <input
                    type="hidden"
                    name="school_id"
                    value="<?= htmlspecialchars($school_id) ?>"
                >


                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>


                <?php if (
                    $search !== '' ||
                    $status !== '' ||
                    $school_id !== '' ||
                    $sort !== 'staff_id' ||
                    $direction !== 'DESC'
                ): ?>

                    <a
                        href="<?= ROOT ?>/staff"
                        class="clear-search-btn"
                    >
                        Clear
                    </a>

                <?php endif; ?>


            </form>


            <!-- =========================
                 SORT + FILTER
            ========================== -->

            <form
                method="GET"
                action="<?= ROOT ?>/staff"
                class="staff-sort-form"
            >


                <!-- KEEP SEARCH -->

                <input
                    type="hidden"
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                >


                <!-- SORT -->

                <label for="staff-sort">
                    Sort by
                </label>


                <select
                    name="sort"
                    id="staff-sort"
                    onchange="this.form.submit()"
                >

                    <option
                        value="staff_id"
                        <?= $sort === 'staff_id' ? 'selected' : '' ?>
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
                        value="role"
                        <?= $sort === 'role' ? 'selected' : '' ?>
                    >
                        Role
                    </option>


                    <option
                        value="department"
                        <?= $sort === 'department' ? 'selected' : '' ?>
                    >
                        Department
                    </option>


                    <option
                        value="school"
                        <?= $sort === 'school' ? 'selected' : '' ?>
                    >
                        School
                    </option>


                    <option
                        value="email"
                        <?= $sort === 'email' ? 'selected' : '' ?>
                    >
                        Email
                    </option>


                    <option
                        value="qualification"
                        <?= $sort === 'qualification' ? 'selected' : '' ?>
                    >
                        Qualification
                    </option>


                    <option
                        value="joining_date"
                        <?= $sort === 'joining_date' ? 'selected' : '' ?>
                    >
                        Joining Date
                    </option>


                    <option
                        value="employment_type"
                        <?= $sort === 'employment_type' ? 'selected' : '' ?>
                    >
                        Employment Type
                    </option>


                    <option
                        value="status"
                        <?= $sort === 'status' ? 'selected' : '' ?>
                    >
                        Status
                    </option>

                </select>


                <!-- =========================
                     DIRECTION
                ========================== -->

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


                <!-- =========================
                     STATUS
                ========================== -->

                <label for="staff-status">
                    Status
                </label>


                <select
                    name="status"
                    id="staff-status"
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


                <!-- =========================
                     SCHOOL
                ========================== -->

                <?php if (!empty($schools)): ?>

                    <label for="staff-school">
                        School
                    </label>


                    <select
                        name="school_id"
                        id="staff-school"
                        onchange="this.form.submit()"
                    >

                        <option
                            value=""
                            <?= $school_id === '' ? 'selected' : '' ?>
                        >
                            All Schools
                        </option>


                        <?php foreach ($schools as $school): ?>

                            <option
                                value="<?= htmlspecialchars($school->id) ?>"
                                <?= (string)$school_id === (string)$school->id ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars(
                                    $school->school_name
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                <?php endif; ?>


            </form>


        </div>


        <!-- =========================
             TABLE
        ========================== -->

        <?php if (!empty($staff)): ?>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Staff ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Qualification
                            </th>

                            <th>
                                Joining Date
                            </th>

                            <th>
                                Employment Type
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


                    <?php foreach ($staff as $member): ?>


                        <tr>


                            <!-- STAFF ID -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->staff_id ?? '-'
                                ) ?>

                            </td>


                            <!-- NAME -->

                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        ($member->firstname ?? '')
                                        . ' '
                                        . ($member->lastname ?? '')
                                    ) ?>

                                </strong>

                            </td>


                            <!-- ROLE -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->designation ?? '-'
                                ) ?>

                            </td>


                            <!-- DEPARTMENT -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->department ?? '-'
                                ) ?>

                            </td>


                            <!-- SCHOOL -->

                            <td>

                                <?php if (
                                    !empty($member->school_name)
                                ): ?>

                                    <?= htmlspecialchars(
                                        $member->school_name
                                    ) ?>

                                <?php else: ?>

                                    <span class="no-school">
                                        No School
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- EMAIL -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->email ?? '-'
                                ) ?>

                            </td>


                            <!-- QUALIFICATION -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->qualification ?? '-'
                                ) ?>

                            </td>


                            <!-- JOINING DATE -->

                            <td>

                                <?= !empty($member->joining_date)
                                    ? htmlspecialchars($member->joining_date)
                                    : '-'
                                ?>

                            </td>


                            <!-- EMPLOYMENT TYPE -->

                            <td>

                                <?= htmlspecialchars(
                                    $member->employment_type ?? '-'
                                ) ?>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <?php if (
                                    ($member->status ?? '')
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

                                <div class="table-actions">


                                    <!-- VIEW -->

                                    <a
                                        href="<?= ROOT ?>/staff/details/<?= urlencode($member->staff_id) ?>"
                                        class="view-btn"
                                    >
                                        View
                                    </a>


                                    <!-- EDIT -->

                                    <a
                                        href="<?= ROOT ?>/staff/edit/<?= urlencode($member->staff_id) ?>"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>


                                </div>

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
                    No staff found
                </h3>


                <p>


                    <?php if ($search !== ''): ?>

                        No staff member matches

                        <strong>
                            "<?= htmlspecialchars($search) ?>"
                        </strong>.


                    <?php elseif ($status !== ''): ?>

                        No
                        <?= htmlspecialchars($status) ?>
                        staff members found.


                    <?php elseif ($school_id !== ''): ?>

                        No staff members found in the selected school.


                    <?php else: ?>

                        There are currently no staff members
                        registered in the system.

                    <?php endif; ?>


                </p>


                <?php if (
                    $search !== '' ||
                    $status !== '' ||
                    $school_id !== ''
                ): ?>

                    <a
                        href="<?= ROOT ?>/staff"
                        class="clear-search-btn"
                    >
                        View All Staff
                    </a>

                <?php endif; ?>


            </div>


        <?php endif; ?>


    </section>


</main>


<!-- =========================
     FOOTER
========================= -->

<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>