<?php

$parent = $data['parent'] ?? null;

if (!$parent) {
    die("Parent not found.");
}


$initial = strtoupper(
    substr(
        $parent->firstname ?? 'P',
        0,
        1
    )
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Parent Details - My School
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-details.view.css?v=1"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                School Admin
            </p>

            <h1>
                Parent Details
            </h1>

            <p class="welcome-text">
                View detailed information about
                this parent.
            </p>

        </div>

    </section>


    <!-- PROFILE -->

    <section class="parent-profile-card">


        <div class="parent-profile-left">


            <div class="parent-large-avatar">

                <?= htmlspecialchars($initial) ?>

            </div>


            <div class="parent-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        ($parent->firstname ?? '')
                        . ' '
                        . ($parent->lastname ?? '')
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $parent->email ?? '-'
                    ) ?>

                </p>


                <span class="parent-role-badge">
                    Parent
                </span>

            </div>


        </div>


        <?php if (
            ($parent->status ?? '')
            === 'active'
        ): ?>

            <span class="status active">
                Active
            </span>

        <?php else: ?>

            <span class="status inactive">
                Inactive
            </span>

        <?php endif; ?>


    </section>


    <!-- ACCOUNT INFORMATION -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Account Information
            </h2>

            <p>
                Parent account details
            </p>

        </div>


        <div class="details-grid">


            <div class="details-item">

                <span>
                    Parent ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->user_id
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    First Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->firstname
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Last Name
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->lastname
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->email
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Gender
                </span>

                <strong>
                    <?= htmlspecialchars(
                        ucfirst(
                            $parent->gender ?? '-'
                        )
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Role
                </span>

                <strong>
                    Parent
                </strong>

            </div>


            <div class="details-item">

                <span>
                    School
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->school_name
                        ?? 'No School'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    School ID
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $parent->school_code
                        ?? '-'
                    ) ?>
                </strong>

            </div>


            <div class="details-item">

                <span>
                    Account Status
                </span>

                <strong>
                    <?= htmlspecialchars(
                        ucfirst(
                            $parent->status
                            ?? 'active'
                        )
                    ) ?>
                </strong>

            </div>


        </div>


    </section>


    <!-- BACK -->

    <section class="parent-actions">

        <a
            href="<?= ROOT ?>/parents"
            class="back-btn"
        >
            ← Back to Parents
        </a>

    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>