<?php

/*
|--------------------------------------------------------------------------
| PROFILE CARD
|--------------------------------------------------------------------------
| This file is used as a component inside home.view.php
|
| Example:
| <?php require "../private/views/profile.view.php"; ?>
|
*/


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =========================
   USER INFORMATION
========================= */

$firstname = $_SESSION['firstname'] ?? 'User';

$lastname = $_SESSION['lastname'] ?? '';

$email = $_SESSION['email'] ?? '';

$rank = $_SESSION['rank'] ?? 'user';

$user_id = $_SESSION['user_id'] ?? '-';


/* =========================
   RANK NAME
========================= */

$rankNames = [

    'super_admin'    => 'Super Admin',

    'admin'          => 'School Admin',

    'principal'      => 'Principal',

    'vice_principal' => 'Vice Principal',

    'teacher'        => 'Teacher',

    'student'        => 'Student',

    'parent'         => 'Parent',

    'staff'          => 'Staff'

];


$rankName = $rankNames[$rank]
    ?? ucfirst($rank);


/* =========================
   AVATAR
========================= */

$avatar = strtoupper(
    substr($firstname, 0, 1)
);

?>



<!-- =========================
     PROFILE CARD
========================= -->

<section class="profile-card">


    <!-- LEFT SIDE -->

    <div class="profile-left">


        <!-- AVATAR -->

        <div class="profile-avatar">

            <?= htmlspecialchars($avatar) ?>

        </div>


        <!-- USER DETAILS -->

        <div class="profile-details">


            <!-- NAME -->

            <h2>

                <?= htmlspecialchars(
                    $firstname
                    . ' '
                    . $lastname
                ) ?>

            </h2>


            <!-- EMAIL -->

            <p>

                <?= htmlspecialchars($email) ?>

            </p>


            <!-- RANK -->

            <span>

                <?= htmlspecialchars($rankName) ?>

            </span>


        </div>


    </div>



    <!-- PROFILE BUTTON -->

    <a
    href="<?= ROOT ?>/superadmin"
    class="profile-btn"
>
    Dashboard
</a>


</section>