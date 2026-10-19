<?php
$schools = $data['schools'] ?? [];
$search = $data['search'] ?? '';
$sort = $data['sort'] ?? 'id';
$direction = strtoupper($data['direction'] ?? 'DESC');
$status = $data['status'] ?? '';

$escape = static function ($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
};

/*
 * Prefer full-platform stats supplied by the controller.
 * If unavailable, use the currently returned schools as a fallback.
 * For accurate totals while searching/filtering, provide $data['stats'] from the controller.
 */
$stats = $data['stats'] ?? [];
$statsGet = static function (string $key, $fallback = null) use ($stats) {
    if (is_array($stats) && array_key_exists($key, $stats) && is_numeric($stats[$key])) {
        return (int) $stats[$key];
    }
    if (is_object($stats) && isset($stats->{$key}) && is_numeric($stats->{$key})) {
        return (int) $stats->{$key};
    }
    return $fallback;
};

$visibleTotal = count($schools);
$visibleActive = 0;
$visibleInactive = 0;
$visibleStudents = 0;
foreach ($schools as $row) {
    if (strtolower((string) ($row->status ?? '')) === 'active') {
        $visibleActive++;
    } else {
        $visibleInactive++;
    }
    $visibleStudents += (int) ($row->student_count ?? 0);
}

$totalSchools = $statsGet('total_schools', $visibleTotal);
$totalActive = $statsGet('active_schools', $visibleActive);
$totalInactive = $statsGet('inactive_schools', $visibleInactive);
$totalStudents = $statsGet('total_students', $visibleStudents);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schools - My School</title>

    <link rel="stylesheet" href="<?= ROOT ?>/css/home.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/superadmin.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/schools.view.css?v=5">
    <link rel="stylesheet" href="<?= ROOT ?>/css/schools-redesign.css?v=1">
    <link rel="stylesheet" href="<?= ROOT ?>/css/footer.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/nav.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/sidebar.view.css?v=2">
</head>
<body>
<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>

