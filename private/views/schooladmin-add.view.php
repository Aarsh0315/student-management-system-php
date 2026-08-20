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
        Add School Admin - My School
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schooladmin-add.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- HEADER -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Add School Admin
            </h1>

            <p class="welcome-text">
                Create an administrator account for a school.
            </p>

        </div>

    </section>


    <!-- FORM -->

    <section class="admin-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/schooladmins/create"
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
                            Phone
                        </label>

                        <input
                            type="tel"
                            name="phone"
                        >

                    </div>


                </div>

            </div>


            <!-- =========================
                 SCHOOL
            ========================== -->

            <div class="form-section">

                <h2>
                    School Assignment
                </h2>


                <div class="form-grid">


                    <div class="form-group">

                        <label>
                            School ID
                        </label>

                        <input
                            type="number"
                            name="school_id"
                            required
                        >

                        <small>
                            Enter the database ID of the school.
                        </small>

                    </div>


                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            required
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


            <!-- =========================
                 ACTIONS
            ========================== -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/schooladmins"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-btn"
                >
                    Add School Admin
                </button>

            </div>


        </form>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>