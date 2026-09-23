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
        href="<?= ROOT ?>/css/superadmin.view.css?v=12"
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
        <?= htmlspecialchars(
            SettingsHelper::currentTime()
        ) ?>
    </p>

</section>


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?> Admin

                </h1>


                <p class="welcome-description">

                    Here's an overview of your platform and recent system activity.

                </p>

            </div>

        </section>



        <!-- =================================================
             QUICK ACTIONS
        ================================================== -->

        <section class="quick-actions-section">

            <div class="section-heading">

                <div>

                    <h2>
                        Quick Actions
                    </h2>

                    <p>
                        Manage your platform quickly.
                    </p>

                </div>

            </div>


            <div class="quick-actions">


                <!-- ADD SCHOOL -->

                <a
                    href="<?= ROOT ?>/schools/create"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        +
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Add School
                        </strong>

                        <small>
                            Register a new school
                        </small>

                    </span>

                    <span class="quick-action-arrow">
                        →
                    </span>

                </a>



                <!-- ADD SCHOOL ADMIN -->

                <a
                    href="<?= ROOT ?>/schooladmins/create"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        +
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Add School Admin
                        </strong>

                        <small>
                            Create a school administrator
                        </small>

                    </span>

                    <span class="quick-action-arrow">
                        →
                    </span>

</a>        


            </div>

        </section>



        <!-- =================================================
             SYSTEM OVERVIEW
        ================================================== -->

        <section class="system-overview-section">


            <div class="section-heading">

                <div>

                    <h2>
                        Platform Overview
                    </h2>

                    <p>
                        Monitor your schools, users, and platform activity.
                    </p>

                </div>

            </div>


            <div class="kpi-grid">


    <!-- TOTAL SCHOOLS -->

    <a
        href="<?= ROOT ?>/schools"
        class="kpi-card"
    >

        <div class="kpi-icon">
            SC
        </div>


        <div class="kpi-content">

            <span class="kpi-label">
                Total Schools
            </span>

            <strong class="kpi-value">

                <?= number_format($totalSchools) ?>

            </strong>

        </div>


        <span class="kpi-arrow">
            →
        </span>

    </a>



    <!-- ACTIVE SCHOOLS -->

    <a
        href="<?= ROOT ?>/schools?status=active"
        class="kpi-card"
    >

        <div class="kpi-icon">
            AC
        </div>


        <div class="kpi-content">

            <span class="kpi-label">
                Active Schools
            </span>

            <strong class="kpi-value">

                <?= number_format($activeSchools) ?>

            </strong>

        </div>


        <span class="kpi-arrow">
            →
        </span>

    </a>



    <!-- INACTIVE SCHOOLS -->

    <a
        href="<?= ROOT ?>/schools?status=inactive"
        class="kpi-card"
    >

        <div class="kpi-icon">
            IN
        </div>


        <div class="kpi-content">

            <span class="kpi-label">
                Inactive Schools
            </span>

            <strong class="kpi-value">

                <?= number_format($inactiveSchools) ?>

            </strong>

        </div>


        <span class="kpi-arrow">
            →
        </span>

    </a>



    <!-- TOTAL USERS -->

    <a
        href="<?= ROOT ?>/users"
        class="kpi-card"
    >

        <div class="kpi-icon">
            US
        </div>


        <div class="kpi-content">

            <span class="kpi-label">
                Total Users
            </span>

            <strong class="kpi-value">

                <?= number_format($totalUsers) ?>

            </strong>

        </div>


        <span class="kpi-arrow">
            →
        </span>

    </a>


</div>

        </section>

        <!-- =================================================
     USER DISTRIBUTION
================================================== -->

<section class="user-distribution-section">

    <div class="section-heading">

        <div>

            <h2>
                User Distribution
            </h2>

            <p>
                Active users across the platform by role.
            </p>

        </div>

    </div>


    <div class="user-distribution-grid">


        <!-- STUDENTS -->

        <a
            href="<?= ROOT ?>/users?role=student"
            class="user-distribution-card"
        >

            <div class="user-distribution-icon">
                ST
            </div>

            <div class="user-distribution-content">

                <span class="user-distribution-label">
                    Students
                </span>

                <strong class="user-distribution-value">
                    <?= number_format($studentCount) ?>
                </strong>

            </div>

        </a>



        <!-- TEACHERS -->

        <a
            href="<?= ROOT ?>/users?role=teacher"
            class="user-distribution-card"
        >

            <div class="user-distribution-icon">
                TC
            </div>

            <div class="user-distribution-content">

                <span class="user-distribution-label">
                    Teachers
                </span>

                <strong class="user-distribution-value">
                    <?= number_format($teacherCount) ?>
                </strong>

            </div>

        </a>



        <!-- PARENTS -->

        <a
            href="<?= ROOT ?>/users?role=parent"
            class="user-distribution-card"
        >

            <div class="user-distribution-icon">
                PR
            </div>

            <div class="user-distribution-content">

                <span class="user-distribution-label">
                    Parents
                </span>

                <strong class="user-distribution-value">
                    <?= number_format($parentCount) ?>
                </strong>

            </div>

        </a>



        <!-- SCHOOL ADMINS -->

        <a
            href="<?= ROOT ?>/users?role=admin"
            class="user-distribution-card"
        >

            <div class="user-distribution-icon">
                SA
            </div>

            <div class="user-distribution-content">

                <span class="user-distribution-label">
                    School Admins
                </span>

                <strong class="user-distribution-value">
                    <?= number_format($adminCount) ?>
                </strong>

            </div>

        </a>


    </div>

