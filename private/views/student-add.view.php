<?php

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
        Add Student - My School 
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-add.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
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
                Student Management
            </p>

            <h1>
                Add Student
            </h1>

            <p class="welcome-text">
                Register a new student in the system.
            </p>

        </div>

    </section>


    <!-- FORM -->

    <section class="student-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/students/create"
            enctype="multipart/form-data"
        >


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
                        Profile Image
                    </label>

                    <input
                        type="file"
                        name="profile_image"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small>
                        Upload JPG, PNG or WEBP image. Maximum size 2MB.
                    </small>

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
                    School & Academic Information
                </h2>


                <div class="form-grid">


                    <?php if (
    ($_SESSION['rank'] ?? '') === 'super_admin'
): ?>

    <div class="form-group">

        <label>
            School
        </label>

        <select
            name="school_id"
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

        <small>
            Select the school where this student will be registered.
        </small>

    </div>

<?php endif; ?>


                    <div class="form-group">

                        <label>
                            Admission Number
                        </label>

                        <input
                            type="text"
                            name="admission_number"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Class
                        </label>

                        <input
                            type="text"
                            name="class"
                            placeholder="10"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Division
                        </label>

                        <input
                            type="text"
                            name="division"
                            placeholder="A"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Roll Number
                        </label>

                        <input
                            type="text"
                            name="roll_number"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Admission Date
                        </label>

                        <input
                            type="date"
                            name="admission_date"
                        >

                    </div>


                </div>

            </div>


            <!-- =========================
     PARENT INFORMATION
========================= -->

<div class="form-section">

    <h2>
        Parent / Guardian Information
    </h2>


    <div class="form-grid">


        <!-- PARENT FIRST NAME -->

        <div class="form-group">

            <label>
                Parent First Name
            </label>

            <input
                type="text"
                name="parent_firstname"
                required
            >

        </div>



        <!-- PARENT LAST NAME -->

        <div class="form-group">

            <label>
                Parent Last Name
            </label>

            <input
                type="text"
                name="parent_lastname"
                required
            >

        </div>



        <!-- PARENT EMAIL -->

        <div class="form-group">

            <label>
                Parent Email
            </label>

            <input
                type="email"
                name="parent_email"
                required
            >

            <small>
                This email will be used by the parent to log in.
            </small>

        </div>



        <!-- PARENT PHONE -->

        <div class="form-group">

            <label>
                Parent Phone
            </label>

            <input
                type="tel"
                name="parent_phone"
                required
            >

        </div>


    </div>

</div>


            <!-- =========================
                 ADDRESS
            ========================== -->

            <div class="form-section">

                <h2>
                    Address
                </h2>


                <div class="form-group">

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
                    href="<?= ROOT ?>/students"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Add Student
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