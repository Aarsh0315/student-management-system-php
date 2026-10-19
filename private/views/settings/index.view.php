<?php

$settings = $data['settings'] ?? [];

/*
|--------------------------------------------------------------------------
| GENERAL SETTINGS
|--------------------------------------------------------------------------
*/

$systemName = $settings['system_name']
    ?? 'My School Management System';

$supportEmail = $settings['support_email'] ?? '';

$supportPhone = $settings['support_phone'] ?? '';

$websiteUrl = $settings['website_url'] ?? '';

$timezone = $settings['timezone']
    ?? 'Asia/Kolkata';

$dateFormat = $settings['date_format']
    ?? 'd M Y';

$timeFormat = $settings['time_format']
    ?? 'h:i A';


/*
|--------------------------------------------------------------------------
| SECURITY SETTINGS
|--------------------------------------------------------------------------
*/

$loginProtection =
    ($settings['login_protection'] ?? '1') === '1';

$captchaProtection =
    ($settings['captcha_protection'] ?? '1') === '1';

$superAdminOtp =
    ($settings['super_admin_otp'] ?? '1') === '1';

$failedLoginLimit =
    (int) ($settings['failed_login_limit'] ?? 5);

$lockoutMinutes =
    (int) ($settings['lockout_minutes'] ?? 15);

$otpExpiryMinutes =
    (int) ($settings['otp_expiry_minutes'] ?? 5);

$otpMaxAttempts =
    (int) ($settings['otp_max_attempts'] ?? 5);

$sessionTimeoutMinutes =
    (int) ($settings['session_timeout_minutes'] ?? 60);

/* Additional settings sections (wire these to SettingsModel/controller next). */
$academicYear = $settings['academic_year'] ?? '2026-2027';
$schoolAddress = $settings['school_address'] ?? '';
$schoolCity = $settings['school_city'] ?? 'Mumbai';
$schoolState = $settings['school_state'] ?? 'Maharashtra';
$schoolPincode = $settings['school_pincode'] ?? '';
$schoolCode = $settings['school_code'] ?? '';
$smtpHost = $settings['smtp_host'] ?? '';
$smtpPort = (int) ($settings['smtp_port'] ?? 587);
$smtpUsername = $settings['smtp_username'] ?? '';
$smtpFromEmail = $settings['smtp_from_email'] ?? '';
$smtpFromName = $settings['smtp_from_name'] ?? $systemName;
$emailNotifications = ($settings['email_notifications'] ?? '1') === '1';
$smsNotifications = ($settings['sms_notifications'] ?? '0') === '1';
$systemAnnouncements = ($settings['system_announcements'] ?? '1') === '1';
$loginEmailAlerts = ($settings['login_email_alerts'] ?? '0') === '1';
$maintenanceMode = ($settings['maintenance_mode'] ?? '0') === '1';
$defaultLanguage = $settings['default_language'] ?? 'en';
$themePreference = $settings['theme_preference'] ?? 'light';


/*
|--------------------------------------------------------------------------
| MESSAGES
|--------------------------------------------------------------------------
*/

$successMessage =
    $_SESSION['settings_success'] ?? null;

$errorMessage =
    $_SESSION['settings_error'] ?? null;

