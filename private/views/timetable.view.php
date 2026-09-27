<?php

$entries = $data['entries'] ?? [];

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
        Class Timetable - My School
    </title>


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- TIMETABLE CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/timetable.view.css?v=1"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard timetable-page">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <section class="timetable-page-header">

        <div>

            <p class="page-eyebrow">
                SCHOOL ADMIN
            </p>

            <h1>
                Class Timetable
            </h1>

            <p class="page-description">
                View and manage class-wise timetable.
                Select a class and division to see the schedule.
            </p>

        </div>


        <div class="header-actions">

            <button
                type="button"
                class="print-btn"
                onclick="window.print()"
            >
                🖨 Print
            </button>


            <a
                href="<?= ROOT ?>/timetable/add"
                class="add-timetable-btn"
            >
                + Add Timetable Entry
            </a>

        </div>

    </section>



    <!-- =====================================================
         CLASS FILTER
    ====================================================== -->

    <section class="timetable-filter-card">

        <div class="filter-group">

            <label for="classSelect">
                Class
            </label>

            <select id="classSelect">

                <option value="">
                    Select Class
                </option>

            </select>

        </div>


        <div class="filter-group">

            <label for="divisionSelect">
                Division
            </label>

            <select
                id="divisionSelect"
                disabled
            >

                <option value="">
                    Select Division
                </option>

            </select>

        </div>


        <button
            type="button"
            id="viewTimetableBtn"
            class="view-timetable-btn"
        >
            🔍 View Timetable
        </button>

    </section>



    <!-- =====================================================
         CLASS SCHEDULE
    ====================================================== -->

    <section class="schedule-card">


        <!-- SCHEDULE HEADER -->

        <div class="schedule-header">

            <div class="schedule-title">

                <span class="schedule-script">
                    Class
                </span>

                <span class="schedule-title-text">
                    Schedule
                </span>

            </div>


            <div class="schedule-meta">

                <div>

                    <span>
                        Class:
                    </span>

                    <strong id="selectedClass">
                        —
                    </strong>

                </div>


                <div>

                    <span>
                        Division:
                    </span>

                    <strong id="selectedDivision">
                        —
                    </strong>

                </div>


                <div>

                    <span>
                        Academic Year:
                    </span>

                    <strong>
                        <?= date('Y') ?> -
                        <?= date('Y') + 1 ?>
                    </strong>

                </div>

            </div>

        </div>



        <!-- =================================================
             SCHEDULE TABLE
        ================================================== -->

        <div class="schedule-wrapper">

            <table class="schedule-table">

                <thead>

                    <tr>

                        <th class="time-column">
                            TIME
                        </th>

                        <th>
                            MON
                        </th>

                        <th>
                            TUE
                        </th>

                        <th>
                            WED
                        </th>

                        <th>
                            THU
                        </th>

                        <th>
                            FRI
                        </th>

                        <th>
                            SAT
                        </th>

                        <th class="note-column">
                            NOTE
                        </th>

                    </tr>

                </thead>


                <tbody id="scheduleBody">

                </tbody>

            </table>

        </div>


    </section>


</main>



<!-- =====================================================
     TIMETABLE DATA
====================================================== -->

<script>

const timetableEntries = <?= json_encode(
    array_map(
        function ($entry) {

            return [

                'id' => $entry->id ?? null,

                'class' => $entry->class ?? '',

                'division' => $entry->division ?? '',

                'day' => $entry->day ?? '',

                'period' => (int) (
                    $entry->period ?? 0
                ),

                'subject' =>
                    $entry->subject_name ?? '',

                'code' =>
                    $entry->subject_code ?? '',

                'teacher' =>
                    trim(
                        ($entry->firstname ?? '')
                        . ' '
                        . ($entry->lastname ?? '')
                    ),

                'teacher_id' =>
                    $entry->teacher_id ?? '',

                'room' =>
                    $entry->room ?? '',

                'status' =>
                    (int) (
                        $entry->status ?? 0
                    )

            ];

        },
        $entries
    ),
    JSON_HEX_TAG |
    JSON_HEX_APOS |
    JSON_HEX_AMP |
    JSON_HEX_QUOT
); ?>;


const classSelect =
    document.getElementById(
        'classSelect'
    );


const divisionSelect =
    document.getElementById(
        'divisionSelect'
    );


const viewButton =
    document.getElementById(
        'viewTimetableBtn'
    );


const scheduleBody =
    document.getElementById(
        'scheduleBody'
    );


const selectedClass =
    document.getElementById(
        'selectedClass'
    );


const selectedDivision =
    document.getElementById(
        'selectedDivision'
    );



/* =====================================================
   DAYS
===================================================== */

const days = [
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday'
];



/* =====================================================
   PERIOD TIMES
===================================================== */

const periodTimes = {

    1: '08:00',

    2: '09:00',

    3: '10:00',

    4: '11:00',

    5: '12:00',

    6: '13:00',

    7: '14:00',

    8: '15:00',

    9: '16:00'

};



/* =====================================================
   LOAD CLASSES
===================================================== */

function loadClasses()
{

    const classes = [
        ...new Set(
            timetableEntries.map(
                entry => entry.class
            )
        )
    ];


    classes.sort(
        (a, b) =>
            String(a).localeCompare(
                String(b),
                undefined,
                {
                    numeric: true
                }
            )
    );


    classes.forEach(
        className => {

            if (!className) {
                return;
            }


            const option =
                document.createElement(
                    'option'
                );

            option.value =
                className;

            option.textContent =
                className;

            classSelect.appendChild(
                option
            );

        }
    );

}



