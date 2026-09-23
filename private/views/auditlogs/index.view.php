<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$logs = $data['logs'] ?? [];
$actions = $data['actions'] ?? [];

$search = $data['search'] ?? '';
$role = $data['role'] ?? '';
$action = $data['action'] ?? '';

$page = $data['page'] ?? 1;
$totalPages = $data['totalPages'] ?? 1;
$totalLogs = $data['totalLogs'] ?? 0;

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
        Audit Logs - My School
    </title>


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >


    <!-- AUDIT LOGS CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/auditlogs.view.css?v=1"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php

require "../private/views/includes/nav.view.php";

?>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<?php

require "../private/views/includes/sidebar.view.php";

?>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<main class="auditlogs-page">

    <div class="auditlogs-container">


        <!-- =================================================
             PAGE HEADER
        ================================================== -->

        <section class="auditlogs-header">

            <div class="auditlogs-header-content">

                <p class="auditlogs-eyebrow">
                    SYSTEM MONITORING
                </p>


                <h1>
                    Audit Logs
                </h1>


                <p class="auditlogs-description">

                    Review important platform activity,
                    security events, and administrative actions.

                </p>

            </div>


            <div class="auditlogs-count">

                <strong>
                    <?= number_format($totalLogs) ?>
                </strong>

                <span>
                    Total Logs
                </span>

            </div>

        </section>


        <!-- =================================================
             FILTERS
        ================================================== -->

        <section class="auditlogs-card auditlogs-filters">

            <form
                method="GET"
                action="<?= ROOT ?>/auditlogs"
            >


                <!-- SEARCH -->

                <div class="auditlogs-search">

                    <label>
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="<?= htmlspecialchars($search) ?>"
                        placeholder="Search user, action, description or IP..."
                    >

                </div>


                <!-- ROLE -->

                <div>

                    <label>
                        Role
                    </label>

                    <select name="role">

                        <option value="">
                            All Roles
                        </option>


                        <option
                            value="super_admin"
                            <?= $role === 'super_admin' ? 'selected' : '' ?>
                        >
                            Super Admin
                        </option>


                        <option
                            value="admin"
                            <?= $role === 'admin' ? 'selected' : '' ?>
                        >
                            School Admin
                        </option>


                        <option
                            value="teacher"
                            <?= $role === 'teacher' ? 'selected' : '' ?>
                        >
                            Teacher
                        </option>


                        <option
                            value="student"
                            <?= $role === 'student' ? 'selected' : '' ?>
                        >
                            Student
                        </option>


                        <option
                            value="parent"
                            <?= $role === 'parent' ? 'selected' : '' ?>
                        >
                            Parent
                        </option>

                    </select>

                </div>


                <!-- ACTION -->

                <div>

                    <label>
                        Action
                    </label>

                    <select name="action">

                        <option value="">
                            All Actions
                        </option>


                        <?php foreach ($actions as $item): ?>

                            <option
                                value="<?= htmlspecialchars($item->action) ?>"
                                <?= $action === $item->action ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars($item->action) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- APPLY -->

                <button
                    type="submit"
                    class="auditlogs-filter-button"
                >
                    Apply Filters
                </button>


                <!-- CLEAR -->

                <a
                    href="<?= ROOT ?>/auditlogs"
                    class="auditlogs-clear-button"
                >
                    Clear
                </a>


            </form>

        </section>


        <!-- =================================================
             AUDIT LOG TABLE
        ================================================== -->

        <section class="auditlogs-card">


            <div class="auditlogs-table-wrapper">

                <table class="auditlogs-table">


                    <thead>

                        <tr>

                            <th>
                                User
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Action
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                IP Address
                            </th>

                            <th>
                                Date & Time
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if (!empty($logs)): ?>


                        <?php foreach ($logs as $log): ?>


                            <tr>


                                <!-- USER -->

                                <td>

                                    <div class="auditlogs-user">


                                        <div class="auditlogs-avatar">

                                            <?= htmlspecialchars(
                                                strtoupper(
                                                    substr(
                                                        $log->user_name ?: 'S',
                                                        0,
                                                        1
                                                    )
                                                )
                                            ) ?>

                                        </div>


                                        <div>

                                            <strong>

                                                <?= htmlspecialchars(
                                                    $log->user_name ?: 'System'
                                                ) ?>

                                            </strong>


                                            <span>

                                                <?= htmlspecialchars(
                                                    $log->user_id ?: '—'
                                                ) ?>

                                            </span>

                                        </div>


                                    </div>

                                </td>


                                <!-- ROLE -->

                                <td>

                                    <span class="auditlogs-role">

                                        <?= htmlspecialchars(
                                            ucwords(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $log->user_role ?: 'System'
                                                )
                                            )
                                        ) ?>

                                    </span>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <span class="auditlogs-action">

                                        <?= htmlspecialchars(
                                            $log->action
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DESCRIPTION -->

                                <td>

                                    <div class="auditlogs-description">

                                        <?= htmlspecialchars(
                                            $log->description ?: '—'
                                        ) ?>

                                    </div>

                                </td>


                                <!-- IP -->

                                <td>

                                    <code>

                                        <?= htmlspecialchars(
                                            $log->ip_address ?: '—'
                                        ) ?>

                                    </code>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <div class="auditlogs-date">

                                        <?= htmlspecialchars(
                                            date(
                                                'd M Y',
                                                strtotime(
                                                    $log->created_at
                                                )
                                            )
                                        ) ?>


                                        <span>

                                            <?= htmlspecialchars(
                                                date(
                                                    'h:i A',
                                                    strtotime(
                                                        $log->created_at
                                                    )
                                                )
                                            ) ?>

                                        </span>

                                    </div>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- EMPTY STATE -->

                        <tr>

                            <td
                                colspan="6"
                                class="auditlogs-empty"
                            >

                                <div>

                                    <strong>
                                        No Audit Logs Found
                                    </strong>


                                    <p>

                                        Activity will appear here
                                        when users perform actions.

                                    </p>

                                </div>

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>


            <!-- =================================================
                 PAGINATION
            ================================================== -->

            <?php if ($totalPages > 1): ?>


                <div class="auditlogs-pagination">


                    <?php if ($page > 1): ?>


                        <a
                            href="?<?= http_build_query([
                                'search' => $search,
                                'role' => $role,
                                'action' => $action,
                                'page' => $page - 1
                            ]) ?>"
                        >

                            Previous

                        </a>


                    <?php endif; ?>


                    <span>

                        Page
                        <?= $page ?>
                        of
                        <?= $totalPages ?>

                    </span>


                    <?php if ($page < $totalPages): ?>


                        <a
                            href="?<?= http_build_query([
                                'search' => $search,
                                'role' => $role,
                                'action' => $action,
                                'page' => $page + 1
                            ]) ?>"
                        >

                            Next

                        </a>


                    <?php endif; ?>


                </div>


            <?php endif; ?>


        </section>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php

require "../private/views/includes/footer.view.php";

?>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>