<?php

$parents = $data['parents'] ?? [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rank = $_SESSION['rank'] ?? '';

if ($rank === 'super_admin') {

    $roleName = 'Super Admin';

} elseif ($rank === 'admin') {

    $roleName = 'School Admin';

} else {

    $roleName = 'User';

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
        Parents - My School
    </title>


    <!-- SUPER ADMIN NAVBAR -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/schools.view.css?v=4"
>

    <link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css?v=2"
>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    > 

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/parents.view.css?v=2"
    > 


</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="page-header">

        <div class="welcome">

            <p class="welcome-small">
                <?= htmlspecialchars($roleName) ?>
            </p>

            <h1>
                Parents
            </h1>

            <p class="welcome-text">
                View and manage parents across all schools.
            </p>

        </div>


        
    </section>



    <!-- ========================================
         PARENTS CARD
    ======================================== -->

    <section class="parents-card">


        <!-- ========================================
             CARD HEADER
        ======================================== -->

        <div class="parents-header">

            <div>

                <h2>
                    All Parents
                </h2>

                <p>

                    <?= count($parents) ?>

                    parent(s) registered

                </p>

            </div>

        </div>



        <?php if (!empty($parents)): ?>


            <!-- ========================================
                 TABLE
            ======================================== -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>
                                Parent
                            </th>

                            <th>
                                Student(s)
                            </th>
                            <th>
                                Email
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                School
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


                        <?php foreach (
                            $parents as $parent
                        ): ?>


                            <tr>

                                <!-- PARENT -->

                                <td>

                                    <strong class="parent-name">

                                        <?= htmlspecialchars(
                                            $parent->firstname
                                            ?? ''
                                        ) ?>

                                        <?= htmlspecialchars(
                                            $parent->lastname
                                            ?? ''
                                        ) ?>

                                    </strong>

                                </td>

                                <!-- STUDENT(S) -->

                                <td>

                                    <span class="student-names">

                                        <?= htmlspecialchars(
                                            $parent->student_names
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>

                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->email
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $parent->phone
                                        ?? '-'
                                    ) ?>

                                </td>



                                <!-- SCHOOL -->

                                <td>

                                    <span class="school-name">

                                        <?= htmlspecialchars(
                                            $parent->school_name
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        ($parent->status ?? '')
                                        === 'active'
                                    ): ?>

                                        <span
                                            class="status active"
                                        >
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="status inactive"
                                        >
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="<?= ROOT ?>/parents/details/<?= urlencode($parent->user_id) ?>"
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


            <!-- ========================================
                 EMPTY STATE
            ======================================== -->

            <div class="empty-state">

                <h3>
                    No Parents Found
                </h3>

                <p>
                    There are currently no parents
                    registered in the system.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>