<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
========================================
STUDENT DASHBOARD URL
========================================
*/

$dashboardUrl =
    ROOT . '/studentDashboard';


/*
========================================
CURRENT PAGE
========================================
*/

$currentUrl =
    $_GET['url'] ?? '';

$currentUrl =
    trim(
        $currentUrl,
        '/'
    );

$currentPage =
    explode(
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


                <!-- DASHBOARD -->

                <a
                    href="<?= ROOT ?>/studentDashboard"
                    class="nav-link
                    <?= $currentPage === 'studentDashboard'
                        ? 'active'
                        : '' ?>"
                >
                    Dashboard
                </a>


                <!-- CLASS -->

                <a
                    href="<?= ROOT ?>/studentclasses"
                    class="nav-link
                    <?= $currentPage === 'studentclasses'
                        ? 'active'
                        : '' ?>"
                >
                    My Class
                </a>


                <!-- TESTS -->

                <a
                    href="<?= ROOT ?>/studenttests"
                    class="nav-link
                    <?= $currentPage === 'studenttests'
                        ? 'active'
                        : '' ?>"
                >
                    Tests
                </a>


                <!-- RESULTS -->

                <a
                    href="<?= ROOT ?>/studentresults"
                    class="nav-link
                    <?= $currentPage === 'studentresults'
                        ? 'active'
                        : '' ?>"
                >
                    Results
                </a>


                <!-- PROFILE -->

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
                        ?? 'S';

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
                            ?? 'Student'
                        ) ?>

                    </strong>


                    <span>
                        Student
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