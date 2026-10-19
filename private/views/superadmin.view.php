<?php

/* =====================================================
   SUPER ADMIN DASHBOARD
===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../private/core/SettingsHelper.php";


/* =====================================================
   USER INFORMATION
===================================================== */

$firstname = $_SESSION['firstname'] ?? 'Super Admin';

$initial = strtoupper(
    substr($firstname, 0, 1)
);


/* =====================================================
   PLATFORM KPI DATA
===================================================== */

$totalSchools =
    $data['totalSchools'] ?? 0;

$activeSchools =
    $data['activeSchools'] ?? 0;

$inactiveSchools =
    $data['inactiveSchools'] ?? 0;

$totalUsers =
    $data['totalUsers'] ?? 0;


/* =====================================================
   USER DISTRIBUTION DATA
===================================================== */

$studentCount =
    $data['studentCount'] ?? 0;

$teacherCount =
    $data['teacherCount'] ?? 0;

$parentCount =
    $data['parentCount'] ?? 0;

$adminCount =
    $data['adminCount'] ?? 0;


/* =====================================================
   SCHOOL OVERVIEW
===================================================== */

$schoolOverview =
    $data['schoolOverview'] ?? [];

/* =====================================================
   SCHOOLS REQUIRING ATTENTION
===================================================== */

$attentionSchools =
    $data['attentionSchools'] ?? [];


/* =====================================================
   RECENT ACTIVITY
===================================================== */

$recentActivities =
    $data['recentActivities'] ?? [];

/* =====================================================
   PLATFORM GROWTH DATA
===================================================== */

$growthData = $data['growthData'] ?? ['schools' => [], 'students' => [], 'users' => []];

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
        Super Admin Dashboard - My School
    </title>


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- SUPER ADMIN CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css?v=17"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >


