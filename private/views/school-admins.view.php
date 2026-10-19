<?php
$admins = $data['admins'] ?? [];
$search = $data['search'] ?? '';
$sort = $data['sort'] ?? 'id';
$direction = strtoupper($data['direction'] ?? 'DESC');

$escape = static function ($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
};

/*
 * For accurate platform-wide totals, pass $data['stats'] from the controller.
 * Otherwise these cards use the admins currently returned by the controller.
 */
$stats = $data['stats'] ?? [];
$statsGet = static function (string $key, $fallback = null) use ($stats) {
    if (is_array($stats) && isset($stats[$key]) && is_numeric($stats[$key])) {
        return (int) $stats[$key];
    }
    if (is_object($stats) && isset($stats->{$key}) && is_numeric($stats->{$key})) {
        return (int) $stats->{$key};
    }
    return $fallback;
};

$activeCount = 0;
$inactiveCount = 0;
$schoolNames = [];
foreach ($admins as $adminRow) {
    if (strtolower((string) ($adminRow->status ?? '')) === 'active') {
        $activeCount++;
    } else {
        $inactiveCount++;
    }
    $schoolNameValue = trim((string) ($adminRow->school_name ?? ''));
    if ($schoolNameValue !== '') {
        $schoolNames[strtolower($schoolNameValue)] = true;
    }
}
$totalAdmins = $statsGet('total_admins', count($admins));
$totalActive = $statsGet('active_admins', $activeCount);
$totalInactive = $statsGet('inactive_admins', $inactiveCount);
$schoolsWithAdmins = $statsGet('schools_with_admins', count($schoolNames));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admins - My School</title>

    <link rel="stylesheet" href="<?= ROOT ?>/css/nav.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/home.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/school-admins.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/school-admins-redesign.css?v=1">
    <link rel="stylesheet" href="<?= ROOT ?>/css/footer.view.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/sidebar.view.css">
</head>
<body>
<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>

