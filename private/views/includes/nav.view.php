<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| SYSTEM SETTINGS
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/../../models/SettingsModel.php';

$settingsModel = new SettingsModel();

$systemName =
    $settingsModel->get('system_name')
    ?: 'My School';


/*
=====================================================
USER ROLE
=====================================================
*/

$rank = $_SESSION['rank'] ?? '';


/*
=====================================================
DASHBOARD URL
=====================================================
*/

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

    $dashboardUrl = ROOT . '/studentDashboard';
    $roleName = 'Student';

} elseif ($rank === 'parent') {

    $dashboardUrl = ROOT . '/parentDashboard';
    $roleName = 'Parent';

} else {

    $dashboardUrl = ROOT . '/home';
    $roleName = 'User';

}


/*
=====================================================
USER INFORMATION
=====================================================
*/

$firstname = $_SESSION['firstname'] ?? 'User';

$initial = strtoupper(
    substr($firstname, 0, 1)
);

?>



<!-- =================================================
     TOP NAVBAR
================================================== -->

<header class="top-navbar">

    <div class="top-navbar-container">


        <!-- =================================================
             LEFT SIDE
        ================================================== -->

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
    <?= htmlspecialchars($systemName) ?>
</a>

        </div>



        <!-- =================================================
             SEARCH
        ================================================== -->

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



            <!-- =================================================
                 SEARCH RESULTS
            ================================================== -->

            <div
                class="search-dropdown"
                id="searchDropdown"
            >


               <!-- =================================================
     SUPER ADMIN
================================================== -->

<?php if ($rank === 'super_admin'): ?>


    <!-- PLATFORM -->

    <div class="search-section">

        <div class="search-section-title">
            PLATFORM
        </div>


        <!-- SCHOOLS -->

        <a
            href="<?= ROOT ?>/schools"
            class="search-item"
            data-search="schools school platform management"
        >

            <span class="search-item-icon">
                SC
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


        <!-- SCHOOL ADMINS -->

        <a
            href="<?= ROOT ?>/schooladmins"
            class="search-item"
            data-search="school admins school administrators platform"
        >

            <span class="search-item-icon">
                SA
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


        <!-- USERS -->

        <a
            href="<?= ROOT ?>/users"
            class="search-item"
            data-search="users user platform management"
        >

            <span class="search-item-icon">
                US
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



    <!-- MONITORING -->

    <div class="search-section">

        <div class="search-section-title">
            MONITORING
        </div>


        <!-- REPORTS -->

        <a
            href="<?= ROOT ?>/reports"
            class="search-item"
            data-search="reports report analytics monitoring"
        >

            <span class="search-item-icon">
                RP
            </span>

            <span class="search-item-content">

                <strong>
                    Reports
                </strong>

                <small>
                    View platform reports and analytics
                </small>

            </span>

        </a>


        <!-- AUDIT LOGS -->

        <a
            href="<?= ROOT ?>/auditlogs"
            class="search-item"
            data-search="audit logs activity history security monitoring"
        >

            <span class="search-item-icon">
                AL
            </span>

            <span class="search-item-content">

                <strong>
                    Audit Logs
                </strong>

                <small>
                    View platform activity logs
                </small>

            </span>

        </a>


        <!-- SECURITY -->

        <a
            href="<?= ROOT ?>/security"
            class="search-item"
            data-search="security login protection failed logins monitoring"
        >

            <span class="search-item-icon">
                SE
            </span>

            <span class="search-item-content">

                <strong>
                    Security
                </strong>

                <small>
                    Monitor platform security
                </small>

            </span>

        </a>

    </div>



    <!-- SYSTEM -->

    <div class="search-section">

        <div class="search-section-title">
            SYSTEM
        </div>


        <!-- SETTINGS -->

        <a
            href="<?= ROOT ?>/settings"
            class="search-item"
            data-search="settings system configuration preferences"
        >

            <span class="search-item-icon">
                ST
            </span>

            <span class="search-item-content">

                <strong>
                    Settings
                </strong>

                <small>
                    Manage system settings
                </small>

            </span>

        </a>

    </div>


<?php endif; ?>



               <!-- =================================================
     SCHOOL ADMIN