<main class="dashboard schools-page-redesign">
    <!-- Page heading -->
    <section class="schools-hero">
        <div class="schools-hero-copy">
            <p class="schools-breadcrumb">SUPER ADMIN <span>/</span> PLATFORM</p>
            <h1>Schools</h1>
            <p>Manage all schools registered in the system.</p>
        </div>
        <div class="schools-hero-decoration" aria-hidden="true"></div>
    </section>

    <!-- Summary cards -->
    <section class="schools-stats-grid" aria-label="School statistics">
        <article class="schools-stat-card">
            <span class="schools-stat-icon schools-stat-icon-neutral" aria-hidden="true">▦</span>
            <div class="schools-stat-copy">
                <p>Total Schools</p>
                <strong><?= number_format($totalSchools) ?></strong>
                <small><?= number_format($totalActive) ?> Active <span>•</span> <?= number_format($totalInactive) ?> Inactive</small>
            </div>
        </article>
        <article class="schools-stat-card">
            <span class="schools-stat-icon schools-stat-icon-green" aria-hidden="true">♧</span>
            <div class="schools-stat-copy">
                <p>Total Students</p>
                <strong><?= number_format($totalStudents) ?></strong>
                <small>Across registered schools</small>
            </div>
        </article>
        <article class="schools-stat-card">
            <span class="schools-stat-icon schools-stat-icon-purple" aria-hidden="true">♙</span>
            <div class="schools-stat-copy">
                <p>Active Schools</p>
                <strong><?= number_format($totalActive) ?></strong>
                <small>Currently active</small>
            </div>
        </article>
        <article class="schools-stat-card">
            <span class="schools-stat-icon schools-stat-icon-red" aria-hidden="true">!</span>
            <div class="schools-stat-copy">
                <p>Inactive Schools</p>
                <strong><?= number_format($totalInactive) ?></strong>
                <small>May require attention</small>
            </div>
        </article>
    </section>

    <!-- Schools table -->
    <section class="schools-card schools-table-card">
        <div class="schools-header schools-redesign-header">
            <div>
                <h2>All Schools</h2>
                <p>
                    <?= number_format(count($schools)) ?> school(s) found
                    <?php if ($search !== ''): ?>
                        for <strong>"<?= $escape($search) ?>"</strong>
                    <?php endif; ?>
                </p>
            </div>
            <a href="<?= ROOT ?>/schools/add" class="add-school-btn schools-add-btn">
                <span aria-hidden="true">+</span> Add School
            </a>
        </div>

        <div class="schools-toolbar schools-redesign-toolbar">
            <form method="GET" action="<?= ROOT ?>/schools" class="school-search-form schools-redesign-search">
                <label class="school-search-box schools-redesign-search-box">
                    <span class="search-icon" aria-hidden="true">⌕</span>
                    <input
                        type="search"
                        name="search"
                        placeholder="Search school by name, email or phone..."
                        value="<?= $escape($search) ?>"
                        aria-label="Search schools"
                    >
                </label>
                <input type="hidden" name="sort" value="<?= $escape($sort) ?>">
                <input type="hidden" name="direction" value="<?= $escape($direction) ?>">
                <input type="hidden" name="status" value="<?= $escape($status) ?>">
                <button type="submit" class="search-btn schools-search-btn">Search</button>
                <?php if ($search !== ''): ?>
                    <a href="<?= ROOT ?>/schools" class="clear-search-btn">Clear</a>
                <?php endif; ?>
            </form>

            <form method="GET" action="<?= ROOT ?>/schools" class="school-sort-form schools-redesign-filters">
                <input type="hidden" name="search" value="<?= $escape($search) ?>">
                <label for="school-sort">Sort by</label>
                <select name="sort" id="school-sort" onchange="this.form.submit()">
                    <option value="id" <?= $sort === 'id' ? 'selected' : '' ?>>ID</option>
                    <option value="school_name" <?= $sort === 'school_name' ? 'selected' : '' ?>>School Name</option>
                    <option value="school_id" <?= $sort === 'school_id' ? 'selected' : '' ?>>School ID</option>
                    <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="phone" <?= $sort === 'phone' ? 'selected' : '' ?>>Phone</option>
                    <option value="status" <?= $sort === 'status' ? 'selected' : '' ?>>Status</option>
                </select>

                <select name="direction" aria-label="Sort direction" onchange="this.form.submit()">
                    <option value="ASC" <?= $direction === 'ASC' ? 'selected' : '' ?>>Ascending</option>
                    <option value="DESC" <?= $direction === 'DESC' ? 'selected' : '' ?>>Descending</option>
                </select>

                <label for="school-status">Status</label>
                <select name="status" id="school-status" onchange="this.form.submit()">
                    <option value="" <?= $status === '' ? 'selected' : '' ?>>All Status</option>
                    <option value="active" <?= $status === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $status === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </form>
        </div>

        <?php if (!empty($schools)): ?>
            <div class="table-wrapper schools-redesign-table-wrapper">
                <table class="schools-redesign-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>School</th>
                            <th>School ID</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($schools as $school): ?>
                        <?php $isActive = strtolower((string) ($school->status ?? '')) === 'active'; ?>
                        <tr>
                            <td class="school-db-id"><?= $escape($school->id ?? '-') ?></td>
                            <td>
                                <div class="school-name-cell">
                                    <span class="school-row-avatar" aria-hidden="true">
                                        <?= $escape(function_exists('mb_substr')
                                            ? mb_strtoupper(mb_substr((string) ($school->school_name ?? 'S'), 0, 1, 'UTF-8'), 'UTF-8')
                                            : strtoupper(substr((string) ($school->school_name ?? 'S'), 0, 1))) ?>
                                    </span>
                                    <strong><?= $escape($school->school_name ?? '-') ?></strong>
                                </div>
                            </td>
                            <td><span class="school-code"><?= $escape($school->school_id ?? '-') ?></span></td>
                            <td class="school-contact-cell"><?= $escape($school->email ?? '-') ?></td>
                            <td class="school-contact-cell"><?= $escape($school->phone ?? '-') ?></td>
                            <td><span class="student-count"><?= number_format((int) ($school->student_count ?? 0)) ?></span></td>
                            <td>
                                <span class="status <?= $isActive ? 'active' : 'inactive' ?>">
                                    <span class="school-status-dot" aria-hidden="true"></span>
                                    <?= $isActive ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <div class="school-actions schools-redesign-actions">
                                    <a href="<?= ROOT ?>/schools/details/<?= rawurlencode((string) ($school->school_id ?? '')) ?>" class="view-btn">View</a>
                                    <a href="<?= ROOT ?>/schools/edit/<?= rawurlencode((string) ($school->school_id ?? '')) ?>" class="edit-btn">Edit</a>

                                    <?php if ($isActive): ?>
                                        <form method="POST"
                                              action="<?= ROOT ?>/schools/delete/<?= rawurlencode((string) ($school->school_id ?? '')) ?>"
                                              onsubmit="return confirm('Are you sure you want to deactivate this school?');">
                                            <?= CSRF::field() ?>
                                            <button type="submit" class="delete-btn">Deactivate</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="POST"
                                              action="<?= ROOT ?>/schools/activate/<?= rawurlencode((string) ($school->school_id ?? '')) ?>"
                                              onsubmit="return confirm('Are you sure you want to activate this school?');">
                                            <?= CSRF::field() ?>
                                            <button type="submit" class="activate-btn">Activate</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="schools-table-footer">
                <span>Showing <?= number_format(count($schools)) ?> school(s)</span>
            </div>
        <?php else: ?>
            <div class="empty-state schools-redesign-empty">
                <span class="schools-empty-icon" aria-hidden="true">⌕</span>
                <h3>No schools found</h3>
                <p>
                    <?php if ($search !== ''): ?>
                        No school matches "<?= $escape($search) ?>".
                    <?php else: ?>
                        There are currently no schools registered in the system.
                    <?php endif; ?>
                </p>
                <?php if ($search !== '' || $status !== ''): ?>
                    <a href="<?= ROOT ?>/schools" class="clear-search-btn">Clear filters</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php require "../private/views/includes/footer.view.php"; ?>
<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
</body>
</html>
