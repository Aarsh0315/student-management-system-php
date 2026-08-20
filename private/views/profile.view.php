<?php

/*
|--------------------------------------------------------------------------
| SUPER ADMIN PROFILE CARD
|--------------------------------------------------------------------------
*/


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
========================================
USER INFORMATION
========================================
*/

$firstname =
    $_SESSION['firstname']
    ?? 'System';

$lastname =
    $_SESSION['lastname']
    ?? 'Admin';

$email =
    $_SESSION['email']
    ?? 'superadmin@myschool.com';



/*
========================================
AVATAR
========================================
*/

$avatar = strtoupper(
    substr(
        $firstname,
        0,
        1
    )
);

?>


<section class="profile-card">


    <!-- ====================================
         PROFILE LEFT
    ===================================== -->

    <div class="profile-left">


        <!-- AVATAR -->

        <div class="profile-avatar">

            <?= htmlspecialchars($avatar) ?>

        </div>



        <!-- DETAILS -->

        <div class="profile-details">

            <p class="profile-label">
                Signed in as
            </p>


            <h2>

                <?= htmlspecialchars(
                    trim(
                        $firstname
                        . ' '
                        . $lastname
                    )
                ) ?>

            </h2>


            <p class="profile-email">

                <?= htmlspecialchars($email) ?>

            </p>


            <span class="profile-role">
                Super Admin
            </span>

        </div>


    </div>



    <!-- ====================================
         VIEW PROFILE
    ===================================== -->

    <a
        href="<?= ROOT ?>/profile"
        class="profile-btn"
    >
        View Profile
        <span>→</span>
    </a>


</section>