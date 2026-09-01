<?php

$error =
    $data['error'] ?? '';

$success =
    $data['success'] ?? '';

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
        Add Teacher - My School
    </title>


    <!-- =================================================
         NAVBAR
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- =================================================
         SIDEBAR
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- =================================================
         TEACHER ADD PAGE
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-add.view.css?v=2"
    >


    <!-- =================================================
         FOOTER
    ================================================== -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =================================================
         PAGE HEADER
    ================================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">

                School Admin

            </p>


            <h1>

                Add Teacher

            </h1>


            <p class="welcome-text">

                Register a new teacher in your school.

            </p>

        </div>

    </section>



    <!-- =================================================
         TEACHER FORM CARD
    ================================================== -->

    <section class="teacher-form-card">


        <!-- =================================================
             ERROR
        ================================================== -->

        <?php if (!empty($error)): ?>

            <div class="error-message">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- =================================================
             SUCCESS
        ================================================== -->

        <?php if (!empty($success)): ?>

            <div class="success-message">

                <?= htmlspecialchars($success) ?>

            </div>

        <?php endif; ?>



        <!-- =================================================
             FORM
        ================================================== -->

        <form
            method="POST"
            action="<?= ROOT ?>/teachers/create"
        >


            <!-- =================================================
                 PERSONAL INFORMATION
            ================================================== -->

            <div class="form-section">

                <h2>
                    Personal Information
                </h2>


                <div class="form-grid">


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



                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="teacher@example.com"
                            required
                        >

                    </div>



                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter password"
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


                </div>

            </div>



            <!-- =================================================
                 PROFESSIONAL INFORMATION
            ================================================== -->

            <div class="form-section">

                <h2>
                    Professional Information
                </h2>


                <div class="form-grid">


                    <!-- DEPARTMENT -->

                    <div class="form-group">

                        <label for="department">
                            Department
                        </label>

                        <input
                            type="text"
                            id="department"
                            name="department"
                            placeholder="Science"
                            required
                        >

                    </div>



                    <!-- DESIGNATION -->

                    <div class="form-group">

                        <label for="designation">
                            Designation
                        </label>

                        <select
                            id="designation"
                            name="designation"
                            required
                        >

                            <option value="">
                                Select Designation
                            </option>

                            <option value="Teacher">
                                Teacher
                            </option>

                            <option value="Senior Teacher">
                                Senior Teacher
                            </option>

                            <option value="Head Teacher">
                                Head Teacher
                            </option>

                            <option value="Principal">
                                Principal
                            </option>

                            <option value="Other">
                                Other
                            </option>

                        </select>

                    </div>



                    <!-- QUALIFICATION -->

                    <div class="form-group">

                        <label for="qualification">
                            Qualification
                        </label>

                        <input
                            type="text"
                            id="qualification"
                            name="qualification"
                            placeholder="M.Sc Physics"
                            required
                        >

                    </div>



                    <!-- JOINING DATE -->

                    <div class="form-group">

                        <label for="joining_date">
                            Joining Date
                        </label>

                        <input
                            type="date"
                            id="joining_date"
                            name="joining_date"
                            required
                        >

                    </div>



                    <!-- EMPLOYMENT TYPE -->

                    <div class="form-group">

                        <label for="employment_type">
                            Employment Type
                        </label>

                        <select
                            id="employment_type"
                            name="employment_type"
                            required
                        >

                            <option value="">
                                Select Employment Type
                            </option>

                            <option value="Full-time">
                                Full-time
                            </option>

                            <option value="Part-time">
                                Part-time
                            </option>

                            <option value="Contract">
                                Contract
                            </option>

                        </select>

                    </div>


                </div>

            </div>



            <!-- =================================================
                 CONTACT INFORMATION
            ================================================== -->

            <div class="form-section">

                <h2>
                    Contact Information
                </h2>


                <div class="form-grid">


                    <!-- PHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Phone
                        </label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="Enter phone number"
                            required
                        >

                    </div>



                    <!-- ADDRESS -->

                    <div class="form-group">

                        <label for="address">
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            placeholder="Enter teacher address"
                        ></textarea>

                    </div>


                </div>

            </div>



            <!-- =================================================
                 ACTIONS
            ================================================== -->

            <div class="form-actions">


                <a
                    href="<?= ROOT ?>/teachers"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Add Teacher
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