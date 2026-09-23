<?php

$subjects = $data['subjects'] ?? [];

$success =
    $_SESSION['subject_success']
    ?? '';

$error =
    $_SESSION['subject_error']
    ?? '';

unset($_SESSION['subject_success']);
unset($_SESSION['subject_error']);

?>

<?php require "../private/views/includes/nav.view.php"; ?>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/subjects.view.css?v=1"
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
                    Subjects
                </h1>

                <p>
                    Manage subjects for your school.
                </p>

            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="openSubjectModal()"
            >
                + Add Subject
            </button>

        </div>



        <!-- =====================================================
             ALERTS
        ====================================================== -->

        <?php if ($success !== ''): ?>

            <div class="alert alert-success">

                <?= htmlspecialchars($success) ?>

            </div>

        <?php endif; ?>


        <?php if ($error !== ''): ?>

            <div class="alert alert-error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- =====================================================
             SUBJECTS CARD
        ====================================================== -->

        <div class="card">

            <div class="card-header">

                <div>

                    <h2>
                        Subject List
                    </h2>

                    <p>
                        <?= count($subjects) ?>
                        subject<?= count($subjects) === 1 ? '' : 's' ?>
                    </p>

                </div>


                <div class="table-search">

                    <input
                        type="text"
                        id="subjectSearch"
                        placeholder="Search subjects..."
                        onkeyup="filterSubjects()"
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
                                Subject
                            </th>

                            <th>
                                Code
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody id="subjectsTable">

                    <?php if (!empty($subjects)): ?>

                        <?php foreach ($subjects as $index => $subject): ?>

                            <tr>

                                <!-- NUMBER -->

                                <td>
                                    <?= $index + 1 ?>
                                </td>


                                <!-- SUBJECT -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $subject->name
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- CODE -->

                                <td>

                                    <?php if (!empty($subject->code)): ?>

                                        <span class="subject-code">

                                            <?= htmlspecialchars(
                                                $subject->code
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="muted">
                                            —
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- DESCRIPTION -->

                                <td>

                                    <?php if (!empty($subject->description)): ?>

                                        <span
                                            class="description-text"
                                            title="<?= htmlspecialchars(
                                                $subject->description
                                            ) ?>"
                                        >

                                            <?= htmlspecialchars(
                                                $subject->description
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="muted">
                                            —
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if ((int) $subject->status === 1): ?>

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

                                        <button
                                            type="button"
                                            class="action-btn edit"
                                            onclick='editSubject(
                                                <?= json_encode([
                                                    'id' =>
                                                        $subject->id,

                                                    'name' =>
                                                        $subject->name,

                                                    'code' =>
                                                        $subject->code,

                                                    'description' =>
                                                        $subject->description,

                                                    'status' =>
                                                        $subject->status
                                                ]) ?>
                                            )'
                                        >

                                            Edit

                                        </button>



                                        <!-- ACTIVATE / DEACTIVATE -->

                                        <?php if (
                                            (int) $subject->status === 1
                                        ): ?>

                                            <a
                                                href="<?= ROOT ?>/subjects/deactivate/<?= (int) $subject->id ?>"
                                                class="action-btn deactivate"
                                                onclick="return confirm(
                                                    'Are you sure you want to deactivate this subject?'
                                                )"
                                            >

                                                Deactivate

                                            </a>

                                        <?php else: ?>

                                            <a
                                                href="<?= ROOT ?>/subjects/activate/<?= (int) $subject->id ?>"
                                                class="action-btn activate"
                                            >

                                                Activate

                                            </a>

                                        <?php endif; ?>



                                        <!-- DELETE -->

                                        <a
                                            href="<?= ROOT ?>/subjects/delete/<?= (int) $subject->id ?>"
                                            class="action-btn delete"
                                            onclick="return confirm(
                                                'Are you sure you want to permanently delete this subject?'
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
                                colspan="6"
                                class="empty-state"
                            >

                                <div>

                                    <strong>
                                        No subjects found
                                    </strong>

                                    <p>
                                        Add your first subject to get started.
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
     ADD / EDIT SUBJECT MODAL
========================================================= -->

<div
    class="modal-overlay"
    id="subjectModal"
    onclick="closeSubjectModal(event)"