/* =====================================================
   LOAD DIVISIONS
===================================================== */

function loadDivisions(className)
{

    divisionSelect.innerHTML =
        '<option value="">Select Division</option>';


    divisionSelect.disabled =
        true;


    if (!className) {
        return;
    }


    const divisions = [
        ...new Set(

            timetableEntries

                .filter(
                    entry =>
                        entry.class ===
                        className
                )

                .map(
                    entry =>
                        entry.division
                )

        )
    ];


    divisions.sort();


    divisions.forEach(
        division => {

            if (!division) {
                return;
            }


            const option =
                document.createElement(
                    'option'
                );

            option.value =
                division;

            option.textContent =
                division;

            divisionSelect.appendChild(
                option
            );

        }
    );


    divisionSelect.disabled =
        divisions.length === 0;

}



/* =====================================================
   RENDER TIMETABLE
===================================================== */

function renderTimetable()
{

    const className =
        classSelect.value;


    const division =
        divisionSelect.value;


    selectedClass.textContent =
        className || '—';


    selectedDivision.textContent =
        division || '—';


    scheduleBody.innerHTML =
        '';


    if (
        !className ||
        !division
    ) {

        renderEmptySchedule(
            'Select a class and division to view the timetable.'
        );

        return;
    }


    const filteredEntries =
        timetableEntries.filter(
            entry =>
                entry.class ===
                    className
                &&
                entry.division ===
                    division
        );


    if (
        filteredEntries.length === 0
    ) {

        renderEmptySchedule(
            'No timetable entries found for this class.'
        );

        return;
    }


    for (
        let period = 1;
        period <= 9;
        period++
    ) {

        const row =
            document.createElement(
                'tr'
            );


        const timeCell =
            document.createElement(
                'td'
            );

        timeCell.className =
            'time-cell';


        timeCell.textContent =
            periodTimes[period] || '—';


        row.appendChild(
            timeCell
        );


        days.forEach(
            day => {

                const cell =
                    document.createElement(
                        'td'
                    );


                const entry =
                    filteredEntries.find(
                        item =>
                            item.day ===
                                day
                            &&
                            item.period ===
                                period
                    );


                if (entry) {

                    cell.innerHTML =
                        createEntryHTML(
                            entry
                        );

                } else {

                    cell.innerHTML =
                        '<span class="empty-slot">—</span>';

                }


                row.appendChild(
                    cell
                );

            }
        );


        const noteCell =
            document.createElement(
                'td'
            );


        noteCell.innerHTML =
            '<span class="empty-slot">—</span>';


        noteCell.className =
            'note-cell';


        row.appendChild(
            noteCell
        );


        scheduleBody.appendChild(
            row
        );

    }

}



/* =====================================================
   ENTRY HTML
===================================================== */

function createEntryHTML(entry)
{

    const statusClass =
        entry.status === 1
            ? 'active'
            : 'inactive';


    const subject =
        escapeHTML(
            entry.subject ||
            'Subject'
        );


    const teacher =
        escapeHTML(
            entry.teacher ||
            'Teacher'
        );


    const room =
        escapeHTML(
            entry.room ||
            'Room not assigned'
        );


    const code =
        escapeHTML(
            entry.code ||
            ''
        );


    return `

        <div class="schedule-entry ${statusClass}">

            <div class="entry-subject">
                ${subject}
            </div>

            ${
                code
                    ? `<div class="entry-code">${code}</div>`
                    : ''
            }

            <div class="entry-teacher">
                ${teacher}
            </div>

            <div class="entry-room">
                ${room}
            </div>

        </div>

    `;

}



/* =====================================================
   EMPTY SCHEDULE
===================================================== */

function renderEmptySchedule(message)
{

    scheduleBody.innerHTML = `

        <tr>

            <td
                colspan="8"
                class="schedule-empty"
            >

                <div class="empty-schedule-icon">
                    📅
                </div>

                <strong>
                    No Schedule Available
                </strong>

                <span>
                    ${escapeHTML(message)}
                </span>

            </td>

        </tr>

    `;

}



/* =====================================================
   ESCAPE HTML
===================================================== */

function escapeHTML(value)
{

    return String(value)
        .replace(
            /&/g,
            '&amp;'
        )
        .replace(
            /</g,
            '&lt;'
        )
        .replace(
            />/g,
            '&gt;'
        )
        .replace(
            /"/g,
            '&quot;'
        )
        .replace(
            /'/g,
            '&#039;'
        );

}



/* =====================================================
   EVENTS
===================================================== */

classSelect.addEventListener(
    'change',
    function () {

        loadDivisions(
            this.value
        );

        selectedClass.textContent =
            this.value || '—';

        selectedDivision.textContent =
            '—';

        scheduleBody.innerHTML =
            '';

    }
);


divisionSelect.addEventListener(
    'change',
    function () {

        selectedDivision.textContent =
            this.value || '—';

    }
);


viewButton.addEventListener(
    'click',
    function () {

        renderTimetable();

    }
);



/* =====================================================
   INITIAL LOAD
===================================================== */

loadClasses();


if (timetableEntries.length > 0) {

    const firstClass =
        timetableEntries[0].class;

    const firstDivision =
        timetableEntries[0].division;


    if (firstClass) {

        classSelect.value =
            firstClass;

        loadDivisions(
            firstClass
        );

    }


    if (firstDivision) {

        divisionSelect.value =
            firstDivision;

        renderTimetable();

    }

}

</script>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>