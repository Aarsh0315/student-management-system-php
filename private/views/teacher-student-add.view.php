<?php

$school_id = $data['school_id'] ?? '';

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


    <!-- TEACHER NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-nav.view.css?v=4"
    >


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- ADD STUDENT CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-student-add.view.css?v=3"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=4"
    >

</head>


<body>


<?php require "../private/views/includes/teacher-nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Add Student
            </h1>

            <p class="welcome-text">
                Add a new student to your school.
            </p>

        </div>

    </section>



    <!-- ========================================
         ADD STUDENT FORM
    ======================================== -->

    <form
        action="<?= ROOT ?>/teacherstudents/add"
        method="POST"
        class="student-form"
    >


        <!-- ========================================
             PERSONAL INFORMATION
        ======================================== -->

        <section class="form-card">

            <div class="form-header">

                <h2>
                    Personal Information
                </h2>

                <p>
                    Enter the student's basic information.
                </p>

            </div>


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
                        placeholder="Enter student email"
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
                            Select gender
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



                <!-- DATE OF BIRTH -->

                <div class="form-group">

                    <label for="date_of_birth">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        id="date_of_birth"
                        name="date_of_birth"
                    >

                </div>


            </div>

        </section>



        <!-- ========================================
             ACADEMIC INFORMATION
        ======================================== -->

        <section class="form-card">

            <div class="form-header">

                <h2>
                    Academic Information
                </h2>

                <p>
                    Enter the student's academic details.
                </p>

            </div>


            <div class="form-grid">


                <!-- ADMISSION NUMBER -->

                <div class="form-group">

                    <label for="admission_number">
                        Admission Number
                    </label>

                    <input
                        type="text"
                        id="admission_number"
                        name="admission_number"
                        placeholder="Enter admission number"
                        required
                    >

                </div>



                <!-- ROLL NUMBER -->

                <div class="form-group">

                    <label for="roll_number">
                        Roll Number
                    </label>

                    <input
                        type="number"
                        id="roll_number"
                        name="roll_number"
                        placeholder="Enter roll number"
                    >

                </div>



                <!-- CLASS -->

                <div class="form-group">

                    <label for="class">
                        Class
                    </label>

                    <input
                        type="text"
                        id="class"
                        name="class"
                        placeholder="Example: 10"
                        required
                    >

                </div>



                <!-- DIVISION -->

                <div class="form-group">

                    <label for="division">
                        Division
                    </label>

                    <input
                        type="text"
                        id="division"
                        name="division"
                        placeholder="Example: A"
                        required
                    >

                </div>



                <!-- ADMISSION DATE -->

                <div class="form-group">

                    <label for="admission_date">
                        Admission Date
                    </label>

                    <input
                        type="date"
                        id="admission_date"
                        name="admission_date"
                    >

                </div>


            </div>

        </section>



        <!-- ========================================
             PARENT INFORMATION
        ======================================== -->

        <section class="form-card">

            <div class="form-header">

                <h2>
                    Parent / Guardian Information
                </h2>

                <p>
                    Enter the parent or guardian contact details.
                </p>

            </div>


            <div class="form-grid">


                <!-- PARENT NAME -->

                <div class="form-group">

                    <label for="parent_name">
                        Parent Name
                    </label>

                    <input
                        type="text"
                        id="parent_name"
                        name="parent_name"
                        placeholder="Enter parent name"
                    >

                </div>



                <!-- PARENT PHONE -->

                <div class="form-group">

                    <label for="parent_phone">
                        Parent Phone
                    </label>

                    <input
                        type="tel"
                        id="parent_phone"
                        name="parent_phone"
                        placeholder="Enter parent phone"
                    >

                </div>



                <!-- PARENT EMAIL -->

                <div class="form-group">

                    <label for="parent_email">
                        Parent Email
                    </label>

                    <input
                        type="email"
                        id="parent_email"
                        name="parent_email"
                        placeholder="Enter parent email"
                    >

                </div>


            </div>

        </section>



        <!-- ========================================
             CONTACT INFORMATION
        ======================================== -->

        <section class="form-card">

            <div class="form-header">

                <h2>
                    Contact Information
                </h2>

                <p>
                    Enter the student's address.
                </p>

            </div>


            <div class="form-grid">


                <!-- ADDRESS -->

                <div class="form-group full-width">

                    <label for="address">
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Enter student address"
                    ></textarea>

                </div>


            </div>

        </section>



        <!-- ========================================
             FORM ACTIONS
        ======================================== -->

        <div class="form-actions">
            
            <button
                type="submit"
                class="save-btn"
            >
                Add Student
            </button>

        </div>


    </form>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>