>

    <div
        class="modal"
        onclick="event.stopPropagation()"
    >


        <!-- MODAL HEADER -->

        <div class="modal-header">

            <div>

                <h2 id="modalTitle">
                    Add Subject
                </h2>

                <p>
                    Enter subject information.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                onclick="closeSubjectModal()"
                aria-label="Close"
            >

                ×

            </button>

        </div>



        <!-- FORM -->

        <form
            method="POST"
            id="subjectForm"
            action="<?= ROOT ?>/subjects/create"
        >


            <div class="modal-body">


                <!-- SUBJECT NAME -->

                <div class="form-group">

                    <label for="subjectName">

                        Subject Name

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        id="subjectName"
                        name="name"
                        maxlength="100"
                        required
                        placeholder="e.g. Mathematics"
                    >

                </div>



                <!-- SUBJECT CODE -->

                <div class="form-group">

                    <label for="subjectCode">

                        Subject Code

                    </label>

                    <input
                        type="text"
                        id="subjectCode"
                        name="code"
                        maxlength="30"
                        placeholder="e.g. MATH"
                    >

                </div>



                <!-- DESCRIPTION -->

                <div class="form-group">

                    <label for="subjectDescription">

                        Description

                    </label>

                    <textarea
                        id="subjectDescription"
                        name="description"
                        rows="4"
                        maxlength="500"
                        placeholder="Short description of the subject..."
                    ></textarea>

                </div>



                <!-- STATUS -->

                <div
                    class="form-group"
                    id="statusGroup"
                    style="display:none;"
                >

                    <label for="subjectStatus">

                        Status

                    </label>

                    <select
                        id="subjectStatus"
                        name="status"
                    >

                        <option value="1">
                            Active
                        </option>

                        <option value="0">
                            Inactive
                        </option>

                    </select>

                </div>

            </div>



            <!-- MODAL FOOTER -->

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeSubjectModal()"
                >

                    Cancel

                </button>


                <button
                    type="submit"
                    class="btn btn-primary"
                    id="submitSubjectButton"
                >

                    Add Subject

                </button>

            </div>

        </form>

    </div>

</div>



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/*
|--------------------------------------------------------------------------
| Open Add Subject Modal
|--------------------------------------------------------------------------
*/

function openSubjectModal()
{
    const modal =
        document.getElementById(
            'subjectModal'
        );

    const form =
        document.getElementById(
            'subjectForm'
        );


    document.getElementById(
        'modalTitle'
    ).textContent =
        'Add Subject';


    document.getElementById(
        'submitSubjectButton'
    ).textContent =
        'Add Subject';


    document.getElementById(
        'subjectName'
    ).value = '';


    document.getElementById(
        'subjectCode'
    ).value = '';


    document.getElementById(
        'subjectDescription'
    ).value = '';


    document.getElementById(
        'subjectStatus'
    ).value = '1';


    document.getElementById(
        'statusGroup'
    ).style.display =
        'none';


    form.action =
        '<?= ROOT ?>/subjects/create';


    modal.classList.add(
        'show'
    );


    setTimeout(function() {

        document.getElementById(
            'subjectName'
        ).focus();

    }, 100);
}



/*
|--------------------------------------------------------------------------
| Open Edit Subject Modal
|--------------------------------------------------------------------------
*/

function editSubject(subject)
{
    const modal =
        document.getElementById(
            'subjectModal'
        );

    const form =
        document.getElementById(
            'subjectForm'
        );


    document.getElementById(
        'modalTitle'
    ).textContent =
        'Edit Subject';


    document.getElementById(
        'submitSubjectButton'
    ).textContent =
        'Save Changes';


    document.getElementById(
        'subjectName'
    ).value =
        subject.name || '';


    document.getElementById(
        'subjectCode'
    ).value =
        subject.code || '';


    document.getElementById(
        'subjectDescription'
    ).value =
        subject.description || '';


    document.getElementById(
        'subjectStatus'
    ).value =
        subject.status == 1
            ? '1'
            : '0';


    document.getElementById(
        'statusGroup'
    ).style.display =
        'block';


    form.action =
        '<?= ROOT ?>/subjects/update/'
        + subject.id;


    modal.classList.add(
        'show'
    );


    setTimeout(function() {

        document.getElementById(
            'subjectName'
        ).focus();

    }, 100);
}



/*
|--------------------------------------------------------------------------
| Close Modal
|--------------------------------------------------------------------------
*/

function closeSubjectModal(event)
{
    if (
        event &&
        event.target &&
        event.target.id !==
            'subjectModal'
    ) {
        return;
    }


    document.getElementById(
        'subjectModal'
    ).classList.remove(
        'show'
    );
}



/*
|--------------------------------------------------------------------------
| Search Subjects
|--------------------------------------------------------------------------
*/

function filterSubjects()
{
    const input =
        document.getElementById(
            'subjectSearch'
        );

    const filter =
        input.value
            .toLowerCase()
            .trim();


    const rows =
        document.querySelectorAll(
            '#subjectsTable tr'
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



/*
|--------------------------------------------------------------------------
| Escape Key
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'keydown',
    function(event)
    {
        if (
            event.key ===
            'Escape'
        ) {
            closeSubjectModal();
        }
    }
);


/*
|--------------------------------------------------------------------------
| Prevent Background Scroll When Modal Is Open
|--------------------------------------------------------------------------
*/

const subjectModal =
    document.getElementById(
        'subjectModal'
    );


const observer =
    new MutationObserver(
        function()
        {
            if (
                subjectModal.classList
                    .contains('show')
            ) {

                document.body.style
                    .overflow = 'hidden';

            } else {

                document.body.style
                    .overflow = '';

            }
        }
    );


observer.observe(
    subjectModal,
    {
        attributes: true,
        attributeFilter: [
            'class'
        ]
    }
);

</script>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>



<?php require "../private/views/includes/footer.view.php"; ?>