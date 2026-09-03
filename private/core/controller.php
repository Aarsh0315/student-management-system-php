<?php

class Controller
{
    /*
    ========================================
    REQUIRE LOGIN
    ========================================
    */
protected function requireLogin()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    ========================================
    CHECK LOGIN
    ========================================
    */

    if (empty($_SESSION['user_id'])) {

        header("Location: " . ROOT . "/login");
        exit;
    }


    /*
    ========================================
    SESSION TIMEOUT
    1 HOUR OF INACTIVITY
    ========================================
    */

    $sessionTimeout = 3600;

    if (
        isset($_SESSION['last_activity']) &&
        (time() - $_SESSION['last_activity']) > $sessionTimeout
    ) {

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

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

        session_destroy();

        header(
            "Location: " . ROOT . "/login"
        );

        exit;
    }


    /*
    ========================================
    UPDATE LAST ACTIVITY
    ========================================
    */

    $_SESSION['last_activity'] = time();
}


    /*
    ========================================
    REQUIRE SPECIFIC ROLE
    ========================================
    */

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


    /*
    ========================================
    REQUIRE ONE OF MULTIPLE ROLES
    ========================================
    */

    protected function requireRoles(array $roles)
    {
        $this->requireLogin();

        $currentRole = $_SESSION['rank'] ?? '';

        if (!in_array($currentRole, $roles, true)) {

            header("Location: " . ROOT . "/home");
            exit;
        }
    }


    /*
    ========================================
    VIEW
    ========================================
    */

    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        require "../private/views/" . $name . ".view.php";
    }


    /*
    ========================================
    MODEL
    ========================================
    */

    public function model($name)
    {
        require_once "../private/models/" . $name . ".php";

        return new $name();
    }
}