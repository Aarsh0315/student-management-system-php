<?php

$student = $data['student'] ?? null;
$schools = $data['schools'] ?? [];
$error   = $data['error'] ?? '';

if (!$student) {
    die("Student not found.");
}


/* =====================================================
   STUDENT NAME
===================================================== */

$fullName = trim(
    ($student->firstname ?? '') . ' ' .
    ($student->lastname ?? '')
);


/* =====================================================
   INITIALS
===================================================== */

$firstInitial = !empty($student->firstname)
    ? substr($student->firstname, 0, 1)
    : '';

$lastInitial = !empty($student->lastname)
    ? substr($student->lastname, 0, 1)
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


    <!-- STUDENTS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/students.view.css?v=5"
    >


    <!-- SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- EDIT STUDENT -->

   <link rel="stylesheet" href="<?= ROOT ?>/css/edit-student.view.css?v=1">

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
            Super Admin / Students
        </p>

        <h1>
            Edit Student
        </h1>

        <p class="welcome-text">
            Update student information, academic details
            and parent information.
        </p>

    </section>



    <!-- ==================================================
         EDIT STUDENT CARD
    =================================================== -->

    <section class="student-details-card">


        <!-- ==================================================
             STUDENT HEADER
        =================================================== -->

        <div class="student-details-header">


            <div class="student-avatar">

                <?= htmlspecialchars($initials) ?>

            </div>


            <div class="student-header-info">

                <h2>
                    <?= htmlspecialchars($fullName) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        $student->student_id ?? ''
                    ) ?>
                </p>

            </div>


            <span
                class="status
                <?= ($student->status ?? '') === 'active'
                    ? 'active'
                    : 'inactive' ?>"
            >

                <?= htmlspecialchars(
                    ucfirst(
                        $student->status ?? 'inactive'
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
            action="<?= ROOT ?>/students/update/<?= urlencode($student->student_id) ?>"
            enctype="multipart/form-data"
            class="student-edit-form"
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
                                $student->firstname ?? ''
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
                                $student->lastname ?? ''
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
                                $student->email ?? ''
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
                                <?= ($student->gender ?? '') === 'Male'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Male
                            </option>


                            <option
                                value="Female"
                                <?= ($student->gender ?? '') === 'Female'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Female
                            </option>


                            <option
                                value="Other"
                                <?= ($student->gender ?? '') === 'Other'
                                    ? 'selected'
                                    : '' ?>
                            >
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
                            value="<?= htmlspecialchars(
                                $student->date_of_birth ?? ''
                            ) ?>"
                        >

                    </div>


                </div>

            </div>



            <!-- ==================================================
                 ACADEMIC INFORMATION
            =================================================== -->

            <div class="details-section">

                <h3>
                    Academic Information
                </h3>


                <div class="information-grid">


                    <!-- STUDENT ID -->

                    <div class="form-group">

                        <label for="student_id">
                            Student ID
                        </label>

                        <input
                            type="text"
                            id="student_id"
                            value="<?= htmlspecialchars(
                                $student->student_id ?? ''
                            ) ?>"
                            readonly
                        >

                        <small>
                            Student ID cannot be changed.
                        </small>

                    </div>



                    <!-- ADMISSION NUMBER -->

                    <div class="form-group">

                        <label for="admission_number">
                            Admission Number
                        </label>

                        <input
                            type="text"
                            id="admission_number"
                            name="admission_number"
                            value="<?= htmlspecialchars(
                                $student->admission_number ?? ''
                            ) ?>"
                            required
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
                            value="<?= htmlspecialchars(
                                $student->class ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $student->division ?? ''
                            ) ?>"
                            required
                        >

                    </div>



                    <!-- ROLL NUMBER -->

                    <div class="form-group">

                        <label for="roll_number">
                            Roll Number
                        </label>

                        <input
                            type="text"
                            id="roll_number"
                            name="roll_number"
                            value="<?= htmlspecialchars(
                                $student->roll_number ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $student->admission_date ?? ''
                            ) ?>"
                        >

                    </div>



                    <!-- SCHOOL -->

                    <div class="form-group">

                        <label for="school_id">
                            School
                        </label>

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
                                        $student->school_id ?? ''
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

                    </div>


                </div>

            </div>



            <!-- ==================================================
                 PARENT / GUARDIAN INFORMATION
            =================================================== -->

            <div class="details-section">

                <h3>
                    Parent / Guardian Information
                </h3>


                <div class="information-grid">


                    <!-- PARENT NAME -->

                    <div class="form-group">

                        <label for="parent_name">
                            Parent / Guardian Name
                        </label>

                        <input
                            type="text"
                            id="parent_name"
                            name="parent_name"
                            value="<?= htmlspecialchars(
                                $student->parent_name ?? ''
                            ) ?>"
                        >

                    </div>



                    <!-- PARENT PHONE -->

                    <div class="form-group">

                        <label for="parent_phone">
                            Parent Phone
                        </label>

                        <input
                            type="text"
                            id="parent_phone"
                            name="parent_phone"
                            value="<?= htmlspecialchars(
                                $student->parent_phone ?? ''
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $student->parent_email ?? ''
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
                            placeholder="Enter student's address"
                        ><?= htmlspecialchars(
                            $student->address ?? ''
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
                                <?= ($student->status ?? '') === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>


                            <option
                                value="inactive"
                                <?= ($student->status ?? '') === 'inactive'
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


                    <?php if (!empty($student->profile_image)): ?>

                        <div class="current-profile-image">

                            <img
                                src="<?= ROOT ?>/<?= htmlspecialchars(
                                    $student->profile_image
                                ) ?>"
                                alt="Student Profile"
                            >

                        </div>

                    <?php else: ?>

                        <div class="profile-placeholder">

                            <?= htmlspecialchars(
                                $initials
                            ) ?>

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

            <div class="student-actions">


                <a
                    href="<?= ROOT ?>/students/details/<?= urlencode(
                        $student->student_id
                    ) ?>"
                    class="back-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="save-student-btn"
                >
                    Update Student
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