<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Add Staff - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/staff-add.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >
    
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css"
    > 

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- HEADER -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Add Staff
            </h1>

            <p class="welcome-text">
                Register a new staff member in the system.
            </p>

        </div>

    </section>


    <!-- FORM -->

    <section class="staff-form-card">

        <form
    method="POST"
    action="<?= ROOT ?>/staff/create"
    enctype="multipart/form-data"
>

<?= CSRF::field() ?>


            <!-- =========================
                 PERSONAL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Personal Information
                </h2>


                <div class="form-grid">


                    <div class="form-group">

                        <label>
                            First Name
                        </label>

                        <input
                            type="text"
                            name="firstname"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Last Name
                        </label>

                        <input
                            type="text"
                            name="lastname"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Gender
                        </label>

                        <select
                            name="gender"
                            required
                        >

                            <option value="">
                                Select Gender
                            </option>

                            <option value="Male">
                                Male
                            </option>

                            <option value="Female">
                                Female
                            </option>

                            <option value="Other">
                                Other
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                    <label>
                        Profile Image
                    </label>

                    <input
                        type="file"
                        name="profile_image"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small>
                        JPG, PNG or WEBP. Maximum 2MB.
                    </small>

                </div>


                    <div class="form-group">

                        <label>
                            Date of Birth
                        </label>

                        <input
                            type="date"
                            name="date_of_birth"
                        >

                    </div>


                </div>

            </div>


            <!-- =========================
                 SCHOOL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    School Information
                </h2>


                <div class="form-grid">


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


        <?php foreach (
            ($data['schools'] ?? []) as $school
        ): ?>

            <option
                value="<?= htmlspecialchars($school->id) ?>"
            >

                <?= htmlspecialchars(
                    $school->school_name
                ) ?>

                -
                <?= htmlspecialchars(
                    $school->school_id
                ) ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>


                    


                </div>

            </div>


            <!-- =========================
                 PROFESSIONAL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Professional Information
                </h2>


                <div class="form-grid">


                    <div class="form-group">

                        <label>
                            Designation
                        </label>

                        <input
                            type="text"
                            name="designation"
                            placeholder="Teacher"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            placeholder="Mathematics"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Joining Date
                        </label>

                        <input
                            type="date"
                            name="joining_date"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Employment Type
                        </label>

                        <select name="employment_type">

                            <option value="">
                                Select Type
                            </option>

                            <option value="full_time">
                                Full Time
                            </option>

                            <option value="part_time">
                                Part Time
                            </option>

                            <option value="contract">
                                Contract
                            </option>

                        </select>

                    </div>


                </div>

            </div>


            <!-- =========================
                 CONTACT INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Contact Information
                </h2>


                <div class="form-grid">


                    <div class="form-group">

                        <label>
                            Phone
                        </label>

                        <input
                            type="tel"
                            name="phone"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Emergency Contact
                        </label>

                        <input
                            type="tel"
                            name="emergency_contact"
                        >

                    </div>


                </div>


                <div class="form-group address-field">

                    <label>
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                    ></textarea>

                </div>

            </div>


            <!-- ACTIONS -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/staff"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Add Staff
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