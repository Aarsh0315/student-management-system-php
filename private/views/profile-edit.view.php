<?php

$profile = $data['profile'] ?? null;

if (!$profile) {
    die("User profile not found.");
}

$firstname = (string) ($profile->firstname ?? '');
$lastname  = (string) ($profile->lastname ?? '');
$gender    = (string) ($profile->gender ?? '');
$email     = (string) ($profile->email ?? '-');

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
$rank = $rankNames[$profile->rank ?? ''] ?? ucfirst((string) ($profile->rank ?? '-'));

$escape = static function ($value): string {
    return htmlspecialchars((string) ($value ?? '-'), ENT_QUOTES, 'UTF-8');
};

/*
 * profile_image is expected to contain the saved filename, e.g. user_123_ab12.jpg.
 * The same file URL is used by the Users list.
 */
$profileImageName = basename((string) ($profile->profile_image ?? ''));
$profileImageUrl = $profileImageName !== ''
    ? rtrim(ROOT, '/') . '/uploads/users/' . rawurlencode($profileImageName)
    : '';

$initial = strtoupper(substr($firstname !== '' ? $firstname : 'U', 0, 1));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - My School</title>

    <link rel="stylesheet" href="<?= ROOT ?>/css/home.view.css?v=2">
    <link rel="stylesheet" href="<?= ROOT ?>/css/nav.view.css?v=3">
    <link rel="stylesheet" href="<?= ROOT ?>/css/sidebar.view.css?v=3">
    <link rel="stylesheet" href="<?= ROOT ?>/css/footer.view.css?v=1">
    <link rel="stylesheet" href="<?= ROOT ?>/css/my-profile.view.css?v=3">
    <link rel="stylesheet" href="<?= ROOT ?>/css/profile-edit-summary.css?v=2">
</head>
<body>

<?php require "../private/views/includes/nav.view.php"; ?>
<?php require "../private/views/includes/sidebar.view.php"; ?>

