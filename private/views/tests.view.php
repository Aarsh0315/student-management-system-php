<?php

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
        Tests - My School
    </title>


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- TESTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/tests.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
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


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

           <p class="welcome-small">
                <?= htmlspecialchars($roleName) ?>
            </p>

            <h1>
                Tests
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
         TESTS CARD
    ======================================== -->

    <section class="tests-card">


        <!-- ========================================
             CARD HEADER
        ======================================== -->

        <div class="tests-header">

            <div>

                <h2>
                    <?= $rank === 'super_admin'
                        ? 'All Tests'
                        : 'School Tests'
                    ?>
                </h2>

                <p>

                    <?= count($tests) ?>

                    test(s) registered

                </p>

            </div>

        </div>



        <?php if (!empty($tests)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <!-- =================================================
     SEARCH + SORT
================================================= -->

<div class="tests-toolbar">

    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/tests"
        class="test-search-form"
    >

        <div class="test-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search test by ID, name, class, division..."
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
                href="<?= ROOT ?>/tests"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>



    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/tests"
        class="test-sort-form"
    >

        <!-- KEEP SEARCH -->

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >


        <label for="test-sort">
            Sort by
        </label>


        <select
            name="sort"
            id="test-sort"
            onchange="this.form.submit()"
        >

            <option
                value="id"
                <?= $sort === 'id' ? 'selected' : '' ?>
            >
                Test ID
            </option>

            <option
                value="name"
                <?= $sort === 'name' ? 'selected' : '' ?>
            >
                Test Name
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
                value="marks"
                <?= $sort === 'marks' ? 'selected' : '' ?>
            >
                Total Marks
            </option>

            <option
                value="duration"
                <?= $sort === 'duration' ? 'selected' : '' ?>
            >
                Duration
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
                                Test ID
                            </th>

                            <th>
                                Test
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Total Marks
                            </th>

                            <th>
                                Duration
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
                            $tests as $test
                        ): ?>


                            <tr>


                                <!-- TEST ID -->

                                <td>

                                    <span class="test-id">

                                        <?= htmlspecialchars(
                                            $test->test_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- TEST -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- CLASS -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->class
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->division
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- TOTAL MARKS -->

                                <td>

                                    <span class="marks">

                                        <?= htmlspecialchars(
                                            $test->total_marks
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- DURATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->duration
                                        ?? '-'
                                    ) ?>

                                    min

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($test->status ?? '')
                                        === 'active'
                                    ): ?>

                                        <span
                                            class="status active"
                                        >
                                            Active
                                        </span>

                                    <?php elseif (
                                        ($test->status ?? '')
                                        === 'draft'
                                    ): ?>

                                        <span
                                            class="status draft"
                                        >
                                            Draft
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status inactive"
                                        >
                                            <?= htmlspecialchars(
                                                ucfirst(
                                                    $test->status
                                                    ?? 'Unknown'
                                                )
                                            ) ?>
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/tests/details/<?= urlencode(
                                            $test->test_id
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
                    No Tests Found
                </h3>

                <p>
                    There are currently no tests
                    registered in the system.
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