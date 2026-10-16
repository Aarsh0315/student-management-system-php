<?php



if (session_status() === PHP_SESSION_NONE) {

    session_start();

}



$rank = $_SESSION['rank'] ?? '';



/*

========================================

CURRENT PAGE

========================================

*/



$currentUrl = $_GET['url'] ?? '';



$currentUrl = trim(

    $currentUrl,

    '/'

);



$currentPage = explode(

    '/',

    $currentUrl

)[0] ?? '';



?>





<!-- ========================================

     SIDEBAR OVERLAY

======================================== -->



<div

    class="sidebar-overlay"

    id="sidebarOverlay"

></div>







<!-- ========================================

     SIDEBAR

======================================== -->



<aside

    class="sidebar"

    id="sidebar"

>





    <!-- ====================================

         SIDEBAR HEADER

    ===================================== -->



   <div class="sidebar-header">


    <?php



    $headerFirstname =

        $_SESSION['firstname']

        ?? 'User';



    $headerEmail =

        $_SESSION['email']

        ?? '';



    $headerRole =

        ucfirst(

            str_replace(

                '_',

                ' ',

                $rank

            )

        );



    $headerInitial =

        strtoupper(

            substr(

                $headerFirstname,

                0,

                1

            )

        );



    ?>



    <div class="sidebar-header-profile">



        <div class="sidebar-header-avatar">

            <?= htmlspecialchars($headerInitial) ?>

        </div>





        <div class="sidebar-header-profile-info">



            <strong>

                <?= htmlspecialchars($headerFirstname) ?>

            </strong>



            <span class="sidebar-header-profile-role">

                <?= htmlspecialchars($headerRole) ?>

            </span>



            <?php if ($headerEmail !== ''): ?>



                <span class="sidebar-header-profile-email">

                    <?= htmlspecialchars($headerEmail) ?>

                </span>



            <?php endif; ?>



        </div>



    </div>



</div>







    <!-- ====================================

         NAVIGATION

    ===================================== -->



    <div class="sidebar-content">





       <!-- =================================

     SUPER ADMIN

================================== -->



<?php if ($rank === 'super_admin'): ?>





    <!-- MAIN -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            MAIN

        </p>





        <!-- DASHBOARD -->



        <a

            href="<?= ROOT ?>/superadmin"

            class="sidebar-link

            <?= $currentPage === 'superadmin'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg></span>



            <span>

                Dashboard

            </span>



        </a>



    </div>







    <!-- PLATFORM -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            PLATFORM

        </p>





        <!-- SCHOOLS -->



        <a

            href="<?= ROOT ?>/schools"

            class="sidebar-link

            <?= $currentPage === 'schools'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m3 10 9-6 9 6"/><path d="M5 10v9M9 10v9M15 10v9M19 10v9M3 20h18"/></svg></span>



            <span>

                Schools

            </span>



        </a>





        <!-- SCHOOL ADMINS -->



        <a

            href="<?= ROOT ?>/schooladmins"

            class="sidebar-link

            <?= $currentPage === 'schooladmins'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M20 8v6M17 11h6"/></svg></span>



            <span>

                School Admins

            </span>



        </a>





        <!-- USERS -->



        <a

            href="<?= ROOT ?>/users"

            class="sidebar-link

            <?= $currentPage === 'users'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M20 8v6M17 11h6"/></svg></span>



            <span>

                Users

            </span>



        </a>



    </div>







    <!-- MONITORING -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            MONITORING

        </p>





        <!-- REPORTS -->



        <a

            href="<?= ROOT ?>/reports"

            class="sidebar-link

            <?= $currentPage === 'reports'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 19V5M4 19h17"/><path d="m7 15 4-4 3 2 5-6"/></svg></span>



            <span>

                Reports

            </span>



        </a>





        <!-- AUDIT LOGS -->



        <a

            href="<?= ROOT ?>/auditlogs"

            class="sidebar-link

            <?= $currentPage === 'auditlogs'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>



            <span>

                Audit Logs

            </span>



        </a>





        <!-- SECURITY -->



        <a

            href="<?= ROOT ?>/security"

            class="sidebar-link

            <?= $currentPage === 'security'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"/></svg></span>



            <span>

                Security

            </span>



        </a>



    </div>



    <!-- SYSTEM -->

