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


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- TEACHER RESULTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-results.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
======================================== -->

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
                View student test results
                and performance.
            </p>

        </div>

    </section>



    <!-- ========================================
         RESULTS CARD
    ======================================== -->

    <section class="results-card">


        <!-- ========================================
             HEADER
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
        ======================================== -->

        <?php if (!empty($results)): ?>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

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


                                <!-- STUDENT -->

                                <td>

                                    <strong class="student-name">

                                        <?= htmlspecialchars(
                                            $result->student_name
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- TEST -->

                                <td>

                                    <span class="test-name">

                                        <?= htmlspecialchars(
                                            $result->test_title
                                            ?? '-'
                                        ) ?>

                                    </span>

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



                                <!-- TOTAL MARKS -->

                                <td>

                                    <span class="marks-count">

                                        <?= htmlspecialchars(
                                            $result->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- OBTAINED MARKS -->

                                <td>

                                    <strong class="obtained-marks">

                                        <?= htmlspecialchars(
                                            $result->marks_obtained
                                            ?? '0'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- PERCENTAGE -->

                                <td>

                                    <?php

                                    $total =
                                        (float) (
                                            $result->total_marks
                                            ?? 0
                                        );

                                    $obtained =
                                        (float) (
                                            $result->marks_obtained
                                            ?? 0
                                        );

                                    $percentage =
                                        $total > 0
                                            ? round(
                                                (
                                                    $obtained
                                                    / $total
                                                ) * 100,
                                                2
                                            )
                                            : 0;

                                    ?>

                                    <span class="percentage">

                                        <?= $percentage ?>%

                                    </span>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php

                                    $status =
                                        strtolower(
                                            $result->status
                                            ?? 'pending'
                                        );

                                    ?>


                                    <?php if (
                                        $status === 'checked'
                                    ): ?>

                                        <span
                                            class="status checked"
                                        >
                                            Checked
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status pending"
                                        >
                                            Pending
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/teacherresults/details/<?= urlencode($result->submission_id ?? '') ?>"
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
                    No students have submitted
                    any tests yet.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>