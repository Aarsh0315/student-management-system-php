<?php

/*
========================================
SECURE SESSION CONFIGURATION
========================================
*/

if (session_status() === PHP_SESSION_NONE) {

    $isHttps = (
        isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS'] !== 'off'
    );

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}


/*
========================================
LOAD APPLICATION
========================================
*/

require "../private/core/autoload.php";


/*
========================================
START APPLICATION
========================================
*/

$control = new App();