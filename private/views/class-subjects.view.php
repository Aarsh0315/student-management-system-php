<?php

$assignments =
    $data['assignments'] ?? [];

?>

<?php require "../private/views/includes/nav.view.php"; ?>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/class-subjects.view.css?v=1"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/nav.view.css?v=1"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/sidebar.view.css?v=1"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/footer.view.css?v=1"
>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="main-content">

    <div class="page-container">


        <!-- =====================================================
             PAGE HEADER
        ====================================================== -->

        <div class="page-header">

            <div>

                <h1>
                    Teaching Assignments
                </h1>

                <p>
                    Assign subjects to classes, divisions and teachers.
                </p>

            </div>


            <a
                href="<?= ROOT ?>/classsubjects/add"
                class="btn btn-primary"
            >
                + Add Assignment
            </a>

        </div>



        <!-- =====================================================
             ASSIGNMENTS CARD
        ====================================================== -->

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Assignment List
                    </h2>

                    <p>
                        <?= count($assignments) ?>
                        assignment<?= count($assignments) === 1 ? '' : 's' ?>
                    </p>

                </div>


                <div class="table-search">

                    <input
                        type="text"
                        id="assignmentSearch"
                        placeholder="Search assignments..."
                        onkeyup="filterAssignments()"
                    >

                </div>

            </div>



            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="table-wrapper">

                <table class="data-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Subject
                            </th>

                            <th>
                                Code
                            </th>

                            <th>
                                Teacher
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody id="assignmentsTable">

                    <?php if (!empty($assignments)): ?>

                        <?php foreach (
                            $assignments
                            as $index => $assignment
                        ): ?>

                            <tr>


                                <!-- NUMBER -->

                                <td>
                                    <?= $index + 1 ?>
                                </td>



                                <!-- CLASS -->

                                <td>

                                    <span class="class-badge">

                                        <?= htmlspecialchars(
                                            $assignment->class
                                        ) ?>

                                    </span>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <span class="division-badge">

                                        <?= htmlspecialchars(
                                            $assignment->division
                                        ) ?>

                                    </span>

                                </td>



                                <!-- SUBJECT -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $assignment->subject_name
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- SUBJECT CODE -->

                                <td>

                                    <?php if (
                                        !empty(
                                            $assignment->subject_code
                                        )
                                    ): ?>

                                        <span class="subject-code">

                                            <?= htmlspecialchars(
                                                $assignment->subject_code
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="muted">
                                            —
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- TEACHER -->

                                <td>

                                    <div class="teacher-info">

                                        <strong>

                                            <?= htmlspecialchars(
                                                trim(
                                                    ($assignment->firstname ?? '')
                                                    . ' '
                                                    . ($assignment->lastname ?? '')
                                                )
                                            ) ?>

                                        </strong>

                                        <?php if (
                                            !empty(
                                                $assignment->teacher_id
                                            )
                                        ): ?>

                                            <span>

                                                <?= htmlspecialchars(
                                                    $assignment->teacher_id
                                                ) ?>

                                            </span>

                                        <?php endif; ?>

                                    </div>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <?php if (
                                        (int) $assignment->status === 1
                                    ): ?>

                                        <span class="status-badge active">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="status-badge inactive">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>



                                <!-- ACTIONS -->

                                <td>

                                    <div class="action-buttons">


                                        <!-- EDIT -->

                                        <a
                                            href="<?= ROOT ?>/classsubjects/edit/<?= (int) $assignment->id ?>"
                                            class="action-btn edit"
                                        >
                                            Edit
                                        </a>



                                        <!-- ACTIVATE / DEACTIVATE -->

                                        <?php if (
                                            (int) $assignment->status === 1
                                        ): ?>

                                            <a
                                                href="<?= ROOT ?>/classsubjects/deactivate/<?= (int) $assignment->id ?>"
                                                class="action-btn deactivate"
                                                onclick="return confirm(
                                                    'Are you sure you want to deactivate this teaching assignment?'
                                                )"
                                            >
                                                Deactivate
                                            </a>

                                        <?php else: ?>

                                            <a
                                                href="<?= ROOT ?>/classsubjects/activate/<?= (int) $assignment->id ?>"
                                                class="action-btn activate"
                                            >
                                                Activate
                                            </a>

                                        <?php endif; ?>



                                        <!-- DELETE -->

                                        <a
                                            href="<?= ROOT ?>/classsubjects/delete/<?= (int) $assignment->id ?>"
                                            class="action-btn delete"
                                            onclick="return confirm(
                                                'Are you sure you want to permanently delete this teaching assignment?'
                                            )"
                                        >
                                            Delete
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <!-- EMPTY STATE -->

                        <tr>

                            <td
                                colspan="8"
                                class="empty-state"
                            >

                                <div>

                                    <strong>
                                        No teaching assignments found
                                    </strong>

                                    <p>
                                        Create your first teaching assignment to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

function filterAssignments()
{
    const input =
        document.getElementById(
            'assignmentSearch'
        );

    const filter =
        input.value
            .toLowerCase()
            .trim();


    const rows =
        document.querySelectorAll(
            '#assignmentsTable tr'
        );


    rows.forEach(function(row)
    {
        const text =
            row.textContent
                .toLowerCase();


        row.style.display =
            text.includes(filter)
                ? ''
                : 'none';
    });
}

</script>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


<?php require "../private/views/includes/footer.view.php"; ?>