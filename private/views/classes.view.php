<?php

$classes = $data['classes'] ?? [];

$search = $data['search'] ?? '';

$sort = $data['sort'] ?? 'class';

$direction = strtoupper(
    $data['direction'] ?? 'ASC'
);

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
        Classes - My School
    </title>


    <!-- HOME CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=3"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=3"
    >


    <!-- CLASSES CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/classes.view.css?v=3"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>

<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                School Admin
            </p>


            <h1>
                Classes
            </h1>


            <p class="welcome-text">
                View classes and divisions
                in your school.
            </p>

        </div>

    </section>



    <!-- ========================================
         CLASSES CARD
    ======================================== -->

  <section class="classes-card">

    <div class="classes-header">

        <div>

            <h2>
                All Classes
            </h2>

            <p>
                <?= count($classes) ?>
                class(es) registered
            </p>

        </div>

    </div>


    <?php if (!empty($classes)): ?>

        <!-- ========================================
     SEARCH + SORT
======================================== -->

<div class="classes-toolbar">

    <!-- SEARCH -->

    <form
        method="GET"
        action="<?= ROOT ?>/classes"
        class="class-search-form"
    >

        <div class="class-search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                name="search"
                placeholder="Search class or division..."
                value="<?= htmlspecialchars($search) ?>"
            >

        </div>


        <!-- KEEP SORT -->

        <input
            type="hidden"
            name="sort"
            value="<?= htmlspecialchars($sort) ?>"
        >

        <input
            type="hidden"
            name="direction"
            value="<?= htmlspecialchars($direction) ?>"
        >


        <button
            type="submit"
            class="search-btn"
        >
            Search
        </button>


        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/classes"
                class="clear-search-btn"
            >
                Clear
            </a>

        <?php endif; ?>

    </form>



    <!-- SORT -->

    <form
        method="GET"
        action="<?= ROOT ?>/classes"
        class="class-sort-form"
    >

        <!-- KEEP SEARCH -->

        <input
            type="hidden"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
        >


        <label for="class-sort">
            Sort by
        </label>


        <select
            name="sort"
            id="class-sort"
            onchange="this.form.submit()"
        >

            <option
                value="class"
                <?= $sort === 'class' ? 'selected' : '' ?>
            >
                Class
            </option>

            <option
                value="division"
                <?= $sort === 'division' ? 'selected' : '' ?>
            >
                Division
            </option>

            <option
                value="students"
                <?= $sort === 'students' ? 'selected' : '' ?>
            >
                Students
            </option>

            <option
                value="status"
                <?= $sort === 'status' ? 'selected' : '' ?>
            >
                Status
            </option>

        </select>


        <select
            name="direction"
            onchange="this.form.submit()"
        >

            <option
                value="ASC"
                <?= $direction === 'ASC' ? 'selected' : '' ?>
            >
                Ascending
            </option>

            <option
                value="DESC"
                <?= $direction === 'DESC' ? 'selected' : '' ?>
            >
                Descending
            </option>

        </select>

    </form>

</div>

        <div class="classes-table-wrapper">

            <table class="classes-table">

                    <thead>

                        <tr>

                            <th>
                                Class
                            </th>

                            <th>
                                Division
                            </th>

                            <th>
                                Students
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
                            $classes as $class
                        ): ?>


                            <tr>


                                <!-- CLASS -->

                                <td>

                                    <strong class="class-name">

                                        <?= htmlspecialchars(
                                            $class->class
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>



                                <!-- DIVISION -->

                                <td>

                                    <span class="class-division">

                                        <?= htmlspecialchars(
                                            $class->division
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STUDENTS -->

                                <td>

                                    <span class="student-count">

                                        <?= htmlspecialchars(
                                            $class->student_count
                                            ?? '0'
                                        ) ?>

                                    </span>

                                </td>



                                <!-- STATUS -->

                                <td>

                                    <span class="status active">

                                        Active

                                    </span>

                                </td>



                                <!-- ACTION -->

                                <td>

                                    <a
                                                href="<?= ROOT ?>/students/classDetails/<?= urlencode($class->class ?? '') ?>/<?= urlencode($class->division ?? '') ?>"
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

        <p>

            <?php if ($search !== ''): ?>

                No class matches
                <strong>
                    "<?= htmlspecialchars($search) ?>"
                </strong>.

            <?php else: ?>

                There are currently no classes
                registered in your school.

            <?php endif; ?>

        </p>


        <?php if ($search !== ''): ?>

            <a
                href="<?= ROOT ?>/classes"
                class="clear-search-btn"
            >
                View All Classes
            </a>

        <?php endif; ?>

    </div>

<?php endif; ?>


    </section>



</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/sidebar.js"></script>
<script src="<?= ROOT ?>/js/nav.js"></script>


</body>

</html>