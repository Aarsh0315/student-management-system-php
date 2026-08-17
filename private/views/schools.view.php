<?php

$schools = $data['schools'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Schools - My School</title>


    <!-- Same navbar CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css"
    >


    <!-- Schools CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/schools.view.css"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<main class="dashboard">


    <!-- PAGE HEADER -->

    <section class="page-header">

        <div>

            <p class="page-small">
                Super Admin
            </p>

            <h1>
                Schools
            </h1>

            <p>
                View and manage all schools in the system.
            </p>

        </div>


        <a
            href="<?= ROOT ?>/schools/create"
            class="add-school-btn"
        >
            + Add School
        </a>

    </section>



    <!-- SCHOOL LIST -->

    <section class="schools-card">


        <div class="card-header">

            <div>

                <h2>
                    All Schools
                </h2>

                <p>
                    <?= count($schools) ?> schools registered
                </p>

            </div>

        </div>



        <?php if (!empty($schools)): ?>


            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                School
                            </th>

                            <th>
                                School ID
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
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


                        <?php foreach ($schools as $school): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($school->id) ?>
                                </td>


                                <td>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $school->school_name
                                        ) ?>
                                    </strong>

                                </td>


                                <td>
                                    <?= htmlspecialchars(
                                        $school->school_id
                                    ) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars(
                                        $school->email
                                    ) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars(
                                        $school->phone
                                    ) ?>
                                </td>


                                <td>

                                    <?php if (
                                        $school->status === 'active'
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


                                <td>

                                    <a
                                        href="<?= ROOT ?>/schools/view/<?= $school->school_id ?>"
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


            <div class="empty-state">

                <h3>
                    No schools found
                </h3>

                <p>
                    There are currently no schools registered.
                </p>

                <a
                    href="<?= ROOT ?>/schools/create"
                    class="add-school-btn"
                >
                    + Add School
                </a>

            </div>


        <?php endif; ?>


    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>