<?php

$results = $data['results'] ?? [];

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


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- STUDENT RESULTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-results.view.css?v=1"
    >


    <!-- STUDENT NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-nav.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/student-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Student
            </p>


            <h1>
                Results
            </h1>


            <p class="welcome-text">
                View your test results and
                academic performance.
            </p>

        </div>

    </section>



    <!-- ========================================
         RESULTS CARD
    ======================================== -->

    <section class="results-card">


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



        <?php if (!empty($results)): ?>


            <!-- ========================================
                 RESULTS TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

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
                                Marks
                            </th>

                            <th>
                                Percentage
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
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


                                <!-- TEST -->

                                <td>

                                    <strong class="result-test-name">

                                        <?= htmlspecialchars(
                                            $result->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- CLASS -->

                                <td>

                                    <span class="result-class">

                                        <?= htmlspecialchars(
                                            $result->class
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DIVISION -->

                                <td>

                                    <span class="result-division">

                                        <?= htmlspecialchars(
                                            $result->division
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- MARKS -->

                                <td>

                                    <span class="result-marks">

                                        <?= htmlspecialchars(
                                            $result->obtained_marks
                                            ?? '0'
                                        ) ?>

                                        /

                                        <?= htmlspecialchars(
                                            $result->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- PERCENTAGE -->

                                <td>

                                    <strong class="result-percentage">

                                        <?= htmlspecialchars(
                                            $result->percentage
                                            ?? '0'
                                        ) ?>%

                                    </strong>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span class="result-status submitted">

                                        <span class="status-dot"></span>

                                        Submitted

                                    </span>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <?php

                                    $date =
                                        $result->created_at
                                        ?? null;

                                    if ($date) {

                                        echo htmlspecialchars(
                                            date(
                                                'd M Y',
                                                strtotime($date)
                                            )
                                        );

                                    } else {

                                        echo '-';

                                    }

                                    ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= ROOT ?>/studentresults/details/<?= urlencode($result->test_id) ?>"
                                        class="view-result-btn"
                                    >
                                        View Result
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
                    No Results Yet
                </h3>


                <p>
                    Your test results will appear
                    here after you submit a test.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>