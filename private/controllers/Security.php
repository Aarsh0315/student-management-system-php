<?php

class Security extends Controller
{
    public function index()
    {
        $this->requireRole('super_admin');

        /*
        |--------------------------------------------------------------------------
        | MODELS
        |--------------------------------------------------------------------------
        */

        $settingsModel = $this->model('SettingsModel');
        $auditModel = $this->model('AuditLog');


        /*
        |--------------------------------------------------------------------------
        | SECURITY SETTINGS
        |--------------------------------------------------------------------------
        */

        $settings = $settingsModel->getAllAsArray();

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
        | RECENT SECURITY ACTIVITY
        |--------------------------------------------------------------------------
        */

        $recentSecurityLogs = $auditModel->getLogs(
            '',
            '',
            'LOGIN_FAILED',
            5,
            0
        );

        $recentLoginSuccess = $auditModel->getLogs(
            '',
            '',
            'LOGIN_SUCCESS',
            5,
            0
        );

        $recentTwoFactor = $auditModel->getLogs(
            '',
            '',
            'LOGIN_2FA_SUCCESS',
            5,
            0
        );


        /*
        |--------------------------------------------------------------------------
        | COMBINE SECURITY ACTIVITY
        |--------------------------------------------------------------------------
        */

        $securityActivity = array_merge(
            $recentSecurityLogs,
            $recentLoginSuccess,
            $recentTwoFactor
        );

        usort(
            $securityActivity,
            function ($a, $b) {
                return strtotime($b->created_at)
                    <=> strtotime($a->created_at);
            }
        );

        $securityActivity = array_slice(
            $securityActivity,
            0,
            10
        );


        /*
        |--------------------------------------------------------------------------
        | SECURITY STATUS
        |--------------------------------------------------------------------------
        */

        $securityStatus = 'Protected';

        $securityChecks = [
            $loginProtection,
            $captchaProtection,
            $superAdminOtp,
            $sessionTimeoutMinutes > 0
        ];

        if (in_array(false, $securityChecks, true)) {
            $securityStatus = 'Attention Required';
        }


        /*
        |--------------------------------------------------------------------------
        | SECURITY RECOMMENDATIONS
        |--------------------------------------------------------------------------
        */

        $recommendations = [];

        if (!$loginProtection) {
            $recommendations[] =
                'Enable login protection to reduce brute-force attacks.';
        }

        if (!$captchaProtection) {
            $recommendations[] =
                'Enable CAPTCHA protection after failed login attempts.';
        }

        if (!$superAdminOtp) {
            $recommendations[] =
                'Enable OTP verification for Super Admin accounts.';
        }

        if ($sessionTimeoutMinutes <= 0) {
            $recommendations[] =
                'Configure a session timeout for inactive users.';
        }

        if (empty($recommendations)) {
            $recommendations[] =
                'Your current security protections are active.';
        }


        /*
        |--------------------------------------------------------------------------
        | PAGE DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'securityStatus' =>
                $securityStatus,

            'loginProtection' =>
                $loginProtection,

            'captchaProtection' =>
                $captchaProtection,

            'superAdminOtp' =>
                $superAdminOtp,

            'failedLoginLimit' =>
                $failedLoginLimit,

            'lockoutMinutes' =>
                $lockoutMinutes,

            'otpExpiryMinutes' =>
                $otpExpiryMinutes,

            'otpMaxAttempts' =>
                $otpMaxAttempts,

            'sessionTimeoutMinutes' =>
                $sessionTimeoutMinutes,

            'securityActivity' =>
                $securityActivity,

            'recommendations' =>
                $recommendations
        ];


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        $this->view(
            'security',
            $data
        );
    }
}