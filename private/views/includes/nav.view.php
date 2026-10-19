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

    ?: 'EduSphere';


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


$firstname = trim((string) ($_SESSION['firstname'] ?? 'User'));
$lastname = trim((string) ($_SESSION['lastname'] ?? ''));
$displayName = trim($firstname . ' ' . $lastname);
if ($displayName === '') {
    $displayName = 'User';
}
$initial = strtoupper(substr($firstname !== '' ? $firstname : 'U', 0, 1));


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


            <span class="search-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
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

                <!-- MAIN -->
                <div class="search-section">
                    <div class="search-section-title">MAIN</div>
                    <a href="<?= htmlspecialchars($dashboardUrl, ENT_QUOTES, 'UTF-8') ?>"
                       class="search-item"
                       data-search="dashboard home main overview">
                        <span class="search-item-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                 stroke="currentColor" stroke-width="1.7"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="3"></rect>
                                <path d="M9 3v18M9 9h12M9 15h12"></path>
                            </svg>
                        </span>
                        <span class="search-item-content">
                            <strong>Dashboard</strong>
                            <small>Go to your dashboard</small>
                        </span>
                    </a>
                </div>




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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M8 9v.01M8 12v.01M8 15v.01M16 13v.01M16 16v.01"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-6h6v6"/><path d="M9 9h.01M15 9h.01"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M20 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 2h8l4 4v16H4V2z"/><path d="M16 2v5h5"/><path d="M8 13h8M8 17h5"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14v3"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="m19.4 15 .1.1 1.4 1.1-1.4 2.4-1.7-.6a8 8 0 0 1-1.7 1l-.3 1.8h-2.8l-.3-1.8a8 8 0 0 1-1.7-1l-1.7.6-1.4-2.4 1.4-1.1a7 7 0 0 1 0-2l-1.4-1.1 1.4-2.4 1.7.6a8 8 0 0 1 1.7-1l.3-1.8h2.8l.3 1.8a8 8 0 0 1 1.7 1l1.7-.6 1.4 2.4-1.4 1.1a7 7 0 0 1 0 2z"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a6 6 0 0 1 12 0v2"/><path d="M16 11a4 4 0 0 0 0-8"/><path d="M21 21v-2a6 6 0 0 0-4-5.65"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 10 12 4l10 6-10 6-10-6Z"/><path d="M6 13v5c3 3 9 3 12 0v-5"/><path d="M22 10v6"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2"/><path d="M15 15a5 5 0 0 1 6 5"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v18H6.5A2.5 2.5 0 0 1 4 17.5z"/><path d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20"/><path d="M8 6h8M8 9h6"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/><path d="M8 7h8M8 11h8"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="m8 15 2 2 5-5"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H5a2 2 0 0 0-2 2v13h18V7a2 2 0 0 0-2-2h-4"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="m7 13 2 2 4-4M15 14h3"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19V5M4 19h17"/><rect x="7" y="11" width="3" height="5"/><rect x="13" y="7" width="3" height="9"/><rect x="19" y="3" width="2" height="13"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/><path d="M8 2v2M16 2v2"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="m8 15 2 2 5-5"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18"/><path d="M7 15h4"/></svg></span>


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


            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 10h.01M15 10h.01M9 14h.01M15 14h.01"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a6 6 0 0 1 12 0v2"/><path d="M16 11a4 4 0 0 0 0-8"/><path d="M21 21v-2a6 6 0 0 0-4-5.65"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v18H6.5A2.5 2.5 0 0 1 4 17.5z"/><path d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20"/><path d="M8 6h8M8 9h6"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H5a2 2 0 0 0-2 2v13h18V7a2 2 0 0 0-2-2h-4"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="m7 13 2 2 4-4M15 14h3"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19V5M4 19h17"/><rect x="7" y="11" width="3" height="5"/><rect x="13" y="7" width="3" height="9"/><rect x="19" y="3" width="2" height="13"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2"/><path d="M15 15a5 5 0 0 1 6 5"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v18H6.5A2.5 2.5 0 0 1 4 17.5z"/><path d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20"/><path d="M8 6h8M8 9h6"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H5a2 2 0 0 0-2 2v13h18V7a2 2 0 0 0-2-2h-4"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="m7 13 2 2 4-4M15 14h3"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19V5M4 19h17"/><rect x="7" y="11" width="3" height="5"/><rect x="13" y="7" width="3" height="9"/><rect x="19" y="3" width="2" height="13"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a6 6 0 0 1 12 0v2"/><path d="M16 11a4 4 0 0 0 0-8"/><path d="M21 21v-2a6 6 0 0 0-4-5.65"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H5a2 2 0 0 0-2 2v13h18V7a2 2 0 0 0-2-2h-4"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="m7 13 2 2 4-4M15 14h3"/></svg></span>


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


                            <span class="search-item-icon"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19V5M4 19h17"/><rect x="7" y="11" width="3" height="5"/><rect x="13" y="7" width="3" height="9"/><rect x="19" y="3" width="2" height="13"/></svg></span>


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



                <!-- ACCOUNT -->
                <div class="search-section">
                    <div class="search-section-title">ACCOUNT</div>

                    <a href="<?= ROOT ?>/profile"
                       class="search-item"
                       data-search="my profile profile account">
                        <span class="search-item-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                 stroke="currentColor" stroke-width="1.7"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </span>
                        <span class="search-item-content">
                            <strong>My Profile</strong>
                            <small>View and manage your profile</small>
                        </span>
                    </a>

                    <a href="<?= ROOT ?>/notifications"
                       class="search-item"
                       data-search="notifications notification alerts account">
                        <span class="search-item-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                 stroke="currentColor" stroke-width="1.7"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                                <path d="M10 21h4"></path>
                            </svg>
                        </span>
                        <span class="search-item-content">
                            <strong>Notifications</strong>
                            <small>View your notifications</small>
                        </span>
                    </a>

                    <button type="button"
                            class="search-item search-action-item"
                            id="searchKeyboardShortcuts"
                            data-search="keyboard shortcuts hotkeys help">
                        <span class="search-item-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                 stroke="currentColor" stroke-width="1.7"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                <path d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M7 13h.01M11 13h.01M15 13h.01M8 16h8"></path>
                            </svg>
                        </span>
                        <span class="search-item-content">
                            <strong>Keyboard Shortcuts</strong>
                            <small>View available shortcuts</small>
                        </span>
                    </button>

                    <a href="<?= ROOT ?>/logout"
                       class="search-item"
                       data-search="logout sign out account">
                        <span class="search-item-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"
                                 stroke="currentColor" stroke-width="1.7"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 17l5-5-5-5"></path>
                                <path d="M15 12H3"></path>
                                <path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path>
                            </svg>
                        </span>
                        <span class="search-item-content">
                            <strong>Logout</strong>
                            <small>Sign out of your account</small>
                        </span>
                    </a>
                </div>


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
    <a href="<?= ROOT ?>/notifications" class="navbar-icon-btn notification-link" aria-label="Notifications" title="Notifications">
        <span class="notification-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                <path d="M10 21h4"></path>
            </svg>
        </span>
        <?php
        $notificationCount = 0;
        if (!empty($_SESSION['user_id'])) {
            require_once __DIR__ . '/../../models/NotificationModel.php';
            $notificationModel = new NotificationModel();
            $notificationCount = $notificationModel->getUnreadCount(
                $_SESSION['user_id'],
                $_SESSION['school_id'] ?? null
            );
        }
        ?>
        <?php if ($notificationCount > 0): ?>
            <span class="notification-badge"><?= $notificationCount > 99 ? '99+' : (int) $notificationCount ?></span>
        <?php endif; ?>
    </a>

    <div class="navbar-user-menu" id="navbarUserMenu">
        <button type="button" class="navbar-profile" id="navbarProfileToggle"
            aria-label="Open account menu" aria-haspopup="true" aria-expanded="false"
            aria-controls="navbarProfileDropdown">
            <span class="navbar-profile-avatar" aria-hidden="true"><?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></span>
            <span class="navbar-profile-text">
                <span class="navbar-profile-name"><?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?></span>
                <span class="navbar-profile-role"><?= htmlspecialchars($roleName, ENT_QUOTES, 'UTF-8') ?></span>
            </span>

        </button>

        <div class="navbar-profile-dropdown" id="navbarProfileDropdown" hidden>
            <div class="navbar-dropdown-heading">
                <span class="navbar-dropdown-avatar" aria-hidden="true"><?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></span>
                <span class="navbar-dropdown-user">
                    <strong><?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?></strong>
                    <small><?= htmlspecialchars($roleName, ENT_QUOTES, 'UTF-8') ?></small>
                </span>
            </div>
            <div class="navbar-dropdown-divider"></div>
            <a class="navbar-dropdown-item" href="<?= ROOT ?>/profile">
                <span class="navbar-dropdown-item-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"></circle>
                        <path d="M4 21a8 8 0 0 1 16 0"></path>
                    </svg>
                </span>
                <span>My Profile</span>
            </a>
            <a class="navbar-dropdown-item navbar-dropdown-logout" href="<?= ROOT ?>/logout">
                <span class="navbar-dropdown-item-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 17l5-5-5-5"></path>
                        <path d="M15 12H3"></path>
                        <path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path>
                    </svg>
                </span>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<script>
