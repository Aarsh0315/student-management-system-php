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


    <!-- HOME CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- TEACHER STUDENT ADD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-student-add.view.css?v=1"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher / Student Management
            </p>

            <h1>
                Add Student
            </h1>

            <p class="welcome-text">
                Register a new student in your school.
            </p>

        </div>

    </section>



    <!-- ========================================
         STUDENT FORM
    ======================================== -->

    <section class="student-form-card">


        <form
            method="POST"
            action="<?= ROOT ?>/teacherstudents/create"
            enctype="multipart/form-data"
        >


            <!-- ========================================
                 PERSONAL INFORMATION
            ======================================== -->

            <div class="form-section">

                <div class="form-section-header">

                    <h2>
                        Personal Information
                    </h2>

                    <p>
                        Enter the student's basic personal details.
                    </p>

                </div>


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
                            placeholder="Enter student email"
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
                            placeholder="Create login password"
                            required
                        >

                    </div>



                    <!-- PROFILE IMAGE -->

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



                    <!-- DATE OF BIRTH -->

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



            <!-- ========================================
                 SCHOOL & ACADEMIC INFORMATION
            ======================================== -->

            <div class="form-section">

                <div class="form-section-header">

                    <h2>
                        Academic Information
                    </h2>

                    <p>
                        Enter the student's school and academic details.
                    </p>

                </div>


                <div class="form-grid">


                    <!-- ADMISSION NUMBER -->

                    <div class="form-group">

                        <label>
                            Admission Number
                        </label>

                        <input
                            type="text"
                            name="admission_number"
                            placeholder="Enter admission number"
                            required
                        >

                    </div>



                    <!-- CLASS -->

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



                    <!-- DIVISION -->

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



                    <!-- ROLL NUMBER -->

                    <div class="form-group">

                        <label>
                            Roll Number
                        </label>

                        <input
                            type="text"
                            name="roll_number"
                            placeholder="Enter roll number"
                        >

                    </div>



                    <!-- ADMISSION DATE -->

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



            <!-- ========================================
                 PARENT INFORMATION
            ======================================== -->

            <div class="form-section">

                <div class="form-section-header">

                    <h2>
                        Parent / Guardian Information
                    </h2>

                    <p>
                        Enter the parent or guardian details.
                    </p>

                </div>


                <div class="form-grid">


                    <!-- PARENT FIRST NAME -->

                    <div class="form-group">

                        <label>
                            Parent First Name
                        </label>

                        <input
                            type="text"
                            name="parent_firstname"
                            placeholder="Enter parent first name"
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
                            placeholder="Enter parent last name"
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
                            placeholder="Enter parent email"
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
                            placeholder="Enter parent phone number"
                            required
                        >

                    </div>


                </div>

            </div>



            <!-- ========================================
                 ADDRESS
            ======================================== -->

            <div class="form-section">

                <div class="form-section-header">

                    <h2>
                        Address
                    </h2>

                    <p>
                        Enter the student's residential address.
                    </p>

                </div>


                <div class="form-group">

                    <label>
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Enter residential address"
                    ></textarea>

                </div>

            </div>



            <!-- ========================================
                 ACTIONS
            ======================================== -->

            <div class="form-actions">


                <a
                    href="<?= ROOT ?>/teacherstudents"
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