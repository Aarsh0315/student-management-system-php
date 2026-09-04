<?php

$school = $data['school'] ?? null;
$error = $data['error'] ?? '';

if (!$school) {
    die("School not found.");
}

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
        Edit <?= htmlspecialchars($school->school_name) ?>
        - My School
    </title>


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- HOME / COMMON -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >


    <!-- SCHOOL DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/school.view.css?v=2"
    >


    <!-- SCHOOLS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schools.view.css?v=5"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/edit-school.view.css?v=2">

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin / Schools
        </p>

        <h1>
            Edit School
        </h1>

        <p class="welcome-text">
            Update school information and contact details.
        </p>

    </section>



    <!-- =========================
         EDIT SCHOOL CARD
    ========================== -->

    <section class="school-details-card">


        <!-- =========================
             SCHOOL HEADER
        ========================== -->

        <div class="school-details-header">


            <div class="school-avatar">

                <?= strtoupper(
                    substr(
                        $school->school_name,
                        0,
                        1
                    )
                ) ?>

            </div>


            <div>

                <h2>
                    <?= htmlspecialchars(
                        $school->school_name
                    ) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        $school->school_id
                    ) ?>
                </p>

            </div>


            <span
                class="status
                <?= $school->status === 'active'
                    ? 'active'
                    : 'inactive' ?>"
            >

                <?= htmlspecialchars(
                    ucfirst($school->status)
                ) ?>

            </span>


        </div>



        <!-- =========================
             ERROR MESSAGE
        ========================== -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- =========================
             EDIT FORM
        ========================== -->

        <form
            method="POST"
            action="<?= ROOT ?>/schools/update/<?= urlencode($school->school_id) ?>"
            class="school-edit-form"
        >

            <?= CSRF::field() ?>



            <!-- =========================
                 SCHOOL INFORMATION
            ========================== -->

            <div class="details-section">

                <h3>
                    School Information
                </h3>


                <div class="information-grid">


                    <!-- SCHOOL NAME -->

                    <div class="form-group">

                        <label for="school_name">
                            School Name
                        </label>

                        <input
                            type="text"
                            id="school_name"
                            name="school_name"
                            value="<?= htmlspecialchars($school->school_name ?? '') ?>"
                            required
                        >

                    </div>



                    <!-- SCHOOL ID -->

                    <div class="form-group">

                        <label for="school_id">
                            School ID
                        </label>

                        <input
                            type="text"
                            id="school_id"
                            value="<?= htmlspecialchars($school->school_id ?? '') ?>"
                            readonly
                        >

                        <small>
                            School ID cannot be changed.
                        </small>

                    </div>



                    <!-- SCHOOL CODE -->

                    <div class="form-group">

                        <label for="school_code">
                            School Code
                        </label>

                        <input
                            type="text"
                            id="school_code"
                            name="school_code"
                            value="<?= htmlspecialchars($school->school_code ?? '') ?>"
                        >

                    </div>



                    <!-- ESTABLISHED YEAR -->

                    <div class="form-group">

                        <label for="established_year">
                            Established Year
                        </label>

                        <input
                            type="number"
                            id="established_year"
                            name="established_year"
                            value="<?= htmlspecialchars($school->established_year ?? '') ?>"
                            min="1800"
                            max="<?= date('Y') ?>"
                        >

                    </div>



                    <!-- BOARD -->

                    <div class="form-group">

                        <label for="board">
                            Board
                        </label>

                        <input
                            type="text"
                            id="board"
                            name="board"
                            value="<?= htmlspecialchars($school->board ?? '') ?>"
                        >

                    </div>



                    <!-- MEDIUM -->

                    <div class="form-group">

                        <label for="medium">
                            Medium
                        </label>

                        <input
                            type="text"
                            id="medium"
                            name="medium"
                            value="<?= htmlspecialchars($school->medium ?? '') ?>"
                        >

                    </div>



                    <!-- SCHOOL TYPE -->

                    <div class="form-group">

                        <label for="school_type">
                            School Type
                        </label>

                        <input
                            type="text"
                            id="school_type"
                            name="school_type"
                            value="<?= htmlspecialchars($school->school_type ?? '') ?>"
                        >

                    </div>



                    <!-- ACADEMIC YEAR -->

                    <div class="form-group">

                        <label for="academic_year">
                            Academic Year
                        </label>

                        <input
                            type="text"
                            id="academic_year"
                            name="academic_year"
                            value="<?= htmlspecialchars($school->academic_year ?? '') ?>"
                        >

                    </div>


                </div>

            </div>



            <!-- =========================
                 CONTACT INFORMATION
            ========================== -->

            <div class="details-section">

                <h3>
                    Contact Information
                </h3>


                <div class="information-grid">


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($school->email ?? '') ?>"
                        >

                    </div>



                    <!-- PHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Phone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="<?= htmlspecialchars($school->phone ?? '') ?>"
                        >

                    </div>



                    <!-- EMERGENCY CONTACT -->

                    <div class="form-group">

                        <label for="emergency_contact">
                            Emergency Contact
                        </label>

                        <input
                            type="text"
                            id="emergency_contact"
                            name="emergency_contact"
                            value="<?= htmlspecialchars($school->emergency_contact ?? '') ?>"
                        >

                    </div>



                    <!-- WEBSITE -->

                    <div class="form-group">

                        <label for="website">
                            Website
                        </label>

                        <input
                            type="url"
                            id="website"
                            name="website"
                            value="<?= htmlspecialchars($school->website ?? '') ?>"
                            placeholder="https://example.com"
                        >

                    </div>


                </div>

            </div>



            <!-- =========================
                 ADDRESS
            ========================== -->

            <div class="details-section">

                <h3>
                    Address
                </h3>


                <div class="form-group full-width">

                    <label for="address">
                        School Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                    ><?= htmlspecialchars($school->address ?? '') ?></textarea>

                </div>

            </div>



            <!-- =========================
                 STATUS
            ========================== -->

            <div class="details-section">

                <h3>
                    School Status
                </h3>


                <div class="form-group">

                    <label for="status">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                    >

                        <option
                            value="active"
                            <?= $school->status === 'active'
                                ? 'selected'
                                : '' ?>
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            <?= $school->status === 'inactive'
                                ? 'selected'
                                : '' ?>
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>



            <!-- =========================
                 FORM ACTIONS
            ========================== -->

            <div class="school-actions">


                <a
                    href="<?= ROOT ?>/schools/details/<?= urlencode($school->school_id) ?>"
                    class="back-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-school-btn"
                >
                    Update School
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