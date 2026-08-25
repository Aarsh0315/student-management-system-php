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


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Results
            </h1>

            <p class="welcome-text">
                View student results across all schools.
            </p>

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

                <p>
                    There are currently no student
                    results registered in the system.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>