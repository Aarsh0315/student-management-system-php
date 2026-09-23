<?php

class Settings extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Super Admin only
        if (
            !isset($_SESSION['user_id']) ||
            ($_SESSION['rank'] ?? '') !== 'super_admin'
        ) {
            header('Location: ' . ROOT . '/login');
            exit;
        }

        $settingsModel = $this->model('SettingsModel');

        $settings = $settingsModel->getAllAsArray();

        $data = [
            'settings' => $settings
        ];

        $this->view('settings/index', $data);
    }


    public function save()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Super Admin only
        if (
            !isset($_SESSION['user_id']) ||
            ($_SESSION['rank'] ?? '') !== 'super_admin'
        ) {
            header('Location: ' . ROOT . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        $settingsModel = $this->model('SettingsModel');

        /*
        |--------------------------------------------------------------------------
        | GENERAL SETTINGS
        |--------------------------------------------------------------------------
        */

        $settings = [
            'system_name'   => trim($_POST['system_name'] ?? ''),
            'support_email' => trim($_POST['support_email'] ?? ''),
            'support_phone' => trim($_POST['support_phone'] ?? ''),
            'website_url'   => trim($_POST['website_url'] ?? ''),
            'timezone'      => trim($_POST['timezone'] ?? 'Asia/Kolkata'),
            'date_format'   => trim($_POST['date_format'] ?? 'd M Y'),
            'time_format'   => trim($_POST['time_format'] ?? 'h:i A'),
        ];


        /*
        |--------------------------------------------------------------------------
        | GENERAL SETTINGS VALIDATION
        |--------------------------------------------------------------------------
        */

        if ($settings['system_name'] === '') {
            $_SESSION['settings_error'] = 'System name is required.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $settings['support_email'] !== '' &&
            !filter_var(
                $settings['support_email'],
                FILTER_VALIDATE_EMAIL
            )
        ) {
            $_SESSION['settings_error'] =
                'Please enter a valid support email.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $settings['website_url'] !== '' &&
            !filter_var(
                $settings['website_url'],
                FILTER_VALIDATE_URL
            )
        ) {
            $_SESSION['settings_error'] =
                'Please enter a valid website URL.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | TIMEZONE VALIDATION
        |--------------------------------------------------------------------------
        */

        $allowedTimezones = [
            'Asia/Kolkata',
            'UTC',
            'Asia/Dubai',
            'Asia/Singapore'
        ];

        if (
            !in_array(
                $settings['timezone'],
                $allowedTimezones,
                true
            )
        ) {
            $_SESSION['settings_error'] =
                'Invalid timezone selected.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | DATE FORMAT VALIDATION
        |--------------------------------------------------------------------------
        */

        $allowedDateFormats = [
            'd M Y',
            'd/m/Y',
            'm/d/Y',
            'Y-m-d'
        ];

        if (
            !in_array(
                $settings['date_format'],
                $allowedDateFormats,
                true
            )
        ) {
            $_SESSION['settings_error'] =
                'Invalid date format selected.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | TIME FORMAT VALIDATION
        |--------------------------------------------------------------------------
        */

        $allowedTimeFormats = [
            'h:i A',
            'H:i'
        ];

        if (
            !in_array(
                $settings['time_format'],
                $allowedTimeFormats,
                true
            )
        ) {
            $_SESSION['settings_error'] =
                'Invalid time format selected.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | SECURITY SETTINGS
        |--------------------------------------------------------------------------
        */

        $securitySettings = [

            'login_protection' =>
                isset($_POST['login_protection']) ? '1' : '0',

            'captcha_protection' =>
                isset($_POST['captcha_protection']) ? '1' : '0',

            'super_admin_otp' =>
                isset($_POST['super_admin_otp']) ? '1' : '0',

            'failed_login_limit' =>
                (int) ($_POST['failed_login_limit'] ?? 5),

            'lockout_minutes' =>
                (int) ($_POST['lockout_minutes'] ?? 15),

            'otp_expiry_minutes' =>
                (int) ($_POST['otp_expiry_minutes'] ?? 5),

            'otp_max_attempts' =>
                (int) ($_POST['otp_max_attempts'] ?? 5),

            'session_timeout_minutes' =>
                (int) ($_POST['session_timeout_minutes'] ?? 60),
        ];


        /*
        |--------------------------------------------------------------------------
        | SECURITY SETTINGS VALIDATION
        |--------------------------------------------------------------------------
        */

        if (
            $securitySettings['failed_login_limit'] < 1 ||
            $securitySettings['failed_login_limit'] > 20
        ) {
            $_SESSION['settings_error'] =
                'Failed login limit must be between 1 and 20.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $securitySettings['lockout_minutes'] < 1 ||
            $securitySettings['lockout_minutes'] > 1440
        ) {
            $_SESSION['settings_error'] =
                'Lockout duration must be between 1 and 1440 minutes.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $securitySettings['otp_expiry_minutes'] < 1 ||
            $securitySettings['otp_expiry_minutes'] > 30
        ) {
            $_SESSION['settings_error'] =
                'OTP expiry must be between 1 and 30 minutes.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $securitySettings['otp_max_attempts'] < 1 ||
            $securitySettings['otp_max_attempts'] > 10
        ) {
            $_SESSION['settings_error'] =
                'OTP attempts must be between 1 and 10.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $securitySettings['session_timeout_minutes'] < 5 ||
            $securitySettings['session_timeout_minutes'] > 1440
        ) {
            $_SESSION['settings_error'] =
                'Session timeout must be between 5 and 1440 minutes.';

            header('Location: ' . ROOT . '/settings');
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE GENERAL SETTINGS
        |--------------------------------------------------------------------------
        */

        $settingsModel->setMultiple($settings);


        /*
        |--------------------------------------------------------------------------
        | SAVE SECURITY SETTINGS
        |--------------------------------------------------------------------------
        */

        $settingsModel->setMultiple($securitySettings);

        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */

        $this->audit(
            'SETTINGS_UPDATED',
            'System and security settings were updated.'
        );


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        $_SESSION['settings_success'] =
            'Settings saved successfully.';

        header('Location: ' . ROOT . '/settings');
        exit;
    }
}