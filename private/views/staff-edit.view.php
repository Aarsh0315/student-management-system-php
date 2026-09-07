<?php

$staff   = $data['staff'] ?? null;
$schools = $data['schools'] ?? [];
$error   = $data['error'] ?? '';

if (!$staff) {
    die("Staff not found.");
}


/* =====================================================
   STAFF NAME
===================================================== */

$fullName = trim(
    ($staff->firstname ?? '') . ' ' .
    ($staff->lastname ?? '')
);


/* =====================================================
   INITIALS
===================================================== */

$firstInitial = !empty($staff->firstname)
    ? substr($staff->firstname, 0, 1)
    : '';

$lastInitial = !empty($staff->lastname)
    ? substr($staff->lastname, 0, 1)
    : '';

$initials = strtoupper(
    $firstInitial . $lastInitial
);

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
        Edit <?= htmlspecialchars($fullName) ?>
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


    <!-- STAFF -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/staff.view.css?v=4"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- EDIT STAFF -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/edit-staff.view.css?v=1"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ==================================================
         PAGE HEADER
    =================================================== -->

    <section class="welcome">

        <p class="welcome-small">
            Super Admin / Staff
        </p>

        <h1>
            Edit Staff
        </h1>

        <p class="welcome-text">
            Update staff information, professional details
            and account information.
        </p>

    </section>



    <!-- ==================================================
         EDIT STAFF CARD
    =================================================== -->

    <section class="staff-details-card">


        <!-- ==================================================
             STAFF HEADER
        =================================================== -->

        <div class="staff-details-header">


            <div class="staff-avatar">

                <?= htmlspecialchars($initials) ?>

            </div>


            <div class="staff-header-info">

                <h2>
                    <?= htmlspecialchars($fullName) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        $staff->staff_id ?? ''
                    ) ?>
                </p>

            </div>


            <span
                class="status
                <?= ($staff->status ?? '') === 'active'
                    ? 'active'
                    : 'inactive' ?>"
            >

                <?= htmlspecialchars(
                    ucfirst(
                        $staff->status ?? 'inactive'
                    )
                ) ?>

            </span>


        </div>



        <!-- ==================================================
             ERROR MESSAGE
        =================================================== -->

        <?php if (!empty($error)): ?>

            <div class="form-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- ==================================================
             EDIT FORM
        =================================================== -->

        <form
            method="POST"
            action="<?= ROOT ?>/staff/update/<?= urlencode($staff->staff_id) ?>"
            enctype="multipart/form-data"
            class="staff-edit-form"
        >

            <?= CSRF::field() ?>



            <!-- ==================================================
                 PERSONAL INFORMATION
            =================================================== -->

            <div class="details-section">

                <h3>
                    Personal Information
                </h3>


                <div class="information-grid">


                    <!-- FIRST NAME -->

                    <div class="form-group">

                        <label for="firstname">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="firstname"
                            name="firstname"
                            value="<?= htmlspecialchars(
                                $staff->firstname ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $staff->lastname ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $staff->email ?? ''
                            ) ?>"
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
                                Select Gender
                            </option>


                            <option
                                value="Male"
                                <?= ($staff->gender ?? '') === 'Male'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Male
                            </option>


                            <option
                                value="Female"
                                <?= ($staff->gender ?? '') === 'Female'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Female
                            </option>


                            <option
                                value="Other"
                                <?= ($staff->gender ?? '') === 'Other'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Other
                            </option>

                        </select>

                    </div>


                </div>

            </div>



            <!-- ==================================================
                 STAFF INFORMATION
            =================================================== -->

            <div class="details-section">

                <h3>
                    Staff Information
                </h3>


                <div class="information-grid">


                    <!-- STAFF ID -->

                    <div class="form-group">

                        <label for="staff_id">
                            Staff ID
                        </label>

                        <input
                            type="text"
                            id="staff_id"
                            value="<?= htmlspecialchars(
                                $staff->staff_id ?? ''
                            ) ?>"
                            readonly
                        >

                        <small>
                            Staff ID cannot be changed.
                        </small>

                    </div>



                    <!-- SCHOOL -->

                    <div class="form-group">

                        <label for="school_id">
                            School
                        </label>

                        <?php if (!empty($schools)): ?>

                            <select
                                id="school_id"
                                name="school_id"
                                required
                            >

                                <option value="">
                                    Select School
                                </option>


                                <?php foreach ($schools as $school): ?>

                                    <option
                                        value="<?= htmlspecialchars(
                                            $school->id
                                        ) ?>"
                                        <?= (string)(
                                            $staff->school_id ?? ''
                                        ) === (string)$school->id
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        <?= htmlspecialchars(
                                            $school->school_name
                                        ) ?>

                                        (<?= htmlspecialchars(
                                            $school->school_id
                                        ) ?>)

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        <?php else: ?>

                            <input
                                type="text"
                                value="<?= htmlspecialchars(
                                    $staff->school_name ?? ''
                                ) ?>"
                                readonly
                            >

                            <input
                                type="hidden"
                                name="school_id"
                                value="<?= htmlspecialchars(
                                    $staff->school_id ?? ''
                                ) ?>"
                            >

                        <?php endif; ?>

                    </div>



                    <!-- DEPARTMENT -->

                    <div class="form-group">

                        <label for="department">
                            Department
                        </label>

                        <input
                            type="text"
                            id="department"
                            name="department"
                            value="<?= htmlspecialchars(
                                $staff->department ?? ''
                            ) ?>"
                            required
                        >

                    </div>



                    <!-- DESIGNATION -->

                    <div class="form-group">

                        <label for="designation">
                            Designation
                        </label>

                        <input
                            type="text"
                            id="designation"
                            name="designation"
                            value="<?= htmlspecialchars(
                                $staff->designation ?? ''
                            ) ?>"
                            required
                        >

                    </div>



                    <!-- QUALIFICATION -->

                    <div class="form-group">

                        <label for="qualification">
                            Qualification
                        </label>

                        <input
                            type="text"
                            id="qualification"
                            name="qualification"
                            value="<?= htmlspecialchars(
                                $staff->qualification ?? ''
                            ) ?>"
                        >

                    </div>



                    <!-- JOINING DATE -->

                    <div class="form-group">

                        <label for="joining_date">
                            Joining Date
                        </label>

                        <input
                            type="date"
                            id="joining_date"
                            name="joining_date"
                            value="<?= htmlspecialchars(
                                $staff->joining_date ?? ''
                            ) ?>"
                        >

                    </div>



                    <!-- EMPLOYMENT TYPE -->

                    <div class="form-group">

                        <label for="employment_type">
                            Employment Type
                        </label>

                        <select
                            id="employment_type"
                            name="employment_type"
                        >

                            <option value="">
                                Select Employment Type
                            </option>

                            <option
                                value="Full Time"
                                <?= ($staff->employment_type ?? '') === 'Full Time'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Full Time
                            </option>

                            <option
                                value="Part Time"
                                <?= ($staff->employment_type ?? '') === 'Part Time'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Part Time
                            </option>

                            <option
                                value="Contract"
                                <?= ($staff->employment_type ?? '') === 'Contract'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Contract
                            </option>

                        </select>

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
                                $staff->phone ?? ''
                            ) ?>"
                        >

                    </div>


                </div>

            </div>



            <!-- ==================================================
                 ADDRESS
            =================================================== -->

            <div class="details-section">

                <h3>
                    Address
                </h3>


                <div class="information-grid single-column">

                    <div class="form-group">

                        <label for="address">
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            placeholder="Enter staff address"
                        ><?= htmlspecialchars(
                            $staff->address ?? ''
                        ) ?></textarea>

                    </div>

                </div>

            </div>



            <!-- ==================================================
                 ACCOUNT STATUS
            =================================================== -->

            <div class="details-section">

                <h3>
                    Account Status
                </h3>


                <div class="information-grid">

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
                                <?= ($staff->status ?? '') === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>


                            <option
                                value="inactive"
                                <?= ($staff->status ?? '') === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

            </div>



            <!-- ==================================================
                 PROFILE IMAGE
            =================================================== -->

            <div class="details-section">

                <h3>
                    Profile Image
                </h3>


                <div class="profile-image-section">


                    <?php if (!empty($staff->profile_image)): ?>

                        <div class="current-profile-image">

                            <img
                                src="<?= ROOT ?>/<?= htmlspecialchars(
                                    $staff->profile_image
                                ) ?>"
                                alt="Staff Profile"
                            >

                        </div>

                    <?php else: ?>

                        <div class="profile-placeholder">

                            <?= htmlspecialchars($initials) ?>

                        </div>

                    <?php endif; ?>


                    <div class="profile-upload">

                        <div class="form-group">

                            <label for="profile_image">
                                Choose New Image
                            </label>

                            <input
                                type="file"
                                id="profile_image"
                                name="profile_image"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small>
                                JPG, PNG or WEBP.
                                Maximum file size 2MB.
                            </small>

                        </div>

                    </div>


                </div>

            </div>



            <!-- ==================================================
                 FORM ACTIONS
            =================================================== -->

            <div class="staff-actions">


                <a
                    href="<?= ROOT ?>/staff/details/<?= urlencode(
                        $staff->staff_id
                    ) ?>"
                    class="back-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-staff-btn"
                >
                    Update Staff
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