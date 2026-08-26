<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rank = $_SESSION['rank'] ?? '';

/*
========================================
DASHBOARD URL
========================================
*/

if ($rank === 'super_admin') {

    $dashboardUrl = ROOT . '/superadmin';

    $roleName = 'Super Admin';

} elseif ($rank === 'admin') {

    $dashboardUrl = ROOT . '/school-admin';

    $roleName = 'School Admin';

} else {

    $dashboardUrl = ROOT . '/home';

    $roleName = 'User';

}


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
        ========================================= -->

        <a
            href="<?= $dashboardUrl ?>"
            class="navbar-brand"
        >
            My School
        </a>



        <!-- ========================================
             RIGHT SIDE
        ========================================= -->

        <div class="nav-right">


            <!-- ========================================
                 NAVIGATION LINKS
            ========================================= -->

            <div class="nav-links">


                <?php if ($rank === 'super_admin'): ?>


                    <!-- SUPER ADMIN -->

                    <a
                        href="<?= ROOT ?>/superadmin"
                        class="nav-link
                        <?= $currentPage === 'superadmin'
                            ? 'active'
                            : '' ?>"
                    >
                        Dashboard
                    </a>


                    <a
                        href="<?= ROOT ?>/schools"
                        class="nav-link
                        <?= $currentPage === 'schools'
                            ? 'active'
                            : '' ?>"
                    >
                        Schools
                    </a>


                    <a
                        href="<?= ROOT ?>/users"
                        class="nav-link
                        <?= $currentPage === 'users'
                            ? 'active'
                            : '' ?>"
                    >
                        Users
                    </a>


                    <a
                        href="<?= ROOT ?>/students"
                        class="nav-link
                        <?= $currentPage === 'students'
                            ? 'active'
                            : '' ?>"
                    >
                        Students
                    </a>


                    <a
                        href="<?= ROOT ?>/staff"
                        class="nav-link
                        <?= $currentPage === 'staff'
                            ? 'active'
                            : '' ?>"
                    >
                        Staff
                    </a>

                    <a
                        href="<?= ROOT ?>/parents"
                        class="nav-link
                        <?= $currentPage === 'parents'
                            ? 'active'
                            : '' ?>"
                    >
                        Parents
                    </a>


                    <a
                        href="<?= ROOT ?>/tests"
                        class="nav-link
                        <?= $currentPage === 'tests'
                            ? 'active'
                            : '' ?>"
                    >
                        Tests
                    </a>


                    <a
                        href="<?= ROOT ?>/results"
                        class="nav-link
                        <?= $currentPage === 'results'
                            ? 'active'
                            : '' ?>"
                    >
                        Results
                    </a>


                    <a
                        href="<?= ROOT ?>/schooladmins"
                        class="nav-link
                        <?= $currentPage === 'schooladmins'
                            ? 'active'
                            : '' ?>"
                    >
                        School Admins
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



                <?php elseif ($rank === 'admin'): ?>


                    <!-- ========================================
         SCHOOL ADMIN
    ======================================== -->


    <!-- DASHBOARD -->

    <a
        href="<?= ROOT ?>/school-admin"
        class="nav-link
        <?= $currentPage === 'school-admin'
            ? 'active'
            : '' ?>"
    >
        Dashboard
    </a>



    <!-- STUDENTS -->

    <a
        href="<?= ROOT ?>/students"
        class="nav-link
        <?= $currentPage === 'students'
            ? 'active'
            : '' ?>"
    >
        Students
    </a>



    <!-- TEACHERS -->

    <a
        href="<?= ROOT ?>/teachers"
        class="nav-link
        <?= $currentPage === 'teachers'
            ? 'active'
            : '' ?>"
    >
        Teachers
    </a>



    <!-- CLASSES -->

    <a
        href="<?= ROOT ?>/classes"
        class="nav-link
        <?= $currentPage === 'classes'
            ? 'active'
            : '' ?>"
    >
        Classes
    </a>



    <!-- PARENTS -->

    <a
        href="<?= ROOT ?>/parents"
        class="nav-link
        <?= $currentPage === 'parents'
            ? 'active'
            : '' ?>"
    >
        Parents
    </a>



    <!-- TESTS -->

    <a
        href="<?= ROOT ?>/tests"
        class="nav-link
        <?= $currentPage === 'tests'
            ? 'active'
            : '' ?>"
    >
        Tests
    </a>



    <!-- RESULTS -->

    <a
        href="<?= ROOT ?>/results"
        class="nav-link
        <?= $currentPage === 'results'
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


                <?php endif; ?>


            </div>



            <!-- ========================================
                 USER PROFILE
            ========================================= -->

            <a
                href="<?= ROOT ?>/profile"
                class="profile-link"
            >

                <div class="user-avatar">

                    <?php

                    $firstname =
                        $_SESSION['firstname']
                        ?? 'U';

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
                            ?? 'User'
                        ) ?>

                    </strong>

                    <span>
                        <?= htmlspecialchars(
                            $roleName
                        ) ?>
                    </span>

                </div>

            </a>



            <!-- ========================================
                 LOGOUT
            ========================================= -->

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