================================================== -->

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
                ST
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


        <!-- TEACHERS -->

        <a
            href="<?= ROOT ?>/teachers"
            class="search-item"
            data-search="teachers teacher staff faculty people"
        >

            <span class="search-item-icon">
                SF
            </span>

            <span class="search-item-content">

                <strong>
                    Teachers
                </strong>

                <small>
                    Manage teachers and faculty
                </small>

            </span>

        </a>


        <!-- PARENTS -->

        <a
            href="<?= ROOT ?>/parents"
            class="search-item"
            data-search="parents parent guardians people"
        >

            <span class="search-item-icon">
                PR
            </span>

            <span class="search-item-content">

                <strong>
                    Parents
                </strong>

                <small>
                    Manage parent records
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
            data-search="classes class divisions division academics"
        >

            <span class="search-item-icon">
                CL
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


        <!-- SUBJECTS -->

        <a
            href="<?= ROOT ?>/subjects"
            class="search-item"
            data-search="subjects subject academics curriculum"
        >

            <span class="search-item-icon">
                SB
            </span>

            <span class="search-item-content">

                <strong>
                    Subjects
                </strong>

                <small>
                    Manage school subjects
                </small>

            </span>

        </a>


        <!-- TEACHING ASSIGNMENTS -->

        <a
            href="<?= ROOT ?>/classsubjects"
            class="search-item"
            data-search="teaching assignments assignment class subject teacher faculty academics"
        >

            <span class="search-item-icon">
                TA
            </span>

            <span class="search-item-content">

                <strong>
                    Teaching Assignments
                </strong>

                <small>
                    Assign subjects and teachers to classes
                </small>

            </span>

        </a>


        <!-- TESTS -->

        <a
            href="<?= ROOT ?>/tests"
            class="search-item"
            data-search="tests test exams exam assessment assessments academics"
        >

            <span class="search-item-icon">
                TS
            </span>

            <span class="search-item-content">

                <strong>
                    Tests
                </strong>

                <small>
                    Manage tests and assessments
                </small>

            </span>

        </a>


        <!-- RESULTS -->

        <a
            href="<?= ROOT ?>/results"
            class="search-item"
            data-search="results result marks grades grade academics performance"
        >

            <span class="search-item-icon">
                RS
            </span>

            <span class="search-item-content">

                <strong>
                    Results
                </strong>

                <small>
                    Manage student results and marks
                </small>

            </span>

        </a>


        <!-- TIMETABLE -->

        <a
            href="<?= ROOT ?>/timetable"
            class="search-item"
            data-search="timetable time table schedule class teacher subject academics"
        >

            <span class="search-item-icon">
                TT
            </span>

            <span class="search-item-content">

                <strong>
                    Timetable
                </strong>

                <small>
                    Manage class schedules and periods
                </small>

            </span>

        </a>

    </div>



    <!-- ATTENDANCE -->

    <div class="search-section">

        <div class="search-section-title">
            ATTENDANCE
        </div>


        <!-- ATTENDANCE -->

        <a
            href="<?= ROOT ?>/attendance"
            class="search-item"
            data-search="attendance present absent late leave students teachers"
        >

            <span class="search-item-icon">
                AT
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

    </div>



    <!-- FINANCE -->

    <div class="search-section">

        <div class="search-section-title">
            FINANCE
        </div>


        <!-- FEES -->

        <a
            href="<?= ROOT ?>/fees"
            class="search-item"
            data-search="fees fee payments payment finance student fees"
        >

            <span class="search-item-icon">
                FE
            </span>

            <span class="search-item-content">

                <strong>
                    Fees
                </strong>

                <small>
                    Manage student fees and payments
                </small>

            </span>

        </a>

    </div>



    <!-- SCHOOL -->

    <div class="search-section">

        <div class="search-section-title">
            SCHOOL
        </div>


        <!-- SCHOOL PROFILE -->

        <a
            href="<?= ROOT ?>/school-profile"
            class="search-item"
            data-search="school profile school information details institution"
        >

            <span class="search-item-icon">
                SP
            </span>

            <span class="search-item-content">

                <strong>
                    School Profile
                </strong>

                <small>
                    Manage school information
                </small>

            </span>

        </a>

    </div>