<style>
.dashboard-range-form { margin: 0; }
.dashboard-range { cursor: pointer; }
.dashboard-range select {
    appearance: none;
    -webkit-appearance: none;
    border: 0;
    outline: 0;
    background: transparent;
    color: inherit;
    font: inherit;
    cursor: pointer;
    min-width: 112px;
}
.dashboard-range select option { color: #111; background: #fff; }
.dashboard-range:focus-within { outline: 2px solid #777; outline-offset: 3px; }
</style>

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
     MAIN DASHBOARD
===================================================== -->

<main class="superadmin-page">

    <div class="superadmin-container">

<section class="dashboard-date">
    <p>
        <?= htmlspecialchars(date('l, d F Y')) ?>
        &nbsp; • &nbsp;
        <?= htmlspecialchars(SettingsHelper::currentTime()) ?>
    </p>
</section>

<div class="dashboard-top-row">
    <section class="dashboard-welcome">
        <div class="welcome-content">
            <h1>Welcome back, <?= htmlspecialchars($firstname) ?></h1>
            <p class="welcome-description">Here's an overview of your platform and recent system activity.</p>
        </div>
    </section>
    <?php
        $allowedDashboardRanges = ['7', '30', '90', '365', 'all'];
        $dashboardRange = (string) ($_GET['range'] ?? '30');
        if (!in_array($dashboardRange, $allowedDashboardRanges, true)) {
            $dashboardRange = '30';
        }
        $dashboardRangeLabels = [
            '7' => 'Last 7 days',
            '30' => 'Last 30 days',
            '90' => 'Last 90 days',
            '365' => 'Last 12 months',
            'all' => 'All time'
        ];
    ?>
    <form class="dashboard-range-form" method="get" action="">
        <label class="dashboard-range" for="dashboardRange" aria-label="Filter dashboard date range">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3.5" y="5" width="17" height="15" rx="2"></rect>
                <path d="M7.5 3.5v3M16.5 3.5v3M3.5 9.5h17"></path>
            </svg>
            <select id="dashboardRange" name="range" aria-label="Dashboard date range" onchange="this.form.submit()">
                <?php foreach ($dashboardRangeLabels as $rangeValue => $rangeLabel): ?>
                    <option value="<?= htmlspecialchars($rangeValue) ?>" <?= $dashboardRange === $rangeValue ? 'selected' : '' ?>>
                        <?= htmlspecialchars($rangeLabel) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m7 10 5 5 5-5"></path>
            </svg>
        </label>
    </form>
    <button type="button" class="dashboard-theme-toggle" id="dashboardThemeToggle" aria-label="Switch dashboard theme">
        <svg class="theme-icon theme-icon-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.5 15.2A8.5 8.5 0 0 1 8.8 3.5 8.7 8.7 0 1 0 20.5 15.2Z"/></svg>
        <svg class="theme-icon theme-icon-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/></svg>
        <span class="theme-toggle-label">Dark mode</span>
    </button>
</div>

<section class="dashboard-kpi-grid" aria-label="Platform statistics">
    <a href="<?= ROOT ?>/schools" class="dashboard-kpi-card">
        <span class="dashboard-kpi-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-5h6v5M8 10h2m4 0h2M8 13h2m4 0h2"></path>
            </svg>
        </span>
        <span class="dashboard-kpi-content">
            <span class="dashboard-kpi-label">Total Schools</span>
            <span class="dashboard-kpi-value-row"><strong class="dashboard-kpi-value"><?= number_format($totalSchools) ?></strong></span>
            <span class="dashboard-kpi-note"><strong><?= number_format($activeSchools) ?></strong> Active &nbsp;•&nbsp; <?= number_format($inactiveSchools) ?> Inactive</span>
        </span>
    </a>

    <a href="<?= ROOT ?>/users?role=student" class="dashboard-kpi-card">
        <span class="dashboard-kpi-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-1.7a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V21M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM16 3.2a4 4 0 0 1 0 7.6M18 15.3a4 4 0 0 1 4 4V21"></path>
            </svg>
        </span>
        <span class="dashboard-kpi-content">
            <span class="dashboard-kpi-label">Total Students</span>
            <span class="dashboard-kpi-value-row"><strong class="dashboard-kpi-value"><?= number_format($studentCount) ?></strong></span>
            <span class="dashboard-kpi-note">Across all schools</span>
        </span>
    </a>

    <a href="<?= ROOT ?>/users?role=teacher" class="dashboard-kpi-card">
        <span class="dashboard-kpi-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18M5 18V5h10v13M8 8h4m-4 3h4M17 8l4 2-4 2M17 10h-2M9 21v-3h3v3"></path>
                <circle cx="19" cy="5" r="2"></circle>
            </svg>
        </span>
        <span class="dashboard-kpi-content">
            <span class="dashboard-kpi-label">Total Teachers</span>
            <span class="dashboard-kpi-value-row"><strong class="dashboard-kpi-value"><?= number_format($teacherCount) ?></strong></span>
            <span class="dashboard-kpi-note">Registered teachers</span>
        </span>
    </a>

    <a href="<?= ROOT ?>/users?role=parent" class="dashboard-kpi-card">
        <span class="dashboard-kpi-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-1.7a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V21M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM16 4a3.5 3.5 0 0 1 0 7M18 15.5a4 4 0 0 1 4 4V21"></path>
            </svg>
        </span>
        <span class="dashboard-kpi-content">
            <span class="dashboard-kpi-label">Total Parents</span>
            <span class="dashboard-kpi-value-row"><strong class="dashboard-kpi-value"><?= number_format($parentCount) ?></strong></span>
            <span class="dashboard-kpi-note">Registered parents</span>
        </span>
    </a>
</section>

        <?php
            $schoolTotalForInsight = max(1, (int) $totalSchools);
            // Use the sum of displayed role counts so donut percentages stay consistent.
            $distributionTotal = (int) $studentCount + (int) $parentCount
                + (int) $teacherCount + (int) $adminCount;
            $userTotalForInsight = max(1, $distributionTotal);
            $studentPercent = round(((int) $studentCount / $userTotalForInsight) * 100);
            $parentPercent = round(((int) $parentCount / $userTotalForInsight) * 100);
            $teacherPercent = round(((int) $teacherCount / $userTotalForInsight) * 100);
            $adminPercent = max(0, 100 - $studentPercent - $parentPercent - $teacherPercent);
            $attentionRows = array_slice(is_array($attentionSchools) ? $attentionSchools : [], 0, 4);
        ?>

        <!-- PLATFORM GROWTH + USER DISTRIBUTION -->
        <section class="dashboard-analytics-grid" aria-label="Platform analytics">
            <article class="dashboard-panel growth-panel">
                <div class="dashboard-panel-heading">
                    <div>
                        <h2>Platform Growth</h2>
                        <p>New school registrations, students and users over time</p>
                    </div>
                    <div class="growth-tabs" role="group" aria-label="Growth metric">
                        <button type="button" class="growth-tab active" data-growth="schools" aria-pressed="true">Schools</button>
                        <button type="button" class="growth-tab" data-growth="students" aria-pressed="false">Students</button>
                        <button type="button" class="growth-tab" data-growth="users" aria-pressed="false">Users</button>
                    </div>
                </div>
                <div class="growth-chart-wrap">
                    <svg
                        class="growth-chart"
                        id="platformGrowthChart"
                        viewBox="0 0 720 190"
                        role="img"
                        aria-label="Monthly school registrations"
                        data-growth-chart
                    >
                        <defs>
                            <linearGradient id="growthAreaFill" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#777" stop-opacity=".38" />
                                <stop offset="100%" stop-color="#777" stop-opacity=".08" />
                            </linearGradient>
                        </defs>
                        <g class="chart-grid-lines" data-chart-grid></g>
                        <g class="chart-y-labels" data-chart-y-labels></g>
                        <path class="growth-area" data-growth-area d=""></path>
                        <path class="growth-line" data-growth-line d=""></path>
                        <g class="growth-points" data-growth-points></g>
                        <g class="chart-x-labels" data-chart-x-labels></g>
                    </svg>
                    <div class="growth-chart-tooltip" data-growth-tooltip role="status" aria-live="polite" hidden></div>
                </div>
            </article>

            <article class="dashboard-panel distribution-panel">
                <div class="dashboard-panel-heading">
                    <div><h2>User Distribution</h2><p>Total users by role</p></div>
                </div>
                <div class="distribution-content">
                    <div class="distribution-donut" style="--students: <?= $studentPercent ?>%; --parents: <?= $parentPercent ?>%; --teachers: <?= $teacherPercent ?>%; --admins: <?= $adminPercent ?>%;">
                        <div class="distribution-donut-center"><strong><?= number_format($distributionTotal) ?></strong><span>Active Users by Role</span></div>
                    </div>
                    <div class="distribution-legend">
                        <a href="<?= ROOT ?>/users?role=student" class="distribution-legend-row"><span class="distribution-dot students"></span><span>Students</span><strong><?= number_format($studentCount) ?></strong><small><?= $studentPercent ?>%</small></a>
                        <a href="<?= ROOT ?>/users?role=parent" class="distribution-legend-row"><span class="distribution-dot parents"></span><span>Parents</span><strong><?= number_format($parentCount) ?></strong><small><?= $parentPercent ?>%</small></a>
                        <a href="<?= ROOT ?>/users?role=teacher" class="distribution-legend-row"><span class="distribution-dot teachers"></span><span>Teachers</span><strong><?= number_format($teacherCount) ?></strong><small><?= $teacherPercent ?>%</small></a>
                        <a href="<?= ROOT ?>/users?role=admin" class="distribution-legend-row"><span class="distribution-dot admins"></span><span>School Admins</span><strong><?= number_format($adminCount) ?></strong><small><?= $adminPercent ?>%</small></a>
                    </div>
                </div>
            </article>
        </section>

        <!-- QUICK ACTIONS + SCHOOLS REQUIRING ATTENTION -->
        <section class="dashboard-lower-grid">
            <article class="dashboard-panel quick-actions-panel">
                <div class="dashboard-panel-heading">
                    <div><h2>Quick Actions</h2><p>Manage your platform quickly.</p></div>
                    <a class="dashboard-view-all" href="<?= ROOT ?>/schools">View All <span aria-hidden="true">→</span></a>
                </div>
                <div class="dashboard-quick-actions">
                    <a href="<?= ROOT ?>/schools/create" class="dashboard-action-tile">
                        <span class="dashboard-action-icon plus-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                        <strong>Add School</strong><small>Register a new school</small>
                    </a>
                    <a href="<?= ROOT ?>/schools" class="dashboard-action-tile">
                        <span class="dashboard-action-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-5h6v5M8 10h2m4 0h2m-6 3h2m4 0h2"/></svg></span>
                        <strong>Manage Schools</strong><small>View and edit schools</small>
                    </a>
                    <a href="<?= ROOT ?>/users" class="dashboard-action-tile">
                        <span class="dashboard-action-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-2a6 6 0 0 1 12 0v2M16 5a3 3 0 0 1 0 6m2 3a5 5 0 0 1 3 4v2"/></svg></span>
                        <strong>Manage Users</strong><small>Students, teachers, parents</small>
                    </a>
                    <a href="<?= ROOT ?>/reports" class="dashboard-action-tile">
                        <span class="dashboard-action-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 20V11h4v9M10 20V5h4v15M16 20V8h4v12M2 20h20"/></svg></span>
                        <strong>View Reports</strong><small>Platform analytics</small>
                    </a>
                </div>
            </article>

            <article class="dashboard-panel attention-panel">
                <div class="dashboard-panel-heading">
                    <div><h2>Schools Requiring Attention</h2><p>Schools that need your review or action.</p></div>
                    <a class="dashboard-view-all" href="<?= ROOT ?>/schools">View All <span aria-hidden="true">→</span></a>
                </div>
                <?php if (!empty($attentionRows)): ?>
                    <div class="attention-table-wrap">
                        <table class="dashboard-attention-table">
                            <thead><tr><th>School Name</th><th>Issue</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
                            <?php foreach ($attentionRows as $school): ?>
                                <?php
                                    $attentionName = $school->school_name ?? 'Unnamed School';
                                    $attentionStatus = ucfirst(strtolower(trim($school->status ?? 'Pending')));
                                    $attentionIssue = $school->issue ?? ($attentionStatus === 'Inactive' ? 'Inactive school' : 'School requires review');
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($attentionName) ?></td>
                                    <td><?= htmlspecialchars($attentionIssue) ?></td>
                                    <td><span class="dashboard-status-pill <?= strtolower($attentionStatus) === 'active' ? 'status-active' : (strtolower($attentionStatus) === 'inactive' ? 'status-inactive' : 'status-pending') ?>"><?= htmlspecialchars($attentionStatus) ?></span></td>
                                    <td><a class="dashboard-review-button" href="<?= ROOT ?>/schools">Review</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="dashboard-attention-empty"><strong>No schools require attention</strong><span>Schools needing review will appear here.</span></div>
                <?php endif; ?>
            </article>
        </section>

      
<!-- SCHOOLS OVERVIEW -->
<section class="schools-overview-section">

    <div class="section-heading">
        <div>
            <h2>Schools Overview</h2>
            <p>Monitor schools and their current platform status.</p>
        </div>

        <a href="<?= ROOT ?>/schools" class="section-action">
            View All <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="schools-overview-card">

        <?php if (!empty($schoolOverview)): ?>

            <div class="schools-table-wrapper">
                <table class="schools-overview-table">
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
                        <?php foreach ($schoolOverview as $school): ?>
                            <?php
                                $schoolName = $school->school_name
                                    ?? 'Unnamed School';

                                $status = strtolower(
                                    trim($school->status ?? '')
                                );

                                $isActive = $status === 'active';
                            ?>

                            <tr>
                                <td>
                                    <div class="school-name-cell">
                                        <div class="school-avatar">
                                            <?= htmlspecialchars(
                                                strtoupper(substr($schoolName, 0, 1))
                                            ) ?>
                                        </div>

                                        <div class="school-name-content">
                                            <strong>
                                                <?= htmlspecialchars($schoolName) ?>
                                            </strong>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->student_count ?? 0
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->staff_count ?? 0
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->admin_count ?? 0
                                        ) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="school-status-badge <?= $isActive ? 'active' : 'inactive' ?>">
                                        <span class="school-status-dot"></span>
                                        <?= $isActive ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if (!empty($school->id)): ?>
                                        <a
                                            href="<?= ROOT ?>/schools"
                                            class="school-view-action"
                                        >
                                            View
                                        </a>
                                    <?php else: ?>
                                        <span class="school-view-action disabled">
                                            View
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <div class="schools-empty-state">
                <div class="schools-empty-icon">SC</div>

                <div>
                    <h3>No schools found</h3>
                    <p>
                        There are currently no schools available on the platform.
                    </p>
                </div>

                <a href="<?= ROOT ?>/schools" class="section-action">
                    Manage Schools
                </a>
            </div>

        <?php endif; ?>

    </div>
</section>


<!-- =================================================
     PLATFORM HEALTH
================================================== -->

<?php
$platformHealth = $data['platformHealth'] ?? [];

$healthStatus = $platformHealth['status'] ?? 'Healthy';
$isHealthy = strtolower(trim($healthStatus)) === 'healthy';

$healthMetrics = [
    [
        'label' => 'Active Schools',
        'value' => $platformHealth['activeSchools'] ?? 0,
        'icon' => '✓'
    ],
    [
        'label' => 'Inactive Schools',
        'value' => $platformHealth['inactiveSchools'] ?? 0,
        'icon' => '!'
    ],
    [
        'label' => 'Total Users',
        'value' => $platformHealth['totalUsers'] ?? 0,
        'icon' => '♙'
    ]
];
?>




<!-- FINAL ROW: SECURITY OVERVIEW, PLATFORM HEALTH, RECENT ACTIVITY -->
<section class="dashboard-final-grid">

<!-- =================================================
     SECURITY OVERVIEW
================================================== -->

<?php
$securityOverview = $data['securityOverview'] ?? [];

$securityFeatures = [
    [
        'label' => 'Super Admin OTP',
        'description' => 'Email verification for Super Admin login.',
        'enabled' => !empty($securityOverview['superAdminOtp']),
        'icon' => 'shield'
    ],
    [
        'label' => 'Login Protection',
        'description' => 'Failed login attempts are tracked and temporarily restricted.',
        'enabled' => !empty($securityOverview['loginProtection']),
        'icon' => 'lock'
    ],
    [
        'label' => 'CAPTCHA Protection',
        'description' => 'Verification is triggered after failed login attempts.',
        'enabled' => !empty($securityOverview['captchaProtection']),
        'icon' => 'check'
    ]
];
?>

<section class="security-overview-section dashboard-panel-section">

    <div class="section-heading">
        <div>
            <h2>Security Overview</h2>
            <p>Monitor authentication and account protection.</p>
        </div>

        <a href="<?= ROOT ?>/security" class="section-action">
            Security Settings <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="security-overview-card redesigned-security-card">

        <div class="security-feature-list">
            <?php foreach ($securityFeatures as $feature): ?>

                <div class="security-feature-item redesigned-security-item">

                    <div class="security-feature-info">
                        <div class="security-feature-icon <?= $feature['enabled'] ? 'enabled' : 'disabled' ?>">
                            <?php if ($feature['icon'] === 'shield'): ?>
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 3 19 6v5c0 5-3 8-7 10-4-2-7-5-7-10V6l7-3Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            <?php elseif ($feature['icon'] === 'lock'): ?>
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="5" y="10" width="14" height="11" rx="2"/>
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                </svg>
                            <?php else: ?>
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M5 12 10 17 20 7"/>
                                </svg>
                            <?php endif; ?>
                        </div>

                        <div class="security-feature-content">
                            <strong><?= htmlspecialchars($feature['label']) ?></strong>
                            <span><?= htmlspecialchars($feature['description']) ?></span>
                        </div>
                    </div>

                    <span class="security-feature-status <?= $feature['enabled'] ? 'enabled' : 'disabled' ?>">
                        <span class="security-status-dot"></span>
                        <?= $feature['enabled'] ? 'Enabled' : 'Disabled' ?>
                    </span>

                </div>

            <?php endforeach; ?>
        </div>

    </div>

</section>


<!-- =================================================
     RECENT ACTIVITY
================================================== -->

<section class="platform-health-section dashboard-panel-section dashboard-reference-health">
    <div class="section-heading">
        <div>
            <h2>Platform Health</h2>
            <p>Overall system status and key metrics.</p>
        </div>
    </div>

    <?php
        $platformHealth = $data['platformHealth'] ?? [];
        $healthStatus = $platformHealth['status'] ?? 'Healthy';
        $isHealthy = strtolower(trim($healthStatus)) === 'healthy';
        $databaseStatus = $data['databaseStatus'] ?? 'Connected';
        $healthTotalUsers = (int) ($platformHealth['totalUsers'] ?? $totalUsers);
        $healthActiveSchools = (int) ($platformHealth['activeSchools'] ?? $activeSchools);
        $healthTotalSchools = (int) ($data['totalSchools'] ?? $totalSchools);
    ?>

    <div class="platform-health-reference-grid">
        <article class="platform-health-reference-card">
            <span class="platform-health-reference-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.2"/><path d="M3 20v-1.5a6 6 0 0 1 12 0V20M16 5.5a3 3 0 0 1 0 5.5M18 14a4 4 0 0 1 3 3.8V20"/></svg>
            </span>
            <span class="platform-health-reference-copy"><small>Total Users</small><strong><?= number_format($healthTotalUsers) ?></strong></span>
        </article>

        <article class="platform-health-reference-card">
            <span class="platform-health-reference-icon health-icon-good" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m7.5 12 3 3 6-6"/></svg>
            </span>
            <span class="platform-health-reference-copy"><small>Active Schools</small><strong><?= number_format($healthActiveSchools) ?> / <?= number_format($healthTotalSchools) ?></strong></span>
        </article>

        <article class="platform-health-reference-card">
            <span class="platform-health-reference-icon <?= $isHealthy ? 'health-icon-good' : 'health-icon-warning' ?>" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M12 2.8 20 6v5.2c0 4.6-3.1 8-8 10-4.9-2-8-5.4-8-10V6l8-3.2Z"/><path d="m8.5 12 2.3 2.3 4.8-5"/></svg>
            </span>
            <span class="platform-health-reference-copy"><small>System Status</small><strong><?= htmlspecialchars($healthStatus, ENT_QUOTES, 'UTF-8') ?></strong></span>
        </article>

        <article class="platform-health-reference-card">
            <span class="platform-health-reference-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v5c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10v5c0 1.7 3.6 3 8 3s8-1.3 8-3v-5M4 15v4c0 1.7 3.6 3 8 3s8-1.3 8-3v-4"/></svg>
            </span>
            <span class="platform-health-reference-copy"><small>Database Status</small><strong><?= htmlspecialchars($databaseStatus, ENT_QUOTES, 'UTF-8') ?></strong></span>
        </article>
    </div>
</section>
<section class="recent-activity-section dashboard-panel-section dashboard-reference-activity">
    <div class="section-heading">
        <div>
            <h2>Recent Activity</h2>
            <p>Latest actions across the platform.</p>
        </div>
        <a href="<?= ROOT ?>/activity" class="section-action">View All <span aria-hidden="true">→</span></a>
    </div>

    <div class="recent-activity-card dashboard-reference-activity-card">
        <?php if (!empty($recentActivities)): ?>
            <div class="recent-activity-table-wrap">
                <table class="recent-activity-table">
                    <thead><tr><th scope="col">#</th><th scope="col">Activity</th><th scope="col">Date &amp; Time</th><th scope="col">User</th></tr></thead>
                    <tbody>
                    <?php foreach ($recentActivities as $activityIndex => $activity): ?>
                        <?php
                            $activityType = strtolower(trim((string) ($activity['type'] ?? 'system')));
                            $activityTitle = (string) ($activity['title'] ?? 'System activity');
                            $activityDescription = (string) ($activity['description'] ?? '');
                            $activityDateTime = (string) ($activity['datetime'] ?? $activity['time'] ?? 'Recently');
                            $activityUser = (string) ($activity['user'] ?? ($activityType === 'user' ? 'School Admin' : 'System'));
                            $signals = ['user', 'student', 'teacher', 'parent', 'admin', 'account'];
                            $searchText = strtolower($activityType . ' ' . $activityTitle);
                            $isUserActivity = false;
                            foreach ($signals as $signal) {
                                if (strpos($searchText, $signal) !== false) {
                                    $isUserActivity = true;
                                    break;
                                }
                            }
                        ?>
                        <tr>
                            <td class="activity-row-number"><?= (int) $activityIndex + 1 ?></td>
                            <td>
                                <div class="activity-table-description">
                                    <span class="activity-table-icon" aria-hidden="true">
                                        <?php if ($isUserActivity): ?>
                                            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2Z"/></svg>
                                        <?php else: ?>
                                            <svg viewBox="0 0 24 24"><path d="M4 4h11l5 5v11H4Z"/><path d="M14 4v6h6M8 14h8M8 17h6"/></svg>
                                        <?php endif; ?>
                                    </span>
                                    <span class="activity-table-copy">
                                        <strong><?= htmlspecialchars($activityTitle, ENT_QUOTES, 'UTF-8') ?></strong>
                                        <?php if ($activityDescription !== ''): ?><small><?= htmlspecialchars($activityDescription, ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
                                    </span>
                                </div>
                            </td>
                            <td class="activity-table-time"><?= htmlspecialchars($activityDateTime, ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="activity-table-user"><?= htmlspecialchars($activityUser, ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="recent-activity-empty"><strong>No recent activity</strong><p>Recent platform activity will appear here.</p></div>
        <?php endif; ?>
    </div>
</section>
</div>




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


<style>
/* Bottom row: make all three panels stretch to the same row height. */
.dashboard-final-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, .9fr) minmax(0, 1fr);
    gap: 16px;
    align-items: stretch;
    margin-top: 16px;
}
.dashboard-final-grid > section {
    display: flex;
    flex-direction: column;
    align-self: stretch;
    min-width: 0;
    min-height: 0;
    margin: 0;
}
.dashboard-final-grid .section-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    flex: 0 0 auto;
    min-height: 48px;
    margin-bottom: 10px;
}
.dashboard-final-grid .security-overview-card,
.dashboard-final-grid .platform-health-reference-grid,
.dashboard-final-grid .dashboard-reference-activity-card {
    flex: 1 1 auto;
    min-height: 100%;
    height: 100%;
    box-sizing: border-box;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    overflow: hidden;
}
.dashboard-final-grid .security-overview-card {
    display: flex;
    flex-direction: column;
}
.dashboard-final-grid .security-feature-list {
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
    justify-content: space-evenly;
}
.dashboard-final-grid .security-feature-item {
    flex: 1 1 0;
    min-height: 58px;
}
.dashboard-final-grid .platform-health-reference-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    grid-auto-rows: minmax(76px, 1fr);
    align-content: stretch;
    gap: 8px;
    padding: 8px;
}
.dashboard-final-grid .dashboard-reference-activity-card {
    display: flex;
    flex-direction: column;
}
.recent-activity-table-wrap { width: 100%; overflow-x: auto; }
.recent-activity-table { width: 100%; border-collapse: collapse; color: #171717; font-size: 12px; }
.recent-activity-table thead { background: #f1f2f3; }
.recent-activity-table th { padding: 8px 10px; text-align: left; font-weight: 700; white-space: nowrap; }
.recent-activity-table td { padding: 7px 10px; border-top: 1px solid #ededed; vertical-align: middle; }
.recent-activity-table tbody tr:hover { background: #fafafa; }
.activity-row-number { width: 30px; color: #555; }
.activity-table-description { display: flex; align-items: center; gap: 8px; min-width: 180px; }
.activity-table-copy { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
.activity-table-copy strong { font-size: 12px; font-weight: 600; }
.activity-table-copy small { color: #777; font-size: 11px; line-height: 1.3; }
.activity-table-icon { display: inline-flex; align-items: center; justify-content: center; flex: 0 0 24px; width: 24px; height: 24px; border-radius: 6px; background: #f2f2f2; }
.activity-table-icon svg { width: 15px; height: 15px; fill: none; stroke: #111; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
.activity-table-time, .activity-table-user { white-space: nowrap; color: #333; }
.platform-health-reference-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px; padding: 8px; }
.platform-health-reference-card { display: flex; align-items: center; gap: 11px; min-width: 0; padding: 10px; border: 1px solid #e8e8e8; border-radius: 9px; background: #fff; }
.platform-health-reference-icon { display: flex; flex: 0 0 40px; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #f3f3f3; }
.platform-health-reference-icon svg { width: 23px; height: 23px; fill: none; stroke: #111; stroke-width: 1.7; stroke-linecap: round; stroke-linejoin: round; }
.platform-health-reference-icon svg circle { fill: #111; }
.platform-health-reference-icon svg circle + path { stroke: #fff; }
.platform-health-reference-copy { display: flex; flex-direction: column; gap: 3px; min-width: 0; }
.platform-health-reference-copy small { color: #666; font-size: 11px; }
.platform-health-reference-copy strong { color: #111; font-size: 16px; line-height: 1.25; overflow-wrap: anywhere; }
@media (max-width: 1100px) { .dashboard-final-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .dashboard-final-grid > section:first-child { grid-column: 1 / -1; } }
@media (max-width: 700px) { .dashboard-final-grid { grid-template-columns: 1fr; } .dashboard-final-grid > section:first-child { grid-column: auto; } }
@media (max-width: 1100px) {
    .dashboard-final-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .dashboard-final-grid > section:first-child { grid-column: 1 / -1; }
}
@media (max-width: 700px) {
    .dashboard-final-grid { grid-template-columns: minmax(0, 1fr); }
    .dashboard-final-grid > section:first-child { grid-column: auto; }
    .dashboard-final-grid .security-overview-card,
    .dashboard-final-grid .platform-health-reference-grid,
    .dashboard-final-grid .dashboard-reference-activity-card {
        height: auto;
        min-height: 0;
    }
}
@media (max-width: 520px) {
    .dashboard-final-grid .platform-health-reference-grid { grid-template-columns: 1fr; }
    .recent-activity-table { min-width: 570px; }
}
</style>

<style>
.growth-chart-wrap { position: relative; }
.growth-chart-tooltip {
    position: absolute; z-index: 5; pointer-events: none;
    padding: 9px 12px; border: 1px solid #d8d8d8; border-radius: 8px;
    background: #111; color: #fff; font-size: 12px; font-weight: 600;
    line-height: 1.4; white-space: nowrap; box-shadow: 0 5px 18px rgba(0,0,0,.16);
}
.growth-chart-tooltip[hidden] { display: none; }
.growth-points circle { cursor: crosshair; outline: none; transition: r .12s ease; }
.growth-points circle:hover, .growth-points circle:focus { r: 6; stroke: #fff; stroke-width: 2; }
</style>

<script>
(function () {
    'use strict';

    const growthData = <?= json_encode(
        $growthData,
        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
    ) ?>;

    const chart = document.querySelector('[data-growth-chart]');
    const tabs = document.querySelectorAll('.growth-tab');

    if (!chart || !tabs.length) return;

    const grid = chart.querySelector('[data-chart-grid]');
    const yLabels = chart.querySelector('[data-chart-y-labels]');
    const xLabels = chart.querySelector('[data-chart-x-labels]');
    const area = chart.querySelector('[data-growth-area]');
    const line = chart.querySelector('[data-growth-line]');
    const points = chart.querySelector('[data-growth-points]');
    const chartWrap = chart.closest('.growth-chart-wrap');
    const tooltip = chartWrap ? chartWrap.querySelector('[data-growth-tooltip]') : null;

    const NS = 'http://www.w3.org/2000/svg';
    const left = 42;
    const right = 700;
    const top = 20;
    const bottom = 160;
    const chartWidth = right - left;
    const chartHeight = bottom - top;

    function svgElement(tag, attrs, text) {
        const element = document.createElementNS(NS, tag);
        Object.keys(attrs || {}).forEach(function (key) {
            element.setAttribute(key, attrs[key]);
        });
        if (text !== undefined) element.textContent = text;
        return element;
    }

    function clear(element) {
        while (element.firstChild) element.removeChild(element.firstChild);
    }

    function renderChart(metric) {
        const records = Array.isArray(growthData[metric]) ? growthData[metric] : [];
        const values = records.map(function (record) {
            return Math.max(0, Number(record.total) || 0);
        });

        clear(grid);
        clear(yLabels);
        clear(xLabels);
        clear(points);
        if (tooltip) tooltip.hidden = true;

        if (!records.length) {
            area.setAttribute('d', '');
            line.setAttribute('d', '');
            chart.setAttribute('aria-label', 'No monthly registration data available');
            return;
        }

        const maxValue = Math.max(1, ...values);
        const step = Math.max(1, Math.ceil(maxValue / 4));
        const scaleMax = step * 4;

        for (let i = 0; i <= 4; i++) {
            const y = bottom - (chartHeight * i / 4);
            const value = Math.round(scaleMax * i / 4);

            grid.appendChild(svgElement('line', {
                x1: left, y1: y, x2: right, y2: y
            }));

            yLabels.appendChild(svgElement('text', {
                x: 29, y: y + 4
            }, String(value)));
        }

        const coords = records.map(function (record, index) {
            const x = records.length === 1
                ? left + chartWidth / 2
                : left + (chartWidth * index / (records.length - 1));
            const y = bottom - ((values[index] / scaleMax) * chartHeight);

            xLabels.appendChild(svgElement('text', {
                x: x, y: 180, 'text-anchor': 'middle'
            }, record.label || record.month_key || ''));

            return { x: x, y: y, value: values[index], label: record.label || record.month_key || '' };
        });

        const linePath = coords.map(function (point, index) {
            return (index === 0 ? 'M' : 'L') + point.x + ' ' + point.y;
        }).join(' ');

        const areaPath = linePath +
            ' L ' + coords[coords.length - 1].x + ' ' + bottom +
            ' L ' + coords[0].x + ' ' + bottom + ' Z';

        area.setAttribute('d', areaPath);
        line.setAttribute('d', linePath);

        coords.forEach(function (point) {
            const circle = svgElement('circle', {
                cx: point.x,
                cy: point.y,
                r: 4.5,
                tabindex: '0',
                role: 'img',
                'aria-label': point.label + ': ' + point.value + ' ' + (metric === 'schools' ? 'schools' : metric === 'students' ? 'students' : 'users'),
                class: 'growth-point-dot'
            });
            circle.appendChild(svgElement('title', {}, point.label + ': ' + point.value));

            function showTooltip(event) {
                if (!tooltip || !chartWrap) return;
                const wrapRect = chartWrap.getBoundingClientRect();
                let x;
                let y;

                if (event && typeof event.clientX === 'number' && event.clientX !== 0) {
                    x = event.clientX - wrapRect.left;
                    y = event.clientY - wrapRect.top;
                } else {
                    const svgPoint = chart.createSVGPoint();
                    svgPoint.x = point.x;
                    svgPoint.y = point.y;
                    const screenPoint = svgPoint.matrixTransform(chart.getScreenCTM());
                    x = screenPoint.x - wrapRect.left;
                    y = screenPoint.y - wrapRect.top;
                }

                const label = metric === 'schools' ? 'Schools' : metric === 'students' ? 'Students' : 'Users';
                tooltip.textContent = point.label + ' · ' + label + ': ' + point.value;
                tooltip.hidden = false;
                const tooltipWidth = tooltip.offsetWidth || 150;
                const tooltipHeight = tooltip.offsetHeight || 36;
                tooltip.style.left = Math.max(6, Math.min(x + 12, chartWrap.clientWidth - tooltipWidth - 6)) + 'px';
                tooltip.style.top = Math.max(4, Math.min(y - tooltipHeight - 10, chartWrap.clientHeight - tooltipHeight - 4)) + 'px';
            }

            circle.addEventListener('mouseenter', showTooltip);
            circle.addEventListener('mousemove', showTooltip);
            circle.addEventListener('focus', showTooltip);
            circle.addEventListener('mouseleave', function () { if (tooltip) tooltip.hidden = true; });
            circle.addEventListener('blur', function () { if (tooltip) tooltip.hidden = true; });
            points.appendChild(circle);
        });

        const metricLabels = {
            schools: 'school registrations',
            students: 'student registrations',
            users: 'user registrations'
        };
        chart.setAttribute('aria-label', 'Monthly ' + (metricLabels[metric] || 'registrations'));
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const metric = tab.getAttribute('data-growth');
            if (!Object.prototype.hasOwnProperty.call(growthData, metric)) return;

            tabs.forEach(function (otherTab) {
                const selected = otherTab === tab;
                otherTab.classList.toggle('active', selected);
                otherTab.setAttribute('aria-pressed', selected ? 'true' : 'false');
            });

            renderChart(metric);
        });
    });

    renderChart('schools');
})();
</script>


<script>
(function () {
    const root = document.documentElement;
    const button = document.getElementById('dashboardThemeToggle');
    if (!button) return;
    const label = button.querySelector('.theme-toggle-label');
    const saved = (() => { try { return localStorage.getItem('superadmin-theme'); } catch (e) { return null; } })();
    const preferred = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    function setTheme(theme) {
        root.setAttribute('data-theme', theme);
        button.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
        button.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
        if (label) label.textContent = theme === 'dark' ? 'Light mode' : 'Dark mode';
        try { localStorage.setItem('superadmin-theme', theme); } catch (e) {}
    }
    setTheme(saved === 'dark' || saved === 'light' ? saved : 'light');
    button.addEventListener('click', function () {
        setTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
    });
})();
</script>


<script>
/* MySchool sidebar layout: fixed on desktop, drawer on mobile. */
(function () {
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const mobileQuery = window.matchMedia('(max-width: 760px)');
    if (!sidebar || !toggle) return;

    const collapsedKey = 'myschool-sidebar-collapsed';
    try {
        if (localStorage.getItem(collapsedKey) === '1' && !mobileQuery.matches) {
            body.classList.add('sidebar-collapsed');
        }
    } catch (e) {}

    function setExpanded(expanded) {
        body.classList.toggle('sidebar-open', expanded && mobileQuery.matches);
        toggle.setAttribute('aria-expanded', String(expanded));
    }
    function closeMobile() {
        body.classList.remove('sidebar-open');
        if (overlay) overlay.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
    }
    if (overlay) overlay.setAttribute('aria-hidden', 'true');

    /* Capture the click so an older drawer handler cannot conflict. */
    document.addEventListener('click', function (event) {
        const clickedToggle = event.target.closest('#sidebarToggle');
        if (!clickedToggle) return;
        event.preventDefault();
        event.stopImmediatePropagation();
        if (mobileQuery.matches) {
            const open = !body.classList.contains('sidebar-open');
            body.classList.toggle('sidebar-open', open);
            if (overlay) overlay.setAttribute('aria-hidden', String(!open));
            toggle.setAttribute('aria-expanded', String(open));
        } else {
            const collapsed = body.classList.toggle('sidebar-collapsed');
            toggle.setAttribute('aria-expanded', String(!collapsed));
            try { localStorage.setItem(collapsedKey, collapsed ? '1' : '0'); } catch (e) {}
        }
    }, true);

    if (overlay) overlay.addEventListener('click', closeMobile);
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeMobile();
    });
    mobileQuery.addEventListener('change', function (event) {
        body.classList.remove('sidebar-open');
        if (event.matches) body.classList.remove('sidebar-collapsed');
        if (overlay) overlay.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', String(!event.matches && !body.classList.contains('sidebar-collapsed')));
    });
})();
</script>

</body>

</html>
