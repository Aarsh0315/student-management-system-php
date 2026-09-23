<?php

$totalSchools =
    $data['totalSchools'] ?? 0;

$activeSchools =
    $data['activeSchools'] ?? 0;

$inactiveSchools =
    $data['inactiveSchools'] ?? 0;

$totalUsers =
    $data['totalUsers'] ?? 0;

$studentCount =
    $data['studentCount'] ?? 0;

$teacherCount =
    $data['teacherCount'] ?? 0;

$parentCount =
    $data['parentCount'] ?? 0;

$adminCount =
    $data['adminCount'] ?? 0;

$schoolOverview = $data['schoolOverview'] ?? [];

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
        Reports - My School
    </title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- REPORTS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/reports.view.css?v=1"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php

require "../private/views/includes/nav.view.php";

?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php

require "../private/views/includes/sidebar.view.php";

?>


<!-- =====================================================
     MAIN
===================================================== -->

<main class="reports-page">

    <!-- =================================================
     REPORTS HEADER
================================================== -->

<div class="reports-header">

    <div class="reports-header-content">

        <span class="reports-eyebrow">
            PLATFORM ANALYTICS
        </span>

        <h1>
            Reports
        </h1>

        <p>
            Monitor platform performance, user distribution,
            and school activity from one place.
        </p>

    </div>

    <div class="reports-header-actions">

        <a
            href="<?= ROOT ?>/reports?export=schools"
            class="report-export-button"
        >
            Export Report
        </a>

    </div>

</div>


<!-- =================================================
     PLATFORM SUMMARY
================================================== -->

<section class="reports-summary">

    <div class="report-summary-card">

        <div class="report-summary-top">

            <span class="report-summary-label">
                Total Schools
            </span>

            <span class="report-summary-icon">
                SC
            </span>

        </div>

        <strong class="report-summary-value">
            <?= number_format($totalSchools) ?>
        </strong>

        <span class="report-summary-description">
            Registered on platform
        </span>

    </div>


    <div class="report-summary-card">

        <div class="report-summary-top">

            <span class="report-summary-label">
                Active Schools
            </span>

            <span class="report-summary-icon active">
                AC
            </span>

        </div>

        <strong class="report-summary-value">
            <?= number_format($activeSchools) ?>
        </strong>

        <span class="report-summary-description">
            Currently active
        </span>

    </div>


    <div class="report-summary-card">

        <div class="report-summary-top">

            <span class="report-summary-label">
                Inactive Schools
            </span>

            <span class="report-summary-icon inactive">
                IN
            </span>

        </div>

        <strong class="report-summary-value">
            <?= number_format($inactiveSchools) ?>
        </strong>

        <span class="report-summary-description">
            Require attention
        </span>

    </div>


    <div class="report-summary-card">

        <div class="report-summary-top">

            <span class="report-summary-label">
                Total Users
            </span>

            <span class="report-summary-icon users">
                US
            </span>

        </div>

        <strong class="report-summary-value">
            <?= number_format($totalUsers) ?>
        </strong>

        <span class="report-summary-description">
            Across all schools
        </span>

    </div>

</section>



<!-- =================================================
     USER ANALYTICS
================================================== -->

<section class="reports-section">

    <div class="section-heading">

        <div>

            <h2>
                User Analytics
            </h2>

            <p>
                Distribution of active users across platform roles.
            </p>

        </div>

    </div>

    <div class="chart-card">

        <div class="chart-container chart-container-doughnut">

            <canvas id="userDistributionChart"></canvas>

        </div>

        <div class="chart-summary">

            <div class="chart-summary-item">

                <span class="chart-summary-dot students"></span>

                <span>
                    Students
                </span>

                <strong>
                    <?= number_format($studentCount) ?>
                </strong>

            </div>

            <div class="chart-summary-item">

                <span class="chart-summary-dot teachers"></span>

                <span>
                    Teachers
                </span>

                <strong>
                    <?= number_format($teacherCount) ?>
                </strong>

            </div>

            <div class="chart-summary-item">

                <span class="chart-summary-dot parents"></span>

                <span>
                    Parents
                </span>

                <strong>
                    <?= number_format($parentCount) ?>
                </strong>

            </div>

            <div class="chart-summary-item">

                <span class="chart-summary-dot admins"></span>

                <span>
                    School Admins
                </span>

                <strong>
                    <?= number_format($adminCount) ?>
                </strong>

            </div>

        </div>

    </div>

</section>
<!-- =================================================
     SCHOOL ANALYTICS
================================================== -->

<section class="reports-section">

    <div class="section-heading">

        <div>

            <h2>
                School Analytics
            </h2>

            <p>
                Current distribution and status of schools across the platform.
            </p>

        </div>

    </div>

    <div class="chart-card">

        <div class="chart-container chart-container-doughnut">

            <canvas id="schoolStatusChart"></canvas>

        </div>

        <div class="chart-summary">

            <div class="chart-summary-item">

                <span class="chart-summary-dot school-active"></span>

                <span>
                    Active Schools
                </span>

                <strong>
                    <?= number_format($activeSchools) ?>
                </strong>

            </div>

            <div class="chart-summary-item">

                <span class="chart-summary-dot school-inactive"></span>

                <span>
                    Inactive Schools
                </span>

                <strong>
                    <?= number_format($inactiveSchools) ?>
                </strong>

            </div>

            <div class="chart-summary-item">

                <span class="chart-summary-dot school-total"></span>

                <span>
                    Total Schools
                </span>

                <strong>
                    <?= number_format($totalSchools) ?>
                </strong>

            </div>

        </div>

    </div>

