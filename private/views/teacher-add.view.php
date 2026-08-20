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
        Add Teacher - My School
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


    <!-- TEACHER ADD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-add.view.css?v=1"
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
                Add Teacher
            </h1>

            <p class="welcome-text">
                Register a new teacher in your school.
            </p>

        </div>

    </section>



    <!-- =========================
         TEACHER FORM
    ========================== -->

    <section class="teacher-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/teachers/create"
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
                 PROFESSIONAL INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Professional Information
                </h2>


                <div class="form-grid">


                    <!-- DEPARTMENT -->

                    <div class="form-group">

                        <label>
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            placeholder="Science"
                            required
                        >

                    </div>


                    <!-- DESIGNATION -->

                    <div class="form-group">

                        <label>
                            Designation
                        </label>

                        <select
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

                        <label>
                            Qualification
                        </label>

                        <input
                            type="text"
                            name="qualification"
                            placeholder="M.Sc Physics"
                            required
                        >

                    </div>


                    <!-- JOINING DATE -->

                    <div class="form-group">

                        <label>
                            Joining Date
                        </label>

                        <input
                            type="date"
                            name="joining_date"
                            required
                        >

                    </div>


                    <!-- EMPLOYMENT TYPE -->

                    <div class="form-group">

                        <label>
                            Employment Type
                        </label>

                        <select
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



            <!-- =========================
                 CONTACT INFORMATION
            ========================== -->

            <div class="form-section">

                <h2>
                    Contact Information
                </h2>


                <div class="form-grid">


                    <!-- PHONE -->

                    <div class="form-group">

                        <label>
                            Phone
                        </label>

                        <input
                            type="tel"
                            name="phone"
                            required
                        >

                    </div>


                    <!-- ADDRESS -->

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

            </div>



            <!-- =========================
                 ACTIONS
            ========================== -->

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


</body>

</html>