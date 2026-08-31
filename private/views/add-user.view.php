<?php

$error = $data['error'] ?? '';

$schools = $data['schools'] ?? [];

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
        Add User - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    > 
    
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/add-user.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin
        </p>

        <h1>
            Add User
        </h1>

        <p class="welcome-text">
            Create a new user and assign them to a school.
        </p>

    </section>


    <!-- =========================
         ERROR
    ========================== -->

    <?php if (!empty($error)): ?>

        <div class="error-message">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>


    <!-- =========================
         FORM
    ========================== -->

    <section class="user-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/users/add"
            enctype="multipart/form-data"
        >


            <!-- =========================
                 PERSONAL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Personal Information
                </h2>


                <div class="form-row">


                    <!-- USER ID -->

                    


                    <!-- FIRST NAME -->

                    <div class="form-group">

                        <label for="firstname">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="firstname"
                            name="firstname"
                            placeholder="Enter first name"
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
                            placeholder="Enter last name"
                            required
                        >

                    </div>


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
                        placeholder="Enter email address"
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

                        <option value="male">
                            Male
                        </option>

                        <option value="female">
                            Female
                        </option>

                        <option value="other">
                            Other
                        </option>

                    </select>

                </div>

            </div>

            <!-- PROFILE IMAGE -->

<!-- ========================================
     PROFILE IMAGE
======================================== -->

<div class="form-group profile-image-group">

    <label for="profile_image">
        Profile Image
    </label>

    <div class="profile-image-input">

        <input
            type="file"
            id="profile_image"
            name="profile_image"
            accept="image/jpeg,image/png,image/webp"
        >

    </div>

    <small>
        JPG, PNG or WEBP. Maximum 2MB.
    </small>

</div>


            <!-- =========================
                 SCHOOL & ROLE
            ========================== -->

            <div class="form-section">

                <h2>
                    School & Role
                </h2>


                <!-- SCHOOL -->

                <div class="form-group">

    <label for="school_id">
        School
    </label>

    <select
        name="school_id"
        id="school_id"
        required
    >

        <option value="">
            Select School
        </option>

        <?php foreach ($schools as $school): ?>

            <option
                value="<?= htmlspecialchars($school->id) ?>"
            >

                <?= htmlspecialchars(
                    $school->school_id
                ) ?>

                -
                
                <?= htmlspecialchars(
                    $school->school_name
                ) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

                <!-- SCHOOL ID / CODE -->

                <div class="form-group">

                    <label for="school_code_display">
                        School ID
                    </label>

                    <input
                        type="text"
                        id="school_code_display"
                        placeholder="Select a school"
                        readonly
                    >

                </div>


                <!-- RANK -->

                <div class="form-group">

                    <label for="rank">
                        Rank
                    </label>

                    <select
                        id="rank"
                        name="rank"
                        required
                    >

                        <option value="">
                            Select Rank
                        </option>

                        <option value="admin">
                            School Admin
                        </option>

                        <option value="principal">
                            Principal
                        </option>

                        <option value="vice_principal">
                            Vice Principal
                        </option>

                        <option value="teacher">
                            Teacher
                        </option>

                        <option value="student">
                            Student
                        </option>

                        <option value="parent">
                            Parent
                        </option>

                        <option value="staff">
                            Staff
                        </option>

                    </select>

                </div>

            </div>


            <!-- =========================
                 PASSWORD
            ========================== -->

            <div class="form-section">

                <h2>
                    Account Security
                </h2>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                        required
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
                        placeholder="Confirm password"
                        required
                    >

                </div>

            </div>


            <!-- =========================
                 STATUS
            ========================== -->

            <div class="form-section">

                <h2>
                    Account Status
                </h2>


                <div class="form-group">

                    <label for="status">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                    >

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            <!-- =========================
                 ACTIONS
            ========================== -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/users"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="submit-btn"
                >
                    Add User
                </button>

            </div>


        </form>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<!-- =========================
     SCHOOL CODE SCRIPT
========================== -->

<script>

const schoolSelect = document.getElementById('school_id');

const schoolCode = document.getElementById(
    'school_code_display'
);


schoolSelect.addEventListener(
    'change',
    function () {

        const selectedOption =
            this.options[this.selectedIndex];

        const code =
            selectedOption.dataset.schoolCode || '';

        schoolCode.value = code;

    }
);

</script>


</body>

</html>