<?php

class Notifications extends Controller
{
    /*
    =====================================================
    NOTIFICATION LIST
    =====================================================
    */
    public function index()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: " . ROOT . "/login");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $school_id = $_SESSION['school_id'] ?? null;

    $notificationModel = $this->model('NotificationModel');

    $notifications = $notificationModel->getAllNotifications(
        $user_id,
        $school_id
    );

    $unreadCount = $notificationModel->getUnreadCount(
        $user_id,
        $school_id
    );

    $this->view('notifications', [
        'notifications' => $notifications,
        'unreadCount'   => $unreadCount
    ]);
}

    /*
    =====================================================
    MARK ONE AS READ
    =====================================================
    */
    public function read($notification_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token. Please refresh the page and try again.");
        }

        $notification_id = trim($notification_id ?? '');

        if ($notification_id === '') {
            header("Location: " . ROOT . "/notifications");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $school_id = $_SESSION['school_id'] ?? null;

        if (!$school_id) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $notificationModel = $this->model('NotificationModel');

        $notification = $notificationModel->getNotificationById(
            $notification_id,
            $user_id,
            $school_id
        );

        if (!$notification) {
            header("Location: " . ROOT . "/notifications");
            exit;
        }

        $notificationModel->markAsRead(
            $notification_id,
            $user_id,
            $school_id
        );

        /*
        =================================================
        OPTIONAL REFERENCE REDIRECT
        =================================================
        */

        $type = $notification->type ?? '';
        $reference_id = $notification->reference_id ?? '';

        if ($reference_id !== '') {

            if ($type === 'test') {
                header(
                    "Location: " . ROOT . "/studenttests"
                );
                exit;
            }

            if ($type === 'result') {
                header(
                    "Location: " . ROOT . "/studentresults"
                );
                exit;
            }
        }

        header("Location: " . ROOT . "/notifications");
        exit;
    }


    /*
    =====================================================
    MARK ALL AS READ
    =====================================================
    */
    public function readAll()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token. Please refresh the page and try again.");
        }

        $user_id = $_SESSION['user_id'];
        $school_id = $_SESSION['school_id'] ?? null;

        if (!$school_id) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $notificationModel = $this->model('NotificationModel');

        $notificationModel->markAllAsRead(
            $user_id,
            $school_id
        );

        header("Location: " . ROOT . "/notifications");
        exit;
    }
}