<?php

$notifications = $data['notifications'] ?? [];
$unreadCount   = (int)($data['unreadCount'] ?? 0);

?>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/nav.view.css?v=3"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/sidebar.view.css?v=3"
>

<link
    rel="stylesheet"
    href="<?= ROOT ?>/css/notifications.view.css?v=3"
>

<?php require "../private/views/includes/nav.view.php"; ?>

<?php require "../private/views/includes/sidebar.view.php"; ?>


<div class="notifications-page">

    <main class="notifications-container">

        <!-- PAGE HEADER -->
        <section class="notifications-header">

            <div class="notifications-heading">

                <span class="notifications-eyebrow">
                    ACCOUNT
                </span>

                <h1>
                    Notifications
                </h1>

                <p>
                    Stay updated with important activities and updates.
                </p>

            </div>


            <?php if ($unreadCount > 0): ?>

                <form
                    action="<?= ROOT ?>/notifications/readAll"
                    method="POST"
                    class="mark-all-form"
                >

                    <?= CSRF::field() ?>

                    <button
                        type="submit"
                        class="mark-all-btn"
                    >
                        Mark all as read
                    </button>

                </form>

            <?php endif; ?>

        </section>


        <!-- SUMMARY -->
        <section class="notifications-summary">

            <div class="summary-icon">
                NT
            </div>

            <div class="summary-content">

                <strong>
                    <?= $unreadCount ?>
                    <?= $unreadCount === 1 ? 'unread notification' : 'unread notifications' ?>
                </strong>

                <span>
                    <?= count($notifications) ?>
                    <?= count($notifications) === 1 ? 'notification' : 'notifications' ?>
                    in total
                </span>

            </div>

        </section>


        <!-- NOTIFICATIONS LIST -->
        <section class="notifications-card">

            <?php if (!empty($notifications)): ?>

                <?php foreach ($notifications as $notification): ?>

                    <?php

                    $isUnread = (int)($notification->is_read ?? 0) === 0;

                    $type = strtolower(
                        trim($notification->type ?? 'general')
                    );

                    $icon = 'NT';

                    if ($type === 'test') {
                        $icon = 'TS';
                    } elseif ($type === 'result') {
                        $icon = 'RS';
                    } elseif ($type === 'attendance') {
                        $icon = 'AT';
                    } elseif ($type === 'fee') {
                        $icon = 'FE';
                    } elseif ($type === 'notice') {
                        $icon = 'NO';
                    } elseif ($type === 'account') {
                        $icon = 'AC';
                    }

                    $createdAt = !empty($notification->created_at)
                        ? strtotime($notification->created_at)
                        : false;

                    ?>

                    <article
                        class="notification-item <?= $isUnread ? 'is-unread' : 'is-read' ?>"
                    >

                        <!-- ICON -->
                        <div class="notification-icon">
                            <?= htmlspecialchars($icon) ?>
                        </div>


                        <!-- CONTENT -->
                        <div class="notification-content">

                            <div class="notification-title-row">

                                <h2>
                                    <?= htmlspecialchars(
                                        $notification->title ?? 'Notification'
                                    ) ?>
                                </h2>

                                <?php if ($isUnread): ?>

                                    <span
                                        class="unread-dot"
                                        title="Unread notification"
                                    ></span>

                                <?php endif; ?>

                            </div>


                            <p class="notification-message">
                                <?= nl2br(
                                    htmlspecialchars(
                                        $notification->message ?? '',
                                        ENT_QUOTES,
                                        'UTF-8'
                                    )
                                ) ?>
                            </p>


                            <?php if ($createdAt): ?>

                                <time
                                    class="notification-time"
                                    datetime="<?= htmlspecialchars(
                                        $notification->created_at,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                >
                                    <?= htmlspecialchars(
                                        date('d M Y, h:i A', $createdAt)
                                    ) ?>
                                </time>

                            <?php endif; ?>

                        </div>


                        <!-- ACTION -->
                        <?php if ($isUnread): ?>

                            <form
                                action="<?= ROOT ?>/notifications/read/<?= urlencode($notification->notification_id) ?>"
                                method="POST"
                                class="notification-action-form"
                            >

                                <?= CSRF::field() ?>

                                <button
                                    type="submit"
                                    class="notification-action"
                                >
                                    Mark as read
                                </button>

                            </form>

                        <?php else: ?>

                            <span class="read-label">
                                Read
                            </span>

                        <?php endif; ?>

                    </article>

                <?php endforeach; ?>


            <?php else: ?>

                <!-- EMPTY STATE -->
                <div class="notifications-empty">

                    <div class="notifications-empty-icon">
                        NT
                    </div>

                    <h2>
                        No notifications
                    </h2>

                    <p>
                        You're all caught up. New notifications will appear here.
                    </p>

                </div>

            <?php endif; ?>

        </section>

    </main>

</div>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>
<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>