</section>


<!-- =================================================
     SCHOOLS OVERVIEW
================================================== -->

<section class="schools-overview-section">

    <div class="section-heading">

        <div>

            <h2>
                Schools Overview
            </h2>

            <p>
                Monitor schools and their current platform status.
            </p>

        </div>

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

                            <tr>

                                <!-- SCHOOL -->

                                <td>

                                    <div class="school-name-cell">

                                        <div class="school-avatar">
                                            <?= strtoupper(
                                                substr(
                                                    $school->school_name ?? 'S',
                                                    0,
                                                    1
                                                )
                                            ) ?>
                                        </div>

                                        <div class="school-name-content">

                                            <strong>
                                                <?= htmlspecialchars(
                                                    $school->school_name ?? 'Unnamed School'
                                                ) ?>
                                            </strong>

                                        </div>

                                    </div>

                                </td>


                                <!-- STUDENTS -->

                                <td>

                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->student_count ?? 0
                                        ) ?>
                                    </span>

                                </td>


                                <!-- STAFF -->

                                <td>

                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->staff_count ?? 0
                                        ) ?>
                                    </span>

                                </td>


                                <!-- ADMIN -->

                                <td>

                                    <span class="school-table-number">
                                        <?= number_format(
                                            $school->admin_count ?? 0
                                        ) ?>
                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php
                                    $status = strtolower(
                                        trim($school->status ?? '')
                                    );

                                    $isActive = $status === 'active';
                                    ?>

                                    <span
                                        class="school-status-badge <?= $isActive ? 'active' : 'inactive' ?>"
                                    >

                                        <span class="school-status-dot"></span>

                                        <?= $isActive ? 'Active' : 'Inactive' ?>

                                    </span>

                                </td>


                                <!-- ACTION -->

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

                <div class="schools-empty-icon">
                    SC
                </div>

                <h3>
                    No schools found
                </h3>

                <p>
                    There are currently no schools available on the platform.
                </p>

                <a
                    href="<?= ROOT ?>/schools"
                    class="section-action"
                >
                    Manage Schools
                </a>

            </div>

        <?php endif; ?>

    </div>

</section>


<!-- =================================================
     SCHOOLS REQUIRING ATTENTION
================================================== -->

<section class="schools-attention-section">

    <div class="section-heading">

        <div>

            <h2>
                Schools Requiring Attention
            </h2>

            <p>
                Schools that are currently inactive or need review.
            </p>

        </div>

        

    </div>


    <div class="schools-attention-card">

        <?php if (!empty($attentionSchools)): ?>

            <div class="attention-list">

                <?php foreach ($attentionSchools as $school): ?>

                    <div class="attention-item">

                        <div class="attention-school-info">

                            <div class="attention-school-icon">
                                <?= strtoupper(
                                    substr(
                                        $school->school_name ?? 'S',
                                        0,
                                        1
                                    )
                                ) ?>
                            </div>

                            <div class="attention-school-details">

                                <strong>
                                    <?= htmlspecialchars(
                                        $school->school_name ?? 'Unnamed School'
                                    ) ?>
                                </strong>

                                <span>
                                    School requires review
                                </span>

                            </div>

                        </div>


                        <div class="attention-school-right">

                            <span class="attention-status-badge">

                                <span class="attention-status-dot"></span>

                                <?= htmlspecialchars(
                                    ucfirst(
                                        strtolower(
                                            $school->status ?? 'Inactive'
                                        )
                                    )
                                ) ?>

                            </span>


                            <?php if (!empty($school->id)): ?>

                               <a
                                    href="<?= ROOT ?>/schools"
                                    class="school-view-action"
                                >
                                    View
                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="attention-empty-state">

                <div class="attention-empty-icon">
                    ✓
                </div>

                <div>

                    <strong>
                        All schools are active
                    </strong>

                    <p>
                        There are currently no schools requiring attention.
                    </p>

                </div>

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