<div class="sidebar-section">



    <p class="sidebar-section-title">

        SYSTEM

    </p>



    <!-- SETTINGS -->

    <a

        href="<?= ROOT ?>/settings"

        class="sidebar-link

        <?= $currentPage === 'settings'

            ? 'active'

            : '' ?>"

    >



        <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="3"/><path d="m19.4 15 .1.1 1.4 1.1-1.4 2.4-1.7-.7a8 8 0 0 1-1.7 1l-.3 1.8h-2.8l-.3-1.8a8 8 0 0 1-1.7-1l-1.7.7-1.4-2.4 1.4-1.1a7 7 0 0 1 0-2l-1.4-1.1 1.4-2.4 1.7.7a8 8 0 0 1 1.7-1l.3-1.8h2.8l.3 1.8a8 8 0 0 1 1.7 1l1.7-.7 1.4 2.4-1.4 1.1a7 7 0 0 1 0 2Z"/></svg></span>



        <span>

            Settings

        </span>



    </a>



</div>

<?php elseif ($rank === 'admin'): ?>



    <!-- =================================

         SCHOOL ADMIN

    ================================== -->





    <!-- MAIN -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            MAIN

        </p>





        <!-- DASHBOARD -->



        <a

            href="<?= ROOT ?>/school-admin"

            class="sidebar-link

            <?= $currentPage === 'school-admin'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg></span>



            <span>

                Dashboard

            </span>



        </a>



    </div>







    <!-- PEOPLE -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            PEOPLE

        </p>





        <!-- STUDENTS -->



        <a

            href="<?= ROOT ?>/students"

            class="sidebar-link

            <?= $currentPage === 'students'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9 12 4l10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5M22 9v6"/></svg></span>



            <span>

                Students

            </span>



        </a>





        <!-- TEACHERS -->



        <a

            href="<?= ROOT ?>/teachers"

            class="sidebar-link

            <?= $currentPage === 'teachers'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 5h16v12H4z"/><path d="M8 21h8M12 17v4M8 9h8M8 13h5"/></svg></span>



            <span>

                Teachers

            </span>



        </a>





        <!-- PARENTS -->



        <a

            href="<?= ROOT ?>/parents"

            class="sidebar-link

            <?= $currentPage === 'parents'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2M15 15a5 5 0 0 1 6 5"/></svg></span>



            <span>

                Parents

            </span>



        </a>



    </div>







    <!-- ACADEMICS -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            ACADEMICS

        </p>





        <!-- CLASSES -->



        <a

            href="<?= ROOT ?>/classes"

            class="sidebar-link

            <?= $currentPage === 'classes'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg></span>



            <span>

                Classes

            </span>



        </a>





        <!-- SUBJECTS -->



        <a

            href="<?= ROOT ?>/subjects"

            class="sidebar-link

            <?= $currentPage === 'subjects'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 3h11l3 3v15H5z"/><path d="M15 3v4h4M8 12h8M8 16h8"/></svg></span>



            <span>

                Subjects

            </span>



        </a>





        <!-- TEACHING ASSIGNMENTS -->



        <a

            href="<?= ROOT ?>/classsubjects"

            class="sidebar-link

            <?= $currentPage === 'classsubjects'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5M8 17h3"/><path d="m15 15 2 2 4-5"/></svg></span>



            <span>

                Teaching Assignments

            </span>



        </a>





        <!-- TESTS -->



        <a

            href="<?= ROOT ?>/tests"

            class="sidebar-link

            <?= $currentPage === 'tests'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 3h10v4H7z"/><path d="M6 5H4v16h16V5h-2"/><path d="m8 13 2 2 5-5"/></svg></span>



            <span>

                Tests

            </span>



        </a>





        <!-- RESULTS -->



        <a

            href="<?= ROOT ?>/results"

            class="sidebar-link

            <?= $currentPage === 'results'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 19V5M4 19h17"/><path d="M8 15v-4M13 15V7M18 15V9"/></svg></span>



            <span>

                Results

            </span>



        </a>





        <!-- TIMETABLE -->



        <a

            href="<?= ROOT ?>/timetable"

            class="sidebar-link

            <?= $currentPage === 'timetable'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M7 14h3M14 14h3M7 17h3"/></svg></span>



            <span>

                Timetable

            </span>



        </a>



    </div>







    <!-- ATTENDANCE -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            ATTENDANCE

        </p>





        <a

            href="<?= ROOT ?>/attendance"

            class="sidebar-link

            <?= $currentPage === 'attendance'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12 4 4L19 6"/><circle cx="12" cy="12" r="10"/></svg></span>



            <span>

                Attendance

            </span>



        </a>



    </div>







    <!-- FINANCE -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            FINANCE

        </p>





        <!-- FEES -->



        <a

            href="<?= ROOT ?>/fees"

            class="sidebar-link

            <?= $currentPage === 'fees'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h4"/></svg></span>



            <span>

                Fees

            </span>



        </a>



    </div>







    <!-- SCHOOL -->



    <div class="sidebar-section">



        <p class="sidebar-section-title">

            SCHOOL

        </p>





        <!-- SCHOOL PROFILE -->



        <a

            href="<?= ROOT ?>/school-profile"

            class="sidebar-link

            <?= $currentPage === 'school-profile'

                ? 'active'

                : '' ?>"

        >



            <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m3 10 9-6 9 6"/><path d="M5 10v9M9 10v9M15 10v9M19 10v9M3 20h18"/></svg></span>



            <span>

                School Profile

            </span>



        </a>



    </div>







        <!-- =================================

             STUDENT

        ================================== -->



        <?php elseif ($rank === 'student'): ?>





            <div class="sidebar-section">



                <p class="sidebar-section-title">

                    MAIN

                </p>





                <!-- DASHBOARD -->



                <a

                    href="<?= ROOT ?>/studentDashboard"

                    class="sidebar-link

                    <?= $currentPage === 'studentDashboard'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg></span>



                    <span>

                        Dashboard

                    </span>



                </a>





                <!-- MY CLASS -->



                <a

                    href="<?= ROOT ?>/studentclasses"

                    class="sidebar-link

                    <?= $currentPage === 'studentclasses'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9 12 4l10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5"/></svg></span>



                    <span>

                        My Class

                    </span>



                </a>





                <!-- TESTS -->



                <a

                    href="<?= ROOT ?>/studenttests"

                    class="sidebar-link

                    <?= $currentPage === 'studenttests'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 3h10v4H7z"/><path d="M6 5H4v16h16V5h-2"/><path d="m8 13 2 2 5-5"/></svg></span>



                    <span>

                        Tests

                    </span>



                </a>





                <!-- RESULTS -->



                <a

                    href="<?= ROOT ?>/studentresults"

                    class="sidebar-link

                    <?= $currentPage === 'studentresults'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 19V5M4 19h17"/><path d="M8 15v-4M13 15V7M18 15V9"/></svg></span>



                    <span>

                        Results

                    </span>



                </a>



            </div>







        <!-- =================================

             TEACHER

        ================================== -->



        <?php elseif ($rank === 'teacher'): ?>





            <!-- MAIN -->



            <div class="sidebar-section">



                <p class="sidebar-section-title">

                    MAIN

                </p>





                <!-- DASHBOARD -->



                <a

                    href="<?= ROOT ?>/teacherDashboard"

                    class="sidebar-link

                    <?= $currentPage === 'teacherDashboard'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg></span>



                    <span>

                        Dashboard

                    </span>



                </a>





                <!-- STUDENTS -->



                <a

                    href="<?= ROOT ?>/teacherstudents"

                    class="sidebar-link

                    <?= $currentPage === 'teacherstudents'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9 12 4l10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5"/></svg></span>



                    <span>

                        Students

                    </span>



                </a>





                <!-- CLASSES -->



                <a

                    href="<?= ROOT ?>/teacherclasses"

                    class="sidebar-link

                    <?= $currentPage === 'teacherclasses'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 4h16v16H4z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg></span>



                    <span>

                        Classes

                    </span>



                </a>





                <!-- PARENTS -->



                <a

                    href="<?= ROOT ?>/teacherparents"

                    class="sidebar-link

                    <?= $currentPage === 'teacherparents'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2M15 15a5 5 0 0 1 6 5"/></svg></span>



                    <span>

                        Parents

                    </span>



                </a>



            </div>







            <!-- ACADEMICS -->



            <div class="sidebar-section">



                <p class="sidebar-section-title">

                    ACADEMICS

                </p>





                <!-- TESTS -->



                <a

                    href="<?= ROOT ?>/teachertests"

                    class="sidebar-link

                    <?= $currentPage === 'teachertests'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 3h10v4H7z"/><path d="M6 5H4v16h16V5h-2"/><path d="m8 13 2 2 5-5"/></svg></span>



                    <span>

                        Tests

                    </span>



                </a>





                <!-- RESULTS -->



                <a

                    href="<?= ROOT ?>/teacherresults"

                    class="sidebar-link

                    <?= $currentPage === 'teacherresults'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 19V5M4 19h17"/><path d="M8 15v-4M13 15V7M18 15V9"/></svg></span>



                    <span>

                        Results

                    </span>



                </a>



            </div>







        <!-- =================================

             PARENT

        ================================== -->



        <?php elseif ($rank === 'parent'): ?>





            <!-- MAIN -->



            <div class="sidebar-section">



                <p class="sidebar-section-title">

                    MAIN

                </p>





                <!-- DASHBOARD -->



                <a

                    href="<?= ROOT ?>/parentDashboard"

                    class="sidebar-link

                    <?= $currentPage === 'parentDashboard'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h4"/></svg></span>



                    <span>

                        Dashboard

                    </span>



                </a>





                <!-- MY CHILDREN -->



                <a

                    href="<?= ROOT ?>/parentchildren"

                    class="sidebar-link

                    <?= $currentPage === 'parentchildren'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20v-2a6 6 0 0 1 12 0v2M15 15a5 5 0 0 1 6 5"/></svg></span>



                    <span>

                        My Children

                    </span>



                </a>



            <!-- ACADEMICS -->



            <div class="sidebar-section">



                <p class="sidebar-section-title">

                    ACADEMICS

                </p>





                <!-- TESTS -->



                <a

                    href="<?= ROOT ?>/parenttests"

                    class="sidebar-link

                    <?= $currentPage === 'parenttests'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 3h10v4H7z"/><path d="M6 5H4v16h16V5h-2"/><path d="m8 13 2 2 5-5"/></svg></span>



                    <span>

                        Tests

                    </span>



                </a>





                <!-- RESULTS -->



                <a

                    href="<?= ROOT ?>/parentresults"

                    class="sidebar-link

                    <?= $currentPage === 'parentresults'

                        ? 'active'

                        : '' ?>"

                >



                    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 19V5M4 19h17"/><path d="M8 15v-4M13 15V7M18 15V9"/></svg></span>



                    <span>

                        Results

                    </span>



                </a>



            </div>





        <?php endif; ?>







        <!-- =================================

     ACCOUNT

