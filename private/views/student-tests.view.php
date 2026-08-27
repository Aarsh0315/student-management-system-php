<?php


$tests = $data['tests'] ?? [];

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


    <!-- DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- STUDENT TESTS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-tests.view.css?v=2"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-nav.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/student-nav.view.php"; ?>


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
                Tests
            </h1>

            <p class="welcome-text">
                View and attempt tests assigned
                to your class.
            </p>

        </div>

    </section>



    <!-- ========================================
         TESTS CARD
    ========================================= -->

    <section class="tests-card">


        <div class="tests-header">

            <div>

                <h2>
                    Available Tests
                </h2>

                <p>

                    <?= count($tests) ?>

                    test(s) available

                </p>

            </div>

        </div>



        <?php if (!empty($tests)): ?>


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
                                     TEST NAME
                                ========================================= -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- ========================================
                                     CLASS
                                ========================================= -->

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
                                ========================================= -->

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
                                ========================================= -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->duration
                                        ?? '0'
                                    ) ?>

                                    min

                                </td>



                                <!-- ========================================
                                     ACTION
                                ========================================= -->

                                <td>

                                    <?php if (!empty($test->result)): ?>

                                        <!-- ========================================
                                             ALREADY SUBMITTED
                                        ========================================= -->

                                        <span class="status submitted">

                                            ✓ Submitted

                                        </span>


                                    <?php else: ?>

                                        <!-- ========================================
                                             START TEST
                                        ========================================= -->

                                        <a
                                            href="<?= ROOT ?>/studenttests/start/<?= htmlspecialchars($test->test_id) ?>"
                                            class="start-test-btn"
                                        >
                                            Start Test
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
            ========================================= -->

            <div class="empty-state">

                <h3>
                    No Tests Available
                </h3>

                <p>
                    There are currently no tests
                    assigned to your class.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>