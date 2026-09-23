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
        Edit <?= htmlspecialchars($school->school_name ?? 'School') ?>
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


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- SCHOOLS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schools.view.css?v=5"
    >

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/edit-school.view.css?v=1"
>

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- =========================
         PAGE HEADER
    ========================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Super Admin / Schools
            </p>

            <h1>
                Edit School
            </h1>

            <p class="welcome-text">
                Update school information and settings.
            </p>

        </div>

    </section>



    <!-- =========================
         EDIT SCHOOL CARD
    ========================== -->

    <section class="schools-card">


        <!-- SCHOOL HEADER -->

        <div class="schools-header">

            <div>

                <h2>
                    <?= htmlspecialchars(
                        $school->school_name ?? 'School'
                    ) ?>
                </h2>

                <p>
                    School ID:
                    <strong>
                        <?= htmlspecialchars(
                            $school->school_id ?? ''
                        ) ?>
                    </strong>
                </p>

            </div>

        </div>



        <!-- ERROR -->

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
            action="<?= ROOT ?>/schools/update/<?= urlencode(
                $school->school_id
            ) ?>"
        >

            <?= CSRF::field() ?>


            <!-- =========================
                 BASIC INFORMATION
            ========================== -->

            <div class="details-section">

                <h3>
                    Basic Information
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
                            value="<?= htmlspecialchars(
                                $school->school_name ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $school->school_id ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $school->school_code ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $school->email ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $school->phone ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $school->emergency_contact ?? ''
                            ) ?>"
                        >

                    </div>


                </div>

            </div>



            <!-- =========================
                 SCHOOL DETAILS
            ========================== -->

            <div class="details-section">

                <h3>
                    School Details
                </h3>


                <div class="information-grid">


                    <!-- BOARD -->

                    <div class="form-group">

                        <label for="board">
                            Board
                        </label>

                        <input
                            type="text"
                            id="board"
                            name="board"
                            value="<?= htmlspecialchars(
                                $school->board ?? ''
                            ) ?>"
                            placeholder="e.g. CBSE, ICSE, State Board"
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
                            value="<?= htmlspecialchars(
                                $school->medium ?? ''
                            ) ?>"
                            placeholder="e.g. English, Hindi, Marathi"
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
                            value="<?= htmlspecialchars(
                                $school->school_type ?? ''
                            ) ?>"
                            placeholder="e.g. Private, Public"
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
                            value="<?= htmlspecialchars(
                                $school->academic_year ?? ''
                            ) ?>"
                            placeholder="e.g. 2026-27"
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
                            value="<?= htmlspecialchars(
                                $school->established_year ?? ''
                            ) ?>"
                            min="1800"
                            max="<?= date('Y') ?>"
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
                            value="<?= htmlspecialchars(
                                $school->website ?? ''
                            ) ?>"
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


                <div class="form-group">

                    <label for="address">
                        School Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Enter complete school address"
                    ><?= htmlspecialchars(
                        $school->address ?? ''
                    ) ?></textarea>

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
                        required
                    >

                        <option
                            value="active"
                            <?= ($school->status ?? '') === 'active'
                                ? 'selected'
                                : '' ?>
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            <?= ($school->status ?? '') === 'inactive'
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

            <div class="user-actions">

                <a
                    href="<?= ROOT ?>/schools/details/<?= urlencode(
                        $school->school_id
                    ) ?>"
                    class="back-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-user-btn"
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