================================== -->



<div class="sidebar-section">



    <p class="sidebar-section-title">

        ACCOUNT

    </p>





    <!-- PROFILE -->



    <a

        href="<?= ROOT ?>/profile"

        class="sidebar-link

        <?= $currentPage === 'profile'

            ? 'active'

            : '' ?>"

    >



        <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span>



        <span>

            My Profile

        </span>



    </a>



    <!-- NOTIFICATIONS -->



<a

    href="<?= ROOT ?>/notifications"

    class="sidebar-link

    <?= $currentPage === 'notifications'

        ? 'active'

        : '' ?>"

>



    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg></span>



    <span>

        Notifications

    </span>



</a>



<!-- HELP & SUPPORT -->



<a

    href="<?= ROOT ?>/help"

    class="sidebar-link

    <?= $currentPage === 'help'

        ? 'active'

        : '' ?>"

>



    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M9.6 9a2.5 2.5 0 1 1 4.4 1.6c-1.2 1-2 1.3-2 3M12 17h.01"/></svg></span>



    <span>

        Help & Support

    </span>



</a>



<!-- KEYBOARD SHORTCUTS -->



<a

    href="<?= ROOT ?>/shortcuts"

    class="sidebar-link

    <?= $currentPage === 'shortcuts'

        ? 'active'

        : '' ?>"

