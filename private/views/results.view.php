<?php

$results = $data['results'] ?? [];

$tests = $data['tests'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'id';

$direction = strtoupper(
    $data['direction'] ?? 'DESC'
);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rank = $_SESSION['rank'] ?? '';

if ($rank === 'super_admin') {

    $roleName = 'Super Admin';

} elseif ($rank === 'admin') {

    $roleName = 'School Admin';

} else {

    $roleName = 'User';

}

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
        Results - My School
    </title>


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- RESULTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/results.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

     <section class="welcome">

        <div>

           <p class="welcome-small">
                <?= htmlspecialchars($roleName) ?>
            </p>

            <h1>
                Results
            </h1>

            <?php if ($rank === 'super_admin'): ?>

                <p class="welcome-text">
                    View and manage tests across all schools.
                </p>

            <?php else: ?>

                <p class="welcome-text">
                    View tests created for your school.
                </p>

            <?php endif; ?>

        </div>

    </section>



    <!-- ========================================
         RESULTS CARD
    ======================================== -->

    <section class="results-card">


        <!-- ========================================
             CARD HEADER
        ======================================== -->

        <div class="results-header">

            <div>

                <h2>
                    All Results
                </h2>

                <p>

                    <?= count($results) ?>

                    result(s) registered

                </p>

            </div>

        </div>



        <?php if (!empty($results)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <!-- =================================================
     SEARCH + SORT
================================================= -->

<div class="results-toolbar">

    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/results"
        class="result-search-form"
    >

        <div class="result-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search result by ID, student, test, school..."
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


        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>


        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/results"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>



    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/results"
        class="result-sort-form"
    >

        <!-- KEEP SEARCH -->

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >


        <label for="result-sort">
            Sort by
        </label>


        <select
            name="sort"
            id="result-sort"
            onchange="this.form.submit()"
        >

            <option
                value="id"
                <?= $sort === 'id' ? 'selected' : '' ?>
            >
                Result ID
            </option>

            <option
                value="student"
                <?= $sort === 'student' ? 'selected' : '' ?>
            >
                Student
            </option>

            <option
                value="test"
                <?= $sort === 'test' ? 'selected' : '' ?>
            >
                Test
            </option>

            <option
                value="school"
                <?= $sort === 'school' ? 'selected' : '' ?>
            >
                School
            </option>

            <option
                value="total_marks"
                <?= $sort === 'total_marks' ? 'selected' : '' ?>
            >
                Total Marks
            </option>

            <option
                value="obtained_marks"
                <?= $sort === 'obtained_marks' ? 'selected' : '' ?>
            >
                Obtained Marks
            </option>

            <option
                value="percentage"
                <?= $sort === 'percentage' ? 'selected' : '' ?>
            >
                Percentage
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
                                Result ID
                            </th>

                            <th>
                                Student
                            </th>

                            <th>
                                Test
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                Total Marks
                            </th>

                            <th>
                                Obtained
                            </th>

                            <th>
                                Percentage
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
                            $results as $result
                        ): ?>


                            <tr>


                                <!-- ========================================
                                     RESULT ID
                                ======================================== -->

                                <td>

                                    <span class="result-id">

                                        <?= htmlspecialchars(
                                            $result->result_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     STUDENT
                                ======================================== -->

                                <td>

                                    <strong class="student-name">

                                        <?= htmlspecialchars(
                                            $result->student_firstname
                                            ?? ''
                                        ) ?>

                                        <?= htmlspecialchars(
                                            $result->student_lastname
                                            ?? ''
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     TEST
                                ======================================== -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $result->test_title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     SCHOOL
                                ======================================== -->

                                <td>

                                    <span class="school-name">

                                        <?= htmlspecialchars(
                                            $result->school_name
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     TOTAL MARKS
                                ======================================== -->

                                <td>

                                    <span class="marks">

                                        <?= htmlspecialchars(
                                            $result->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     OBTAINED MARKS
                                ======================================== -->

                                <td>

                                    <strong class="obtained-marks">

                                        <?= htmlspecialchars(
                                            $result->obtained_marks
                                            ?? '0'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     PERCENTAGE
                                ======================================== -->

                                <td>

                                    <span class="percentage">

                                        <?= htmlspecialchars(
                                            $result->percentage
                                            ?? '0'
                                        ) ?>%

                                    </span>

                                </td>



                                <!-- ========================================
                                     STATUS
                                ======================================== -->

                                <td>

                                    <?php if (
                                        ($result->status ?? '')
                                        === 'pass'
                                    ): ?>

                                        <span
                                            class="status pass"
                                        >
                                            Pass
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status fail"
                                        >
                                            Fail
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ========================================
                                     ACTION
                                ======================================== -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/results/details/<?= urlencode(
                                            $result->result_id
                                            ?? ''
                                        ) ?>"
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


        

    <!-- ========================================
         EMPTY STATE
    ======================================== -->

    <div class="empty-state">

        <h3>
            No Results Found
        </h3>

        <?php if ($search !== ''): ?>

            <p>
                No result matches
                <strong>
                    "<?= htmlspecialchars($search) ?>"
                </strong>.
            </p>

            <a
                href="<?= ROOT ?>/results"
                class="view-all-results-btn"
            >
                View All Results
            </a>

        <?php else: ?>

            <p>
                There are currently no student
                results registered in the system.
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