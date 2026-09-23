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

<footer class="footer">

    <div class="footer-content">

        <p>
            &copy; <?= date('Y') ?>
            <?= htmlspecialchars($systemName) ?>.
            All Rights Reserved.
        </p>

        <div class="footer-links">

            <a href="<?= ROOT ?>/about">
                About
            </a>

            <a href="<?= ROOT ?>/contact">
                Contact
            </a>

            <?php if ($supportEmail !== ''): ?>

                <a
                    href="mailto:<?= htmlspecialchars($supportEmail) ?>"
                >
                    Email Support
                </a>

            <?php endif; ?>


            <?php if ($supportPhone !== ''): ?>

                <a
                    href="tel:<?= htmlspecialchars($supportPhone) ?>"
                >
                    Call Support
                </a>

            <?php endif; ?>

            <a href="<?= ROOT ?>/privacy">
                Privacy
            </a>

            <a href="<?= ROOT ?>/terms">
                Terms
            </a>

        </div>

    </div>

</footer>