>



    <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M7 9h2M12 9h2M17 9h.01M7 13h.01M11 13h2M16 13h1M8 16h8"/></svg></span>



    <span>

        Keyboard Shortcuts

    </span>



</a>





    <!-- LOGOUT -->



    <a

        href="<?= ROOT ?>/logout"

        class="sidebar-link sidebar-logout"

    >



        <span class="sidebar-icon"><svg class="sidebar-svg-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M10 17l5-5-5-5M15 12H3"/><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"/></svg></span>



        <span>

            Logout

        </span>



    </a>



</div>





    </div>







    </aside>


<!-- SIDEBAR TOGGLE BEHAVIOUR -->
<script>
(function () {
    'use strict';

    function initializeSidebarDrawer() {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');
        const closeButton = document.getElementById('sidebarClose');

        if (!sidebar || !toggle || !overlay) return;

        // Prevent duplicate initialization if this partial is included more than once.
        if (toggle.dataset.sidebarDrawerBound === 'true') return;
        toggle.dataset.sidebarDrawerBound = 'true';

        function setOpen(open) {
            sidebar.classList.toggle('open', open);
            overlay.classList.toggle('open', open);
            document.body.classList.toggle('sidebar-open', open);
            document.body.classList.toggle('sidebar-expanded-blur', open);
            toggle.classList.toggle('active', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
        }

        toggle.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            setOpen(!sidebar.classList.contains('open'));
        }, true);

        overlay.addEventListener('click', function () { setOpen(false); });
        if (closeButton) {
            closeButton.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                setOpen(false);
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && sidebar.classList.contains('open')) {
                setOpen(false);
                toggle.focus();
            }
        });

        sidebar.querySelectorAll('a.sidebar-link').forEach(function (link) {
            link.addEventListener('click', function () { setOpen(false); });
        });

        // Start closed consistently at every viewport width.
        setOpen(false);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeSidebarDrawer, { once: true });
    } else {
        initializeSidebarDrawer();
    }
})();
</script>