<?php endif; ?>



                <!-- =================================================
                     TEACHER
                ================================================== -->

                <?php if ($rank === 'teacher'): ?>

                    <div class="search-section">

                        <div class="search-section-title">
                            TEACHING
                        </div>


                        <a
                            href="<?= ROOT ?>/teacherstudents"
                            class="search-item"
                            data-search="students student teaching"
                        >

                            <span class="search-item-icon">
                                ST
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


                        <a
                            href="<?= ROOT ?>/teacherclasses"
                            class="search-item"
                            data-search="classes class division teaching"
                        >

                            <span class="search-item-icon">
                                CL
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


                        <a
                            href="<?= ROOT ?>/teachertests"
                            class="search-item"
                            data-search="tests test exam assessment teaching"
                        >

                            <span class="search-item-icon">
                                TS
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


                        <a
                            href="<?= ROOT ?>/teacherresults"
                            class="search-item"
                            data-search="results result marks performance teaching"
                        >

                            <span class="search-item-icon">
                                RS
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


                        <a
                            href="<?= ROOT ?>/teacherparents"
                            class="search-item"
                            data-search="parents parent students teaching"
                        >

                            <span class="search-item-icon">
                                PR
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



                <!-- =================================================
                     STUDENT
                ================================================== -->

                <?php if ($rank === 'student'): ?>

                    <div class="search-section">

                        <div class="search-section-title">
                            ACADEMICS
                        </div>


                        <a
                            href="<?= ROOT ?>/studentclasses"
                            class="search-item"
                            data-search="classes class division student"
                        >

                            <span class="search-item-icon">
                                CL
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


                        <a
                            href="<?= ROOT ?>/studenttests"
                            class="search-item"
                            data-search="tests test exam student"
                        >

                            <span class="search-item-icon">
                                TS
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


                        <a
                            href="<?= ROOT ?>/studentresults"
                            class="search-item"
                            data-search="results result marks student"
                        >

                            <span class="search-item-icon">
                                RS
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



                <!-- =================================================
                     PARENT
                ================================================== -->

                <?php if ($rank === 'parent'): ?>

                    <div class="search-section">

                        <div class="search-section-title">
                            FAMILY
                        </div>


                        <a
                            href="<?= ROOT ?>/parentchildren"
                            class="search-item"
                            data-search="children child students parent"
                        >

                            <span class="search-item-icon">
                                ST
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    My Children
                                </strong>

                                <small>
                                    View your children
                                </small>

                            </span>

                        </a>


                        <a
                            href="<?= ROOT ?>/parenttests"
                            class="search-item"
                            data-search="tests test exam parent children"
                        >

                            <span class="search-item-icon">
                                TS
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Tests
                                </strong>

                                <small>
                                    View children tests
                                </small>

                            </span>

                        </a>


                        <a
                            href="<?= ROOT ?>/parentresults"
                            class="search-item"
                            data-search="results result marks parent children"
                        >

                            <span class="search-item-icon">
                                RS
                            </span>

                            <span class="search-item-content">

                                <strong>
                                    Results
                                </strong>

                                <small>
                                    View children results
                                </small>

                            </span>

                        </a>

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     NO RESULTS
                ================================================== -->

                <div
                    class="search-no-results"
                    id="searchNoResults"
                >
                    No matching pages found.
                </div>


            </div>

        </div>



<!-- =================================================
     RIGHT SIDE
================================================= -->

<div class="navbar-right">


    <!-- =================================================
         QUICK ADD
    ================================================== -->

    <button
        type="button"
        class="navbar-icon-btn quick-add-btn"
        title="Quick Add"
        aria-label="Quick Add"
    >

        <span class="quick-add-icon">
            +
        </span>

    </button>



    <!-- =================================================
         NOTIFICATIONS
    ================================================== -->

    <a
        href="<?= ROOT ?>/notifications"
        class="navbar-icon-btn notification-link"
        aria-label="Notifications"
        title="Notifications"
    >

        <span class="notification-icon">
            ♟
        </span>


        <?php

        $notificationCount = 0;

        if (
            isset($_SESSION['user_id']) &&
            !empty($_SESSION['user_id'])
        ) {

            require_once __DIR__ .
                '/../../models/NotificationModel.php';

            $notificationModel =
                new NotificationModel();

            $notificationCount =
                $notificationModel->getUnreadCount(
                    $_SESSION['user_id'],
                    $_SESSION['school_id'] ?? null
                );
        }

        ?>


        <?php if ($notificationCount > 0): ?>

            <span class="notification-badge">

                <?= $notificationCount > 99
                    ? '99+'
                    : $notificationCount
                ?>

            </span>

        <?php endif; ?>

    </a>



    <!-- =================================================
         SETTINGS
    ================================================== -->

    <a
        href="<?= ROOT ?>/settings"
        class="navbar-icon-btn settings-btn"
        aria-label="Settings"
        title="Settings"
    >

        <span class="settings-icon">
            ⚙
        </span>

    </a>



    <!-- =================================================
         PROFILE MENU
    ================================================== -->

    <div class="profile-menu">


        <!-- PROFILE BUTTON -->

        <button
            type="button"
            class="navbar-profile"
            id="profileMenuButton"
            aria-label="Open profile menu"
            aria-expanded="false"
        >

            <div class="navbar-avatar">

                <?= htmlspecialchars($initial) ?>

            </div>

        </button>



        <!-- PROFILE DROPDOWN -->

        <div
            class="profile-dropdown"
            id="profileDropdown"
        >


            <!-- USER INFO -->

            <div class="profile-dropdown-header">

                <div class="profile-dropdown-avatar">

                    <?= htmlspecialchars($initial) ?>

                </div>


                <div class="profile-dropdown-info">

                    <strong>
                        <?= htmlspecialchars($firstname) ?>
                    </strong>

                    <span>
                        <?= htmlspecialchars($roleName) ?>
                    </span>

                </div>

            </div>



            <div class="profile-dropdown-divider"></div>



            <!-- PROFILE -->

            <a
                href="<?= ROOT ?>/profile"
                class="profile-dropdown-item"
            >

                <span class="dropdown-item-icon">
                    ◉
                </span>

                <span>
                    Profile
                </span>

            </a>



            <!-- LOGOUT -->

            <a
                href="<?= ROOT ?>/logout"
                class="profile-dropdown-item logout-item"
            >

                <span class="dropdown-item-icon">
                    ↪
                </span>

                <span>
                    Logout
                </span>

            </a>


        </div>

    </div>


</div>

</header>