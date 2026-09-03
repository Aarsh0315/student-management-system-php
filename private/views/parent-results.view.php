<?php

$results = $data['results'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Results - My School</title>


    <link rel="stylesheet"
          href="<?= ROOT ?>/css/home.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/parent-results.view.css?v=1">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/footer.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/nav.view.css">

    <link rel="stylesheet"
          href="<?= ROOT ?>/css/sidebar.view.css">

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



        <?php if (!empty($results)): ?>


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


                            <!-- RESULT ID -->

                            <td>

                                <span class="test-id">
                                    <?= htmlspecialchars($result->test_id ?? '-') ?>
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
                                    href="<?= ROOT ?>/parentresults/details/<?= urlencode($result->result_id ?? '') ?>"
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


            <!-- EMPTY -->

            <div class="empty-state">

                <h3>
                    No Results Found
                </h3>

                <p>
                    There are currently no results available
                    for your children.
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