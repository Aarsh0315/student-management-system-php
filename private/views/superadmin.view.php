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
        href="<?= ROOT ?>/css/superadmin.view.css?v=14"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- FOOTER CSS -->

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
    <div class="dashboard-range" aria-label="Selected date range">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3.5" y="5" width="17" height="15" rx="2"></rect>
            <path d="M7.5 3.5v3M16.5 3.5v3M3.5 9.5h17"></path>
        </svg>
        <span>Last 30 days</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m7 10 5 5 5-5"></path>
        </svg>
    </div>
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
            $userTotalForInsight = max(1, (int) $totalUsers);
            $studentPercent = min(100, round(((int) $studentCount / $userTotalForInsight) * 100));
            $parentPercent = min(100, round(((int) $parentCount / $userTotalForInsight) * 100));
            $teacherPercent = min(100, round(((int) $teacherCount / $userTotalForInsight) * 100));
            $adminPercent = min(100, round(((int) $adminCount / $userTotalForInsight) * 100));
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
                    <svg class="growth-chart" viewBox="0 0 720 190" role="img" aria-label="Illustrative monthly platform growth chart">
                        <defs>
                            <linearGradient id="growthAreaFill" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#777" stop-opacity=".38" />
                                <stop offset="100%" stop-color="#777" stop-opacity=".08" />
                            </linearGradient>
                        </defs>
                        <g class="chart-grid-lines">
                            <line x1="42" y1="20" x2="700" y2="20"/><line x1="42" y1="55" x2="700" y2="55"/><line x1="42" y1="90" x2="700" y2="90"/><line x1="42" y1="125" x2="700" y2="125"/><line x1="42" y1="160" x2="700" y2="160"/>
                            <line x1="42" y1="20" x2="42" y2="160"/><line x1="115" y1="20" x2="115" y2="160"/><line x1="188" y1="20" x2="188" y2="160"/><line x1="261" y1="20" x2="261" y2="160"/><line x1="334" y1="20" x2="334" y2="160"/><line x1="407" y1="20" x2="407" y2="160"/><line x1="480" y1="20" x2="480" y2="160"/><line x1="553" y1="20" x2="553" y2="160"/><line x1="626" y1="20" x2="626" y2="160"/><line x1="700" y1="20" x2="700" y2="160"/>
                        </g>
                        <g class="chart-y-labels"><text x="29" y="164">0</text><text x="23" y="129">10</text><text x="23" y="94">20</text><text x="23" y="59">30</text><text x="23" y="24">40</text></g>
                        <path class="growth-area" d="M42 133 C68 127 89 119 115 135 S164 143 188 112 S236 112 261 123 S309 105 334 101 S382 76 407 88 S455 111 480 91 S529 71 553 66 S601 29 626 37 S674 57 700 63 L700 160 L42 160 Z"/>
                        <path class="growth-line" d="M42 133 C68 127 89 119 115 135 S164 143 188 112 S236 112 261 123 S309 105 334 101 S382 76 407 88 S455 111 480 91 S529 71 553 66 S601 29 626 37 S674 57 700 63"/>
                        <path class="growth-secondary-line" d="M42 145 L115 141 L188 145 L261 137 L334 139 L407 143 L480 136 L553 129 L626 120 L700 126"/>
                        <g class="growth-points"><circle cx="42" cy="133" r="3.8"/><circle cx="115" cy="135" r="3.8"/><circle cx="188" cy="112" r="3.8"/><circle cx="261" cy="123" r="3.8"/><circle cx="334" cy="101" r="3.8"/><circle cx="407" cy="88" r="3.8"/><circle cx="480" cy="91" r="3.8"/><circle cx="553" cy="66" r="3.8"/><circle cx="626" cy="37" r="3.8"/><circle cx="700" cy="63" r="3.8"/></g>
                        <g class="chart-x-labels"><text x="42" y="180">Jan</text><text x="115" y="180">Feb</text><text x="188" y="180">Mar</text><text x="261" y="180">Apr</text><text x="334" y="180">May</text><text x="407" y="180">Jun</text><text x="480" y="180">Jul</text><text x="553" y="180">Aug</text><text x="626" y="180">Sep</text><text x="700" y="180">Oct</text></g>
                    </svg>
                </div>
            </article>

            <article class="dashboard-panel distribution-panel">
                <div class="dashboard-panel-heading">
                    <div><h2>User Distribution</h2><p>Total users by role</p></div>
                </div>
                <div class="distribution-content">
                    <div class="distribution-donut" style="--students: <?= $studentPercent ?>%; --parents: <?= $parentPercent ?>%; --teachers: <?= $teacherPercent ?>%; --admins: <?= $adminPercent ?>%;">
                        <div class="distribution-donut-center"><strong><?= number_format($totalUsers) ?></strong><span>Total Users</span></div>
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
$platformHealth =
    $data['platformHealth'] ?? [];

