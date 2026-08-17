<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Super Admin - My School</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/superadmin.view.css"
    >

</head>

<body>


<?php require "../private/views/includes/superadmin-navbar.php"; ?>


<main class="superadmin-page">

    <div class="welcome">

        <p>
            Welcome back 👋
        </p>

        <h1>
            Super Admin Dashboard
        </h1>

        <p>
            Manage schools and system users.
        </p>

    </div>


    <div class="admin-cards">


        <div class="admin-card">

            <h2>
                Schools
            </h2>

            <p>
                Create and manage schools.
            </p>

            <a href="<?= ROOT ?>/schools">
                Manage Schools →
            </a>

        </div>


        <div class="admin-card">

            <h2>
                All Users
            </h2>

            <p>
                View and manage users across all schools.
            </p>

            <a href="<?= ROOT ?>/users">
                Manage Users →
            </a>

        </div>


    </div>


</main>


</body>

</html>