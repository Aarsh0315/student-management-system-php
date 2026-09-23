<?php

class Controller
{
    protected function requireLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*
|--------------------------------------------------------------------------
| APPLICATION TIMEZONE
|--------------------------------------------------------------------------
*/

try {

    $settingsModel =
        $this->model('SettingsModel');

    $settings =
        $settingsModel->getAllAsArray();

    $timezone =
        $settings['timezone']
        ?? 'Asia/Kolkata';

    date_default_timezone_set($timezone);

} catch (Throwable $e) {

    date_default_timezone_set('Asia/Kolkata');
}

        /*
        |--------------------------------------------------------------------------
        | CHECK LOGIN
        |--------------------------------------------------------------------------
        */

        if (empty($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD SESSION TIMEOUT FROM SETTINGS
        |--------------------------------------------------------------------------
        */

        $sessionTimeoutMinutes = 60;

        try {
            $settingsModel = $this->model('SettingsModel');

            $settings = $settingsModel->getAllAsArray();

            $sessionTimeoutMinutes =
                (int) (
                    $settings['session_timeout_minutes']
                    ?? 60
                );

        } catch (Throwable $e) {

            // Fall back to 60 minutes if settings cannot be loaded.
            $sessionTimeoutMinutes = 60;
        }


        /*
        |--------------------------------------------------------------------------
        | CONVERT MINUTES TO SECONDS
        |--------------------------------------------------------------------------
        */

        $sessionTimeout =
            $sessionTimeoutMinutes * 60;


        /*
        |--------------------------------------------------------------------------
        | CHECK SESSION TIMEOUT
        |--------------------------------------------------------------------------
        */

        if (
            isset($_SESSION['last_activity']) &&
            (time() - $_SESSION['last_activity']) > $sessionTimeout
        ) {

            /*
            |--------------------------------------------------------------------------
            | CLEAR SESSION
            |--------------------------------------------------------------------------
            */

            $_SESSION = [];


            /*
            |--------------------------------------------------------------------------
            | DELETE SESSION COOKIE
            |--------------------------------------------------------------------------
            */

            if (ini_get('session.use_cookies')) {

                $params =
                    session_get_cookie_params();

                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }


            /*
            |--------------------------------------------------------------------------
            | DESTROY SESSION
            |--------------------------------------------------------------------------
            */

            session_destroy();


            /*
            |--------------------------------------------------------------------------
            | REDIRECT TO LOGIN
            |--------------------------------------------------------------------------
            */

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE LAST ACTIVITY
        |--------------------------------------------------------------------------
        */

        $_SESSION['last_activity'] = time();
    }


    protected function requireRole($role)
    {
        $this->requireLogin();

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== $role
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }
    }


    protected function requireRoles(array $roles)
    {
        $this->requireLogin();

        $currentRole =
            $_SESSION['rank'] ?? '';

        if (
            !in_array(
                $currentRole,
                $roles,
                true
            )
        ) {
            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }
    }


    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        require "../private/views/" .
                $name .
                ".view.php";
    }


    public function model($name)
    {
        $modelPath =
            dirname(__DIR__) .
            "/models/" .
            $name .
            ".php";


        if (!file_exists($modelPath)) {

            die(
                "Model file not found: " .
                $modelPath
            );
        }


        require_once $modelPath;


        return new $name();
    }


    protected function audit(
        $action,
        $description = '',
        $userId = null,
        $userName = null,
        $userRole = null
    ) {
        try {

            $audit =
                $this->model('AuditLog');


            return $audit->create(
                $action,
                $description,
                $userId,
                $userName,
                $userRole
            );

        } catch (Throwable $e) {

            return false;
        }
    }
}