<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* ========================================
   USER ROLE
======================================== */

$rank = $_SESSION['rank'] ?? '';


/* ========================================
   DASHBOARD URL
======================================== */

if ($rank === 'super_admin') {

    $dashboardUrl = ROOT . '/superadmin';

    $roleName = 'Super Admin';

} elseif ($rank === 'admin') {

    $dashboardUrl = ROOT . '/school-admin';

    $roleName = 'School Admin';

} elseif ($rank === 'teacher') {

    $dashboardUrl = ROOT . '/home';

    $roleName = 'Teacher';

} elseif ($rank === 'student') {

    $dashboardUrl = ROOT . '/home';

    $roleName = 'Student';

} elseif ($rank === 'parent') {

    $dashboardUrl = ROOT . '/home';

    $roleName = 'Parent';

} else {

    $dashboardUrl = ROOT . '/home';

    $roleName = 'User';

}


/* ========================================
   USER INFORMATION
======================================== */

$firstname =
    $_SESSION['firstname']
    ?? 'User';


$initial = strtoupper(
    substr(
        $firstname,
        0,
        1
    )
);

?>

<!-- ========================================
     TOP NAVBAR
======================================== -->

<header class="top-navbar">

    <div class="top-navbar-container">


        <!-- ====================================
             LEFT SIDE
        ===================================== -->

        <div class="navbar-left">


            <!-- SIDEBAR TOGGLE -->

            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarToggle"
                aria-label="Open navigation"
                aria-controls="sidebar"
                aria-expanded="false"
            >

                <span></span>
                <span></span>
                <span></span>

            </button>


            <!-- BRAND -->

            <a
                href="<?= $dashboardUrl ?>"
                class="navbar-brand"
            >
                My School
            </a>

        </div>



        <!-- ====================================
             SEARCH
        ===================================== -->

        <div class="navbar-search" id="navbarSearch">

    <span class="search-icon">
        ⌕
    </span>

    <input
        type="search"
        id="globalSearch"
        placeholder="Search anything..."
        autocomplete="off"
        aria-label="Search"
    >

    <span class="search-shortcut">
        /
    </span>


    <!-- SEARCH RESULTS -->

    <!-- SEARCH RESULTS -->

<div
    class="search-dropdown"
    id="searchDropdown"
>

    <!-- MANAGEMENT -->
    <div class="search-section">

        <div class="search-section-title">
            MANAGEMENT
        </div>


        <?php if ($rank === 'super_admin'): ?>

            <!-- SCHOOLS -->
            <a
                href="<?= ROOT ?>/schools"
                class="search-item"
                data-search="schools school management"
            >
                <span class="search-item-icon">
                    ▣
                </span>

                <span class="search-item-content">
                    <strong>Schools</strong>

                    <small>
                        Manage schools
                    </small>
                </span>
            </a>


            <!-- USERS -->
            <a
                href="<?= ROOT ?>/users"
                class="search-item"
                data-search="users user management"
            >
                <span class="search-item-icon">
                    👥
                </span>

                <span class="search-item-content">
                    <strong>Users</strong>

                    <small>
                        Manage system users
                    </small>
                </span>
            </a>

        <?php endif; ?>

    </div>


    <!-- PEOPLE -->

    <div class="search-section">

        <div class="search-section-title">
            PEOPLE
        </div>


        <!-- STUDENTS -->

        <a
            href="<?= ROOT ?>/students"
            class="search-item"
            data-search="students student people"
        >
            <span class="search-item-icon">
                🎓
            </span>

            <span class="search-item-content">
                <strong>Students</strong>

                <small>
                    Manage student records
                </small>
            </span>
        </a>


        <!-- STAFF -->

        <a
            href="<?= ROOT ?>/staff"
            class="search-item"
            data-search="staff teacher teachers people"
        >
            <span class="search-item-icon">
                👨‍🏫
            </span>

            <span class="search-item-content">
                <strong>Staff</strong>

                <small>
                    Manage staff members
                </small>
            </span>
        </a>


        <!-- PARENTS -->

        <a
            href="<?= ROOT ?>/parents"
            class="search-item"
            data-search="parents parent people"
        >
            <span class="search-item-icon">
                👨‍👩‍👧
            </span>

            <span class="search-item-content">
                <strong>Parents</strong>

                <small>
                    Manage parents
                </small>
            </span>
        </a>

    </div>


    <!-- ACADEMICS -->

    <div class="search-section">

        <div class="search-section-title">
            ACADEMICS
        </div>


        <!-- TESTS -->

        <a
            href="<?= ROOT ?>/classes"
            class="search-item"
            data-search="classes class division academics"
        >
            <span class="search-item-icon">
                🏫
            </span>

            <span class="search-item-content">
                <strong>Classes</strong>

                <small>
                    Manage classes and divisions
                </small>
            </span>
        </a>

        <a
            href="<?= ROOT ?>/tests"
            class="search-item"
            data-search="tests test exam assessment academics"
        >
            <span class="search-item-icon">
                📝
            </span>

            <span class="search-item-content">
                <strong>Tests</strong>

                <small>
                    Manage assessments
                </small>
            </span>
        </a>


        <!-- RESULTS -->

        <a
            href="<?= ROOT ?>/results"
            class="search-item"
            data-search="results result marks academics"
        >
            <span class="search-item-icon">
                📊
            </span>

            <span class="search-item-content">
                <strong>Results</strong>

                <small>
                    View academic results
                </small>
            </span>
        </a>


        <!-- SCHOOL ADMINS -->

        <?php if ($rank === 'super_admin'): ?>

            <a
                href="<?= ROOT ?>/schooladmins"
                class="search-item"
                data-search="school admins school administrators management"
            >
                <span class="search-item-icon">
                    🧑‍💼
                </span>

                <span class="search-item-content">
                    <strong>School Admins</strong>

                    <small>
                        Manage school administrators
                    </small>
                </span>
            </a>

        <?php endif; ?>

    </div>


    <!-- NO RESULTS -->

    <div
        class="search-no-results"
        id="searchNoResults"
    >
        No matching pages found.
    </div>

</div>

</div>



        <!-- ====================================
             RIGHT SIDE
        ===================================== -->

        <div class="navbar-right">


            <!-- =================================
                 NOTIFICATIONS
            ================================== -->

            <button
                type="button"
                class="navbar-icon-btn"
                aria-label="Notifications"
                title="Notifications"
            >

                <span class="navbar-icon">
                    ♧
                </span>

                <span class="notification-badge">
                    3
                </span>

            </button>



            <!-- =================================
                 MESSAGES
            ================================== -->

            <button
                type="button"
                class="navbar-icon-btn"
                aria-label="Messages"
                title="Messages"
            >

                <span class="navbar-icon">
                    ✉
                </span>

                <span class="message-badge">
                    2
                </span>

            </button>



            <!-- =================================
                 PROFILE
            ================================== -->

            <a
                href="<?= ROOT ?>/profile"
                class="navbar-profile"
            >

                <div class="navbar-avatar">

                    <?= htmlspecialchars($initial) ?>

                </div>


                <div class="navbar-user-info">

                    <strong>
                        <?= htmlspecialchars($firstname) ?>
                    </strong>

                    <span>
                        <?= htmlspecialchars($roleName) ?>
                    </span>

                </div>

                <!-- ====================================
     LOGOUT
===================================== -->

<a
    href="<?= ROOT ?>/logout"
    class="navbar-logout"
    title="Logout"
>
    <span class="logout-icon">↪</span>
    <span class="logout-text">Logout</span>
</a>

            </a>

        </div>

    </div>

</header>