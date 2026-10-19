<?php

$profile = $data['profile'] ?? null;

if (!$profile) {
    die("User profile not found.");
}

$rankNames = [
    'super_admin'    => 'Super Admin',
    'admin'          => 'School Admin',
    'principal'      => 'Principal',
    'vice_principal' => 'Vice Principal',
    'teacher'        => 'Teacher',
    'student'        => 'Student',
    'parent'         => 'Parent',
    'staff'          => 'Staff',
];

$rank = $rankNames[$profile->rank ?? ''] ?? ucfirst((string) ($profile->rank ?? 'User'));
$status = strtolower((string) ($profile->status ?? 'active'));
$fullName = trim((string) ($profile->firstname ?? '') . ' ' . (string) ($profile->lastname ?? ''));
$firstName = (string) ($profile->firstname ?? '');
$initialSource = $firstName !== '' ? $firstName : ($fullName !== '' ? $fullName : 'U');
$initial = function_exists('mb_substr')
    ? mb_strtoupper(mb_substr($initialSource, 0, 1, 'UTF-8'), 'UTF-8')
    : strtoupper(substr($initialSource, 0, 1));
$profileImage = trim((string) ($profile->profile_image ?? ''));
$profileImageUrl = '';
if ($profileImage !== '') {
    // The database stores an uploaded filename; never expose filesystem paths.
    if (preg_match('~^https?://~i', $profileImage)) {
        $profileImageUrl = $profileImage;
    } else {
        $profileImageUrl = rtrim(ROOT, '/') . '/uploads/users/' . rawurlencode(basename($profileImage));
    }
}

$escape = static function ($value): string {
    return htmlspecialchars((string) ($value ?? '-'), ENT_QUOTES, 'UTF-8');
};

/*
 * Read-only summary is the default view.
 * Clicking Edit Profile opens the existing /profile/edit route.
 * No password-change section is included here.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - My School</title>

    <link rel="stylesheet" href="<?= ROOT ?>/css/my-profile.view.css?v=3">
    <link rel="stylesheet" href="<?= ROOT ?>/css/my-profile-summary.css?v=5">
    <link rel="stylesheet" href="<?= ROOT ?>/css/footer.view.css">
    <link rel="stylesheet" href="<?= ROOT ?>/css/nav.view.css?v=3">
    <link rel="stylesheet" href="<?= ROOT ?>/css/sidebar.view.css?v=3">
</head>
<body>

<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>

<main class="profile-page profile-summary-page">
    <section class="profile-welcome">
        <div>
            <p class="profile-eyebrow">ACCOUNT <span>/</span> PROFILE</p>
            <h1>My Profile</h1>
            <p class="profile-welcome-text">View your personal account information.</p>
        </div>
        <div class="profile-welcome-decoration" aria-hidden="true"></div>
    </section>

    <section class="profile-overview-grid" aria-label="Account summary">
        <article class="profile-overview-card">
            <span class="profile-overview-icon icon-blue" aria-hidden="true">♙</span>
            <div>
                <p>User ID</p>
                <strong><?= $escape($profile->user_id ?? '-') ?></strong>
                <small>System generated</small>
            </div>
        </article>

        <article class="profile-overview-card">
            <span class="profile-overview-icon icon-green" aria-hidden="true">✓</span>
            <div>
                <p>Account Status</p>
                <strong><span class="profile-status-pill <?= $status === 'active' ? 'is-active' : 'is-inactive' ?>"><?= $escape(ucfirst($status)) ?></span></strong>
                <small>Your account status</small>
            </div>
        </article>

        <article class="profile-overview-card">
            <span class="profile-overview-icon icon-purple" aria-hidden="true">♛</span>
            <div>
                <p>Role</p>
                <strong><?= $escape($rank) ?></strong>
                <small>Assigned account role</small>
            </div>
        </article>

        <article class="profile-overview-card">
            <span class="profile-overview-icon icon-red" aria-hidden="true">▦</span>
            <div>
                <p>School</p>
                <strong><?= $escape($profile->school_name ?? 'Platform account') ?></strong>
                <small><?= isset($profile->school_name) ? 'Associated school' : 'System-wide account' ?></small>
            </div>
        </article>
    </section>

    <section class="profile-summary-card">
        <div class="profile-summary-avatar">
            <?php if ($profileImageUrl !== ''): ?>
                <img
                    src="<?= $escape($profileImageUrl) ?>"
                    alt="<?= $escape($fullName !== '' ? $fullName : 'User') ?> profile photo"
                    class="profile-summary-avatar-image"
                    onerror="this.hidden=true; this.nextElementSibling.hidden=false;"
                >
                <span class="profile-summary-avatar-fallback" aria-hidden="true" hidden><?= $escape($initial) ?></span>
            <?php else: ?>
                <span class="profile-summary-avatar-fallback" aria-hidden="true"><?= $escape($initial) ?></span>
            <?php endif; ?>
        </div>
        <div class="profile-summary-identity">
            <h2><?= $escape($fullName !== '' ? $fullName : 'User') ?></h2>
            <p><?= $escape($profile->email ?? '-') ?></p>
            <span class="profile-summary-role"><?= $escape($rank) ?></span>
        </div>
        <a href="<?= ROOT ?>/profile/edit" class="profile-edit-button">
            <span aria-hidden="true">✎</span> Edit Profile
        </a>
    </section>

    <section class="profile-details-card">
        <header class="profile-details-header">
            <div>
                <h2>Account Information</h2>
                <p>Your personal account details.</p>
            </div>
            <span class="profile-details-lock" aria-hidden="true">▤</span>
        </header>

        <div class="profile-details-grid">
            <div class="profile-detail-item">
                <span>User ID</span>
                <strong><span class="profile-id-badge"><?= $escape($profile->user_id ?? '-') ?></span></strong>
            </div>
            <div class="profile-detail-item">
                <span>First Name</span>
                <strong><?= $escape($profile->firstname ?? '-') ?></strong>
            </div>
            <div class="profile-detail-item">
                <span>Last Name</span>
                <strong><?= $escape($profile->lastname ?? '-') ?></strong>
            </div>
            <div class="profile-detail-item">
                <span>Email Address</span>
                <strong><?= $escape($profile->email ?? '-') ?></strong>
            </div>
            <div class="profile-detail-item">
                <span>Gender</span>
                <strong><?= $escape(ucfirst((string) ($profile->gender ?? '-'))) ?></strong>
            </div>
            <div class="profile-detail-item">
                <span>Role</span>
                <strong><?= $escape($rank) ?></strong>
            </div>
            <div class="profile-detail-item">
                <span>Account Status</span>
                <strong>
                    <span class="profile-status-pill <?= $status === 'active' ? 'is-active' : 'is-inactive' ?>">
                        <?= $escape(ucfirst($status)) ?>
                    </span>
                </strong>
            </div>
            <?php if (!empty($profile->school_name)): ?>
                <div class="profile-detail-item">
                    <span>School</span>
                    <strong><?= $escape($profile->school_name) ?></strong>
                </div>
            <?php endif; ?>
        </div>

        <div class="profile-details-footer">
            <span><span class="profile-footer-dot"></span> Profile information</span>
            <a href="<?= ROOT ?>/profile/edit">Edit account details <span aria-hidden="true">→</span></a>
        </div>
    </section>
</main>

<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
</body>
</html>