<main class="dashboard school-admins-page">
    <section class="school-admins-hero">
        <div class="school-admins-hero-copy">
            <p class="school-admins-breadcrumb">SUPER ADMIN <span>/</span> PLATFORM</p>
            <h1>School Admins</h1>
            <p>Manage and monitor administrators assigned to schools across the system.</p>
        </div>
        <div class="school-admins-hero-decoration" aria-hidden="true"></div>
    </section>

    <section class="school-admins-stats" aria-label="School administrator statistics">
        <article class="school-admin-stat">
            <span class="school-admin-stat-icon icon-blue" aria-hidden="true">♙</span>
            <div class="school-admin-stat-copy">
                <p>Total School Admins</p>
                <strong><?= number_format($totalAdmins) ?></strong>
                <small><?= number_format($totalActive) ?> active <span>•</span> <?= number_format($totalInactive) ?> inactive</small>
            </div>
        </article>
        <article class="school-admin-stat">
            <span class="school-admin-stat-icon icon-green" aria-hidden="true">▦</span>
            <div class="school-admin-stat-copy">
                <p>Schools with Admins</p>
                <strong><?= number_format($schoolsWithAdmins) ?></strong>
                <small>Across registered schools</small>
            </div>
        </article>
        <article class="school-admin-stat">
            <span class="school-admin-stat-icon icon-purple" aria-hidden="true">♧</span>
            <div class="school-admin-stat-copy">
                <p>Active Admins</p>
                <strong><?= number_format($totalActive) ?></strong>
                <small><?= $totalAdmins > 0 ? (int) round(($totalActive / $totalAdmins) * 100) : 0 ?>% of all admins</small>
            </div>
        </article>
        <article class="school-admin-stat">
            <span class="school-admin-stat-icon icon-red" aria-hidden="true">!</span>
            <div class="school-admin-stat-copy">
                <p>Inactive Admins</p>
                <strong><?= number_format($totalInactive) ?></strong>
                <small><?= $totalInactive > 0 ? 'Requires attention' : 'All admins active' ?></small>
            </div>
        </article>
    </section>

    <section class="admins-card school-admins-table-card">
        <div class="admins-header school-admins-header">
            <div>
                <h2>All School Admins</h2>
                <p>
                    <?= number_format(count($admins)) ?> school admin(s) registered
                    <?php if ($search !== ''): ?>
                        for <strong>"<?= $escape($search) ?>"</strong>
                    <?php endif; ?>
                </p>
            </div>
            <a href="<?= ROOT ?>/schooladmins/add" class="add-admin-btn school-admins-add-btn">
                <span aria-hidden="true">+</span> Add School Admin
            </a>
        </div>

        <div class="admins-toolbar school-admins-toolbar">
            <form method="GET" action="<?= ROOT ?>/schooladmins" class="admin-search-form school-admins-search">
                <label class="admin-search-box school-admins-search-box">
                    <span class="search-icon" aria-hidden="true">⌕</span>
                    <input
                        type="search"
                        name="search"
                        placeholder="Search admin by name, email, school..."
                        value="<?= $escape($search) ?>"
                        aria-label="Search school admins"
                    >
                </label>
                <input type="hidden" name="sort" value="<?= $escape($sort) ?>">
                <input type="hidden" name="direction" value="<?= $escape($direction) ?>">
                <button type="submit" class="search-btn school-admins-search-btn">Search</button>
                <?php if ($search !== ''): ?>
                    <a href="<?= ROOT ?>/schooladmins" class="clear-search-btn">Clear</a>
                <?php endif; ?>
            </form>

            <form method="GET" action="<?= ROOT ?>/schooladmins" class="admin-sort-form school-admins-filters">
                <input type="hidden" name="search" value="<?= $escape($search) ?>">
                <label for="admin-sort">Sort by</label>
                <select name="sort" id="admin-sort" onchange="this.form.submit()">
                    <option value="id" <?= $sort === 'id' ? 'selected' : '' ?>>Admin ID</option>
                    <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name</option>
                    <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="school" <?= $sort === 'school' ? 'selected' : '' ?>>School</option>
                    <option value="status" <?= $sort === 'status' ? 'selected' : '' ?>>Status</option>
                </select>
                <select name="direction" aria-label="Sort direction" onchange="this.form.submit()">
                    <option value="ASC" <?= $direction === 'ASC' ? 'selected' : '' ?>>Ascending</option>
                    <option value="DESC" <?= $direction === 'DESC' ? 'selected' : '' ?>>Descending</option>
                </select>
            </form>
        </div>

        <?php if (!empty($admins)): ?>
            <div class="table-wrapper school-admins-table-wrap">
                <table class="school-admins-table">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>School</th>
                            <th>School ID</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <?php
                        $isActive = strtolower((string) ($admin->status ?? '')) === 'active';
                        $fullName = trim((string) ($admin->firstname ?? '') . ' ' . (string) ($admin->lastname ?? ''));
                        $avatarInitial = function_exists('mb_substr')
                            ? mb_strtoupper(mb_substr($fullName !== '' ? $fullName : 'A', 0, 1, 'UTF-8'), 'UTF-8')
                            : strtoupper(substr($fullName !== '' ? $fullName : 'A', 0, 1));
                        ?>
                        <tr>
                            <td><span class="admin-id school-admins-id"><?= $escape($admin->user_id ?? '-') ?></span></td>
                            <td>
                                <div class="school-admin-name-cell">
                                    <span class="school-admin-avatar" aria-hidden="true"><?= $escape($avatarInitial) ?></span>
                                    <strong class="admin-name"><?= $escape($fullName !== '' ? $fullName : 'Unnamed Admin') ?></strong>
                                </div>
                            </td>
                            <td>
                                <?php if (!empty($admin->school_name)): ?>
                                    <div class="school-admin-school-cell">
                                        <span class="school-admin-school-icon" aria-hidden="true">▦</span>
                                        <span class="admin-school"><?= $escape($admin->school_name) ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="no-school">No School</span>
                                <?php endif; ?>
                            </td>
                            <td><span class="school-code"><?= $escape($admin->school_code ?? '-') ?></span></td>
                            <td class="school-admin-email"><?= $escape($admin->email ?? '-') ?></td>
                            <td><?= $escape($admin->gender ?? '-') ?></td>
                            <td>
                                <span class="status <?= $isActive ? 'active' : 'inactive' ?>">
                                    <span class="school-admin-status-dot" aria-hidden="true"></span>
                                    <?= $isActive ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <div class="school-admin-row-actions">
                                    <a href="<?= ROOT ?>/schooladmins/details/<?= rawurlencode((string) ($admin->user_id ?? '')) ?>" class="view-btn">View</a>
                                    <a href="<?= ROOT ?>/schooladmins/edit/<?= rawurlencode((string) ($admin->user_id ?? '')) ?>" class="edit-btn">Edit</a>
                                    <details class="school-admin-more">
                                        <summary aria-label="More actions">⋮</summary>
                                        <div class="school-admin-more-menu">
                                            <a href="<?= ROOT ?>/schooladmins/details/<?= rawurlencode((string) ($admin->user_id ?? '')) ?>">View details</a>
                                            <a href="<?= ROOT ?>/schooladmins/edit/<?= rawurlencode((string) ($admin->user_id ?? '')) ?>">Edit admin</a>
                                        </div>
                                    </details>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="school-admins-table-footer">
                <span>Showing <?= number_format(count($admins)) ?> school admin(s)</span>
            </div>
        <?php else: ?>
            <div class="empty-state school-admins-empty">
                <span class="school-admins-empty-icon" aria-hidden="true">⌕</span>
                <h3>No School Admins Found</h3>
                <?php if ($search !== ''): ?>
                    <p>No school admin matches <strong>"<?= $escape($search) ?>"</strong>.</p>
                    <a href="<?= ROOT ?>/schooladmins" class="view-all-admins-btn">View All School Admins</a>
                <?php else: ?>
                    <p>There are currently no school administrators registered.</p>
                    <a href="<?= ROOT ?>/schooladmins/add" class="add-admin-btn school-admins-add-btn">+ Add School Admin</a>
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
