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
        Create Test - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- TEACHER TEST CREATE CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-create.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ========================================= -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
            </p>

            <h1>
                Create Test
            </h1>

            <p class="welcome-text">
                Create a test and assign it
                to your class.
            </p>

        </div>

    </section>



    <!-- ========================================
         CREATE TEST CARD
    ======================================== -->

    <section class="test-form-card">


        <!-- FORM HEADER -->

        <div class="test-form-header">

            <h2>
                Test Information
            </h2>

            <p>
                Enter the basic details of your test.
            </p>

        </div>



        <!-- ========================================
             CREATE TEST FORM
        ======================================== -->

        <form
            method="POST"
            action="<?= ROOT ?>/teachertests/create"
        >

         <?= CSRF::field() ?>


            <!-- ========================================
                 TEST TITLE
            ========================================= -->

            <div class="form-group">

                <label for="title">
                    Test Title
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Example: Mathematics Unit Test"
                    required
                >

            </div>



            <!-- ========================================
                 DESCRIPTION
            ========================================= -->

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Enter test instructions or description..."
                ></textarea>

            </div>



            <!-- ========================================
                 CLASS + DIVISION
            ========================================= -->

            <div class="form-row">


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


            </div>



            <!-- ========================================
                 MARKS + DURATION
            ========================================= -->

            <div class="form-row">


                <div class="form-group">

                    <label for="total_marks">
                        Total Marks
                    </label>

                    <input
                        type="number"
                        id="total_marks"
                        name="total_marks"
                        min="1"
                        placeholder="Example: 50"
                        required
                    >

                </div>



                <div class="form-group">

                    <label for="duration">
                        Duration (Minutes)
                    </label>

                    <input
                        type="number"
                        id="duration"
                        name="duration"
                        min="1"
                        placeholder="Example: 60"
                        required
                    >

                </div>


            </div>



            <!-- ========================================
                 DATES
            ========================================= -->

            <div class="form-row">


                <div class="form-group">

                    <label for="start_date">
                        Start Date & Time
                    </label>

                    <input
                        type="datetime-local"
                        id="start_date"
                        name="start_date"
                    >

                </div>



                <div class="form-group">

                    <label for="end_date">
                        End Date & Time
                    </label>

                    <input
                        type="datetime-local"
                        id="end_date"
                        name="end_date"
                    >

                </div>


            </div>



            <!-- ========================================
                 FORM ACTIONS
            ========================================= -->

            <div class="form-actions">


                <a
                    href="<?= ROOT ?>/teachertests"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="create-test-btn"
                >
                    Create Test
                </button>


            </div>


        </form>


    </section>


</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>