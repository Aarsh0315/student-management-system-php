<?php

$teacher = $data['teacher'] ?? null;

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
        Teacher Details - My School
    </title>


    <!-- COMMON CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- TEACHER DETAILS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-details.view.css?v=2"
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
                School Admin
            </p>

            <h1>
                Teacher Details
            </h1>

            <p class="welcome-text">
                View detailed information about
                this teacher.
            </p>

        </div>

    </section>



    <!-- =========================
         TEACHER PROFILE
    ========================== -->

    <section class="teacher-profile-card">


        <!-- AVATAR -->

        <div class="teacher-avatar">

            <?php

            $firstname =
                $teacher->firstname ?? 'T';

            echo strtoupper(
                substr($firstname, 0, 1)
            );

            ?>

        </div>



        <!-- PROFILE INFORMATION -->

        <div class="teacher-profile-info">

            <h2>

                <?= htmlspecialchars(
                    ($teacher->firstname ?? '')
                    . ' '
                    . ($teacher->lastname ?? '')
                ) ?>

            </h2>


            <p>

                <?= htmlspecialchars(
                    $teacher->email ?? '-'
                ) ?>

            </p>


            <span>

                <?= htmlspecialchars(
                    $teacher->designation ?? '-'
                ) ?>

            </span>

        </div>


    </section>



    <!-- =========================
         PROFESSIONAL INFORMATION
    ========================== -->

    <section class="teacher-info-card">


        <div class="teacher-info-header">

            <h2>
                Professional Information
            </h2>

        </div>


        <div class="table-wrapper">

            <table class="teacher-info-table">


                <tbody>


                    <tr>

                        <th>
                            Staff ID
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->staff_id ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Department
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->department ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Designation
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->designation ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Qualification
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->qualification ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Joining Date
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->joining_date ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Employment Type
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->employment_type ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Phone
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->phone ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Address
                        </th>

                        <td>

                            <?= htmlspecialchars(
                                $teacher->address ?? '-'
                            ) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Status
                        </th>

                        <td>

                            <span
                                class="teacher-detail-status <?= strtolower(
                                    $teacher->status ?? ''
                                ) ?>"
                            >

                                <?= htmlspecialchars(
                                    ucfirst(
                                        $teacher->status ?? '-'
                                    )
                                ) ?>

                            </span>

                        </td>

                    </tr>


                </tbody>


            </table>

        </div>


    </section>



    <!-- =========================
         ACTIONS
    ========================== -->

    <div class="teacher-detail-actions">


        <a
            href="<?= ROOT ?>/teachers"
            class="teacher-back-btn"
        >
            ← Back to Teachers
        </a>


        <a
            href="<?= ROOT ?>/teachers/edit/<?= urlencode($teacher->staff_id) ?>"
            class="teacher-edit-btn"
        >
            Edit Teacher
        </a>


    </div>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>