</section>

<!-- =================================================
     SCHOOL-WISE ANALYTICS
================================================== -->

<section class="reports-section">

    <div class="section-heading">

        <div>

            <h2>
                School-wise Analytics
            </h2>

            <p>
                Overview of users and status across individual schools.
            </p>

        </div>

    </div>

    <div class="school-wise-table-wrapper">

        <table class="school-wise-table">

            <thead>

                <tr>
                    <th>School</th>
                    <th>Students</th>
                    <th>Staff</th>
                    <th>Admin</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php if (!empty($schoolOverview)): ?>

                    <?php foreach ($schoolOverview as $school): ?>

                        <tr>

                            <td>
                                <strong class="school-wise-name">
                                    <?= htmlspecialchars($school->school_name ?? 'Unknown School') ?>
                                </strong>
                            </td>

                            <td>
                                <?= number_format((int) ($school->student_count ?? 0)) ?>
                            </td>

                            <td>
                                <?= number_format((int) ($school->staff_count ?? 0)) ?>
                            </td>

                            <td>
                                <?= number_format((int) ($school->admin_count ?? 0)) ?>
                            </td>

                            <td>

                                <?php
                                $status = strtolower($school->status ?? '');
                                ?>

                                <span class="school-wise-status <?= $status === 'active' ? 'active' : 'inactive' ?>">
                                    <?= htmlspecialchars(ucfirst($status ?: 'Inactive')) ?>
                                </span>

                            </td>

                            <td>

                                <a
                                    href="<?= ROOT ?>/schools"
                                    class="school-wise-action"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6" class="school-wise-empty">
                            No school data available.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</section>

<!-- =================================================
     SCHOOL-WISE COMPARISON
================================================== -->

<section class="reports-section">

    <div class="section-heading">

        <div>

            <h2>
                School-wise Comparison
            </h2>

            <p>
                Compare student, staff, and admin distribution across schools.
            </p>

        </div>

    </div>

    <div class="chart-card school-comparison-card">

        <div class="chart-container chart-container-bar">

            <canvas id="schoolComparisonChart"></canvas>

        </div>

    </div>

</section>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php

require "../private/views/includes/footer.view.php";

?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>

<script>
    const userDistributionChart =
        document.getElementById('userDistributionChart');

    if (userDistributionChart) {

        new Chart(userDistributionChart, {

            type: 'doughnut',

            data: {

                labels: [
                    'Students',
                    'Teachers',
                    'Parents',
                    'School Admins'
                ],

                datasets: [{
                    data: [
                        <?= (int) $studentCount ?>,
                        <?= (int) $teacherCount ?>,
                        <?= (int) $parentCount ?>,
                        <?= (int) $adminCount ?>
                    ],

                    backgroundColor: [
                        '#a32675',
                        '#6b7280',
                        '#8b5cf6',
                        '#303641'
                    ],

                    borderWidth: 0
                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {

                    legend: {
                        display: false
                    }

                }

            }

        });

    }
</script>


<script>
    const schoolStatusChart =
        document.getElementById('schoolStatusChart');

    if (schoolStatusChart) {

        new Chart(schoolStatusChart, {

            type: 'doughnut',

            data: {

                labels: [
                    'Active Schools',
                    'Inactive Schools'
                ],

                datasets: [{
                    data: [
                        <?= (int) $activeSchools ?>,
                        <?= (int) $inactiveSchools ?>
                    ],

                    backgroundColor: [
                        '#237a48',
                        '#b33a42'
                    ],

                    borderWidth: 0
                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {

                    legend: {
                        display: false
                    }

                }

            }

        });

    }
</script>

<script>
    const schoolComparisonChart =
        document.getElementById('schoolComparisonChart');

    if (schoolComparisonChart) {

        new Chart(schoolComparisonChart, {

            type: 'bar',

            data: {

                labels: [
                    <?php foreach ($schoolOverview as $school): ?>
                        <?= json_encode($school->school_name ?? 'Unknown School') ?>,
                    <?php endforeach; ?>
                ],

                datasets: [

                    {
                        label: 'Students',

                        data: [
                            <?php foreach ($schoolOverview as $school): ?>
                                <?= (int) ($school->student_count ?? 0) ?>,
                            <?php endforeach; ?>
                        ],

                        backgroundColor: '#a32675',

                        borderRadius: 6,

                        borderSkipped: false
                    },

                    {
                        label: 'Staff',

                        data: [
                            <?php foreach ($schoolOverview as $school): ?>
                                <?= (int) ($school->staff_count ?? 0) ?>,
                            <?php endforeach; ?>
                        ],

                        backgroundColor: '#6b7280',

                        borderRadius: 6,

                        borderSkipped: false
                    },

                    {
                        label: 'Admins',

                        data: [
                            <?php foreach ($schoolOverview as $school): ?>
                                <?= (int) ($school->admin_count ?? 0) ?>,
                            <?php endforeach; ?>
                        ],

                        backgroundColor: '#303641',

                        borderRadius: 6,

                        borderSkipped: false
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {

                    legend: {
                        position: 'top',

                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            padding: 18,
                            font: {
                                size: 11
                            }
                        }
                    }

                },

                scales: {

                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#737983',
                            font: {
                                size: 10
                            }
                        }
                    },

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: '#737983',
                            font: {
                                size: 10
                            }
                        },

                        grid: {
                            color: '#eef0f2'
                        }

                    }

                }

            }

        });

    }
</script>

</body>

</html>