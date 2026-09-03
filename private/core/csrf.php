<?php

class CSRF
{
    /*
    ========================================
    GET CSRF TOKEN
    ========================================
    */

    public static function token()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {

            $_SESSION['csrf_token'] =
                bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }


    /*
    ========================================
    VERIFY CSRF TOKEN
    ========================================
    */

    public static function verify($token)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            empty($token) ||
            empty($_SESSION['csrf_token'])
        ) {
            return false;
        }

        return hash_equals(
            $_SESSION['csrf_token'],
            $token
        );
    }


    /*
    ========================================
    FORM INPUT
    ========================================
    */

    public static function field()
    {
        $token = self::token();

        return '
            <input
                type="hidden"
                name="csrf_token"
                value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '"
            >
        ';
    }
}