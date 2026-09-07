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
         TEACHER RESULTS CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-results.view.css?v=2"
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
                Teacher
            </p>

            <h1>
                Results
            </h1>

            <p class="welcome-text">
                View student results and academic performance.
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
                    Student Results
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

        <?php if (!empty($results)): ?>

            <!-- ========================================
     SEARCH + SORT TOOLBAR
======================================== -->

<div class="results-toolbar">

    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/teacherresults"
        class="result-search-form"
    >

        <div class="result-search-box">

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


        <input
            type="hidden"
            name="sort"
            value="<?= htmlspecialchars(
                $sort,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <input
            type="hidden"
            name="direction"
            value="<?= htmlspecialchars(
                $direction,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >


        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>


        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/teacherresults"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>



    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/teacherresults"
        class="result-sort-form"
    >

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars(
                $search,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
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
                value="result_id"
                <?= $sort === 'result_id'
                    ? 'selected'
                    : '' ?>
            >
                Result ID
            </option>


            <option
                value="student"
                <?= $sort === 'student'
                    ? 'selected'
                    : '' ?>
            >
                Student
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
                                     STUDENT
                                ========================================= -->

                                <td>

                                    <strong class="student-name">

                                        <?= htmlspecialchars(
                                            trim(
                                                ($result->student_firstname ?? '')
                                                . ' '
                                                . ($result->student_lastname ?? '')
                                            ) ?: '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     TEST
                                ========================================= -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $result->test_title
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
                                        href="<?= ROOT ?>/teacherresults/details/<?= urlencode(
                                            $result->result_id ?? ''
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

        <?php if ($search !== ''): ?>

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
                href="<?= ROOT ?>/teacherresults"
                class="empty-action-btn"
            >
                View All Results
            </a>

        <?php else: ?>

            <p>
                There are currently no student results available.
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


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>