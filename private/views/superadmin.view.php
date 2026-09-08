<?php

/* =====================================================
   SUPER ADMIN DASHBOARD
===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =====================================================
   USER INFORMATION
===================================================== */

$firstname = $_SESSION['firstname'] ?? 'Super Admin';

$initial = strtoupper(
    substr($firstname, 0, 1)
);


/* =====================================================
   KPI DATA
===================================================== */

$schoolCount =
    $data['schoolCount'] ?? 0;

$studentCount =
    $data['studentCount'] ?? 0;

$adminCount =
    $data['adminCount'] ?? 0;

$parentCount =
    $data['parentCount'] ?? 0;


/* =====================================================
   SCHOOL OVERVIEW
===================================================== */

$schoolOverview =
    $data['schoolOverview'] ?? [];


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
        href="<?= ROOT ?>/css/superadmin.view.css?v=6"
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


        <!-- =================================================
             DATE
        ================================================== -->

        <section class="dashboard-date">

            <p>
                <?= date('l, d F Y') ?>
            </p>

        </section>


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="dashboard-welcome">

            <div class="welcome-content">

                <p class="welcome-label">
                    SCHOOL OVERVIEW
                </p>


                <h1>

                    Welcome back,
                    <?= htmlspecialchars($firstname) ?> Admin

                </h1>


                <p class="welcome-description">

                    Here's an overview of your school
                    management system and recent activity.

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
                        Quickly manage your school system.
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



                <!-- ADD STUDENT -->

                <a
                    href="<?= ROOT ?>/students/create"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        +
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Add Student
                        </strong>

                        <small>
                            Register a new student
                        </small>

                    </span>

                    <span class="quick-action-arrow">
                        →
                    </span>

                </a>



                <!-- ADD PARENT -->

                <a
                    href="<?= ROOT ?>/parents/create"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        +
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Add Parent
                        </strong>

                        <small>
                            Create a parent account
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
                        System Overview
                    </h2>

                    <p>
                        Overview of your school management system.
                    </p>

                </div>

            </div>


            <div class="kpi-grid">


                <!-- SCHOOLS -->

                <a
                    href="<?= ROOT ?>/schools"
                    class="kpi-card"
                >

                    <div class="kpi-icon">
                        SC
                    </div>


                    <div class="kpi-content">

                        <span class="kpi-label">
                            Schools
                        </span>

                        <strong class="kpi-value">

                            <?= number_format($schoolCount) ?>

                        </strong>

                    </div>


                    <span class="kpi-arrow">
                        →
                    </span>

                </a>



                <!-- SCHOOL ADMINS -->

                <a
                    href="<?= ROOT ?>/schooladmins"
                    class="kpi-card"
                >

                    <div class="kpi-icon">
                        SA
                    </div>


                    <div class="kpi-content">

                        <span class="kpi-label">
                            School Admins
                        </span>

                        <strong class="kpi-value">

                            <?= number_format($adminCount) ?>

                        </strong>

                    </div>


                    <span class="kpi-arrow">
                        →
                    </span>

                </a>



                <!-- STUDENTS -->

                <a
                    href="<?= ROOT ?>/students"
                    class="kpi-card"
                >

                    <div class="kpi-icon">
                        ST
                    </div>


                    <div class="kpi-content">

                        <span class="kpi-label">
                            Students
                        </span>

                        <strong class="kpi-value">

                            <?= number_format($studentCount) ?>

                        </strong>

                    </div>


                    <span class="kpi-arrow">
                        →
                    </span>

                </a>



                <!-- PARENTS -->

                <a
                    href="<?= ROOT ?>/parents"
                    class="kpi-card"
                >

                    <div class="kpi-icon">
                        PR
                    </div>


                    <div class="kpi-content">

                        <span class="kpi-label">
                            Parents
                        </span>

                        <strong class="kpi-value">

                            <?= number_format($parentCount) ?>

                        </strong>

                    </div>


                    <span class="kpi-arrow">
                        →
                    </span>

                </a>


            </div>

        </section>



        <!-- =================================================
             SCHOOLS OVERVIEW
        ================================================== -->

        <section class="schools-overview-card">


            <div class="card-header">

                <div>

                    <h2>
                        Schools Overview
                    </h2>

                    <p>
                        Overview of schools registered in the system.
                    </p>

                </div>


                <a
                    href="<?= ROOT ?>/schools"
                    class="card-action"
                >
                    View All
                </a>

            </div>



            <div class="schools-overview-body">


                <?php if (!empty($schoolOverview)): ?>


                    <div class="schools-table-wrapper">

                        <table class="schools-overview-table">

                            <thead>

                                <tr>

                                    <th>
                                        School
                                    </th>

                                    <th>
                                        Students
                                    </th>

                                    <th>
                                        Staff
                                    </th>

                                    <th>
                                        Admin
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                <?php foreach ($schoolOverview as $school): ?>

                                    <tr>

                                        <td>

                                            <strong>
                                                <?= htmlspecialchars(
                                                    $school->school_name ?? 'School'
                                                ) ?>
                                            </strong>

                                        </td>


                                        <td>

                                            <?= number_format(
                                                $school->student_count ?? 0
                                            ) ?>

                                        </td>


                                        <td>

                                            <?= number_format(
                                                $school->staff_count ?? 0
                                            ) ?>

                                        </td>


                                        <td>

                                            <?= number_format(
                                                $school->admin_count ?? 0
                                            ) ?>

                                        </td>


                                        <td>

                                            <?php
                                            $status =
                                                strtolower(
                                                    $school->status ?? 'active'
                                                );
                                            ?>

                                            <span
                                                class="school-status <?= $status === 'active'
                                                    ? 'active'
                                                    : 'inactive' ?>"
                                            >

                                                <?= ucfirst($status) ?>

                                            </span>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>


                            </tbody>

                        </table>

                    </div>


                <?php else: ?>


                    <div class="dashboard-empty">

                        <h3>
                            No schools available
                        </h3>

                        <p>
                            Schools registered in the system will appear here.
                        </p>

                        <a href="<?= ROOT ?>/schools/create">
                            Add School
                        </a>

                    </div>


                <?php endif; ?>


            </div>

        </section>



        <!-- =================================================
             RECENT ACTIVITY
        ================================================== -->

        <section class="activity-card">


            <div class="card-header">

                <div>

                    <h2>
                        Recent Activity
                    </h2>

                    <p>
                        Latest updates across your school system.
                    </p>

                </div>


                <span class="activity-count">
                    Recent
                </span>

            </div>



            <div class="activity-list">


                <?php if (!empty($recentActivities)): ?>


                    <?php foreach ($recentActivities as $activity): ?>


                        <div class="activity-item">


                            <!-- ACTIVITY ICON -->

                            <div class="activity-icon">

                                <?= htmlspecialchars(
                                    $activity['initials'] ?? 'MS'
                                ) ?>

                            </div>



                            <!-- ACTIVITY INFORMATION -->

                            <div class="activity-info">

                                <strong>

                                    <?= htmlspecialchars(
                                        $activity['title']
                                        ?? 'System activity'
                                    ) ?>

                                </strong>


                                <span>

                                    <?= htmlspecialchars(
                                        $activity['description']
                                        ?? 'A system update was recorded.'
                                    ) ?>

                                </span>

                            </div>



                            <!-- TIME -->

                            <time>

                                <?= htmlspecialchars(
                                    $activity['time'] ?? ''
                                ) ?>

                            </time>


                        </div>


                    <?php endforeach; ?>


                <?php else: ?>


                    <div class="activity-empty">

                        <div class="empty-icon">
                            ✓
                        </div>


                        <h3>
                            No recent activity
                        </h3>


                        <p>
                            Recent system activity will appear here.
                        </p>

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