unset(
    $_SESSION['settings_success'],
    $_SESSION['settings_error']
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

    <title>Settings</title>

    <!-- Navbar -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >

    <!-- Sidebar -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >

    <!-- Footer -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

    <!-- Settings -->
    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/settings.view.css?v=4"
    >

</head>

<body>

<?php
require "../private/views/includes/nav.view.php";
?>

<?php
require "../private/views/includes/sidebar.view.php";
?>


<div class="settings-page">

    <div class="settings-container">


        <!-- ============================================================
             ALERTS
        ============================================================= -->

        <?php if ($successMessage): ?>

            <div class="settings-alert settings-alert-success">

                <span class="settings-alert-icon">
                    ✓
                </span>

                <div>

                    <strong>
                        Success
                    </strong>

                    <p>
                        <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
                    </p>

                </div>

            </div>

        <?php endif; ?>


        <?php if ($errorMessage): ?>

            <div class="settings-alert settings-alert-error">

                <span class="settings-alert-icon">
                    !
                </span>

                <div>

                    <strong>
                        Unable to save
                    </strong>

                    <p>
                        <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?>
                    </p>

                </div>

            </div>

        <?php endif; ?>


        <!-- ============================================================
             PAGE HEADER
        ============================================================= -->

        <div class="settings-header">

            <div>

                <span class="settings-eyebrow">
                    SYSTEM CONFIGURATION
                </span>

                <h1>
                    Settings
                </h1>

                <p>
                    Manage your school management system configuration
                    and platform-wide preferences.
                </p>

            </div>

        </div>


        <!-- ============================================================
             FORM
        ============================================================= -->

        <form
            method="POST"
            action="<?= ROOT ?>/settings/save"
        >


            <!-- ========================================================
                 GENERAL SETTINGS
            ========================================================= -->

            <section class="settings-card">

                <div class="settings-card-header">

                    <div>

                        <h2>
                            General Settings
                        </h2>

                        <p>
                            Configure the basic information used throughout
                            the platform.
                        </p>

                    </div>

                </div>


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
                            value="<?= htmlspecialchars($systemName, ENT_QUOTES, 'UTF-8') ?>"
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
                            value="<?= htmlspecialchars($supportEmail, ENT_QUOTES, 'UTF-8') ?>"
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
                            value="<?= htmlspecialchars($supportPhone, ENT_QUOTES, 'UTF-8') ?>"
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
                            value="<?= htmlspecialchars($websiteUrl, ENT_QUOTES, 'UTF-8') ?>"
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

                        <select
                            id="timezone"
                            name="timezone"
                        >

                            <option
                                value="Asia/Kolkata"
                                <?= $timezone === 'Asia/Kolkata'
                                    ? 'selected'
                                    : '' ?>
                            >
                                India (Asia/Kolkata)
                            </option>

                            <option
                                value="UTC"
                                <?= $timezone === 'UTC'
                                    ? 'selected'
                                    : '' ?>
                            >
                                UTC
                            </option>

                            <option
                                value="Asia/Dubai"
                                <?= $timezone === 'Asia/Dubai'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Dubai (Asia/Dubai)
                            </option>

                            <option
                                value="Asia/Singapore"
                                <?= $timezone === 'Asia/Singapore'
                                    ? 'selected'
                                    : '' ?>
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

                        <select
                            id="date_format"
                            name="date_format"
                        >

                            <option
                                value="d M Y"
                                <?= $dateFormat === 'd M Y'
                                    ? 'selected'
                                    : '' ?>
                            >
                                11 Sep 2026
                            </option>

                            <option
                                value="d/m/Y"
                                <?= $dateFormat === 'd/m/Y'
                                    ? 'selected'
                                    : '' ?>
                            >
                                11/09/2026
                            </option>

                            <option
                                value="m/d/Y"
                                <?= $dateFormat === 'm/d/Y'
                                    ? 'selected'
                                    : '' ?>
                            >
                                09/11/2026
                            </option>

                            <option
                                value="Y-m-d"
                                <?= $dateFormat === 'Y-m-d'
                                    ? 'selected'
                                    : '' ?>
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

                        <select
                            id="time_format"
                            name="time_format"
                        >

                            <option
                                value="h:i A"
                                <?= $timeFormat === 'h:i A'
                                    ? 'selected'
                                    : '' ?>
                            >
                                04:30 PM
                            </option>

                            <option
                                value="H:i"
                                <?= $timeFormat === 'H:i'
                                    ? 'selected'
                                    : '' ?>
                            >
                                16:30
                            </option>

                        </select>

                        <small>
                            Default time format used by the system.
                        </small>

                    </div>

                </div>

            </section>


            <!-- ========================================================
                 SECURITY SETTINGS
            ========================================================= -->

            <section class="settings-card settings-security-card">

                <div class="settings-card-header">

                    <div>

                        <h2>
                            Security Settings
                        </h2>

                        <p>
                            Configure login protection, authentication
                            and session security for the platform.
                        </p>

                    </div>

                </div>


                <div class="settings-security-list">


                    <!-- Login Protection -->

                    <div class="settings-security-row">

                        <div class="settings-security-info">

                            <strong>
                                Login Protection
                            </strong>

                            <span>
                                Protect accounts against repeated
                                failed login attempts.
                            </span>

                        </div>

                        <label class="settings-toggle">

                            <input
                                type="checkbox"
                                name="login_protection"
                                value="1"
                                <?= $loginProtection ? 'checked' : '' ?>
                            >

                            <span class="settings-toggle-slider"></span>

                        </label>

                    </div>


                    <!-- CAPTCHA -->

                    <div class="settings-security-row">

                        <div class="settings-security-info">

                            <strong>
                                CAPTCHA Protection
                            </strong>

                            <span>
                                Require CAPTCHA verification after
                                failed login attempts.
                            </span>

                        </div>

                        <label class="settings-toggle">

                            <input
                                type="checkbox"
                                name="captcha_protection"
                                value="1"
                                <?= $captchaProtection ? 'checked' : '' ?>
                            >

                            <span class="settings-toggle-slider"></span>

                        </label>

                    </div>


                    <!-- Super Admin OTP -->

                    <div class="settings-security-row">

                        <div class="settings-security-info">

                            <strong>
                                Super Admin OTP
                            </strong>

                            <span>
                                Require OTP verification when a
                                Super Admin logs in.
                            </span>

                        </div>

                        <label class="settings-toggle">

                            <input
                                type="checkbox"
                                name="super_admin_otp"
                                value="1"
                                <?= $superAdminOtp ? 'checked' : '' ?>
                            >

                            <span class="settings-toggle-slider"></span>

                        </label>

                    </div>

                </div>


                <!-- Security Limits -->

                <div class="settings-security-limits">

                    <div class="settings-subsection-title">

                        <h3>
                            Security Limits
                        </h3>

                        <p>
                            Configure authentication and session
                            thresholds.
                        </p>

                    </div>


                    <div class="settings-grid">


                        <!-- Failed Login -->

                        <div class="settings-field">

                            <label for="failed_login_limit">
                                Failed Login Attempts
                            </label>

                            <input
                                type="number"
                                id="failed_login_limit"
                                name="failed_login_limit"
                                value="<?= $failedLoginLimit ?>"
                                min="1"
                                max="20"
                            >

                            <small>
                                Number of failed attempts before
                                account lockout.
                            </small>

                        </div>


                        <!-- Lockout -->

                        <div class="settings-field">

                            <label for="lockout_minutes">
                                Lockout Duration
                            </label>

                            <div class="settings-input-with-unit">

                                <input
                                    type="number"
                                    id="lockout_minutes"
                                    name="lockout_minutes"
                                    value="<?= $lockoutMinutes ?>"
                                    min="1"
                                    max="1440"
                                >

                                <span>
                                    minutes
                                </span>

                            </div>

                            <small>
                                How long an account remains locked.
                            </small>

                        </div>


                        <!-- OTP Validity -->

                        <div class="settings-field">

                            <label for="otp_expiry_minutes">
                                OTP Validity
                            </label>

                            <div class="settings-input-with-unit">

                                <input
                                    type="number"
                                    id="otp_expiry_minutes"
                                    name="otp_expiry_minutes"
                                    value="<?= $otpExpiryMinutes ?>"
                                    min="1"
                                    max="30"
                                >

                                <span>
                                    minutes
                                </span>

                            </div>

                            <small>
                                How long a generated OTP remains valid.
                            </small>

                        </div>


                        <!-- OTP Attempts -->

                        <div class="settings-field">

                            <label for="otp_max_attempts">
                                Maximum OTP Attempts
                            </label>

                            <input
                                type="number"
                                id="otp_max_attempts"
                                name="otp_max_attempts"
                                value="<?= $otpMaxAttempts ?>"
                                min="1"
                                max="10"
                            >

                            <small>
                                Maximum incorrect OTP attempts allowed.
                            </small>

                        </div>


                        <!-- Session Timeout -->

                        <div class="settings-field">

                            <label for="session_timeout_minutes">
                                Session Timeout
                            </label>

                            <div class="settings-input-with-unit">

                                <input
                                    type="number"
                                    id="session_timeout_minutes"
                                    name="session_timeout_minutes"
                                    value="<?= $sessionTimeoutMinutes ?>"
                                    min="5"
                                    max="1440"
                                >

                                <span>
                                    minutes
                                </span>

                            </div>

                            <small>
                                Automatically log out inactive users.
                            </small>

                        </div>

                    </div>

                </div>

            </section>


            <!-- ========================================================
                 ACTIONS
            ========================================================= -->

            <!-- SCHOOL INFORMATION -->
            <section class="settings-card">
                <div class="settings-card-header">
                    <div>
                        <h2>School Information</h2>
                        <p>Manage the school identity and contact address shown in records and reports.</p>
                    </div>
                </div>
                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="academic_year">Academic Year</label>
                        <input type="text" id="academic_year" name="academic_year" value="<?= htmlspecialchars($academicYear, ENT_QUOTES, 'UTF-8') ?>" placeholder="2026-2027">
                        <small>Academic year used in reports and school records.</small>
                    </div>
                    <div class="settings-field">
                        <label for="school_code">School Code</label>
                        <input type="text" id="school_code" name="school_code" value="<?= htmlspecialchars($schoolCode, ENT_QUOTES, 'UTF-8') ?>" placeholder="SCH-MUM-001">
                        <small>Unique internal school reference code.</small>
                    </div>
                    <div class="settings-field">
                        <label for="school_address">School Address</label>
                        <input type="text" id="school_address" name="school_address" value="<?= htmlspecialchars($schoolAddress, ENT_QUOTES, 'UTF-8') ?>" placeholder="Building, street, area">
                    </div>
                    <div class="settings-field">
                        <label for="school_city">City</label>
                        <input type="text" id="school_city" name="school_city" value="<?= htmlspecialchars($schoolCity, ENT_QUOTES, 'UTF-8') ?>" placeholder="Mumbai">
                    </div>
                    <div class="settings-field">
                        <label for="school_state">State</label>
                        <input type="text" id="school_state" name="school_state" value="<?= htmlspecialchars($schoolState, ENT_QUOTES, 'UTF-8') ?>" placeholder="Maharashtra">
                    </div>
                    <div class="settings-field">
                        <label for="school_pincode">PIN Code</label>
                        <input type="text" id="school_pincode" name="school_pincode" value="<?= htmlspecialchars($schoolPincode, ENT_QUOTES, 'UTF-8') ?>" inputmode="numeric" maxlength="10" placeholder="400001">
                    </div>
                </div>
            </section>

            <!-- EMAIL CONFIGURATION -->
            <section class="settings-card">
                <div class="settings-card-header">
                    <div>
                        <h2>Email Configuration</h2>
                        <p>Configure the outgoing mail server for school notifications and system emails.</p>
                    </div>
                </div>
                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="smtp_host">SMTP Host</label>
                        <input type="text" id="smtp_host" name="smtp_host" value="<?= htmlspecialchars($smtpHost, ENT_QUOTES, 'UTF-8') ?>" placeholder="smtp.example.com" autocomplete="off">
                    </div>
                    <div class="settings-field">
                        <label for="smtp_port">SMTP Port</label>
                        <input type="number" id="smtp_port" name="smtp_port" value="<?= $smtpPort ?>" min="1" max="65535" placeholder="587">
                    </div>
                    <div class="settings-field">
                        <label for="smtp_username">SMTP Username</label>
                        <input type="text" id="smtp_username" name="smtp_username" value="<?= htmlspecialchars($smtpUsername, ENT_QUOTES, 'UTF-8') ?>" placeholder="mailbox@example.com" autocomplete="off">
                    </div>
                    <div class="settings-field">
                        <label for="smtp_from_email">Sender Email</label>
                        <input type="email" id="smtp_from_email" name="smtp_from_email" value="<?= htmlspecialchars($smtpFromEmail, ENT_QUOTES, 'UTF-8') ?>" placeholder="noreply@example.com">
                    </div>
                    <div class="settings-field">
                        <label for="smtp_from_name">Sender Name</label>
                        <input type="text" id="smtp_from_name" name="smtp_from_name" value="<?= htmlspecialchars($smtpFromName, ENT_QUOTES, 'UTF-8') ?>" placeholder="My School">
                        <small>Name recipients see on system emails.</small>
                    </div>
                </div>
                <p class="settings-note"><strong>Security note:</strong> SMTP passwords should be stored securely on the server, not exposed in page HTML. We can add encrypted credential handling in the backend step.</p>
            </section>

            <!-- NOTIFICATIONS -->
            <section class="settings-card">
                <div class="settings-card-header">
                    <div>
                        <h2>Notifications & Preferences</h2>
                        <p>Choose which platform notifications should be enabled.</p>
                    </div>
                </div>
                <div class="settings-security-list">
                    <div class="settings-security-row">
                        <div class="settings-security-info"><strong>Email Notifications</strong><span>Send email updates for important school events.</span></div>
                        <label class="settings-toggle"><input type="checkbox" name="email_notifications" value="1" <?= $emailNotifications ? 'checked' : '' ?>><span class="settings-toggle-slider"></span></label>
                    </div>
                    <div class="settings-security-row">
                        <div class="settings-security-info"><strong>SMS Notifications</strong><span>Allow SMS alerts when an SMS provider is configured.</span></div>
                        <label class="settings-toggle"><input type="checkbox" name="sms_notifications" value="1" <?= $smsNotifications ? 'checked' : '' ?>><span class="settings-toggle-slider"></span></label>
                    </div>
                    <div class="settings-security-row">
                        <div class="settings-security-info"><strong>System Announcements</strong><span>Display important platform-wide announcements.</span></div>
                        <label class="settings-toggle"><input type="checkbox" name="system_announcements" value="1" <?= $systemAnnouncements ? 'checked' : '' ?>><span class="settings-toggle-slider"></span></label>
                    </div>
                    <div class="settings-security-row">
                        <div class="settings-security-info"><strong>Login Email Alerts</strong><span>Send an alert when a new login is detected.</span></div>
                        <label class="settings-toggle"><input type="checkbox" name="login_email_alerts" value="1" <?= $loginEmailAlerts ? 'checked' : '' ?>><span class="settings-toggle-slider"></span></label>
                    </div>
                </div>
            </section>

            <!-- APPEARANCE AND PLATFORM -->
            <section class="settings-card">
                <div class="settings-card-header">
                    <div>
                        <h2>Appearance & Platform</h2>
                        <p>Set the default interface language and maintenance preference.</p>
                    </div>
                </div>
                <div class="settings-grid">
                    <div class="settings-field">
                        <label for="default_language">Default Language</label>
                        <select id="default_language" name="default_language">
                            <option value="en" <?= $defaultLanguage === 'en' ? 'selected' : '' ?>>English</option>
                            <option value="hi" <?= $defaultLanguage === 'hi' ? 'selected' : '' ?>>Hindi</option>
                            <option value="mr" <?= $defaultLanguage === 'mr' ? 'selected' : '' ?>>Marathi</option>
                        </select>
                        <small>Language preference for the platform interface (requires translation support).</small>
                    </div>
                    <div class="settings-field">
                        <label for="theme_preference">Default Theme</label>
                        <select id="theme_preference" name="theme_preference">
                            <option value="light" <?= $themePreference === 'light' ? 'selected' : '' ?>>Light</option>
                            <option value="dark" <?= $themePreference === 'dark' ? 'selected' : '' ?>>Dark</option>
                            <option value="system" <?= $themePreference === 'system' ? 'selected' : '' ?>>Use device preference</option>
                        </select>
                        <small>Theme selection takes effect once theme switching is wired up.</small>
                    </div>
                </div>
                <div class="settings-security-list settings-platform-switch">
                    <div class="settings-security-row">
                        <div class="settings-security-info"><strong>Maintenance Mode</strong><span>Planned: restrict normal platform access during maintenance. Add an admin bypass before enabling in production.</span></div>
                        <label class="settings-toggle"><input type="checkbox" name="maintenance_mode" value="1" <?= $maintenanceMode ? 'checked' : '' ?>><span class="settings-toggle-slider"></span></label>
                    </div>
                </div>
            </section>

            <!-- BACKUP / AUDIT ROADMAP -->
            <section class="settings-card settings-roadmap-card">
                <div class="settings-card-header">
                    <div>
                        <h2>Backup & System Activity</h2>
                        <p>Recommended administration tools for the next implementation phase.</p>
                    </div>
                </div>
                <div class="settings-feature-grid">
                    <div class="settings-feature-item"><span class="settings-feature-icon">↻</span><div><strong>Database Backup</strong><p>Schedule backups, download a protected export, and track the last successful backup.</p><span class="settings-feature-status">Backend feature to implement</span></div></div>
                    <div class="settings-feature-item"><span class="settings-feature-icon">▤</span><div><strong>Audit Log</strong><p>Track who changed settings and when, including security-related updates.</p><span class="settings-feature-status">Backend feature to implement</span></div></div>
                    <div class="settings-feature-item"><span class="settings-feature-icon">♙</span><div><strong>Roles & Permissions</strong><p>Manage which roles can view or change sensitive settings.</p><span class="settings-feature-status">Permission checks required</span></div></div>
                </div>
            </section>

            <div class="settings-actions">
                <button type="reset" class="settings-reset-btn">Reset Form</button>
                <button type="submit" class="settings-save-btn">
                    <span aria-hidden="true">✓</span> Save Settings
                </button>
            </div>

        </form>

    </div>

</div>


<?php
require "../private/views/includes/footer.view.php";
?>


<!-- Navbar JS -->

<script
    src="<?= ROOT ?>/js/nav.js?v=1"
></script>


<!-- Sidebar JS -->

<script
    src="<?= ROOT ?>/js/sidebar.js?v=1"
></script>

</body>

</html>