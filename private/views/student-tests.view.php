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
        href="<?= ROOT ?>/css/student-tests.view.css?v=1"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


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
                                Total Marks
                            </th>

                            <th>
                                Duration
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
                            $tests as $test
                        ): ?>


                            <tr>


                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>


                                <td>

                                    <span class="test-class">

                                        <?= htmlspecialchars(
                                            $test->class
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <span class="test-division">

                                        <?= htmlspecialchars(
                                            $test->division
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <span class="marks-count">

                                        <?= htmlspecialchars(
                                            $test->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $test->duration
                                        ?? '0'
                                    ) ?>

                                    min

                                </td>


                                <td>

                                    <span
                                        class="status active"
                                    >
                                        Available
                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="<?= ROOT ?>/studenttests/start/<?= urlencode($test->test_id) ?>"
                                        class="start-test-btn"
                                    >
                                        Start Test
                                    </a>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php else: ?>


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