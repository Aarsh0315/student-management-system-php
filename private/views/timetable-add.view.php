<?php

require_once dirname(__DIR__) . '/core/CSRF.php';

require_once __DIR__ . '/includes/nav.view.php';
require_once __DIR__ . '/includes/sidebar.view.php';

$subjects = $data['subjects'] ?? [];
$teachers = $data['teachers'] ?? [];
$classes  = $data['classes'] ?? [];

$pageTitle = 'Add Timetable Entry';

?>

<link rel="stylesheet" href="<?= ROOT ?>/css/timetable-add.view.css?v=5">

<main class="main-content">

    <div class="page-header">

        <div>
            <h1>Add Timetable Entry</h1>
            <p>Create a new class schedule entry.</p>
        </div>

        <a href="<?= ROOT ?>/timetable" class="btn btn-secondary">
            ← Back to Timetable
        </a>

    </div>


    <div class="form-card">

        <form method="POST" action="<?= ROOT ?>/timetable/create">

            <?= CSRF::field() ?>


            <!-- CLASS INFORMATION -->

            <div class="form-section">

                <div class="section-title">

                    <h2>Class Information</h2>

                    <p>
                        Select the class and division for this timetable entry.
                    </p>

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label for="class">
                            Class <span>*</span>
                        </label>

                        <select name="class" id="class" required>

                            <option value="">
                                Select Class
                            </option>

                            <?php foreach ($classes as $class): ?>

                                <?php

                                $className = is_object($class)
                                    ? ($class->class ?? '')
                                    : ($class['class'] ?? '');

                                ?>

                                <?php if ($className !== ''): ?>

                                    <option value="<?= htmlspecialchars($className) ?>">
                                        <?= htmlspecialchars($className) ?>
                                    </option>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="division">
                            Division <span>*</span>
                        </label>

                        <select name="division" id="division" required>

                            <option value="">
                                Select Division
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- SCHEDULE -->

            <div class="form-section">

                <div class="section-title">

                    <h2>Schedule</h2>

                    <p>
                        Select the day and period for this class.
                    </p>

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label for="day">
                            Day <span>*</span>
                        </label>

                        <select name="day" id="day" required>

                            <option value="">
                                Select Day
                            </option>

                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="period">
                            Period <span>*</span>
                        </label>

                        <select name="period" id="period" required>

                            <option value="">
                                Select Period
                            </option>

                            <option value="1">Period 1 — 08:00 - 09:00</option>
                            <option value="2">Period 2 — 09:00 - 10:00</option>
                            <option value="3">Period 3 — 10:00 - 11:00</option>
                            <option value="4">Period 4 — 11:00 - 12:00</option>
                            <option value="5">Period 5 — 12:00 - 13:00</option>
                            <option value="6">Period 6 — 13:00 - 14:00</option>
                            <option value="7">Period 7 — 14:00 - 15:00</option>
                            <option value="8">Period 8 — 15:00 - 16:00</option>
                            <option value="9">Period 9 — 16:00 - 17:00</option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- SUBJECT & TEACHER -->

            <div class="form-section">

                <div class="section-title">

                    <h2>Subject & Teacher</h2>

                    <p>
                        Assign the subject and teacher for this period.
                    </p>

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label for="subject_id">
                            Subject <span>*</span>
                        </label>

                        <select name="subject_id" id="subject_id" required>

                            <option value="">
                                Select Subject
                            </option>

                            <?php foreach ($subjects as $subject): ?>

                                <?php

                                $subjectId = is_object($subject)
                                    ? ($subject->id ?? '')
                                    : ($subject['id'] ?? '');

                                $subjectName = is_object($subject)
                                    ? ($subject->name ?? '')
                                    : ($subject['name'] ?? '');

                                $subjectCode = is_object($subject)
                                    ? ($subject->code ?? '')
                                    : ($subject['code'] ?? '');

                                ?>

                                <?php if ($subjectId !== ''): ?>

                                    <option value="<?= htmlspecialchars($subjectId) ?>">

                                        <?= htmlspecialchars($subjectName) ?>

                                        <?php if ($subjectCode !== ''): ?>
                                            (<?= htmlspecialchars($subjectCode) ?>)
                                        <?php endif; ?>

                                    </option>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="teacher_id">
                            Teacher <span>*</span>
                        </label>

                        <select name="teacher_id" id="teacher_id" required>

                            <option value="">
                                Select Teacher
                            </option>

                            <?php foreach ($teachers as $teacher): ?>

                                <?php

                                $teacherId = is_object($teacher)
                                    ? ($teacher->staff_id ?? '')
                                    : ($teacher['staff_id'] ?? '');

                                $firstName = is_object($teacher)
                                    ? ($teacher->firstname ?? '')
                                    : ($teacher['firstname'] ?? '');

                                $lastName = is_object($teacher)
                                    ? ($teacher->lastname ?? '')
                                    : ($teacher['lastname'] ?? '');

                                $teacherName = trim(
                                    $firstName . ' ' . $lastName
                                );

                                ?>

                                <?php if ($teacherId !== ''): ?>

                                    <option value="<?= htmlspecialchars($teacherId) ?>">
                                        <?= htmlspecialchars($teacherName) ?>
                                    </option>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

            </div>


            <!-- ROOM -->

            <div class="form-section">

                <div class="section-title">

                    <h2>Room</h2>

                    <p>
                        Optionally specify the classroom or room number.
                    </p>

                </div>


                <div class="form-group">

                    <label for="room">
                        Room / Classroom
                    </label>

                    <input
                        type="text"
                        name="room"
                        id="room"
                        maxlength="100"
                        placeholder="e.g. Room 101, Lab 2"
                    >

                </div>

            </div>


            <!-- ACTIONS -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/timetable"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Timetable Entry
                </button>

            </div>

        </form>

    </div>

</main>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const classSelect = document.getElementById('class');
    const divisionSelect = document.getElementById('division');

    const classes = <?= json_encode($classes) ?>;


    function getValue(item, key) {

        if (!item || typeof item !== 'object') {
            return '';
        }

        return item[key] ?? '';

    }


    function loadDivisions() {

        const selectedClass = classSelect.value;

        divisionSelect.innerHTML =
            '<option value="">Select Division</option>';

        if (!selectedClass) {
            return;
        }

        const divisions = [];

        classes.forEach(function (item) {

            const className = getValue(item, 'class');
            const division = getValue(item, 'division');

            if (
                className === selectedClass &&
                division &&
                !divisions.includes(division)
            ) {
                divisions.push(division);
            }

        });

        divisions.sort();

        divisions.forEach(function (division) {

            const option = document.createElement('option');

            option.value = division;
            option.textContent = division;

            divisionSelect.appendChild(option);

        });

    }


    classSelect.addEventListener(
        'change',
        loadDivisions
    );

});

</script>


<?php
require_once __DIR__ . '/includes/footer.view.php';
?>