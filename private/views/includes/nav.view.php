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

        <div class="navbar-search">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="search"
                placeholder="Search anything..."
                aria-label="Search"
            >

            <span class="search-shortcut">
                /
            </span>

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

        </div>

    </div>

</header>