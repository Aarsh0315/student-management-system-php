<?php

$profile = $data['profile'] ?? null;

if (!$profile) {
    die("User profile not found.");
}

$firstname = $profile->firstname ?? '';
$lastname  = $profile->lastname ?? '';
$gender    = $profile->gender ?? '';

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
        Edit Profile - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/my-profile.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=3"
    >

</head>

<body>

<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="profile-page">

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Account
            </p>

            <h1>
                Edit Profile
            </h1>

            <p class="welcome-text">
                Update your personal information.
            </p>

        </div>

    </section>


    <section class="profile-info-card">

        <div class="profile-section-header">

            <h2>
                Personal Information
            </h2>

            <p>
                Update the information associated with your account.
            </p>

        </div>


        <form
            method="POST"
            action="<?= ROOT ?>/profile/update"
            class="profile-form"
        >

            <?= CSRF::field() ?>


            <div class="profile-information-grid">


                <!-- FIRST NAME -->

                <div class="profile-information-item">

                    <span>
                        First Name
                    </span>

                    <input
                        type="text"
                        name="firstname"
                        value="<?= htmlspecialchars($firstname) ?>"
                        required
                        maxlength="100"
                    >

                </div>


                <!-- LAST NAME -->

                <div class="profile-information-item">

                    <span>
                        Last Name
                    </span>

                    <input
                        type="text"
                        name="lastname"
                        value="<?= htmlspecialchars($lastname) ?>"
                        required
                        maxlength="100"
                    >

                </div>


                <!-- GENDER -->

                <div class="profile-information-item">

                    <span>
                        Gender
                    </span>

                    <select name="gender">

                        <option value="">
                            Select Gender
                        </option>

                        <option
                            value="Male"
                            <?= $gender === 'Male' ? 'selected' : '' ?>
                        >
                            Male
                        </option>

                        <option
                            value="Female"
                            <?= $gender === 'Female' ? 'selected' : '' ?>
                        >
                            Female
                        </option>

                        <option
                            value="Other"
                            <?= $gender === 'Other' ? 'selected' : '' ?>
                        >
                            Other
                        </option>

                    </select>

                </div>


                <!-- EMAIL -->

                <div class="profile-information-item">

                    <span>
                        Email
                    </span>

                    <strong>
                        <?= htmlspecialchars($profile->email ?? '-') ?>
                    </strong>

                    <small>
                        Email cannot be changed here.
                    </small>

                </div>


                <!-- ROLE -->

                <div class="profile-information-item">

                    <span>
                        Role
                    </span>

                    <strong>
                        <?= htmlspecialchars($profile->rank ?? '-') ?>
                    </strong>

                    <small>
                        Role is managed by the administrator.
                    </small>

                </div>


            </div>


            <div class="profile-form-actions">

                <a
                    href="<?= ROOT ?>/profile"
                    class="profile-cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="profile-save-btn"
                >
                    Save Changes
                </button>

            </div>


        </form>

    </section>

</main>


<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>

</body>

</html>