(function () {
    function initializeNavbarSearchShortcuts() {
        const shortcutButton = document.getElementById('searchKeyboardShortcuts');
        if (!shortcutButton || shortcutButton.dataset.bound === 'true') return;
        shortcutButton.dataset.bound = 'true';

        shortcutButton.addEventListener('click', function () {
            window.alert(
                'Keyboard Shortcuts\\n\\n' +
                '/ — Focus the global search (if supported by this page)\\n' +
                'Esc — Close an open menu or search dropdown (if supported)'
            );
        });
    }

    function initializeNavbarProfileMenu() {
        const toggle = document.getElementById('navbarProfileToggle');
        const dropdown = document.getElementById('navbarProfileDropdown');
        const menu = document.getElementById('navbarUserMenu');
        if (!toggle || !dropdown || !menu || toggle.dataset.bound === 'true') return;
        toggle.dataset.bound = 'true';

        function setOpen(open) {
            dropdown.hidden = !open;
            dropdown.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        }

        // Clicking the account name/avatar opens and closes the menu.
        toggle.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            setOpen(dropdown.hidden);
        });

        // Keep clicks inside the dropdown from being treated as outside clicks.
        dropdown.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        document.addEventListener('click', function (event) {
            if (!menu.contains(event.target)) setOpen(false);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !dropdown.hidden) {
                setOpen(false);
                toggle.focus();
            }
        });

        setOpen(false);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initializeNavbarProfileMenu();
            initializeNavbarSearchShortcuts();
        }, { once: true });
    } else {
        initializeNavbarProfileMenu();
        initializeNavbarSearchShortcuts();
    }
})();
</script>

