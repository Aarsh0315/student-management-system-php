<link rel="stylesheet" href="<?= ROOT ?>/css/settings.view.css?v=1">

<?php

$settings = $data['settings'] ?? [];

$systemName = $settings['system_name'] ?? 'My School Management System';
$supportEmail = $settings['support_email'] ?? '';
$supportPhone = $settings['support_phone'] ?? '';
$websiteUrl = $settings['website_url'] ?? '';
$timezone = $settings['timezone'] ?? 'Asia/Kolkata';
$dateFormat = $settings['date_format'] ?? 'd M Y';
$timeFormat = $settings['time_format'] ?? 'h:i A';
?>

<div class="settings-page">

    <div class="settings-container">

        <!-- Page Header -->
         <?php
$successMessage = $_SESSION['settings_success'] ?? null;
$errorMessage = $_SESSION['settings_error'] ?? null;

unset($_SESSION['settings_success'], $_SESSION['settings_error']);
?>

<?php if ($successMessage): ?>
    <div class="settings-alert settings-alert-success">
        <span class="settings-alert-icon">✓</span>
        <div>
            <strong>Success</strong>
            <p><?= htmlspecialchars($successMessage) ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if ($errorMessage): ?>
    <div class="settings-alert settings-alert-error">
        <span class="settings-alert-icon">!</span>
        <div>
            <strong>Unable to save</strong>
            <p><?= htmlspecialchars($errorMessage) ?></p>
        </div>
    </div>
<?php endif; ?>
        <div class="settings-header">
            <div>
                <span class="settings-eyebrow">SYSTEM CONFIGURATION</span>
                <h1>Settings</h1>
                <p>
                    Manage your school management system configuration
                    and platform-wide preferences.
                </p>
            </div>
        </div>

        <!-- General Settings -->
        <section class="settings-card">

            <div class="settings-card-header">
                <div>
                    <h2>General Settings</h2>
                    <p>
                        Configure the basic information used throughout
                        the platform.
                    </p>
                </div>
            </div>

            <form method="POST" action="<?= ROOT ?>/settings/save">

                <div class="settings-grid">

                    <!-- System Name -->
                    <div class="settings-field">
                        <label for="system_name">
                            System Name
                        </label>

                        <input
                            type="text"
                            id="system_name"
                            name="system_name"
                            value="<?= htmlspecialchars($systemName) ?>"
                            placeholder="My School Management System"
                        >

                        <small>
                            The name displayed across the application.
                        </small>
                    </div>

                    <!-- Support Email -->
                    <div class="settings-field">
                        <label for="support_email">
                            Support Email
                        </label>

                        <input
                            type="email"
                            id="support_email"
                            name="support_email"
                            value="<?= htmlspecialchars($supportEmail) ?>"
                            placeholder="support@example.com"
                        >

                        <small>
                            Email address users can contact for support.
                        </small>
                    </div>

                    <!-- Support Phone -->
                    <div class="settings-field">
                        <label for="support_phone">
                            Support Phone
                        </label>

                        <input
                            type="text"
                            id="support_phone"
                            name="support_phone"
                            value="<?= htmlspecialchars($supportPhone) ?>"
                            placeholder="+91 98765 43210"
                        >

                        <small>
                            Platform support contact number.
                        </small>
                    </div>

                    <!-- Website -->
                    <div class="settings-field">
                        <label for="website_url">
                            Website URL
                        </label>

                        <input
                            type="url"
                            id="website_url"
                            name="website_url"
                            value="<?= htmlspecialchars($websiteUrl) ?>"
                            placeholder="https://example.com"
                        >

                        <small>
                            Main website address of the platform.
                        </small>
                    </div>

                    <!-- Timezone -->
                    <div class="settings-field">
                        <label for="timezone">
                            Timezone
                        </label>

                        <select id="timezone" name="timezone">
                            <option
                                value="Asia/Kolkata"
                                <?= $timezone === 'Asia/Kolkata' ? 'selected' : '' ?>
                            >
                                India (Asia/Kolkata)
                            </option>

                            <option
                                value="UTC"
                                <?= $timezone === 'UTC' ? 'selected' : '' ?>
                            >
                                UTC
                            </option>

                            <option
                                value="Asia/Dubai"
                                <?= $timezone === 'Asia/Dubai' ? 'selected' : '' ?>
                            >
                                Dubai (Asia/Dubai)
                            </option>

                            <option
                                value="Asia/Singapore"
                                <?= $timezone === 'Asia/Singapore' ? 'selected' : '' ?>
                            >
                                Singapore (Asia/Singapore)
                            </option>
                        </select>

                        <small>
                            Used for dates, times and scheduled activities.
                        </small>
                    </div>

                    <!-- Date Format -->
                    <div class="settings-field">
                        <label for="date_format">
                            Date Format
                        </label>

                        <select id="date_format" name="date_format">

                            <option
                                value="d M Y"
                                <?= $dateFormat === 'd M Y' ? 'selected' : '' ?>
                            >
                                11 Sep 2026
                            </option>

                            <option
                                value="d/m/Y"
                                <?= $dateFormat === 'd/m/Y' ? 'selected' : '' ?>
                            >
                                11/09/2026
                            </option>

                            <option
                                value="m/d/Y"
                                <?= $dateFormat === 'm/d/Y' ? 'selected' : '' ?>
                            >
                                09/11/2026
                            </option>

                            <option
                                value="Y-m-d"
                                <?= $dateFormat === 'Y-m-d' ? 'selected' : '' ?>
                            >
                                2026-09-11
                            </option>

                        </select>

                        <small>
                            Default date format used by the system.
                        </small>
                    </div>

                    <!-- Time Format -->
                    <div class="settings-field">
                        <label for="time_format">
                            Time Format
                        </label>

                        <select id="time_format" name="time_format">

                            <option
                                value="h:i A"
                                <?= $timeFormat === 'h:i A' ? 'selected' : '' ?>
                            >
                                04:30 PM
                            </option>

                            <option
                                value="H:i"
                                <?= $timeFormat === 'H:i' ? 'selected' : '' ?>
                            >
                                16:30
                            </option>

                        </select>

                        <small>
                            Default time format used by the system.
                        </small>
                    </div>

                </div>

                <!-- Actions -->
                <div class="settings-actions">
                    <button type="submit" class="settings-save-btn">
                        Save Changes
                    </button>
                </div>

            </form>

        </section>

    </div>

</div>