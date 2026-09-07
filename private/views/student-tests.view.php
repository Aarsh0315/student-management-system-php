<?php

$tests = $data['tests'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'test_id';

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
        Tests - My School
    </title>


    <!-- SHARED NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- SHARED SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- STUDENT TESTS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-tests.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- ========================================
     SHARED NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SHARED SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="student-tests-page">

    <div class="student-tests-container">


        <!-- ========================================
             PAGE HEADER
        ======================================== -->

        <section class="tests-welcome">

            <div class="tests-welcome-content">

                <p class="tests-welcome-label">
                    STUDENT ACADEMICS
                </p>

                <h1>
                    Tests
                </h1>

                <p class="tests-welcome-description">
                    View and attempt tests assigned to your class.
                </p>

            </div>


            <div class="tests-status">

                <span class="status-dot"></span>

                <span>
                    Active
                </span>

            </div>

        </section>



        <!-- ========================================
             TESTS CARD
        ======================================== -->

        <section class="tests-card">


            <!-- ========================================
                 TESTS HEADER
            ======================================== -->

            <div class="tests-header">

                <div>

                    <h2>
                        Available Tests
                    </h2>

                    <p>
                        <?= count($tests) ?>
                        test(s) available for you.
                    </p>

                </div>


                <div class="tests-header-icon">
                    TS
                </div>

            </div>



            <?php if (!empty($tests)): ?>


                <!-- ========================================
                     TABLE
                ======================================== -->

                <!-- ========================================
     SEARCH & SORT TOOLBAR
======================================== -->

<div class="student-tests-toolbar">

    <!-- SEARCH -->
    <form
        method="GET"
        action="<?= ROOT ?>/studenttests"
        class="student-test-search-form"
    >

        <div class="student-test-search-box">

            <span class="search-icon">⌕</span>

            <input
                type="text"
                name="search"
                placeholder="Search tests..."
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
                href="<?= ROOT ?>/studenttests"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>


    <!-- SORT -->
    <form
        method="GET"
        action="<?= ROOT ?>/studenttests"
        class="student-test-sort-form"
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


        <label for="student-test-sort">
            Sort By
        </label>


        <select
            id="student-test-sort"
            name="sort"
            onchange="this.form.submit()"
        >

            <option
                value="test_id"
                <?= $sort === 'test_id' ? 'selected' : '' ?>
            >
                Test ID
            </option>

            <option
                value="title"
                <?= $sort === 'title' ? 'selected' : '' ?>
            >
                Test Name
            </option>

            <option
                value="total_marks"
                <?= $sort === 'total_marks' ? 'selected' : '' ?>
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
                value="start_date"
                <?= $sort === 'start_date' ? 'selected' : '' ?>
            >
                Start Date
            </option>

            <option
                value="end_date"
                <?= $sort === 'end_date' ? 'selected' : '' ?>
            >
                End Date
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

                <div class="tests-table-wrapper">

                    <table class="tests-table">

                        <thead>

                            <tr>

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
                                    Duration
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


                                    <!-- ========================================
                                         TEST
                                    ======================================== -->

                                    <td>

                                        <div class="test-name-cell">

                                            <div class="test-icon">
                                                TS
                                            </div>

                                            <div>

                                                <strong class="test-name">

                                                    <?= htmlspecialchars(
                                                        $test->title
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                                <?php if (!empty($test->description)): ?>

                                                    <span class="test-description">

                                                        <?= htmlspecialchars(
                                                            $test->description
                                                        ) ?>

                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </td>



                                    <!-- ========================================
                                         CLASS
                                    ======================================== -->

                                    <td>

                                        <span class="test-class">

                                            <?= htmlspecialchars(
                                                $test->class
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </td>



                                    <!-- ========================================
                                         DIVISION
                                    ======================================== -->

                                    <td>

                                        <span class="test-division">

                                            <?= htmlspecialchars(
                                                $test->division
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </td>



                                    <!-- ========================================
                                         DURATION
                                    ======================================== -->

                                    <td>

                                        <span class="test-duration">

                                            <?= htmlspecialchars(
                                                $test->duration
                                                ?? '0'
                                            ) ?>

                                            min

                                        </span>

                                    </td>



                                    <!-- ========================================
                                         ACTION
                                    ======================================== -->

                                    <td>

                                        <?php if (!empty($test->result)): ?>


                                            <span class="status submitted">

                                                <span class="submitted-dot"></span>

                                                Submitted

                                            </span>


                                        <?php else: ?>


                                            <a
                                                href="<?= ROOT ?>/studenttests/start/<?= htmlspecialchars($test->test_id) ?>"
                                                class="start-test-btn"
                                            >
                                                Start Test
                                                <span>→</span>
                                            </a>


                                        <?php endif; ?>

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

        <div class="empty-icon">
            TS
        </div>


        <?php if ($search !== ''): ?>

            <h3>
                No Tests Found
            </h3>

            <p>
                No tests match
                <strong>
                    "<?= htmlspecialchars(
                        $search,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                </strong>.
            </p>


            <a
                href="<?= ROOT ?>/studenttests"
                class="empty-action-btn"
            >
                View All Tests
            </a>


        <?php else: ?>

            <h3>
                No Tests Available
            </h3>

            <p>
                There are currently no tests
                assigned to your class.
            </p>

        <?php endif; ?>

    </div>




            <?php endif; ?>


        </section>


    </div>

</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     SHARED JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>