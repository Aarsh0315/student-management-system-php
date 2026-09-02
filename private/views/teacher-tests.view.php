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


    <!-- TEACHER TESTS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-tests.view.css?v=2"
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
    ======================================== -->

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
    ======================================== -->

    <section class="tests-card">


        <!-- ========================================
             CARD HEADER
        ======================================== -->

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

                                    <span class="marks">

                                        <?= htmlspecialchars(
                                            $test->total_marks
                                            ?? '-'
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

                                    $status = strtolower(
                                        $test->status ?? 'draft'
                                    );

                                    ?>


                                    <?php if (
                                        $status === 'active'
                                    ): ?>

                                        <span class="status active">
                                            Active
                                        </span>


                                    <?php elseif (
                                        $status === 'draft'
                                    ): ?>

                                        <span class="status draft">
                                            Draft
                                        </span>


                                    <?php else: ?>

                                        <span class="status inactive">

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
                                        href="<?= ROOT ?>/teachertests/details/<?= urlencode(
                                            $test->test_id ?? ''
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