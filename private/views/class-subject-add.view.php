<?php

require_once dirname(__DIR__) . '/core/CSRF.php';

require "../private/views/includes/nav.view.php";

?>

<link rel="stylesheet" href="<?= ROOT ?>/css/class-subject-add.view.css?v=1">
<link rel="stylesheet" href="<?= ROOT ?>/css/sidebar.view.css?v=1">
<link rel="stylesheet" href="<?= ROOT ?>/css/footer.view.css?v=1">
<link rel="stylesheet" href="<?= ROOT ?>/css/nav.view.css?v=1">


<?php require_once __DIR__ . '/includes/sidebar.view.php'; ?>


<main class="main-content">

    <div class="page-container">

        <!-- PAGE HEADER -->
        <div class="page-header">

            <div>
                <h1>Add Teaching Assignment</h1>

                <p>
                    Assign a subject and teacher to a specific class and division.
                </p>
            </div>

        </div>


        <!-- INFORMATION -->
        <div class="assignment-info">

            <strong>Teaching Assignment:</strong>
            Select a class, division, subject and teacher to define
            who teaches which subject to a particular class.

        </div>


        <!-- ERROR -->
        <?php if (!empty($_SESSION['error'])): ?>

            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>


        <!-- FORM -->
        <div class="form-card">

            <form
                method="POST"
                action="<?= ROOT ?>/classsubjects/create"
                id="assignmentForm"
            >

                <?= CSRF::field() ?>


                <div class="form-grid">

                    <!-- CLASS -->
                    <div class="form-group">

                        <label for="class">
                            Class <span class="required">*</span>
                        </label>

                        <select
                            name="class"
                            id="class"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select Class
                            </option>

                            <?php if (!empty($classes)): ?>

                                <?php foreach ($classes as $class): ?>

                                    <?php
                                    $classValue = $class->class ?? '';
                                    ?>

                                    <option
                                        value="<?= htmlspecialchars($classValue) ?>"
                                    >
                                        <?= htmlspecialchars($classValue) ?>
                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                        <p class="form-help">
                            Select the class for this assignment.
                        </p>

                    </div>


                    <!-- DIVISION -->
                    <div class="form-group">

                        <label for="division">
                            Division <span class="required">*</span>
                        </label>

                        <select
                            name="division"
                            id="division"
                            class="form-control"
                            required
                            disabled
                        >

                            <option value="">
                                Select Division
                            </option>

                        </select>

                        <p class="form-help">
                            Select a class first to load its divisions.
                        </p>

                    </div>


                    <!-- SUBJECT -->
                    <div class="form-group">

                        <label for="subject_id">
                            Subject <span class="required">*</span>
                        </label>

                        <select
                            name="subject_id"
                            id="subject_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select Subject
                            </option>

                            <?php if (!empty($subjects)): ?>

                                <?php foreach ($subjects as $subject): ?>

                                    <option
                                        value="<?= (int) $subject->id ?>"
                                    >

                                        <?= htmlspecialchars($subject->name) ?>

                                        <?php if (!empty($subject->code)): ?>

                                            (<?= htmlspecialchars($subject->code) ?>)

                                        <?php endif; ?>

                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                        <p class="form-help">
                            Only active subjects from your school are shown.
                        </p>

                    </div>


                    <!-- TEACHER -->
                    <div class="form-group">

                        <label for="teacher_id">
                            Teacher <span class="required">*</span>
                        </label>

                        <select
                            name="teacher_id"
                            id="teacher_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select Teacher
                            </option>

                            <?php if (!empty($teachers)): ?>

                                <?php foreach ($teachers as $teacher): ?>

                                    <?php
                                    $teacherName = trim(
                                        ($teacher->firstname ?? '') . ' ' .
                                        ($teacher->lastname ?? '')
                                    );
                                    ?>

                                    <option
                                        value="<?= htmlspecialchars($teacher->staff_id) ?>"
                                    >

                                        <?= htmlspecialchars($teacherName) ?>

                                        <?php if (!empty($teacher->email)): ?>

                                            — <?= htmlspecialchars($teacher->email) ?>

                                        <?php endif; ?>

                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                        <p class="form-help">
                            Select the teacher responsible for this subject.
                        </p>

                    </div>

                </div>


                <!-- ACTIONS -->
                <div class="form-actions">

                    <a
                        href="<?= ROOT ?>/classsubjects"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Create Assignment
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const classSelect = document.getElementById('class');
    const divisionSelect = document.getElementById('division');

    const classData = <?= json_encode($classes ?? []) ?>;

    const divisionsByClass = {};

    classData.forEach(function (item) {

        const className = item.class ?? '';
        const division = item.division ?? '';

        if (!className || !division) {
            return;
        }

        if (!divisionsByClass[className]) {
            divisionsByClass[className] = [];
        }

        if (!divisionsByClass[className].includes(division)) {
            divisionsByClass[className].push(division);
        }

    });


    classSelect.addEventListener('change', function () {

        const selectedClass = this.value;

        divisionSelect.innerHTML =
            '<option value="">Select Division</option>';

        divisionSelect.disabled = true;

        if (!selectedClass || !divisionsByClass[selectedClass]) {
            return;
        }

        divisionsByClass[selectedClass]
            .sort()
            .forEach(function (division) {

                const option = document.createElement('option');

                option.value = division;
                option.textContent = division;

                divisionSelect.appendChild(option);

            });

        divisionSelect.disabled = false;

    });

});

</script>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
<?php

require_once __DIR__ . '/includes/footer.view.php';

?>