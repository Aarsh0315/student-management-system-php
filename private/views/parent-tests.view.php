<?php

$tests =
    $data['tests'] ?? [];

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


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- TESTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/tests.view.css?v=1"
    >


    <!-- PARENT TESTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-tests.view.css?v=1"
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

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Parent
            </p>

            <h1>
                Tests
            </h1>

            <p class="welcome-text">
                View tests assigned to your children.
            </p>

        </div>

    </section>



    <!-- ========================================
         TESTS CARD
    ======================================== -->

    <section class="tests-card">


        <!-- ========================================
             CARD HEADER
        ======================================== -->

        <div class="tests-header">

            <div>

                <h2>
                    My Children's Tests
                </h2>

                <p>

                    <?= count($tests) ?>

                    test(s) available

                </p>

            </div>

        </div>



        <?php if (!empty($tests)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Test ID
                            </th>

                            <th>
                                Test
                            </th>

                            <th>
                                Child
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


                                <!-- TEST ID -->

                                <td>

                                    <span class="test-id">

                                        <?= htmlspecialchars(
                                            $test->test_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- TEST -->

                                <td>

                                    <strong class="test-name">

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- CHILD -->

                                <td>

                                    <div class="child-name-cell">

                                        <div class="child-avatar">

                                            <?= strtoupper(
                                                substr(
                                                    $test->student_name
                                                    ?? 'S',
                                                    0,
                                                    1
                                                )
                                            ) ?>

                                        </div>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $test->student_name
                                                ?? '-'
                                            ) ?>

                                        </strong>

                                    </div>

                                </td>



                                <!-- CLASS -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->class
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->division
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- TOTAL MARKS -->

                                <td>

                                    <span class="marks">

                                        <?= htmlspecialchars(
                                            $test->total_marks
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- DURATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $test->duration
                                        ?? '-'
                                    ) ?>

                                    min

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($test->status ?? '')
                                        === 'active'
                                    ): ?>

                                        <span
                                            class="status active"
                                        >
                                            Active
                                        </span>

                                    <?php elseif (
                                        ($test->status ?? '')
                                        === 'draft'
                                    ): ?>

                                        <span
                                            class="status draft"
                                        >
                                            Draft
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status inactive"
                                        >

                                            <?= htmlspecialchars(
                                                ucfirst(
                                                    $test->status
                                                    ?? 'Unknown'
                                                )
                                            ) ?>

                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/parenttests/details/<?= urlencode(
                                            $test->test_id
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
                    No Tests Found
                </h3>

                <p>
                    There are currently no tests
                    assigned to your children.
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