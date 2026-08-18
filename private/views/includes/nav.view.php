<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar">

    <div class="navbar-container">

        <a
            href="<?= $_SESSION['rank'] === 'super_admin'
                ? ROOT . '/superadmin'
                : ROOT . '/home' ?>"
            class="logo"
        >
            My School
        </a>


        <div class="nav-links">

            <?php if ($_SESSION['rank'] === 'super_admin'): ?>

                <a href="<?= ROOT ?>/superadmin">
                    Dashboard
                </a>

                <a href="<?= ROOT ?>/schools">
                    Schools
                </a>

                <a href="<?= ROOT ?>/users">
                    Users
                </a>

                <a href="<?= ROOT ?>/students">
                    Students
                </a>

                <a href="<?= ROOT ?>/staff">
                    Staff
                </a>

                <a href="<?= ROOT ?>/schooladmins">
                        School Admins
                    </a>

                <a href="<?= ROOT ?>/profile">
                    Profile
                </a>

            <?php else: ?>

                <a href="<?= ROOT ?>/home">
                    Dashboard
                </a>

                <a href="<?= ROOT ?>/students">
                    Students
                </a>

                <a href="<?= ROOT ?>/teachers">
                    Teachers
                </a>
                

                <a href="<?= ROOT ?>/profile">
                    Profile
                </a>

            <?php endif; ?>

            <a
                href="<?= ROOT ?>/logout"
                class="logout-btn"
            >
                Logout
            </a>

        </div>

    </div>

</nav>