<main class="profile-page profile-edit-page">
    <section class="edit-profile-welcome">
        <div class="edit-profile-welcome-copy">
            <p class="edit-profile-eyebrow">ACCOUNT <span>/</span> PROFILE</p>
            <h1>Edit Profile</h1>
            <p class="edit-profile-subtitle">Update your personal information and profile photo.</p>
        </div>
        <div class="edit-profile-welcome-decoration" aria-hidden="true"></div>
    </section>

    <section class="edit-profile-identity-card">
        <div class="edit-profile-avatar-wrap">
            <?php if ($profileImageUrl !== ''): ?>
                <img
                    src="<?= $escape($profileImageUrl) ?>"
                    class="edit-profile-avatar edit-profile-avatar-image"
                    alt="Current profile photo"
                    id="currentProfilePhoto"
                    onerror="this.hidden=true; document.getElementById('profileAvatarFallback').hidden=false;"
                >
                <div class="edit-profile-avatar" id="profileAvatarFallback" aria-hidden="true" hidden><?= $escape($initial) ?></div>
            <?php else: ?>
                <div class="edit-profile-avatar" id="profileAvatarFallback" aria-hidden="true"><?= $escape($initial) ?></div>
                <img src="" class="edit-profile-avatar edit-profile-avatar-image" alt="Profile photo preview" id="currentProfilePhoto" hidden>
            <?php endif; ?>
        </div>

        <div class="edit-profile-identity">
            <h2><?= $escape(trim($firstname . ' ' . $lastname) ?: 'User') ?></h2>
            <p><?= $escape($email) ?></p>
            <span class="edit-profile-role"><?= $escape($rank) ?></span>
        </div>
        <a href="<?= ROOT ?>/profile" class="edit-profile-back-link">← Back to Profile</a>
    </section>

    <section class="edit-profile-panel">
        <header class="edit-profile-panel-header">
            <div>
                <h2>Personal Information</h2>
                <p>Update the information associated with your account.</p>
            </div>
            <span class="edit-profile-panel-icon" aria-hidden="true">✎</span>
        </header>

        <form
            method="POST"
            action="<?= ROOT ?>/profile/update"
            class="edit-profile-form"
            enctype="multipart/form-data"
        >
            <?= CSRF::field() ?>

            <div class="edit-profile-photo-field">
                <div class="edit-profile-photo-copy">
                    <strong>Profile Photo</strong>
                    <p>Choose a clear photo. JPG, PNG, or WebP; maximum 2 MB.</p>
                </div>
                <label class="edit-profile-upload-button" for="profile_image">
                    <span aria-hidden="true">↑</span> Choose Photo
                </label>
                <input
                    class="edit-profile-file-input"
                    id="profile_image"
                    type="file"
                    name="profile_image"
                    accept="image/jpeg,image/png,image/webp"
                    data-max-size="2097152"
                >
                <p class="edit-profile-file-name" id="profilePhotoFileName">No new photo selected</p>
                <p class="edit-profile-file-error" id="profilePhotoError" role="alert" hidden></p>
            </div>

            <div class="edit-profile-fields">
                <label class="edit-profile-field" for="firstname">
                    <span>First Name <b>*</b></span>
                    <input id="firstname" type="text" name="firstname" value="<?= $escape($firstname) ?>" required maxlength="100" autocomplete="given-name" placeholder="Enter first name">
                </label>

                <label class="edit-profile-field" for="lastname">
                    <span>Last Name <b>*</b></span>
                    <input id="lastname" type="text" name="lastname" value="<?= $escape($lastname) ?>" required maxlength="100" autocomplete="family-name" placeholder="Enter last name">
                </label>

                <label class="edit-profile-field" for="gender">
                    <span>Gender</span>
                    <select id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="Male" <?= strcasecmp($gender, 'Male') === 0 ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= strcasecmp($gender, 'Female') === 0 ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= strcasecmp($gender, 'Other') === 0 ? 'selected' : '' ?>>Other</option>
                    </select>
                </label>

                <div class="edit-profile-field edit-profile-readonly-field">
                    <span>Email Address</span>
                    <div class="edit-profile-readonly-value"><?= $escape($email) ?></div>
                    <small>Email cannot be changed here.</small>
                </div>

                <div class="edit-profile-field edit-profile-readonly-field">
                    <span>Role</span>
                    <div class="edit-profile-readonly-value"><?= $escape($rank) ?></div>
                    <small>Role is managed by the administrator.</small>
                </div>
            </div>

            <div class="edit-profile-note">
                <span aria-hidden="true">i</span>
                <p>Your email address and account role are read-only. The profile photo you save here can also be displayed in the Users list.</p>
            </div>

            <div class="edit-profile-form-actions">
                <a href="<?= ROOT ?>/profile" class="edit-profile-cancel">Cancel</a>
                <button type="submit" class="edit-profile-save"><span aria-hidden="true">✓</span> Save Changes</button>
            </div>
        </form>
    </section>
</main>

<?php require "../private/views/includes/footer.view.php"; ?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>
<script>
(() => {
    const input = document.getElementById('profile_image');
    const preview = document.getElementById('currentProfilePhoto');
    const fallback = document.getElementById('profileAvatarFallback');
    const fileName = document.getElementById('profilePhotoFileName');
    const error = document.getElementById('profilePhotoError');
    if (!input) return;

    input.addEventListener('change', () => {
        error.hidden = true;
        error.textContent = '';
        const file = input.files && input.files[0];
        if (!file) {
            fileName.textContent = 'No new photo selected';
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            input.value = '';
            fileName.textContent = 'No new photo selected';
            error.textContent = 'Please choose a JPG, PNG, or WebP image.';
            error.hidden = false;
            return;
        }
        if (file.size > 2097152) {
            input.value = '';
            fileName.textContent = 'No new photo selected';
            error.textContent = 'The photo must be 2 MB or smaller.';
            error.hidden = false;
            return;
        }

        fileName.textContent = file.name;
        const reader = new FileReader();
        reader.onload = (event) => {
            preview.src = event.target.result;
            preview.hidden = false;
            if (fallback) fallback.hidden = true;
        };
        reader.readAsDataURL(file);
    });
})();
</script>
</body>
</html>
