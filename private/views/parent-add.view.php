<?php

$error = $data['error'] ?? '';

$schools = $data['schools'] ?? [];

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


    <!-- COMMON PAGE CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- PARENT ADD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-add.view.css?v=1"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin
            </p>

            <h1>
                Add Parent
            </h1>

            <p class="welcome-text">
                Register a new parent in the system.
            </p>

        </div>

    </section>



    <!-- ========================================
         ERROR
    ======================================== -->

    <?php if (!empty($error)): ?>

        <div class="form-error">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>



    <!-- ========================================
         FORM
    ======================================== -->

    <section class="parent-form-card">

        <form
            method="POST"
            action="<?= ROOT ?>/parents/add"
        >


            <!-- ========================================
                 PERSONAL INFORMATION
            ======================================== -->

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
                            placeholder="Enter parent email"
                            required
                        >

                    </div>



                    <!-- PHONE -->

                    <div class="form-group">

                        <label>
                            Phone
                        </label>

                        <input
                            type="tel"
                            name="phone"
                            placeholder="Enter phone number"
                        >

                    </div>



                    <!-- GENDER -->

                    <div class="form-group">

                        <label>
                            Gender
                        </label>

                        <select
                            name="gender"
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
                 SCHOOL INFORMATION
            ======================================== -->

            <div class="form-section">

                <h2>
                    School Information
                </h2>


                <div class="form-grid">


                    <!-- SCHOOL -->

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
                                $schools as $school
                            ): ?>

                                <option
                                    value="<?= htmlspecialchars(
                                        $school->id
                                    ) ?>"
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



            <!-- ========================================
                 CONTACT INFORMATION
            ======================================== -->

            <div class="form-section">

                <h2>
                    Contact Information
                </h2>


                <div class="form-grid">


                    <!-- ADDRESS -->

                    <div
                        class="form-group address-field"
                    >

                        <label>
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            placeholder="Enter parent address"
                        ></textarea>

                    </div>


                </div>

            </div>



            <!-- ========================================
                 ACTIONS
            ======================================== -->

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

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
</body>

</html>