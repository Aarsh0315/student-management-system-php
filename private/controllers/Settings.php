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

        $settings = [
            'system_name'   => trim($_POST['system_name'] ?? ''),
            'support_email' => trim($_POST['support_email'] ?? ''),
            'support_phone' => trim($_POST['support_phone'] ?? ''),
            'website_url'   => trim($_POST['website_url'] ?? ''),
            'timezone'      => trim($_POST['timezone'] ?? 'Asia/Kolkata'),
            'date_format'   => trim($_POST['date_format'] ?? 'd M Y'),
            'time_format'   => trim($_POST['time_format'] ?? 'h:i A'),
        ];

        // Basic validation
        if ($settings['system_name'] === '') {
            $_SESSION['settings_error'] = 'System name is required.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $settings['support_email'] !== '' &&
            !filter_var($settings['support_email'], FILTER_VALIDATE_EMAIL)
        ) {
            $_SESSION['settings_error'] = 'Please enter a valid support email.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        if (
            $settings['website_url'] !== '' &&
            !filter_var($settings['website_url'], FILTER_VALIDATE_URL)
        ) {
            $_SESSION['settings_error'] = 'Please enter a valid website URL.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        $allowedTimezones = [
            'Asia/Kolkata',
            'UTC',
            'Asia/Dubai',
            'Asia/Singapore'
        ];

        if (!in_array($settings['timezone'], $allowedTimezones, true)) {
            $_SESSION['settings_error'] = 'Invalid timezone selected.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        $allowedDateFormats = [
            'd M Y',
            'd/m/Y',
            'm/d/Y',
            'Y-m-d'
        ];

        if (!in_array($settings['date_format'], $allowedDateFormats, true)) {
            $_SESSION['settings_error'] = 'Invalid date format selected.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        $allowedTimeFormats = [
            'h:i A',
            'H:i'
        ];

        if (!in_array($settings['time_format'], $allowedTimeFormats, true)) {
            $_SESSION['settings_error'] = 'Invalid time format selected.';
            header('Location: ' . ROOT . '/settings');
            exit;
        }

        // Save settings
        $settingsModel->setMultiple($settings);

        $_SESSION['settings_success'] = 'Settings saved successfully.';

        header('Location: ' . ROOT . '/settings');
        exit;
    }
}