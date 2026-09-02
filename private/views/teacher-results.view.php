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
            ========================================= -->

            <div class="empty-state">

                <h3>
                    No Results Found
                </h3>

                <p>
                    There are currently no student results available.
                </p>

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