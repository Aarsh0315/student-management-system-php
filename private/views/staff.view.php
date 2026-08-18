<?php

$staff = $data['staff'] ?? [];

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
        Staff - My School
    </title>


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- STAFF CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/staff.view.css"
    >


    <!-- FOOTER CSS -->

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
                Staff
            </h1>

            <p class="welcome-text">
                Manage all staff members
                across the schools.
            </p>

        </div>

    </section>


    <!-- =========================
         STAFF TABLE
    ========================== -->

    <section class="staff-card">


        <!-- HEADER -->

        <div class="staff-header">

            <div>

                <h2>
                    All Staff
                </h2>

                <p>

                    <?= count($staff) ?>

                    staff member(s) registered

                </p>

            </div>


            <!-- ADD STAFF -->

            <a
                href="<?= ROOT ?>/staff/add"
                class="add-staff-btn"
            >
                + Add Staff
            </a>

        </div>


        <?php if (!empty($staff)): ?>


            <!-- =========================
                 TABLE
            ========================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Staff ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach ($staff as $member): ?>


                            <tr>


                                <!-- STAFF ID -->

                                <td>

                                    <span class="staff-id">

                                        <?= htmlspecialchars(
                                            $member->staff_id ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- NAME -->

                                <td>

                                    <strong class="staff-name">

                                        <?= htmlspecialchars(
                                            ($member->firstname ?? '')
                                            . ' '
                                            . ($member->lastname ?? '')
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- ROLE -->

                                <td>

                                    <span class="staff-role">

                                        <?= htmlspecialchars(
                                            $member->designation
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DEPARTMENT -->

                                <td>

                                    <span class="staff-department">

                                        <?= htmlspecialchars(
                                            $member->department
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- SCHOOL -->

                                <td>

                                    <?php if (
                                        !empty(
                                            $member->school_name
                                        )
                                    ): ?>

                                        <span class="staff-school">

                                            <?= htmlspecialchars(
                                                $member->school_name
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="no-school">
                                            No School
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $member->email ?? '-'
                                    ) ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($member->status ?? '')
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


                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/staff/details/<?= urlencode($member->staff_id) ?>"
                                        class="view-btn"
                                    >
                                        View
                                    </a>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <!-- =========================
                 EMPTY STATE
            ========================== -->

            <div class="empty-state">

                <h3>
                    No staff found
                </h3>

                <p>
                    There are currently no staff
                    members registered.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<!-- =========================
     FOOTER
========================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>