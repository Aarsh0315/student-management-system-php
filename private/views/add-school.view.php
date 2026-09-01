<?php

$error = $data['error'] ?? '';

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
        Add School - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/add-school.view.css"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    > 

</head>

<body>


<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <section class="welcome">

        <p class="welcome-small">
            Super Admin
        </p>

        <h1>
            Add School
        </h1>

        <p class="welcome-text">
            Register a new school in the system.
        </p>

    </section>


    <?php if (!empty($error)): ?>

        <div class="error-message">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <section class="school-form-card">

        <form
            method="POST"
            action="<?= ROOT ?>/schools/add"
        >


            <!-- BASIC INFORMATION -->

            <div class="form-section">

                <h2>
                    School Information
                </h2>


                <div class="form-row">

                    <div class="form-group">

                        <label for="school_name">
                            School Name
                        </label>

                        <input
                            type="text"
                            id="school_name"
                            name="school_name"
                            placeholder="Enter school name"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="school_id">
                            School ID
                        </label>

                        <input
                            type="text"
                            id="school_id"
                            name="school_id"
                            placeholder="Example: SCHOOL004"
                            required
                        >

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="school_code">
                            School Code
                        </label>

                        <input
                            type="text"
                            id="school_code"
                            name="school_code"
                            placeholder="Example: DBM001"
                        >

                    </div>


                    <div class="form-group">

                        <label for="school_type">
                            School Type
                        </label>

                        <select
                            id="school_type"
                            name="school_type"
                        >

                            <option value="">
                                Select Type
                            </option>

                            <option value="Primary">
                                Primary
                            </option>

                            <option value="Secondary">
                                Secondary
                            </option>

                            <option value="Higher Secondary">
                                Higher Secondary
                            </option>

                            <option value="Primary & Secondary">
                                Primary & Secondary
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- ACADEMIC -->

            <div class="form-section">

                <h2>
                    Academic Information
                </h2>


                <div class="form-row">

                    <div class="form-group">

                        <label for="board">
                            Board
                        </label>

                        <input
                            type="text"
                            id="board"
                            name="board"
                            placeholder="CBSE / ICSE / State Board"
                        >

                    </div>


                    <div class="form-group">

                        <label for="medium">
                            Medium
                        </label>

                        <input
                            type="text"
                            id="medium"
                            name="medium"
                            placeholder="English / Marathi / Hindi"
                        >

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="academic_year">
                            Academic Year
                        </label>

                        <input
                            type="text"
                            id="academic_year"
                            name="academic_year"
                            placeholder="2026-27"
                        >

                    </div>


                    <div class="form-group">

                        <label for="established_year">
                            Established Year
                        </label>

                        <input
                            type="number"
                            id="established_year"
                            name="established_year"
                            placeholder="1990"
                        >

                    </div>

                </div>

            </div>


            <!-- CONTACT -->

            <div class="form-section">

                <h2>
                    Contact Information
                </h2>


                <div class="form-row">

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="school@example.com"
                        >

                    </div>


                    <div class="form-group">

                        <label for="phone">
                            Phone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            placeholder="School phone number"
                        >

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="emergency_contact">
                            Emergency Contact
                        </label>

                        <input
                            type="text"
                            id="emergency_contact"
                            name="emergency_contact"
                            placeholder="Emergency phone"
                        >

                    </div>


                    <div class="form-group">

                        <label for="website">
                            Website
                        </label>

                        <input
                            type="text"
                            id="website"
                            name="website"
                            placeholder="https://example.com"
                        >

                    </div>

                </div>

            </div>


            <!-- ADDRESS -->

            <div class="form-section">

                <h2>
                    Address
                </h2>


                <div class="form-group">

                    <label for="address">
                        School Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Enter complete school address"
                    ></textarea>

                </div>

            </div>


            <!-- STATUS -->

            <div class="form-section">

                <h2>
                    Status
                </h2>


                <div class="form-group">

                    <label for="status">
                        School Status
                    </label>

                    <select
                        id="status"
                        name="status"
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


            <!-- BUTTONS -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/schools"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="submit-btn"
                >
                    Add School
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