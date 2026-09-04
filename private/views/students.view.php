<?php

$students = $data['students'] ?? [];
$schools = $data['schools'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'student_id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

$gender = $data['gender'] ?? '';

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
        Students - My School
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
        href="<?= ROOT ?>/css/students.view.css?v=2"
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
                Students
            </h1>

            <p class="welcome-text">
                Manage all students registered in the system.
            </p>

        </div>

    </section>


    <!-- =========================
         STUDENTS TABLE
    ========================== -->

    <section class="students-card">


        <!-- =========================
             HEADER
        ========================== -->

        <div class="students-header">

            <div>

                <h2>
                    All Students
                </h2>

                <p>

                    <?= count($students) ?>

                    student(s) found

                    <?php if ($search !== ''): ?>

                        for

                        <strong>
                            "<?= htmlspecialchars($search) ?>"
                        </strong>

                    <?php endif; ?>

                </p>

            </div>


            <a
                href="<?= ROOT ?>/students/add"
                class="add-student-btn"
            >
                + Add Student
            </a>

        </div>


        <!-- =================================================
             SEARCH + FILTER + SORT
        ================================================== -->

        <div class="students-toolbar">


            <!-- =========================
                 SEARCH
            ========================== -->

            <form
                method="GET"
                action="<?= ROOT ?>/students"
                class="student-search-form"
            >

                <div class="student-search-box">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        placeholder="Search student by name, ID or email..."
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
                    name="gender"
                    value="<?= htmlspecialchars($gender) ?>"
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
                    $gender !== '' ||
                    $status !== '' ||
                    $school_id !== '' ||
                    $sort !== 'student_id' ||
                    $direction !== 'DESC'
                ): ?>

                    <a
                        href="<?= ROOT ?>/students"
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
                action="<?= ROOT ?>/students"
                class="student-sort-form"
            >


                <!-- KEEP SEARCH -->

                <input
                    type="hidden"
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                >


                <!-- SORT -->

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
                        ID
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
                        value="school"
                        <?= $sort === 'school' ? 'selected' : '' ?>
                    >
                        School
                    </option>


                    <option
                        value="parent"
                        <?= $sort === 'parent' ? 'selected' : '' ?>
                    >
                        Parent
                    </option>


                    <option
                        value="email"
                        <?= $sort === 'email' ? 'selected' : '' ?>
                    >
                        Email
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
                     GENDER
                ========================== -->

                <label for="student-gender">
                    Gender
                </label>


                <select
                    name="gender"
                    id="student-gender"
                    onchange="this.form.submit()"
                >

                    <option
                        value=""
                        <?= $gender === '' ? 'selected' : '' ?>
                    >
                        All Gender
                    </option>


                    <option
                        value="Male"
                        <?= $gender === 'Male' ? 'selected' : '' ?>
                    >
                        Male
                    </option>


                    <option
                        value="Female"
                        <?= $gender === 'Female' ? 'selected' : '' ?>
                    >
                        Female
                    </option>


                    <option
                        value="Other"
                        <?= $gender === 'Other' ? 'selected' : '' ?>
                    >
                        Other
                    </option>

                </select>


                <!-- =========================
                     STATUS
                ========================== -->

                <label for="student-status">
                    Status
                </label>


                <select
                    name="status"
                    id="student-status"
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

                <label for="student-school">
                    School
                </label>


                <select
                    name="school_id"
                    id="student-school"
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


            </form>


        </div>


        <!-- =========================
             TABLE
        ========================== -->

        <?php if (!empty($students)): ?>


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
                                School
                            </th>

                            <th>
                                Parent
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


                    <?php foreach ($students as $student): ?>


                        <tr>


                            <!-- =========================
                                 STUDENT ID
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->student_id ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 NAME
                            ========================== -->

                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        ($student->firstname ?? '')
                                        . ' '
                                        . ($student->lastname ?? '')
                                    ) ?>

                                </strong>

                            </td>


                            <!-- =========================
                                 CLASS
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->class ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 DIVISION
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->division ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 SCHOOL
                            ========================== -->

                            <td>

                                <?php if (
                                    !empty($student->school_name)
                                ): ?>

                                    <?= htmlspecialchars(
                                        $student->school_name
                                    ) ?>

                                <?php else: ?>

                                    <span class="no-school">
                                        No School
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- =========================
                                 PARENT
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->parent_name ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 EMAIL
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->email ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 GENDER
                            ========================== -->

                            <td>

                                <?= htmlspecialchars(
                                    $student->gender ?? '-'
                                ) ?>

                            </td>


                            <!-- =========================
                                 STATUS
                            ========================== -->

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


                            <!-- =========================
                                 ACTION
                            ========================== -->

                            <td>

                                <div class="table-actions">


                                    <!-- VIEW -->

                                    <a
                                        href="<?= ROOT ?>/students/details/<?= urlencode($student->student_id) ?>"
                                        class="view-btn"
                                    >
                                        View
                                    </a>


                                    <!-- EDIT -->

                                    <a
                                        href="<?= ROOT ?>/students/edit/<?= urlencode($student->student_id) ?>"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>


                                    <!-- DEACTIVATE / ACTIVATE -->

                                    <?php if (
                                        ($student->status ?? '')
                                        === 'active'
                                    ): ?>


                                        <form
                                            method="POST"
                                            action="<?= ROOT ?>/students/deactivate/<?= urlencode($student->student_id) ?>"
                                            onsubmit="return confirm('Are you sure you want to deactivate this student?');"
                                        >

                                            <?= CSRF::field() ?>


                                            <button
                                                type="submit"
                                                class="delete-btn"
                                            >
                                                Deactivate
                                            </button>

                                        </form>


                                    <?php else: ?>


                                        <form
                                            method="POST"
                                            action="<?= ROOT ?>/students/activate/<?= urlencode($student->student_id) ?>"
                                        >

                                            <?= CSRF::field() ?>


                                            <button
                                                type="submit"
                                                class="activate-btn"
                                            >
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


            <!-- =========================
                 EMPTY STATE
            ========================== -->

            <div class="empty-state">

                <h3>
                    No students found
                </h3>


                <p>


                    <?php if ($search !== ''): ?>

                        No student matches

                        <strong>
                            "<?= htmlspecialchars($search) ?>"
                        </strong>.


                    <?php elseif ($gender !== ''): ?>

                        No
                        <?= htmlspecialchars($gender) ?>
                        students found.


                    <?php elseif ($status !== ''): ?>

                        No
                        <?= htmlspecialchars($status) ?>
                        students found.


                    <?php elseif ($school_id !== ''): ?>

                        No students found in the selected school.


                    <?php else: ?>

                        There are currently no students
                        registered in the system.

                    <?php endif; ?>


                </p>


                <?php if (
                    $search !== '' ||
                    $gender !== '' ||
                    $status !== '' ||
                    $school_id !== ''
                ): ?>

                    <a
                        href="<?= ROOT ?>/students"
                        class="clear-search-btn"
                    >
                        View All Students
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