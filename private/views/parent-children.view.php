<?php

$parent =
    $data['parent'] ?? null;

$children =
    $data['children'] ?? [];

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
        My Children - My School
    </title>


    <!-- SHARED NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- SHARED SIDEBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- PARENT CHILDREN -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parent-children.view.css?v=1"
    >


    <!-- FOOTER -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<!-- ========================================
     SHARED NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SHARED SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="parent-children-page">

    <div class="parent-children-container">


        <!-- ========================================
             PAGE HEADER
        ======================================== -->

        <section class="children-welcome">

            <div class="children-welcome-content">

                <p class="children-welcome-label">
                    PARENT ACADEMICS
                </p>

                <h1>
                    My Children
                </h1>

                <p class="children-welcome-description">
                    View information about your children and their academic details.
                </p>

            </div>


            <div class="children-status">

                <span class="status-dot"></span>

                <span>
                    Active
                </span>

            </div>

        </section>



        <!-- ========================================
             CHILDREN OVERVIEW
        ======================================== -->

        <section class="children-overview-card">

            <div class="children-overview-left">

                <div class="children-icon">
                    PR
                </div>


                <div class="children-overview-info">

                    <span class="children-label">
                        MY CHILDREN
                    </span>

                    <h2>

                        <?= count($children) ?>

                        <span class="children-count-label">
                            <?= count($children) == 1 ? 'Child' : 'Children' ?>
                        </span>

                    </h2>

                    <p>
                        <?= count($children) ?>
                        <?= count($children) == 1 ? 'student is' : 'students are' ?>
                        linked to your parent account.
                    </p>

                </div>

            </div>


            <span class="active-badge">

                <span class="badge-dot"></span>

                Active

            </span>

        </section>



        <!-- ========================================
             PARENT INFORMATION
        ======================================== -->

        <section class="children-card">

            <div class="children-section-header">

                <div>

                    <h2>
                        Parent Information
                    </h2>

                    <p>
                        Your parent account information.
                    </p>

                </div>

            </div>


            <div class="children-details-grid">


                <!-- Parent ID -->

                <div class="children-detail-item">

                    <span>
                        Parent ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $parent->user_id ?? '-'
                        ) ?>
                    </strong>

                </div>


                <!-- Parent Name -->

                <div class="children-detail-item">

                    <span>
                        Parent Name
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            trim(
                                ($parent->firstname ?? '') . ' ' .
                                ($parent->lastname ?? '')
                            ) ?: '-'
                        ) ?>
                    </strong>

                </div>


                <!-- Email -->

                <div class="children-detail-item">

                    <span>
                        Email
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $parent->email ?? '-'
                        ) ?>
                    </strong>

                </div>


                <!-- School -->

                <div class="children-detail-item">

                    <span>
                        School
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $parent->school_name ?? '-'
                        ) ?>
                    </strong>

                </div>


            </div>

        </section>



        <!-- ========================================
             CHILDREN
        ======================================== -->

        <section class="children-card">

            <div class="children-section-header">

                <div>

                    <h2>
                        Children
                    </h2>

                    <p>
                        Students linked to your parent account.
                    </p>

                </div>


                <span class="student-count">

                    <?= count($children) ?>

                    <?= count($children) == 1 ? 'Child' : 'Children' ?>

                </span>

            </div>


            <?php if (!empty($children)): ?>


                <div class="children-table-wrapper">

                    <table class="children-table">

                        <thead>

                            <tr>

                                <th>
                                    Roll No.
                                </th>

                                <th>
                                    Student Name
                                </th>

                                <th>
                                    Admission No.
                                </th>

                                <th>
                                    Class
                                </th>

                                <th>
                                    Division
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

                                <?php

                                $firstname =
                                    $child->firstname ?? '';

                                $lastname =
                                    $child->lastname ?? '';

                                $fullName =
                                    trim(
                                        $firstname . ' ' . $lastname
                                    );

                                $initial =
                                    strtoupper(
                                        substr(
                                            $firstname ?: 'S',
                                            0,
                                            1
                                        )
                                    );

                                $status =
                                    strtolower(
                                        $child->status ?? 'active'
                                    );

                                ?>


                                <tr>


                                    <!-- Roll Number -->

                                    <td>

                                        <span class="roll-number">

                                            <?= htmlspecialchars(
                                                $child->roll_number ?? '-'
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- Student Name -->

                                    <td>

                                        <div class="student-name-cell">

                                            <div class="student-avatar">

                                                <?= $initial ?>

                                            </div>


                                            <strong>

                                                <?= htmlspecialchars(
                                                    $fullName ?: 'Student'
                                                ) ?>

                                            </strong>

                                        </div>

                                    </td>


                                    <!-- Admission Number -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $child->admission_number ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- Class -->

                                    <td>

                                        <span class="class-badge">

                                            <?= htmlspecialchars(
                                                $child->class ?? '-'
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- Division -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $child->division ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- Status -->

                                    <td>

                                        <?php if ($status === 'active'): ?>

                                            <span class="status-badge active">

                                                <span class="status-dot"></span>

                                                Active

                                            </span>

                                        <?php else: ?>

                                            <span class="status-badge inactive">

                                                <span class="status-dot"></span>

                                                <?= htmlspecialchars(
                                                    ucfirst($status)
                                                ) ?>

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>


                            <?php endforeach; ?>


                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <!-- EMPTY STATE -->

                <div class="empty-state">

                    <div class="empty-icon">
                        PR
                    </div>

                    <h3>
                        No Children Found
                    </h3>

                    <p>
                        There are currently no students linked
                        to your parent account.
                    </p>

                </div>


            <?php endif; ?>


        </section>


    </div>

</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     SHARED JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>