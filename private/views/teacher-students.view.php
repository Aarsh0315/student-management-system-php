<?php

$students = $data['students'] ?? [];

$search =
    $data['search'] ?? '';

$sort =
    $data['sort'] ?? 'student_id';

$direction =
    strtoupper(
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
        Students - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-students.view.css?v=2"
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

<?php require "../private/views/includes/sidebar.view.php"; ?>


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
                Students
            </h1>

            <p class="welcome-text">
                View and manage students assigned to your school.
            </p>

        </div>

    </section>


    <!-- =========================
         STUDENTS CARD
    ========================== -->

    <section class="students-card">


        <!-- HEADER -->

        <div class="students-header">

            <div>

                <h2>
                    All Students
                </h2>

                <p>

                    <?= count($students) ?>

                    student(s) registered

                </p>

            </div>


            <!-- ADD STUDENT -->

            <a
                href="<?= ROOT ?>/teacherstudents/add"
                class="add-student-btn"
            >
                + Add Student
            </a>

        </div>


        <?php if (!empty($students)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

            <!-- =========================
     SEARCH + SORT
========================== -->

<div class="students-toolbar">


    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/teacherstudents"
        class="student-search-form"
    >

        <div class="student-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search students..."
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
                href="<?= ROOT ?>/teacherstudents"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>



    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/teacherstudents"
        class="student-sort-form"
    >

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >


        <label for="student-sort">
            Sort by
        </label>


        <select
            name="sort"
            id="student-sort"
            onchange="this.form.submit()"
        >

            <option
                value="student_id"
                <?= $sort === 'student_id' ? 'selected' : '' ?>
            >
                Student ID
            </option>

            <option
                value="name"
                <?= $sort === 'name' ? 'selected' : '' ?>
            >
                Name
            </option>

            <option
                value="class"
                <?= $sort === 'class' ? 'selected' : '' ?>
            >
                Class
            </option>

            <option
                value="division"
                <?= $sort === 'division' ? 'selected' : '' ?>
            >
                Division
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
                                Student ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Parent
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
                            $students as $student
                        ): ?>


                            <tr>


                                <!-- STUDENT ID -->

                                <td>

                                    <span class="student-id">

                                        <?= htmlspecialchars(
                                            $student->student_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- NAME -->

                                <td>

                                    <strong class="student-name">

                                        <?= htmlspecialchars(
                                            ($student->firstname ?? '')
                                            . ' '
                                            . ($student->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- CLASS -->

                                <td>

                                    <span class="student-class">

                                        <?= htmlspecialchars(
                                            $student->class
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DIVISION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->division
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- PARENT -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->parent_name
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $student->email
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($student->status ?? '')
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
                                        href="<?= ROOT ?>/teacherstudents/details/<?= urlencode($student->student_id) ?>"
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

            <p>
                No students match
                <strong>"<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"</strong>.
            </p>

            <a
                href="<?= ROOT ?>/teacherstudents"
                class="empty-action-btn"
            >
                View All Students
            </a>

        <?php else: ?>

            <p>
                There are currently no students registered in your school.
            </p>

            <a
                href="<?= ROOT ?>/teacherstudents/add"
                class="empty-action-btn"
            >
                Add Student
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