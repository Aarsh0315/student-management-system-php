<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rank = $_SESSION['rank'] ?? '';

/*
========================================
TEACHER DASHBOARD URL
========================================
*/

$dashboardUrl = ROOT . '/teacherDashboard';

$roleName = 'Teacher';


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

<nav class="navbar">

    <div class="navbar-container">


        <!-- ========================================
             BRAND
        ======================================== -->

        <a
            href="<?= $dashboardUrl ?>"
            class="navbar-brand"
        >
            My School
        </a>



        <!-- ========================================
             RIGHT SIDE
        ======================================== -->

        <div class="nav-right">


            <!-- ========================================
                 NAVIGATION LINKS
            ======================================== -->

            <div class="nav-links">


                <!-- TEACHER -->

                <a
                    href="<?= ROOT ?>/teacherDashboard"
                    class="nav-link
                    <?= $currentPage === 'teacherDashboard'
                        ? 'active'
                        : '' ?>"
                >
                    Dashboard
                </a>


                <a
                    href="<?= ROOT ?>/teacherstudents"
                    class="nav-link
                    <?= $currentPage === 'teacherstudents'
                        ? 'active'
                        : '' ?>"
                >
                    Students
                </a>


                <a
                    href="<?= ROOT ?>/teacherclasses"
                    class="nav-link
                    <?= $currentPage === 'teacherclasses'
                        ? 'active'
                        : '' ?>"
                >
                    Classes
                </a>


                <a
                    href="<?= ROOT ?>/teachertests"
                    class="nav-link
                    <?= $currentPage === 'teachertests'
                        ? 'active'
                        : '' ?>"
                >
                    Tests
                </a>


                <a
                    href="<?= ROOT ?>/teacherresults"
                    class="nav-link
                    <?= $currentPage === 'teacherresults'
                        ? 'active'
                        : '' ?>"
                >
                    Results
                </a>


                <a
                    href="<?= ROOT ?>/teacherassignments"
                    class="nav-link
                    <?= $currentPage === 'teacherassignments'
                        ? 'active'
                        : '' ?>"
                >
                    Assignments
                </a>


                <a
                    href="<?= ROOT ?>/teacherattendance"
                    class="nav-link
                    <?= $currentPage === 'teacherattendance'
                        ? 'active'
                        : '' ?>"
                >
                    Attendance
                </a>


                <a
                    href="<?= ROOT ?>/teacherparents"
                    class="nav-link
                    <?= $currentPage === 'teacherparents'
                        ? 'active'
                        : '' ?>"
                >
                    Parents
                </a>


                <a
                    href="<?= ROOT ?>/profile"
                    class="nav-link
                    <?= $currentPage === 'profile'
                        ? 'active'
                        : '' ?>"
                >
                    Profile
                </a>


            </div>



            <!-- ========================================
                 USER PROFILE
            ======================================== -->

            <a
                href="<?= ROOT ?>/profile"
                class="profile-link"
            >

                <div class="user-avatar">

                    <?php

                    $firstname =
                        $_SESSION['firstname']
                        ?? 'T';

                    echo strtoupper(
                        substr(
                            $firstname,
                            0,
                            1
                        )
                    );

                    ?>

                </div>


                <div class="user-info">

                    <strong>

                        <?= htmlspecialchars(
                            $_SESSION['firstname']
                            ?? 'Teacher'
                        ) ?>

                    </strong>

                    <span>
                        Teacher
                    </span>

                </div>

            </a>



            <!-- ========================================
                 LOGOUT
            ======================================== -->

            <a
                href="<?= ROOT ?>/logout"
                class="logout-btn"
                title="Logout"
            >
                Logout
            </a>


        </div>

    </div>

</nav>