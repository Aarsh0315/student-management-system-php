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

        <div class="sidebar-title">

            <span class="sidebar-title-icon">
                MS
            </span>

            <div>

                <strong>
                    My School
                </strong>

                <span>
                    Management System
                </span>

            </div>

        </div>


        <!-- CLOSE BUTTON -->

        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
            aria-label="Close navigation"
        >
            ×
        </button>

    </div>



    <!-- ====================================
         NAVIGATION
    ===================================== -->

    <div class="sidebar-content">


        <!-- =================================
             SUPER ADMIN
        ================================== -->

        <?php if ($rank === 'super_admin'): ?>


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

                    <span class="sidebar-icon">
                        ▦
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <!-- SCHOOLS -->

                <a
                    href="<?= ROOT ?>/schools"
                    class="sidebar-link
                    <?= $currentPage === 'schools'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ▣
                    </span>

                    <span>
                        Schools
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

                    <span class="sidebar-icon">
                        ◉
                    </span>

                    <span>
                        Users
                    </span>

                </a>

            </div>



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

                    <span class="sidebar-icon">
                        ♙
                    </span>

                    <span>
                        Students
                    </span>

                </a>


                <!-- STAFF -->

                <a
                    href="<?= ROOT ?>/staff"
                    class="sidebar-link
                    <?= $currentPage === 'staff'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ♟
                    </span>

                    <span>
                        Staff
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

                    <span class="sidebar-icon">
                        ◌
                    </span>

                    <span>
                        Parents
                    </span>

                </a>

            </div>



            <div class="sidebar-section">

                <p class="sidebar-section-title">
                    ACADEMICS
                </p>


                <!-- TESTS -->

                <a
                    href="<?= ROOT ?>/tests"
                    class="sidebar-link
                    <?= $currentPage === 'tests'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ✓
                    </span>

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

                    <span class="sidebar-icon">
                        ≡
                    </span>

                    <span>
                        Results
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

                    <span class="sidebar-icon">
                        ◈
                    </span>

                    <span>
                        School Admins
                    </span>

                </a>

            </div>



        <!-- =================================
             SCHOOL ADMIN
        ================================== -->

        <?php elseif ($rank === 'admin'): ?>


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

                    <span class="sidebar-icon">
                        ▦
                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>


                <!-- STUDENTS -->

                <a
                    href="<?= ROOT ?>/students"
                    class="sidebar-link
                    <?= $currentPage === 'students'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ♙
                    </span>

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

                    <span class="sidebar-icon">
                        ♟
                    </span>

                    <span>
                        Teachers
                    </span>

                </a>


                <!-- CLASSES -->

                <a
                    href="<?= ROOT ?>/classes"
                    class="sidebar-link
                    <?= $currentPage === 'classes'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ▤
                    </span>

                    <span>
                        Classes
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

                    <span class="sidebar-icon">
                        ◌
                    </span>

                    <span>
                        Parents
                    </span>

                </a>

            </div>



            <div class="sidebar-section">

                <p class="sidebar-section-title">
                    ACADEMICS
                </p>


                <!-- TESTS -->

                <a
                    href="<?= ROOT ?>/tests"
                    class="sidebar-link
                    <?= $currentPage === 'tests'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ✓
                    </span>

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

                    <span class="sidebar-icon">
                        ≡
                    </span>

                    <span>
                        Results
                    </span>

                </a>

            </div>



        <!-- =================================
             OTHER USERS
        ================================== -->

        <?php else: ?>


            <div class="sidebar-section">

                <p class="sidebar-section-title">
                    MENU
                </p>


                <a
                    href="<?= ROOT ?>/home"
                    class="sidebar-link
                    <?= $currentPage === 'home'
                        ? 'active'
                        : '' ?>"
                >

                    <span class="sidebar-icon">
                        ▦
                    </span>

                    <span>
                        Dashboard
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

                <span class="sidebar-icon">
                    ◉
                </span>

                <span>
                    My Profile
                </span>

            </a>


            <!-- LOGOUT -->

            <a
                href="<?= ROOT ?>/logout"
                class="sidebar-link sidebar-logout"
            >

                <span class="sidebar-icon">
                    ↪
                </span>

                <span>
                    Logout
                </span>

            </a>

        </div>


    </div>



    <!-- ====================================
         SIDEBAR FOOTER
    ===================================== -->

    <div class="sidebar-footer">

        <div class="sidebar-footer-avatar">

            <?php

            $firstname =
                $_SESSION['firstname']
                ?? 'User';

            echo htmlspecialchars(
                strtoupper(
                    substr(
                        $firstname,
                        0,
                        1
                    )
                )
            );

            ?>

        </div>


        <div class="sidebar-footer-info">

            <strong>

                <?= htmlspecialchars(
                    $firstname
                ) ?>

            </strong>

            <span>

                <?= htmlspecialchars(
                    ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $rank
                        )
                    )
                ) ?>

            </span>

        </div>

    </div>


</aside>