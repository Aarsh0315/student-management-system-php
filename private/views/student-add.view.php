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


                    <div class="form-group">

                        <label>
                            School ID
                        </label>

                        <input
                            type="number"
                            name="school_id"
                            required
                        >

                    </div>


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
            ========================== -->

            <div class="form-section">

                <h2>
                    Parent / Guardian Information
                </h2>


                <div class="form-grid">


                    <div class="form-group">

                        <label>
                            Parent Name
                        </label>

                        <input
                            type="text"
                            name="parent_name"
                            required
                        >

                    </div>


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


                    <div class="form-group">

                        <label>
                            Parent Email
                        </label>

                        <input
                            type="email"
                            name="parent_email"
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


</body>

</html>