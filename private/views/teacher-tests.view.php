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


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- TEACHER TESTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-tests.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- TEACHER NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=3"
    >

</head>


<body>


<?php require "../private/views/includes/teacher-nav.view.php"; ?>


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
                Tests
            </h1>

            <p class="welcome-text">
                Create, manage and evaluate
                tests for your students.
            </p>

        </div>

    </section>



    <!-- ========================================
         TESTS CARD
    ========================================= -->

    <section class="tests-card">


        <!-- ========================================
             HEADER
        ========================================= -->

        <div class="tests-header">

            <div>

                <h2>
                    My Tests
                </h2>

                <p>

                    <?= count($tests) ?>

                    test(s) created

                </p>

            </div>


            <!-- CREATE TEST -->

            <a
                href="<?= ROOT ?>/teachertests/create"
                class="add-test-btn"
            >
                + Create Test
            </a>

        </div>



        <?php if (!empty($tests)): ?>


            <!-- ========================================
                 TABLE
            ========================================= -->

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


                                <!-- TEST -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- CLASS -->

                                <td>

                                    <span class="test-class">

                                        <?= htmlspecialchars(
                                            $test->class
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <span class="test-division">

                                        <?= htmlspecialchars(
                                            $test->division
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- TOTAL MARKS -->

                                <td>

                                    <span class="marks-count">

                                        <?= htmlspecialchars(
                                            $test->total_marks
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- DURATION -->

                                <td>

                                    <?php if (
                                        !empty($test->duration)
                                    ): ?>

                                        <?= htmlspecialchars(
                                            $test->duration
                                        ) ?>

                                        min

                                    <?php else: ?>

                                        <span class="no-duration">
                                            Not set
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php

                                    $status =
                                        strtolower(
                                            $test->status
                                            ?? 'draft'
                                        );

                                    ?>


                                    <?php if (
                                        $status === 'active'
                                    ): ?>

                                        <span
                                            class="status active"
                                        >
                                            Active
                                        </span>

                                    <?php elseif (
                                        $status === 'closed'
                                    ): ?>

                                        <span
                                            class="status inactive"
                                        >
                                            Closed
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status draft"
                                        >
                                            Draft
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/teachertests/details/<?= urlencode($test->test_id ?? '') ?>"
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
                    No Tests Found
                </h3>

                <p>
                    You have not created any tests yet.
                </p>

                <a
                    href="<?= ROOT ?>/teachertests/create"
                    class="empty-create-btn"
                >
                    Create Your First Test
                </a>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>