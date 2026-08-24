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
        Add Parent - My School
    </title>


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- PARENT FORM CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-add.view.css?v=1"
    >


    <!-- FOOTER -->

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

        <div>

            <p class="welcome-small">
                School Admin
            </p>

            <h1>
                Add Parent
            </h1>

            <p class="welcome-text">
                Create a parent account for your school.
            </p>

        </div>

    </section>



    <!-- =========================
         PARENT FORM
    ========================== -->

    <section class="parent-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/parents/create"
        >


            <!-- =========================
                 PERSONAL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Personal Information
                </h2>


                <div class="form-grid">


                    <!-- FIRST NAME -->

                    <div class="form-group">

                        <label>
                            First Name
                        </label>

                        <input
                            type="text"
                            name="firstname"
                            placeholder="Enter first name"
                            required
                        >

                    </div>


                    <!-- LAST NAME -->

                    <div class="form-group">

                        <label>
                            Last Name
                        </label>

                        <input
                            type="text"
                            name="lastname"
                            placeholder="Enter last name"
                            required
                        >

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Enter email address"
                            required
                        >

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label>
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Enter password"
                            required
                        >

                    </div>


                    <!-- GENDER -->

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


                </div>

            </div>



            <!-- =========================
                 SCHOOL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    School Assignment
                </h2>


                <div class="form-grid">


                    <?php if (
                        ($_SESSION['rank'] ?? '')
                        === 'super_admin'
                    ): ?>


                        <div class="form-group">

                            <label>
                                School ID
                            </label>

                            <input
                                type="number"
                                name="school_id"
                                placeholder="Enter school ID"
                                required
                            >

                            <small>
                                Enter the database ID of the school.
                            </small>

                        </div>


                    <?php else: ?>


                        <div class="form-group">

                            <label>
                                School
                            </label>

                            <input
                                type="text"
                                value="Your Assigned School"
                                disabled
                            >

                            <small>
                                Parent will automatically be assigned
                                to your school.
                            </small>

                        </div>


                    <?php endif; ?>


                </div>

            </div>



            <!-- =========================
                 ACTIONS
            ========================== -->

            <div class="form-actions">


                <a
                    href="<?= ROOT ?>/parents"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Add Parent
                </button>


            </div>


        </form>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>