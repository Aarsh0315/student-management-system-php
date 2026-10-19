
<?php

/*
|--------------------------------------------------------------------------
| SYSTEM SETTINGS
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/../../models/SettingsModel.php';

$settingsModel = new SettingsModel();

$systemName =
    $settingsModel->get('system_name')
    ?: 'My School';

$supportEmail =
    $settingsModel->get('support_email')
    ?: '';

$supportPhone =
    $settingsModel->get('support_phone')
    ?: '';
?>

<footer class="footer dashboard-footer">

    <div class="footer-content">

        <div class="footer-brand">
            <span class="footer-brand-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M3 10 12 4l9 6"/>
                    <path d="M5 10v9h14v-9"/>
                    <path d="M9 19v-6h6v6"/>
                    <path d="M2 21h20"/>
                </svg>
            </span>

            <div class="footer-brand-text">
                <strong><?= htmlspecialchars($systemName) ?></strong>
                <span>School Management System</span>
            </div>
        </div>

        <div class="footer-links">

            <a href="<?= ROOT ?>/about">About</a>

            <a href="<?= ROOT ?>/contact">Contact</a>

            <?php if ($supportEmail !== ''): ?>
                <a href="mailto:<?= htmlspecialchars($supportEmail, ENT_QUOTES, 'UTF-8') ?>">
                    Email Support
                </a>
            <?php endif; ?>

            <?php if ($supportPhone !== ''): ?>
                <a href="tel:<?= htmlspecialchars($supportPhone, ENT_QUOTES, 'UTF-8') ?>">
                    Call Support
                </a>
            <?php endif; ?>

            <a href="<?= ROOT ?>/privacy">Privacy</a>

            <a href="<?= ROOT ?>/terms">Terms</a>

        </div>


    </div>

</footer>
