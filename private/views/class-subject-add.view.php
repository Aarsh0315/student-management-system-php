<?php

require_once __DIR__ . '/includes/nav.view.php';
require_once __DIR__ . '/includes/sidebar.view.php';

$subjects = $subjects ?? [];
$teachers = $teachers ?? [];
$classes  = $classes ?? [];

?>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/class-subjects.view.css"
>

<main class="main-content">

    <div class="page-header">

        <div>
            <h1>Assign Subject</h1>

            <p>
                Assign a subject and teacher to a class division.
            </p>
        </div>

        <a
            href="<?= ROOT ?>/classsubjects"
            class="btn-secondary"
        >
            ← Back
        </a>

    </div>


    <div class="form-card">

        <form
            method="POST"
            action="<?= ROOT ?>/classsubjects/create"
        >

            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars(
                    CSRF::token()
                ) ?>"
            >


            <!-- CLASS -->

            <div class="form-group">

                <label for="class">
                    Class
                </label>

                <select
                    id="class"
                    name="class"
                    required
                >

                    <option value="">
                        Select Class
                    </option>

                    <?php

                    $classOptions = [];

                    foreach ($classes as $class) {

                        $className =
                            trim(
                                $class->class ?? ''
                            );

                        $division =
                            trim(
                                $class->division ?? ''
                            );

                        if (
                            $className === '' ||
                            $division === ''
                        ) {
                            continue;
                        }

                        $key =
                            $className .
                            '|' .
                            $division;

                        if (
                            isset(
                                $classOptions[$key]
                            )
                        ) {
                            continue;
                        }

                        $classOptions[$key] = true;

                    ?>

                        <option
                            value="<?= htmlspecialchars(
                                $className
                            ) ?>"
                            data-division="<?= htmlspecialchars(
                                $division
                            ) ?>"
                        >
                            <?= htmlspecialchars(
                                $className
                            ) ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <!-- DIVISION -->

            <div class="form-group">

                <label for="division">
                    Division
                </label>

                <select
                    id="division"
                    name="division"
                    required
                >

                    <option value="">
                        Select Division
                    </option>

                    <?php

                    $divisionOptions = [];

                    foreach ($classes as $class) {

                        $className =
                            trim(
                                $class->class ?? ''
                            );

                        $division =
                            trim(
                                $class->division ?? ''
                            );

                        if (
                            $className === '' ||
                            $division === ''
                        ) {
                            continue;
                        }

                        $key =
                            $className .
                            '|' .
                            $division;

                        if (
                            isset(
                                $divisionOptions[$key]
                            )
                        ) {
                            continue;
                        }

                        $divisionOptions[$key] = [
                            'class' =>
                                $className,
                            'division' =>
                                $division
                        ];

                    ?>

                        <option
                            value="<?= htmlspecialchars(
                                $division
                            ) ?>"
                            data-class="<?= htmlspecialchars(
                                $className
                            ) ?>"
                        >
                            <?= htmlspecialchars(
                                $division
                            ) ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <!-- SUBJECT -->

            <div class="form-group">

                <label for="subject_id">
                    Subject
                </label>

                <select
                    id="subject_id"
                    name="subject_id"
                    required
                >

                    <option value="">
                        Select Subject
                    </option>

                    <?php foreach (
                        $subjects as $subject
                    ): ?>

                        <option
                            value="<?= (int) $subject->id ?>"
                        >
                            <?= htmlspecialchars(
                                $subject->name
                            ) ?>

                            <?php if (
                                !empty(
                                    $subject->code
                                )
                            ): ?>

                                (
                                <?= htmlspecialchars(
                                    $subject->code
                                ) ?>
                                )

                            <?php endif; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- TEACHER -->

            <div class="form-group">

                <label for="teacher_id">
                    Teacher
                </label>

                <select
                    id="teacher_id"
                    name="teacher_id"
                    required
                >

                    <option value="">
                        Select Teacher
                    </option>

                    <?php foreach (
                        $teachers as $teacher
                    ): ?>

                        <option
                            value="<?= htmlspecialchars(
                                $teacher->staff_id
                            ) ?>"
                        >
                            <?= htmlspecialchars(
                                trim(
                                    ($teacher->firstname ?? '') .
                                    ' ' .
                                    ($teacher->lastname ?? '')
                                )
                            ) ?>

                            —
                            <?= htmlspecialchars(
                                $teacher->staff_id
                            ) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- ACTIONS -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/classsubjects"
                    class="btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Assign Subject
                </button>

            </div>

        </form>

    </div>

</main>


<script>

const classSelect =
    document.getElementById('class');

const divisionSelect =
    document.getElementById('division');


classSelect.addEventListener(
    'change',
    function () {

        const selectedClass =
            this.value;

        Array.from(
            divisionSelect.options
        ).forEach(function (option) {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            const optionClass =
                option.dataset.class;

            option.hidden =
                optionClass !== selectedClass;

        });

        divisionSelect.value = '';

    }
);


divisionSelect.addEventListener(
    'change',
    function () {

        const selectedDivision =
            this.value;

        const selectedClass =
            classSelect.value;

        if (
            !selectedClass ||
            !selectedDivision
        ) {
            return;
        }

    }
);

</script>