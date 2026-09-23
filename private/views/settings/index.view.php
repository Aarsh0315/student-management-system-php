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
        href="<?= ROOT ?>/css/settings.view.css?v=2"
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
                        <?= htmlspecialchars($successMessage) ?>
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
                        <?= htmlspecialchars($errorMessage) ?>
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

            <div class="settings-actions">

                <button
                    type="submit"
                    class="settings-save-btn"
                >
                    Save Changes
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