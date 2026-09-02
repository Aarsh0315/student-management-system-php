<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
=====================================================
STUDENT INFORMATION
=====================================================
*/

$firstname = $_SESSION['firstname'] ?? 'Student';
$lastname  = $_SESSION['lastname'] ?? '';

$initial = strtoupper(
    substr($firstname, 0, 1)
);


/*
=====================================================
DASHBOARD DATA
=====================================================
*/

$student = $data['student'] ?? null;

$testCount = $data['testCount'] ?? 0;

$resultCount = $data['resultCount'] ?? 0;

$recentTests = $data['recentTests'] ?? [];


/*
=====================================================
STUDENT CLASS INFORMATION
=====================================================
*/

$class = $student->class ?? '-';

$division = $student->division ?? '-';

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
        Student Dashboard - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- STUDENT DASHBOARD -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-dashboard.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<!-- =====================================================
     STUDENT DASHBOARD
===================================================== -->

<main class="student-page">

    <div class="student-container">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    STUDENT OVERVIEW
                </p>


                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?>

                </h1>


                <p class="welcome-description">

                    View your class, tests, results
                    and academic activities.

                </p>

            </div>


            <!-- STATUS -->

            <div class="dashboard-status">

                <span class="status-dot"></span>

                <span>
                    Active
                </span>

            </div>

        </section>



        <!-- =================================================
             KPI CARDS
        ================================================== -->

        <section class="kpi-grid">


            <!-- =================================================
                 MY CLASS
            ================================================== -->

            <a
                href="<?= ROOT ?>/studentclasses"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    CL
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        My Class
                    </span>


                    <strong class="kpi-value">

                        <?= htmlspecialchars($class) ?>

                        <?php if ($division !== '-'): ?>

                            -
                            <?= htmlspecialchars($division) ?>

                        <?php endif; ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 TESTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/studenttests"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    TS
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Tests
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $testCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- =================================================
                 RESULTS
            ================================================== -->

            <a
                href="<?= ROOT ?>/studentresults"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    RS
                </div>


                <div class="kpi-content">

                    <span class="kpi-label">
                        Results
                    </span>


                    <strong class="kpi-value">

                        <?= number_format(
                            $resultCount
                        ) ?>

                    </strong>

                </div>


                <span class="kpi-arrow">
                    →
                </span>

            </a>


        </section>



        <!-- =================================================
             MAIN DASHBOARD GRID
        ================================================== -->

        <section class="dashboard-grid">


            <!-- =================================================
                 RECENT TESTS
            ================================================== -->

            <div class="activity-card">


                <div class="card-header">

                    <div>

                        <h2>
                            Recent Tests
                        </h2>

                        <p>
                            Your latest tests and assessments.
                        </p>

                    </div>


                    <a
                        href="<?= ROOT ?>/studenttests"
                        class="activity-count"
                    >
                        View All
                    </a>

                </div>



                <div class="activity-list">


                    <?php if (!empty($recentTests)): ?>


                        <?php foreach ($recentTests as $test): ?>


                            <a
                                href="<?= ROOT ?>/studenttests"
                                class="activity-item"
                            >


                                <div class="activity-icon">
                                    TS
                                </div>


                                <div class="activity-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            $test->title
                                            ?? 'Test'
                                        ) ?>

                                    </strong>


                                    <span>

                                        <?php

                                        $testClass =
                                            $test->class
                                            ?? null;

                                        $testDivision =
                                            $test->division
                                            ?? null;

                                        $testSubject =
                                            $test->subject
                                            ?? null;

                                        ?>

                                        <?php if ($testClass): ?>

                                            Class
                                            <?= htmlspecialchars(
                                                $testClass
                                            ) ?>

                                            <?php if ($testDivision): ?>

                                                -
                                                <?= htmlspecialchars(
                                                    $testDivision
                                                ) ?>

                                            <?php endif; ?>

                                        <?php elseif ($testSubject): ?>

                                            <?= htmlspecialchars(
                                                $testSubject
                                            ) ?>

                                        <?php else: ?>

                                            Academic Test

                                        <?php endif; ?>

                                    </span>

                                </div>


                                <time>

                                    <?= !empty(
                                        $test->created_at
                                    )

                                        ? date(
                                            'd M Y',
                                            strtotime(
                                                $test->created_at
                                            )
                                        )

                                        : '-'
                                    ?>

                                </time>


                            </a>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <div class="activity-empty">


                            <div class="empty-icon">
                                TS
                            </div>


                            <strong>
                                No recent tests
                            </strong>


                            <span>
                                Your recent tests will appear here.
                            </span>


                        </div>


                    <?php endif; ?>


                </div>


            </div>



            <!-- =================================================
                 QUICK ACCESS
            ================================================== -->

            <div class="management-card">


                <div class="card-header">

                    <div>

                        <h2>
                            Quick Access
                        </h2>

                        <p>
                            Access your main academic areas.
                        </p>

                    </div>

                </div>



                <div class="management-list">


                    <!-- =================================================
                         TESTS
                    ================================================== -->

                    <a
                        href="<?= ROOT ?>/studenttests"
                        class="management-item"
                    >

                        <div class="management-icon">
                            TS
                        </div>


                        <div class="management-info">

                            <strong>
                                Tests
                            </strong>

                            <small>
                                View available tests
                            </small>

                        </div>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- =================================================
                         MY CLASS
                    ================================================== -->

                    <a
                        href="<?= ROOT ?>/studentclasses"
                        class="management-item"
                    >

                        <div class="management-icon">
                            CL
                        </div>


                        <div class="management-info">

                            <strong>
                                My Class
                            </strong>

                            <small>
                                View your class and division
                            </small>

                        </div>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- =================================================
                         RESULTS
                    ================================================== -->

                    <a
                        href="<?= ROOT ?>/studentresults"
                        class="management-item"
                    >

                        <div class="management-icon">
                            RS
                        </div>


                        <div class="management-info">

                            <strong>
                                Results
                            </strong>

                            <small>
                                View your academic results
                            </small>

                        </div>


                        <span class="management-arrow">
                            →
                        </span>

                    </a>


                </div>


            </div>


        </section>



        <!-- =================================================
             STUDENT SUMMARY
        ================================================== -->

        <section class="system-summary">


            <!-- CLASS -->

            <div class="summary-item">

                <span class="summary-label">
                    Class
                </span>


                <strong>

                    <?= htmlspecialchars(
                        $class
                    ) ?>

                </strong>

            </div>



            <div class="summary-divider"></div>



            <!-- DIVISION -->

            <div class="summary-item">

                <span class="summary-label">
                    Division
                </span>


                <strong>

                    <?= htmlspecialchars(
                        $division
                    ) ?>

                </strong>

            </div>



            <div class="summary-divider"></div>



            <!-- ACCOUNT -->

            <div class="summary-item">

                <span class="summary-label">
                    Your Account
                </span>


                <strong>
                    Student
                </strong>

            </div>


        </section>


    </div>

</main>



<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js"></script>

<script src="<?= ROOT ?>/js/sidebar.js"></script>


</body>

</html>