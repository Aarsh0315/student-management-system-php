<?php

$parent =
    $data['parent'] ?? null;

$children =
    $data['children'] ?? [];

$childCount =
    $data['childCount'] ?? 0;

$testCount =
    $data['testCount'] ?? 0;

$resultCount =
    $data['resultCount'] ?? 0;

?>

<head>


<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/nav.view.css?v=3"> 
    
<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/sidebar.view.css?v=3">

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css?v=3">

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/parent-dashboard.view.css?v=3">
</head>

<!-- =========================================
     NAVBAR
========================================= -->

<?php require __DIR__ . "/includes/nav.view.php"; ?>


<!-- =========================================
     SIDEBAR
========================================= -->

<?php require __DIR__ . "/includes/sidebar.view.php"; ?>


<!-- =========================================
     PARENT DASHBOARD
========================================= -->

<main class="parent-page">

    <div class="parent-container">


        <!-- =====================================
             WELCOME
        ====================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    PARENT DASHBOARD
                </p>

                <h1>
                    Welcome back,
                    <?= htmlspecialchars(
                        $parent->firstname ?? 'Parent'
                    ) ?>
                </h1>

                <p class="welcome-description">
                    Keep track of your children's academic progress.
                </p>

            </div>


            <div class="dashboard-status">

                <span class="status-dot"></span>

                Account Active

            </div>

        </section>



        <!-- =====================================
             KPI CARDS
        ====================================== -->

        <section class="kpi-grid">


            <!-- CHILDREN -->

            <a
                href="<?= ROOT ?>/parentchildren"
                class="kpi-card"
            >

                <div class="kpi-icon">
                    CH
                </div>

                <div class="kpi-content">

                    <span class="kpi-label">
                        My Children
                    </span>

                    <strong class="kpi-value">
                        <?= $childCount ?>
                    </strong>

                </div>

                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- TESTS -->

            <a
                href="<?= ROOT ?>/parenttests"
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
                        <?= $testCount ?>
                    </strong>

                </div>

                <span class="kpi-arrow">
                    →
                </span>

            </a>



            <!-- RESULTS -->

            <a
                href="<?= ROOT ?>/parentresults"
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
                        <?= $resultCount ?>
                    </strong>

                </div>

                <span class="kpi-arrow">
                    →
                </span>

            </a>

        </section>



        <!-- =====================================
             MAIN GRID
        ====================================== -->

        <section class="dashboard-grid">


            <!-- =================================
                 MY CHILDREN
            ================================== -->

            <div class="activity-card">

                <div class="card-header">

                    <div>

                        <h2>
                            My Children
                        </h2>

                        <p>
                            Children linked to your account
                        </p>

                    </div>

                    <span class="activity-count">
                        <?= $childCount ?>
                    </span>

                </div>


                <div class="activity-list">

                    <?php if (!empty($children)): ?>

                        <?php foreach ($children as $child): ?>

                            <a
                                href="<?= ROOT ?>/parentchildren/details/<?= urlencode($child->student_id) ?>"
                                class="activity-item"
                                style="text-decoration:none;"
                            >

                                <div class="activity-icon">
                                    ST
                                </div>


                                <div class="activity-info">

                                    <strong>

                                        <?= htmlspecialchars(
                                            trim(
                                                ($child->firstname ?? '') .
                                                ' ' .
                                                ($child->lastname ?? '')
                                            )
                                        ) ?>

                                    </strong>

                                    <span>

                                        Class
                                        <?= htmlspecialchars(
                                            $child->class ?? '-'
                                        ) ?>

                                        -

                                        <?= htmlspecialchars(
                                            $child->division ?? '-'
                                        ) ?>

                                    </span>

                                </div>


                                <time>
                                    →
                                </time>

                            </a>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="activity-empty">

                            <div class="empty-icon">
                                CH
                            </div>

                            <h3>
                                No Children Found
                            </h3>

                            <p>
                                No students are currently linked to your account.
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>



            <!-- =================================
                 QUICK ACCESS
            ================================== -->

            <div class="management-card">

                <div class="card-header">

                    <div>

                        <h2>
                            Quick Access
                        </h2>

                        <p>
                            Frequently used sections
                        </p>

                    </div>

                </div>


                <div class="management-list">


                    <!-- CHILDREN -->

                    <a
                        href="<?= ROOT ?>/parentchildren"
                        class="management-item"
                    >

                        <div class="management-icon">
                            CH
                        </div>

                        <div class="management-info">

                            <strong>
                                My Children
                            </strong>

                            <small>
                                View children's information
                            </small>

                        </div>

                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- TESTS -->

                    <a
                        href="<?= ROOT ?>/parenttests"
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
                                View children's tests
                            </small>

                        </div>

                        <span class="management-arrow">
                            →
                        </span>

                    </a>



                    <!-- RESULTS -->

                    <a
                        href="<?= ROOT ?>/parentresults"
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
                                View children's results
                            </small>

                        </div>

                        <span class="management-arrow">
                            →
                        </span>

                    </a>

                </div>

            </div>

        </section>



        <!-- =====================================
             ACCOUNT SUMMARY
        ====================================== -->

        <section class="system-summary">


            <!-- PARENT -->

            <div class="summary-item">

                <span>
                    Parent
                </span>

                <strong>

                    <?= htmlspecialchars(
                        trim(
                            ($parent->firstname ?? '') .
                            ' ' .
                            ($parent->lastname ?? '')
                        )
                    ) ?>

                </strong>

            </div>


            <div class="summary-divider"></div>


            <!-- CHILDREN -->

            <div class="summary-item">

                <span>
                    Children
                </span>

                <strong>
                    <?= $childCount ?>
                </strong>

            </div>


            <div class="summary-divider"></div>


            <!-- SCHOOL -->

            <div class="summary-item">

                <span>
                    School
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->school_name ?? '-'
                    ) ?>

                </strong>

            </div>


        </section>


    </div>

</main>



<!-- =========================================
     FOOTER
========================================= -->

<?php require __DIR__ . "/includes/footer.view.php"; ?>


<!-- =========================================
     NAV JS
========================================= -->

<script src="<?= ROOT ?>/js/nav.js"></script>
<script src="<?= ROOT ?>/js/sidebar.js"></script>