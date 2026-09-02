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

    $dashboardUrl = ROOT . '/teacherDashboard';
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

$firstname = $_SESSION['firstname'] ?? 'User';


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

        <div
            class="navbar-search"
            id="navbarSearch"
        >

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



            <!-- ====================================
                 SEARCH RESULTS
            ===================================== -->

            <div
                class="search-dropdown"
                id="searchDropdown"
            >



                <!-- ====================================
                     SUPER ADMIN
                ===================================== -->

                <?php if ($rank === 'super_admin'): ?>


                    <!-- MANAGEMENT -->

                    <div class="search-section">

                        <div class="search-section-title">
                            MANAGEMENT
                        </div>


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

                                <strong>
                                    Schools
                                </strong>

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

                                <strong>
                                    Users
                                </strong>

                                <small>
                                    Manage system users
                                </small>

                            </span>

                        </a>

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

                                <strong>
                                    Students
                                </strong>

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

                                <strong>
                                    Staff
                                </strong>

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

                                <strong>
                                    Parents
                                </strong>

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


                        <!-- CLASSES -->

                        <a
                            href="<?= ROOT ?>/classes"
                            class="search-item"
                            data-search="classes class division academics"
                        >

                            <span class="search-item-icon">
                                🏫
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Classes
                                </strong>

                                <small>
                                    Manage classes and divisions
                                </small>

                            </span>

                        </a>



                        <!-- TESTS -->

                        <a
                            href="<?= ROOT ?>/tests"
                            class="search-item"
                            data-search="tests test exam assessment academics"
                        >

                            <span class="search-item-icon">
                                📝
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Tests
                                </strong>

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

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View academic results
                                </small>

                            </span>

                        </a>



                        <!-- SCHOOL ADMINS -->

                        <a
                            href="<?= ROOT ?>/schooladmins"
                            class="search-item"
                            data-search="school admins school administrators management"
                        >

                            <span class="search-item-icon">
                                🧑‍💼
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    School Admins
                                </strong>

                                <small>
                                    Manage school administrators
                                </small>

                            </span>

                        </a>

                    </div>


                <?php endif; ?>



                <!-- ====================================
                     SCHOOL ADMIN
                ===================================== -->

                <?php if ($rank === 'admin'): ?>


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

                                <strong>
                                    Students
                                </strong>

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

                                <strong>
                                    Staff
                                </strong>

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

                                <strong>
                                    Parents
                                </strong>

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


                        <!-- CLASSES -->

                        <a
                            href="<?= ROOT ?>/classes"
                            class="search-item"
                            data-search="classes class division academics"
                        >

                            <span class="search-item-icon">
                                🏫
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Classes
                                </strong>

                                <small>
                                    Manage classes and divisions
                                </small>

                            </span>

                        </a>



                        <!-- TESTS -->

                        <a
                            href="<?= ROOT ?>/tests"
                            class="search-item"
                            data-search="tests test exam assessment academics"
                        >

                            <span class="search-item-icon">
                                📝
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Tests
                                </strong>

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

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View academic results
                                </small>

                            </span>

                        </a>



                        <!-- ATTENDANCE -->

                        <a
                            href="<?= ROOT ?>/attendance"
                            class="search-item"
                            data-search="attendance students academics"
                        >

                            <span class="search-item-icon">
                                ✓
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Attendance
                                </strong>

                                <small>
                                    Manage student attendance
                                </small>

                            </span>

                        </a>



                        <!-- FEES -->

                        <a
                            href="<?= ROOT ?>/fees"
                            class="search-item"
                            data-search="fees fee payments finance"
                        >

                            <span class="search-item-icon">
                                ₹
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Fees
                                </strong>

                                <small>
                                    Manage school fees
                                </small>

                            </span>

                        </a>



                        <!-- NOTICES -->

                        <a
                            href="<?= ROOT ?>/notices"
                            class="search-item"
                            data-search="notices notice announcements"
                        >

                            <span class="search-item-icon">
                                ▤
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Notices
                                </strong>

                                <small>
                                    Manage school notices
                                </small>

                            </span>

                        </a>

                    </div>


                <?php endif; ?>



                <!-- ====================================
                     TEACHER
                ===================================== -->

                <?php if ($rank === 'teacher'): ?>


                    <div class="search-section">

                        <div class="search-section-title">
                            TEACHING
                        </div>


                        <!-- STUDENTS -->

                        <a
                            href="<?= ROOT ?>/teacherstudents"
                            class="search-item"
                            data-search="students student teaching"
                        >

                            <span class="search-item-icon">
                                🎓
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Students
                                </strong>

                                <small>
                                    View students assigned to your classes
                                </small>

                            </span>

                        </a>



                        <!-- CLASSES -->

                        <a
                            href="<?= ROOT ?>/teacherclasses"
                            class="search-item"
                            data-search="classes class division teaching"
                        >

                            <span class="search-item-icon">
                                🏫
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Classes
                                </strong>

                                <small>
                                    View your assigned classes and divisions
                                </small>

                            </span>

                        </a>



                        <!-- TESTS -->

                        <a
                            href="<?= ROOT ?>/teachertests"
                            class="search-item"
                            data-search="tests test exam assessment teaching"
                        >

                            <span class="search-item-icon">
                                📝
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Tests
                                </strong>

                                <small>
                                    Create and manage tests for your students
                                </small>

                            </span>

                        </a>



                        <!-- RESULTS -->

                        <a
                            href="<?= ROOT ?>/teacherresults"
                            class="search-item"
                            data-search="results result marks performance teaching"
                        >

                            <span class="search-item-icon">
                                📊
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View student test results and performance
                                </small>

                            </span>

                        </a>



                        <!-- PARENTS -->

                        <a
                            href="<?= ROOT ?>/teacherparents"
                            class="search-item"
                            data-search="parents parent students teaching"
                        >

                            <span class="search-item-icon">
                                👨‍👩‍👧
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Parents
                                </strong>

                                <small>
                                    View parents associated with your students
                                </small>

                            </span>

                        </a>

                    </div>


                <?php endif; ?>



                <!-- ====================================
                     STUDENT
                ===================================== -->

                <?php if ($rank === 'student'): ?>


                    <div class="search-section">

                        <div class="search-section-title">
                            ACADEMICS
                        </div>


                        <!-- CLASSES -->

                        <a
                            href="<?= ROOT ?>/classes"
                            class="search-item"
                            data-search="classes class division student"
                        >

                            <span class="search-item-icon">
                                🏫
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Classes
                                </strong>

                                <small>
                                    View your classes and divisions
                                </small>

                            </span>

                        </a>



                        <!-- TESTS -->

                        <a
                            href="<?= ROOT ?>/tests"
                            class="search-item"
                            data-search="tests test exam student"
                        >

                            <span class="search-item-icon">
                                📝
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Tests
                                </strong>

                                <small>
                                    View your tests and assessments
                                </small>

                            </span>

                        </a>



                        <!-- RESULTS -->

                        <a
                            href="<?= ROOT ?>/results"
                            class="search-item"
                            data-search="results result marks student"
                        >

                            <span class="search-item-icon">
                                📊
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View your academic results
                                </small>

                            </span>

                        </a>

                    </div>


                <?php endif; ?>



                <!-- ====================================
                     PARENT
                ===================================== -->

                <?php if ($rank === 'parent'): ?>


                    <div class="search-section">

                        <div class="search-section-title">
                            STUDENT INFORMATION
                        </div>


                        <!-- RESULTS -->

                        <a
                            href="<?= ROOT ?>/results"
                            class="search-item"
                            data-search="results result marks child student parent"
                        >

                            <span class="search-item-icon">
                                📊
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View your child's results
                                </small>

                            </span>

                        </a>


                    </div>


                <?php endif; ?>



                <!-- ====================================
                     NO RESULTS
                ===================================== -->

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

            </a>



            <!-- =================================
                 LOGOUT
            ================================== -->

            <a
                href="<?= ROOT ?>/logout"
                class="navbar-logout"
                title="Logout"
            >

                <span class="logout-icon">
                    ↪
                </span>

                <span class="logout-text">
                    Logout
                </span>

            </a>


        </div>

    </div>

</header>