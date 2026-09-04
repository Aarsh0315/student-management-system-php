<?php

$user = $data['user'] ?? null;
$schools = $data['schools'] ?? [];
$error = $data['error'] ?? '';

if (!$user) {
    die("User not found.");
}

$fullName = trim(
    ($user->firstname ?? '') . ' ' .
    ($user->lastname ?? '')
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
        Edit <?= htmlspecialchars($fullName) ?>
        - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- HOME / COMMON -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- USERS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/users.view.css?v=5"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- EDIT USER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/edit-user.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin / Users
        </p>

        <h1>
            Edit User
        </h1>

        <p class="welcome-text">
            Update user information, account access and profile details.
        </p>

    </section>



    <!-- =========================
         EDIT USER CARD
    ========================== -->

    <section class="user-details-card">


        <!-- =========================
             USER HEADER
        ========================== -->

        <div class="user-details-header">


            <div class="user-avatar">

                <?php

                $firstInitial = !empty($user->firstname)
                    ? substr($user->firstname, 0, 1)
                    : '';

                $lastInitial = !empty($user->lastname)
                    ? substr($user->lastname, 0, 1)
                    : '';

                echo htmlspecialchars(
                    strtoupper($firstInitial . $lastInitial)
                );

                ?>

            </div>


            <div class="user-header-info">

                <h2>
                    <?= htmlspecialchars($fullName) ?>
                </h2>

                <p>
                    <?= htmlspecialchars($user->user_id ?? '') ?>
                </p>

            </div>


            <span
                class="status
                <?= ($user->status ?? '') === 'active'
                    ? 'active'
                    : 'inactive' ?>"
            >

                <?= htmlspecialchars(
                    ucfirst($user->status ?? 'inactive')
                ) ?>

            </span>


        </div>



        <!-- =========================
             ERROR MESSAGE
        ========================== -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- =========================
             EDIT FORM
        ========================== -->

        <form
            method="POST"
            action="<?= ROOT ?>/users/update/<?= urlencode($user->user_id) ?>"
            enctype="multipart/form-data"
            class="user-edit-form"
        >

            <?= CSRF::field() ?>



            <!-- =========================
                 PERSONAL INFORMATION
            ========================== -->

            <div class="details-section">

                <h3>
                    Personal Information
                </h3>


                <div class="information-grid">


                    <!-- FIRST NAME -->

                    <div class="form-group">

                        <label for="firstname">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="firstname"
                            name="firstname"
                            value="<?= htmlspecialchars($user->firstname ?? '') ?>"
                            required
                        >

                    </div>



                    <!-- LAST NAME -->

                    <div class="form-group">

                        <label for="lastname">
                            Last Name
                        </label>

                        <input
                            type="text"
                            id="lastname"
                            name="lastname"
                            value="<?= htmlspecialchars($user->lastname ?? '') ?>"
                            required
                        >

                    </div>



                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($user->email ?? '') ?>"
                            required
                        >

                    </div>



                    <!-- GENDER -->

                    <div class="form-group">

                        <label for="gender">
                            Gender
                        </label>

                        <select
                            id="gender"
                            name="gender"
                            required
                        >

                            <option value="">
                                Select Gender
                            </option>

                            <option
                                value="Male"
                                <?= ($user->gender ?? '') === 'Male'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Male
                            </option>

                            <option
                                value="Female"
                                <?= ($user->gender ?? '') === 'Female'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Female
                            </option>

                            <option
                                value="Other"
                                <?= ($user->gender ?? '') === 'Other'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Other
                            </option>

                        </select>

                    </div>


                </div>

            </div>



            <!-- =========================
                 ACCOUNT INFORMATION
            ========================== -->

            <div class="details-section">

                <h3>
                    Account Information
                </h3>


                <div class="information-grid">


                    <!-- USER ID -->

                    <div class="form-group">

                        <label for="user_id">
                            User ID
                        </label>

                        <input
                            type="text"
                            id="user_id"
                            value="<?= htmlspecialchars($user->user_id ?? '') ?>"
                            readonly
                        >

                        <small>
                            User ID cannot be changed.
                        </small>

                    </div>



                    <!-- SCHOOL -->

                    <div class="form-group">

                        <label for="school_id">
                            School
                        </label>

                        <select
                            id="school_id"
                            name="school_id"
                            required
                        >

                            <option value="">
                                Select School
                            </option>


                            <?php foreach ($schools as $school): ?>

                                <option
                                    value="<?= htmlspecialchars($school->id) ?>"
                                    <?= (string)($user->school_id ?? '') ===
                                       (string)$school->id
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= htmlspecialchars(
                                        $school->school_name
                                    ) ?>

                                    (<?= htmlspecialchars(
                                        $school->school_id
                                    ) ?>)

                                </option>

                            <?php endforeach; ?>


                        </select>

                    </div>



                    <!-- ROLE -->

                    <div class="form-group">

                        <label for="rank">
                            Role
                        </label>

                        <select
                            id="rank"
                            name="rank"
                            required
                        >

                            <option value="">
                                Select Role
                            </option>


                            <option
                                value="super_admin"
                                <?= ($user->rank ?? '') === 'super_admin'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Super Admin
                            </option>


                            <option
                                value="admin"
                                <?= ($user->rank ?? '') === 'admin'
                                    ? 'selected'
                                    : '' ?>
                            >
                                School Admin
                            </option>


                            <option
                                value="principal"
                                <?= ($user->rank ?? '') === 'principal'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Principal
                            </option>


                            <option
                                value="vice_principal"
                                <?= ($user->rank ?? '') === 'vice_principal'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Vice Principal
                            </option>


                            <option
                                value="teacher"
                                <?= ($user->rank ?? '') === 'teacher'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Teacher
                            </option>


                            <option
                                value="student"
                                <?= ($user->rank ?? '') === 'student'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Student
                            </option>


                            <option
                                value="parent"
                                <?= ($user->rank ?? '') === 'parent'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Parent
                            </option>


                            <option
                                value="staff"
                                <?= ($user->rank ?? '') === 'staff'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Staff
                            </option>


                        </select>

                    </div>



                    <!-- STATUS -->

                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                        >

                            <option
                                value="active"
                                <?= ($user->status ?? '') === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= ($user->status ?? '') === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                </div>

            </div>



            <!-- =========================
                 PASSWORD
            ========================== -->

            <div class="details-section">

                <h3>
                    Change Password
                </h3>


                <p class="section-description">
                    Leave both fields empty if you do not want to change
                    the user's password.
                </p>


                <div class="information-grid">


                    <!-- NEW PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            New Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="new-password"
                            placeholder="Enter new password"
                        >

                    </div>



                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label for="password2">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            id="password2"
                            name="password2"
                            autocomplete="new-password"
                            placeholder="Confirm new password"
                        >

                    </div>


                </div>

            </div>



            <!-- =========================
                 PROFILE IMAGE
            ========================== -->

            <div class="details-section">

                <h3>
                    Profile Image
                </h3>


                <div class="profile-image-section">


                    <?php if (!empty($user->profile_image)): ?>

                        <div class="current-profile-image">

                            <img
                                src="<?= ROOT ?>/<?= htmlspecialchars(
                                    $user->profile_image
                                ) ?>"
                                alt="User Profile"
                            >

                        </div>

                    <?php else: ?>

                        <div class="profile-placeholder">

                            <?= htmlspecialchars(
                                strtoupper(
                                    $firstInitial .
                                    $lastInitial
                                )
                            ) ?>

                        </div>

                    <?php endif; ?>


                    <div class="profile-upload">

                        <div class="form-group">

                            <label for="profile_image">
                                Choose New Image
                            </label>

                            <input
                                type="file"
                                id="profile_image"
                                name="profile_image"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small>
                                JPG, PNG or WEBP. Maximum file size 2MB.
                            </small>

                        </div>

                    </div>


                </div>

            </div>



            <!-- =========================
                 FORM ACTIONS
            ========================== -->

            <div class="user-actions">


                <a
                    href="<?= ROOT ?>/users/details/<?= urlencode($user->user_id) ?>"
                    class="back-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-user-btn"
                >
                    Update User
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