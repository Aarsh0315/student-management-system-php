<?php

$parent = $data['parent'] ?? null;

$children = $data['children'] ?? [];


if (!$parent) {

    die("Parent not found.");

}


/* =========================
   FULL NAME
========================= */

$fullName =
    ($parent->firstname ?? '')
    . ' '
    . ($parent->lastname ?? '');


/* =========================
   INITIAL
========================= */

$initial = strtoupper(
    substr(
        $parent->firstname ?? 'P',
        0,
        1
    )
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
        Parent Details - My School
    </title>


    <!-- COMMON -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css"
    >


    <!-- PARENT DETAILS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-details.view.css?v=1"
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
                Super Admin
            </p>

            <h1>
                Parent Details
            </h1>

            <p class="welcome-text">
                View complete information about this parent.
            </p>

        </div>

    </section>



    <!-- =========================
         PARENT PROFILE
    ========================== -->

    <section class="parent-profile-card">


        <div class="parent-profile-left">


            <!-- =========================
                 AVATAR
            ========================== -->

            <div class="parent-large-avatar">

                <?= htmlspecialchars(
                    $initial
                ) ?>

            </div>



            <!-- =========================
                 BASIC DETAILS
            ========================== -->

            <div class="parent-profile-info">

                <h2>

                    <?= htmlspecialchars(
                        trim($fullName)
                    ) ?>

                </h2>


                <p>

                    <?= htmlspecialchars(
                        $parent->email ?? '-'
                    ) ?>

                </p>


                <span class="parent-role-badge">

                    Parent

                </span>

            </div>


        </div>



        <!-- =========================
             STATUS
        ========================== -->

        <?php if (
            ($parent->status ?? 'active')
            === 'active'
        ): ?>

            <span class="status active">
                Active
            </span>

        <?php else: ?>

            <span class="status inactive">
                Inactive
            </span>

        <?php endif; ?>


    </section>



    <!-- =========================
         PERSONAL INFORMATION
    ========================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Personal Information
            </h2>

            <p>
                Basic information about the parent.
            </p>

        </div>


        <div class="details-grid">


            <!-- PARENT ID -->

            <div class="details-item">

                <span>
                    Parent ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->user_id ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- USER ID -->

            <div class="details-item">

                <span>
                    User ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->user_id ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- FIRST NAME -->

            <div class="details-item">

                <span>
                    First Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->firstname ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- LAST NAME -->

            <div class="details-item">

                <span>
                    Last Name
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->lastname ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- EMAIL -->

            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->email ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- GENDER -->

            <div class="details-item">

                <span>
                    Gender
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->gender ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- STATUS -->

            <div class="details-item">

                <span>
                    Status
                </span>

                <strong>

                    <?= htmlspecialchars(
                        ucfirst(
                            $parent->status
                            ?? 'active'
                        )
                    ) ?>

                </strong>

            </div>



            <!-- ROLE -->

            <div class="details-item">

                <span>
                    Role
                </span>

                <strong>
                    Parent
                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         SCHOOL INFORMATION
    ========================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                School Information
            </h2>

            <p>
                School assigned to this parent.
            </p>

        </div>


        <div class="details-grid">


            <!-- SCHOOL -->

            <div class="details-item">

                <span>
                    School
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->school_name
                        ?? 'No School'
                    ) ?>

                </strong>

            </div>



            <!-- SCHOOL ID -->

            <div class="details-item">

                <span>
                    School ID
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->school_id
                        ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         CONTACT INFORMATION
    ========================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Contact Information
            </h2>

            <p>
                Parent contact information.
            </p>

        </div>


        <div class="details-grid">


            <!-- PHONE -->

            <div class="details-item">

                <span>
                    Phone
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->phone ?? '-'
                    ) ?>

                </strong>

            </div>



            <!-- EMAIL -->

            <div class="details-item">

                <span>
                    Email
                </span>

                <strong>

                    <?= htmlspecialchars(
                        $parent->email ?? '-'
                    ) ?>

                </strong>

            </div>


        </div>

    </section>



    <!-- =========================
         CHILDREN INFORMATION
    ========================== -->

    <section class="parent-details-card">


        <div class="details-header">

            <h2>
                Children
            </h2>

            <p>
                Students linked to this parent.
            </p>

        </div>



        <?php if (!empty($children)): ?>


            <div class="children-table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Student ID
                            </th>

                            <th>
                                Student
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Roll Number
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach (
                            $children as $child
                        ): ?>


                            <tr>


                                <!-- STUDENT ID -->

                                <td>

                                    <span class="student-id">

                                        <?= htmlspecialchars(
                                            $child->student_id
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STUDENT -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $child->firstname
                                            ?? ''
                                        ) ?>

                                        <?= htmlspecialchars(
                                            $child->lastname
                                            ?? ''
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- CLASS -->

                                <td>

                                    <?= htmlspecialchars(
                                        $child->class
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $child->division
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- ROLL NUMBER -->

                                <td>

                                    <?= htmlspecialchars(
                                        $child->roll_number
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($child->status ?? '')
                                        === 'active'
                                    ): ?>

                                        <span class="status active">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="status inactive">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <div class="empty-state">

                <h3>
                    No Children Found
                </h3>

                <p>
                    There are currently no students
                    linked to this parent.
                </p>

            </div>


        <?php endif; ?>


    </section>



    <!-- =========================
         BACK BUTTON
    ========================== -->

    <div class="parent-actions">

        <a
            href="<?= ROOT ?>/parents"
            class="back-btn"
        >
            ← Back to Parents
        </a>

    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>