<style>
/* Make button-based search actions match search links */
.top-navbar .search-action-item {
    appearance: none;
    border: 0;
    background: transparent;
    font: inherit;
    text-align: left;
    cursor: pointer;
}

/* Inline SVG icon polish for navbar */
.top-navbar .search-icon,
.top-navbar .notification-icon,
.top-navbar .navbar-dropdown-item-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    line-height: 0;
}
.top-navbar .search-icon svg,
.top-navbar .notification-icon svg,
.top-navbar .navbar-dropdown-item-icon svg {
    display: block;
}
.top-navbar .navbar-dropdown-item-icon {
    width: 20px;
    height: 20px;
    color: #555;
}
.top-navbar .navbar-dropdown-item:hover .navbar-dropdown-item-icon {
    color: #111;
}
/* Account dropdown: reliable visibility and right-aligned positioning */
#navbarUserMenu { position: relative; }
#navbarProfileDropdown[hidden] { display: none !important; }
#navbarProfileDropdown:not([hidden]) {
    display: block !important;
    position: absolute !important;
    top: calc(100% + 10px) !important;
    right: 0 !important;
    left: auto !important;
    z-index: 3000 !important;
    min-width: 220px;
    max-width: min(300px, calc(100vw - 24px));
    background: #fff;
    color: #171717;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    box-shadow: 0 14px 38px rgba(0, 0, 0, .18);
    padding: 8px;
}
#navbarProfileDropdown .navbar-dropdown-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
}
#navbarProfileDropdown .navbar-dropdown-user { display: flex; flex-direction: column; min-width: 0; }
#navbarProfileDropdown .navbar-dropdown-user strong,
#navbarProfileDropdown .navbar-dropdown-user small { overflow-wrap: anywhere; }
#navbarProfileDropdown .navbar-dropdown-user strong { color: #111; font-size: 13px; }
#navbarProfileDropdown .navbar-dropdown-user small { color: #777; font-size: 11px; margin-top: 3px; }
#navbarProfileDropdown .navbar-dropdown-divider { height: 1px; background: #ededed; margin: 4px 0; }
#navbarProfileDropdown .navbar-dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    box-sizing: border-box;
    padding: 10px;
    border-radius: 8px;
    color: #252525;
    text-decoration: none;
    font-size: 13px;
}
#navbarProfileDropdown .navbar-dropdown-item:hover { background: #f3f3f3; }
#navbarProfileDropdown .navbar-dropdown-logout { color: #b42318; }
#navbarProfileDropdown .navbar-dropdown-logout:hover { background: #fff1f0; }

/* Remove profile dropdown arrow entirely */
.top-navbar .navbar-profile-chevron {
    display: none !important;
}
</style>

</header>