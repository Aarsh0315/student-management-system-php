<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$securityStatus =
    $data['securityStatus'] ?? 'Protected';

$loginProtection =
    $data['loginProtection'] ?? false;

$captchaProtection =
    $data['captchaProtection'] ?? false;

$superAdminOtp =
    $data['superAdminOtp'] ?? false;

$failedLoginLimit =
    $data['failedLoginLimit'] ?? 5;

$lockoutMinutes =
    $data['lockoutMinutes'] ?? 15;

$otpExpiryMinutes =
    $data['otpExpiryMinutes'] ?? 5;

$otpMaxAttempts =
    $data['otpMaxAttempts'] ?? 5;

$sessionTimeoutMinutes =
    $data['sessionTimeoutMinutes'] ?? 60;

$securityActivity =
    $data['securityActivity'] ?? [];

$recommendations =
    $data['recommendations'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Security | My School Management System</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=6"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=1"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=3"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/security.view.css?v=1"
    >

</head>

<body>

<?php
require "../private/views/includes/nav.view.php";
?>

<?php
require "../private/views/includes/sidebar.view.php";
?>

<main class="security-page">

    <!-- HEADER -->

    <section class="security-header">

        <div>

            <span class="security-eyebrow">
                SYSTEM SECURITY
            </span>

            <h1>
                Security Center
            </h1>

            <p>
                Monitor and review the security protections
                configured for your school management platform.
            </p>

        </div>

        <a
            href="<?= ROOT ?>/auditlogs"
            class="security-audit-btn"
        >
            View Audit Logs
        </a>

    </section>


    <!-- SECURITY STATUS -->

    <section class="security-status-card">

        <div class="security-status-icon">
            ✓
        </div>

        <div class="security-status-content">

            <span>
                SECURITY STATUS
            </span>

            <h2>
                <?= htmlspecialchars($securityStatus) ?>
            </h2>

            <p>
                Core authentication and session protections
                are currently active.
            </p>

        </div>

    </section>


    <!-- OVERVIEW -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    OVERVIEW
                </span>

                <h2>
                    Security Protection
                </h2>

            </div>

        </div>


        <div class="security-overview-grid">

            <!-- LOGIN -->

            <article class="security-card">

                <div class="security-card-top">

                    <div class="security-card-icon">
                        🔐
                    </div>

                    <span
                        class="security-badge
                        <?= $loginProtection
                            ? 'active'
                            : 'inactive' ?>"
                    >
                        <?= $loginProtection
                            ? 'Active'
                            : 'Inactive' ?>
                    </span>

                </div>

                <h3>
                    Login Protection
                </h3>

                <p>
                    Protects accounts against repeated
                    incorrect password attempts.
                </p>

            </article>


            <!-- CAPTCHA -->

            <article class="security-card">

                <div class="security-card-top">

                    <div class="security-card-icon">
                        🛡️
                    </div>

                    <span
                        class="security-badge
                        <?= $captchaProtection
                            ? 'active'
                            : 'inactive' ?>"
                    >
                        <?= $captchaProtection
                            ? 'Active'
                            : 'Inactive' ?>
                    </span>

                </div>

                <h3>
                    CAPTCHA Protection
                </h3>

                <p>
                    Adds an additional verification step
                    after failed login attempts.
                </p>

            </article>


            <!-- 2FA -->

            <article class="security-card">

                <div class="security-card-top">

                    <div class="security-card-icon">
                        🔑
                    </div>

                    <span
                        class="security-badge
                        <?= $superAdminOtp
                            ? 'active'
                            : 'inactive' ?>"
                    >
                        <?= $superAdminOtp
                            ? 'Active'
                            : 'Inactive' ?>
                    </span>

                </div>

                <h3>
                    Super Admin OTP
                </h3>

                <p>
                    Requires OTP verification before a
                    Super Admin session is created.
                </p>

            </article>


            <!-- SESSION -->

            <article class="security-card">

                <div class="security-card-top">

                    <div class="security-card-icon">
                        ⏱
                    </div>

                    <span class="security-badge active">
                        Active
                    </span>

                </div>

                <h3>
                    Session Security
                </h3>

                <p>
                    Automatically expires inactive sessions
                    after <?= (int) $sessionTimeoutMinutes ?>
                    minutes.
                </p>

            </article>

        </div>

    </section>


    <!-- LOGIN PROTECTION -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    AUTHENTICATION
                </span>

                <h2>
                    Login Protection
                </h2>

            </div>

        </div>


        <div class="security-details-card">

            <div class="security-detail-row">

                <div>
                    <strong>
                        Failed login threshold
                    </strong>

                    <p>
                        Number of failed attempts before
                        temporary account lockout.
                    </p>
                </div>

                <strong>
                    <?= (int) $failedLoginLimit ?>
                    attempts
                </strong>

            </div>


            <div class="security-detail-row">

                <div>
                    <strong>
                        Account lockout
                    </strong>

                    <p>
                        Temporary protection after the
                        failed-login threshold is reached.
                    </p>
                </div>

                <strong>
                    <?= (int) $lockoutMinutes ?>
                    minutes
                </strong>

            </div>


            <div class="security-detail-row">

                <div>
                    <strong>
                        CAPTCHA protection
                    </strong>

                    <p>
                        Additional verification after a
                        failed login attempt.
                    </p>
                </div>

                <span class="security-value-active">
                    Enabled
                </span>

            </div>

        </div>

    </section>


    <!-- SUPER ADMIN OTP -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    SUPER ADMIN
                </span>

                <h2>
                    Two-Factor Authentication
                </h2>

            </div>

        </div>


        <div class="security-details-card">

            <div class="security-detail-row">

                <div>

                    <strong>
                        OTP verification
                    </strong>

                    <p>
                        Email OTP is required for Super Admin
                        authentication.
                    </p>

                </div>

                <span class="security-value-active">
                    Enabled
                </span>

            </div>


            <div class="security-detail-row">

                <div>

                    <strong>
                        OTP validity
                    </strong>

                    <p>
                        Verification codes automatically expire
                        after the configured period.
                    </p>

                </div>

                <strong>
                    <?= (int) $otpExpiryMinutes ?>
                    minutes
                </strong>

            </div>


            <div class="security-detail-row">

                <div>

                    <strong>
                        Maximum OTP attempts
                    </strong>

                    <p>
                        Limits repeated incorrect verification
                        attempts.
                    </p>

                </div>

                <strong>
                    <?= (int) $otpMaxAttempts ?>
                    attempts
                </strong>

            </div>

        </div>

    </section>


    <!-- SESSION SECURITY -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    SESSION
                </span>

                <h2>
                    Session Security
                </h2>

            </div>

        </div>


        <div class="security-details-card">

            <div class="security-detail-row">

                <div>

                    <strong>
                        Session timeout
                    </strong>

                    <p>
                        Users are automatically logged out
                        after prolonged inactivity.
                    </p>

                </div>

                <strong>
                    <?= (int) $sessionTimeoutMinutes ?>
                    minutes
                </strong>

            </div>


            <div class="security-detail-row">

                <div>

                    <strong>
                        Session regeneration
                    </strong>

                    <p>
                        Session ID is regenerated during
                        authentication.
                    </p>

                </div>

                <span class="security-value-active">
                    Enabled
                </span>

            </div>


            <div class="security-detail-row">

                <div>

                    <strong>
                        Secure logout
                    </strong>

                    <p>
                        Authentication session data is cleared
                        during logout.
                    </p>

                </div>

                <span class="security-value-active">
                    Enabled
                </span>

            </div>

        </div>

    </section>


    <!-- SECURITY ACTIVITY -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    MONITORING
                </span>

                <h2>
                    Recent Security Activity
                </h2>

            </div>

            <a
                href="<?= ROOT ?>/auditlogs"
                class="section-link"
            >
                View All
            </a>

        </div>


        <div class="security-activity-card">

            <?php if (!empty($securityActivity)): ?>

                <?php foreach ($securityActivity as $activity): ?>

                    <?php

                    $action =
                        $activity->action ?? '';

                    $actionClass = 'neutral';

                    if ($action === 'LOGIN_FAILED') {
                        $actionClass = 'danger';
                    }

                    if (
                        $action === 'LOGIN_SUCCESS' ||
                        $action === 'LOGIN_2FA_SUCCESS'
                    ) {
                        $actionClass = 'success';
                    }

                    ?>

                    <div class="security-activity-row">

                        <div class="activity-action-icon
                            <?= $actionClass ?>">

                            <?php
                            if ($actionClass === 'danger') {
                                echo '!';
                            } elseif ($actionClass === 'success') {
                                echo '✓';
                            } else {
                                echo '•';
                            }
                            ?>

                        </div>

                        <div class="activity-main">

                            <strong>
                                <?= htmlspecialchars($action) ?>
                            </strong>

                            <p>
                                <?= htmlspecialchars(
                                    $activity->description ?? ''
                                ) ?>
                            </p>

                        </div>

                        <div class="activity-meta">

                            <span>
                                <?= htmlspecialchars(
                                    $activity->user_name
                                    ?? 'Unknown'
                                ) ?>
                            </span>

                            <small>
                                <?= htmlspecialchars(
                                    $activity->created_at
                                    ?? ''
                                ) ?>
                            </small>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="security-empty">

                    <div>
                        ✓
                    </div>

                    <strong>
                        No recent security events
                    </strong>

                    <p>
                        Security activity will appear here
                        when authentication events occur.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>


    <!-- RECOMMENDATIONS -->

    <section class="security-section">

        <div class="security-section-heading">

            <div>

                <span>
                    SECURITY HEALTH
                </span>

                <h2>
                    Security Recommendations
                </h2>

            </div>

        </div>


        <div class="security-recommendations">

            <?php foreach ($recommendations as $recommendation): ?>

                <div class="security-recommendation">

                    <span class="recommendation-icon">
                        ✓
                    </span>

                    <span>
                        <?= htmlspecialchars($recommendation) ?>
                    </span>

                </div>

            <?php endforeach; ?>

        </div>

    </section>


</main>


<?php
require "../private/views/includes/footer.view.php";
?>

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>

</body>

</html>