$healthStatus =
    $platformHealth['status'] ?? 'Healthy';

$isHealthy =
    $healthStatus === 'Healthy';
?>

<section class="platform-health-section">

    <div class="section-heading">

        <div>

            <h2>
                Platform Health
            </h2>

            <p>
                Current health status of your platform.
            </p>

        </div>

    </div>


    <div class="platform-health-card">

        <!-- STATUS -->

        <div class="platform-health-status">

            <div class="platform-health-icon <?= $isHealthy ? 'healthy' : 'attention' ?>">

                <?= $isHealthy ? '✓' : '!' ?>

            </div>

            <div class="platform-health-status-content">

                <span>
                    Platform Status
                </span>

                <strong>
                    <?= htmlspecialchars($healthStatus) ?>
                </strong>

            </div>

        </div>


        <!-- METRICS -->

        <div class="platform-health-metrics">

            <div class="platform-health-metric">

                <span>
                    Active Schools
                </span>

                <strong>
                    <?= number_format(
                        $platformHealth['activeSchools'] ?? 0
                    ) ?>
                </strong>

            </div>


            <div class="platform-health-metric">

                <span>
                    Inactive Schools
                </span>

                <strong>
                    <?= number_format(
                        $platformHealth['inactiveSchools'] ?? 0
                    ) ?>
                </strong>

            </div>


            <div class="platform-health-metric">

                <span>
                    Total Users
                </span>

                <strong>
                    <?= number_format(
                        $platformHealth['totalUsers'] ?? 0
                    ) ?>
                </strong>

            </div>

        </div>

    </div>

</section>


<!-- =================================================
     SECURITY OVERVIEW
================================================== -->

<?php
$securityOverview =
    $data['securityOverview'] ?? [];

$securityFeatures = [
    [
        'label' => 'Super Admin OTP',
        'description' => 'Email verification is enabled for Super Admin login.',
        'enabled' => !empty($securityOverview['superAdminOtp'])
    ],
    [
        'label' => 'Login Protection',
        'description' => 'Failed login attempts are tracked and temporarily restricted.',
        'enabled' => !empty($securityOverview['loginProtection'])
    ],
    [
        'label' => 'CAPTCHA Protection',
        'description' => 'CAPTCHA verification is triggered after failed login attempts.',
        'enabled' => !empty($securityOverview['captchaProtection'])
    ]
];
?>

<section class="security-overview-section">

    <div class="section-heading">

        <div>

            <h2>
                Security Overview
            </h2>

            <p>
                Current authentication and account protection status.
            </p>

        </div>

        <a
            href="<?= ROOT ?>/security"
            class="section-action"
        >
            Security Settings
        </a>

    </div>


    <div class="security-overview-card">

        <div class="security-feature-list">

            <?php foreach ($securityFeatures as $feature): ?>

                <div class="security-feature-item">

                    <div class="security-feature-info">

                        <div class="security-feature-icon <?= $feature['enabled'] ? 'enabled' : 'disabled' ?>">

                            <?= $feature['enabled'] ? '✓' : '!' ?>

                        </div>

                        <div class="security-feature-content">

                            <strong>
                                <?= htmlspecialchars($feature['label']) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars($feature['description']) ?>
                            </span>

                        </div>

                    </div>


                    <span class="security-feature-status <?= $feature['enabled'] ? 'enabled' : 'disabled' ?>">

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

<section class="recent-activity-section">

    <div class="section-heading">

        <div>

            <h2>
                Recent Activity
            </h2>

            <p>
                Latest activity across the platform.
            </p>

        </div>

    </div>


    <div class="recent-activity-card">

        <?php if (!empty($recentActivities)): ?>

            <div class="recent-activity-list">

                <?php foreach ($recentActivities as $activity): ?>

                    <?php
                    $activityType =
                        $activity['type'] ?? 'system';

                    $activityInitials =
                        $activity['initials'] ?? 'SY';

                    $activityTitle =
                        $activity['title'] ?? 'System activity';

                    $activityDescription =
                        $activity['description'] ?? '';

                    $activityTime =
                        $activity['time'] ?? 'Recently';
                    ?>

                    <div class="recent-activity-item">

                        <div class="recent-activity-icon <?= htmlspecialchars($activityType) ?>">

                            <?= htmlspecialchars($activityInitials) ?>

                        </div>


                        <div class="recent-activity-content">

                            <strong>
                                <?= htmlspecialchars($activityTitle) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars($activityDescription) ?>
                            </span>

                        </div>


                        <time class="recent-activity-time">

                            <?= htmlspecialchars($activityTime) ?>

                        </time>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="recent-activity-empty">

                <div class="recent-activity-empty-icon">
                    AC
                </div>

                <div>

                    <strong>
                        No recent activity
                    </strong>

                    <p>
                        Recent platform activity will appear here.
                    </p>

                </div>

            </div>

        <?php endif; ?>

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


</body>

</html>