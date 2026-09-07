<?php

$results = $data['results'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'result_id';

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
        Results - My School
    </title>


    <!-- ========================================
         DASHBOARD CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- ========================================
         NAVBAR CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- ========================================
         SIDEBAR CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- ========================================
         STUDENT RESULTS CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-results.view.css?v=2"
    >


    <!-- ========================================
         FOOTER CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
========================================= -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
========================================= -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ========================================= -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Student
            </p>

            <h1>
                Results
            </h1>

            <p class="welcome-text">
                View your test results and academic performance.
            </p>

        </div>

    </section>



    <!-- ========================================
         RESULTS CARD
    ========================================= -->

    <section class="results-card">


        <!-- ========================================
             CARD HEADER
        ========================================= -->

        <div class="results-header">

            <div>

                <h2>
                    My Test Results
                </h2>

                <p>

                    <?= count($results) ?>

                    result(s) available

                </p>

            </div>

        </div>



        <!-- ========================================
             RESULTS TABLE
        ========================================= -->

        <!-- ========================================
     SEARCH + SORT TOOLBAR
========================================= -->

<div class="student-results-toolbar">

    <!-- SEARCH FORM -->

    <form
        method="GET"
        action="<?= ROOT ?>/studentresults"
        class="student-result-search-form"
    >

        <div class="student-result-search-box">

            <span class="search-icon">⌕</span>

            <input
                type="text"
                name="search"
                placeholder="Search results..."
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
                href="<?= ROOT ?>/studentresults"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>


    <!-- SORT FORM -->

    <form
        method="GET"
        action="<?= ROOT ?>/studentresults"
        class="student-result-sort-form"
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


        <label for="student-result-sort">
            Sort By
        </label>


        <select
            id="student-result-sort"
            name="sort"
            onchange="this.form.submit()"
        >

            <option
                value="result_id"
                <?= $sort === 'result_id'
                    ? 'selected'
                    : '' ?>
            >
                Result ID
            </option>


            <option
                value="test"
                <?= $sort === 'test'
                    ? 'selected'
                    : '' ?>
            >
                Test
            </option>


            <option
                value="class"
                <?= $sort === 'class'
                    ? 'selected'
                    : '' ?>
            >
                Class
            </option>


            <option
                value="total_marks"
                <?= $sort === 'total_marks'
                    ? 'selected'
                    : '' ?>
            >
                Total Marks
            </option>


            <option
                value="obtained_marks"
                <?= $sort === 'obtained_marks'
                    ? 'selected'
                    : '' ?>
            >
                Obtained Marks
            </option>


            <option
                value="percentage"
                <?= $sort === 'percentage'
                    ? 'selected'
                    : '' ?>
            >
                Percentage
            </option>


            <option
                value="status"
                <?= $sort === 'status'
                    ? 'selected'
                    : '' ?>
            >
                Status
            </option>


            <option
                value="created_at"
                <?= $sort === 'created_at'
                    ? 'selected'
                    : '' ?>
            >
                Date
            </option>

        </select>


        <select
            name="direction"
            onchange="this.form.submit()"
        >

            <option
                value="ASC"
                <?= $direction === 'ASC'
                    ? 'selected'
                    : '' ?>
            >
                Ascending
            </option>


            <option
                value="DESC"
                <?= $direction === 'DESC'
                    ? 'selected'
                    : '' ?>
            >
                Descending
            </option>

        </select>

    </form>

</div>


<!-- ========================================
     RESULTS TABLE
========================================= -->


        <?php if (!empty($results)): ?>


            <div class="table-wrapper">


                <table>


                    <thead>

                        <tr>

                            <th>
                                Result ID
                            </th>

                            <th>
                                Test
                            </th>

                            <th>
                                Class
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
                                ========================================= -->

                                <td>

                                    <span class="result-id">

                                        <?= htmlspecialchars(
                                            $result->result_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     TEST
                                ========================================= -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $result->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     CLASS
                                ========================================= -->

                                <td>

                                    <span class="result-class">

                                        <?= htmlspecialchars(
                                            $result->class
                                            ?? '-'
                                        ) ?>

                                        <?php if (
                                            !empty($result->division)
                                        ): ?>

                                            -

                                            <?= htmlspecialchars(
                                                $result->division
                                            ) ?>

                                        <?php endif; ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     TOTAL MARKS
                                ========================================= -->

                                <td>

                                    <span class="marks-count">

                                        <?= htmlspecialchars(
                                            $result->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- ========================================
                                     OBTAINED MARKS
                                ========================================= -->

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
                                ========================================= -->

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
                                ========================================= -->

                                <td>

                                    <?php

                                    $status = strtolower(
                                        trim(
                                            $result->status ?? ''
                                        )
                                    );

                                    ?>


                                    <?php if (
                                        $status === 'pass'
                                        || $status === 'passed'
                                    ): ?>

                                        <span class="status pass">
                                            Pass
                                        </span>

                                    <?php else: ?>

                                        <span class="status fail">
                                            Fail
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ========================================
                                     ACTION
                                ========================================= -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/studentresults/details/<?= urlencode(
                                            $result->test_id ?? ''
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
            ========================================= -->

            <div class="empty-state">

    <?php if ($search !== ''): ?>

        <h3>
            No Results Found
        </h3>

        <p>
            No results match
            <strong>
                "<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            </strong>.
        </p>

        <a
            href="<?= ROOT ?>/studentresults"
            class="empty-action-btn"
        >
            View All Results
        </a>

    <?php else: ?>

        <h3>
            No Results Found
        </h3>

        <p>
            Your test results will appear here
            after you submit a test.
        </p>

    <?php endif; ?>

</div>


        <?php endif; ?>


    </section>


</main>



<!-- ========================================
     FOOTER
========================================= -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
========================================= -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>