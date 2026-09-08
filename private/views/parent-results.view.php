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

    <title>Results - My School</title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-results.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

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


    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Parent
            </p>

            <h1>
                Results
            </h1>

            <p class="welcome-text">
                View the academic results of your children.
            </p>

        </div>

    </section>



    <!-- =========================================
         RESULTS CARD
    ========================================== -->

    <section class="results-card">


        <div class="results-header">

            <div>

                <h2>
                    Children's Results
                </h2>

                <p>
                    <?= count($results) ?>
                    result(s) available
                </p>

            </div>

        </div>



        <!-- =========================================
             SEARCH + SORT
        ========================================== -->

        <div class="parent-results-toolbar">


            <!-- SEARCH -->

            <form
                method="GET"
                action="<?= ROOT ?>/parentresults"
                class="parent-result-search-form"
            >

                <div class="parent-result-search-box">

                    <span class="search-icon">⌕</span>

                    <input
                        type="text"
                        name="search"
                        value="<?= htmlspecialchars(
                            $search,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                        placeholder="Search results..."
                    >

                </div>


                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>


                <?php if (!empty($search)): ?>

                    <a
                        href="<?= ROOT ?>/parentresults"
                        class="clear-search-btn"
                    >
                        Clear
                    </a>

                <?php endif; ?>

            </form>



            <!-- SORT -->

            <form
                method="GET"
                action="<?= ROOT ?>/parentresults"
                class="parent-result-sort-form"
            >

                <?php if (!empty($search)): ?>

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


                <select
                    name="sort"
                    onchange="this.form.submit()"
                >

                    <option
                        value="result_id"
                        <?= $sort === 'result_id' ? 'selected' : '' ?>
                    >
                        Result ID
                    </option>

                    <option
                        value="test"
                        <?= $sort === 'test' ? 'selected' : '' ?>
                    >
                        Test
                    </option>

                    <option
                        value="child"
                        <?= $sort === 'child' ? 'selected' : '' ?>
                    >
                        Child
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

                    <option
                        value="created_at"
                        <?= $sort === 'created_at' ? 'selected' : '' ?>
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



        <?php if (!empty($results)): ?>


            <!-- =========================================
                 TABLE
            ========================================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>Test ID</th>

                            <th>Test</th>

                            <th>Child</th>

                            <th>Class</th>

                            <th>Division</th>

                            <th>Marks</th>

                            <th>Percentage</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach ($results as $result): ?>


                        <?php

                        $studentName = trim(
                            ($result->firstname ?? '') .
                            ' ' .
                            ($result->lastname ?? '')
                        );


                        if ($studentName === '') {
                            $studentName = '-';
                        }


                        $percentage = (float)(
                            $result->percentage ?? 0
                        );


                        $status = strtolower(
                            $result->status ?? ''
                        );

                        ?>


                        <tr>


                            <!-- TEST ID -->

                            <td>

                                <span class="test-id">

                                    <?= htmlspecialchars(
                                        $result->test_id ?? '-'
                                    ) ?>

                                </span>

                            </td>



                            <!-- TEST -->

                            <td>

                                <strong class="result-name">

                                    <?= htmlspecialchars(
                                        $result->title ?? '-'
                                    ) ?>

                                </strong>

                            </td>



                            <!-- CHILD -->

                            <td>

                                <div class="child-name-cell">

                                    <div class="child-avatar">

                                        <?= strtoupper(
                                            substr(
                                                $studentName,
                                                0,
                                                1
                                            )
                                        ) ?>

                                    </div>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $studentName
                                        ) ?>

                                    </strong>

                                </div>

                            </td>



                            <!-- CLASS -->

                            <td>

                                <?= htmlspecialchars(
                                    $result->class ?? '-'
                                ) ?>

                            </td>



                            <!-- DIVISION -->

                            <td>

                                <?= htmlspecialchars(
                                    $result->division ?? '-'
                                ) ?>

                            </td>



                            <!-- MARKS -->

                            <td>

                                <span class="marks">

                                    <?= htmlspecialchars(
                                        $result->obtained_marks ?? '0'
                                    ) ?>

                                    /

                                    <?= htmlspecialchars(
                                        $result->total_marks ?? '0'
                                    ) ?>

                                </span>

                            </td>



                            <!-- PERCENTAGE -->

                            <td>

                                <span class="percentage">

                                    <?= number_format(
                                        $percentage,
                                        1
                                    ) ?>%

                                </span>

                            </td>



                            <!-- STATUS -->

                            <td>

                                <?php if ($status === 'pass'): ?>

                                    <span class="status pass">
                                        Pass
                                    </span>

                                <?php elseif ($status === 'fail'): ?>

                                    <span class="status fail">
                                        Fail
                                    </span>

                                <?php else: ?>

                                    <span class="status">

                                        <?= htmlspecialchars(
                                            ucfirst(
                                                $result->status ?? '-'
                                            )
                                        ) ?>

                                    </span>

                                <?php endif; ?>

                            </td>



                            <!-- ACTION -->

                            <td>

                                <a
                                    href="<?= ROOT ?>/parentresults/details/<?= urlencode(
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


            <!-- =========================================
                 EMPTY STATE
            ========================================== -->

            <div class="empty-state">


                <?php if (!empty($search)): ?>


                    <h3>
                        No Results Found
                    </h3>


                    <p>

                        No results match
                        "<strong><?= htmlspecialchars(
                            $search,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?></strong>"

                    </p>


                    <a
                        href="<?= ROOT ?>/parentresults"
                        class="empty-action-btn"
                    >
                        View All Results
                    </a>


                <?php else: ?>


                    <h3>
                        No Results Found
                    </h3>


                    <p>
                        There are currently no results
                        available for your children.
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