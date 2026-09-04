<?php

class NotificationModel extends Model
{
    protected $table = "notifications";


    /*
    =====================================================
    CREATE NOTIFICATION
    =====================================================
    */
    public function createNotification(
        $user_id,
        $school_id,
        $title,
        $message,
        $type = 'general',
        $reference_id = null
    ) {
        $query = "INSERT INTO notifications
                  (
                      user_id,
                      school_id,
                      title,
                      message,
                      type,
                      reference_id,
                      is_read
                  )
                  VALUES
                  (
                      :user_id,
                      :school_id,
                      :title,
                      :message,
                      :type,
                      :reference_id,
                      0
                  )";

        return $this->query($query, [
            'user_id'      => $user_id,
            'school_id'    => $school_id,
            'title'        => $title,
            'message'      => $message,
            'type'         => $type,
            'reference_id' => $reference_id
        ]);
    }


    /*
    =====================================================
    GET RECENT NOTIFICATIONS
    =====================================================
    */
    public function getNotifications($user_id, $school_id = null, $limit = 5)
    {
        $limit = (int)$limit;

        if ($school_id === null || $school_id === '') {

            $query = "SELECT
                        notification_id,
                        user_id,
                        school_id,
                        title,
                        message,
                        type,
                        reference_id,
                        is_read,
                        created_at
                      FROM notifications
                      WHERE user_id = :user_id
                      ORDER BY created_at DESC
                      LIMIT $limit";

            return $this->query($query, [
                'user_id' => $user_id
            ]);
        }

        $query = "SELECT
                    notification_id,
                    user_id,
                    school_id,
                    title,
                    message,
                    type,
                    reference_id,
                    is_read,
                    created_at
                  FROM notifications
                  WHERE user_id = :user_id
                  AND school_id = :school_id
                  ORDER BY created_at DESC
                  LIMIT $limit";

        return $this->query($query, [
            'user_id'   => $user_id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    GET UNREAD COUNT
    =====================================================
    */
    public function getUnreadCount($user_id, $school_id = null)
    {
        if ($school_id === null || $school_id === '') {

            $query = "SELECT COUNT(*) AS total
                      FROM notifications
                      WHERE user_id = :user_id
                      AND is_read = 0";

            $result = $this->query($query, [
                'user_id' => $user_id
            ]);

            return (int)($result[0]->total ?? 0);
        }

        $query = "SELECT COUNT(*) AS total
                  FROM notifications
                  WHERE user_id = :user_id
                  AND school_id = :school_id
                  AND is_read = 0";

        $result = $this->query($query, [
            'user_id'   => $user_id,
            'school_id' => $school_id
        ]);

        return (int)($result[0]->total ?? 0);
    }


    /*
    =====================================================
    GET ALL NOTIFICATIONS
    =====================================================
    */
    public function getAllNotifications($user_id, $school_id = null)
    {
        if ($school_id === null || $school_id === '') {

            $query = "SELECT
                        notification_id,
                        user_id,
                        school_id,
                        title,
                        message,
                        type,
                        reference_id,
                        is_read,
                        created_at
                      FROM notifications
                      WHERE user_id = :user_id
                      ORDER BY created_at DESC";

            return $this->query($query, [
                'user_id' => $user_id
            ]);
        }

        $query = "SELECT
                    notification_id,
                    user_id,
                    school_id,
                    title,
                    message,
                    type,
                    reference_id,
                    is_read,
                    created_at
                  FROM notifications
                  WHERE user_id = :user_id
                  AND school_id = :school_id
                  ORDER BY created_at DESC";

        return $this->query($query, [
            'user_id'   => $user_id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    MARK ONE NOTIFICATION AS READ
    =====================================================
    */
    public function markAsRead(
        $notification_id,
        $user_id,
        $school_id = null
    ) {
        if ($school_id === null || $school_id === '') {

            $query = "UPDATE notifications
                      SET is_read = 1
                      WHERE notification_id = :notification_id
                      AND user_id = :user_id
                      LIMIT 1";

            return $this->query($query, [
                'notification_id' => $notification_id,
                'user_id'         => $user_id
            ]);
        }

        $query = "UPDATE notifications
                  SET is_read = 1
                  WHERE notification_id = :notification_id
                  AND user_id = :user_id
                  AND school_id = :school_id
                  LIMIT 1";

        return $this->query($query, [
            'notification_id' => $notification_id,
            'user_id'         => $user_id,
            'school_id'       => $school_id
        ]);
    }


    /*
    =====================================================
    MARK ALL NOTIFICATIONS AS READ
    =====================================================
    */
    public function markAllAsRead($user_id, $school_id = null)
    {
        if ($school_id === null || $school_id === '') {

            $query = "UPDATE notifications
                      SET is_read = 1
                      WHERE user_id = :user_id
                      AND is_read = 0";

            return $this->query($query, [
                'user_id' => $user_id
            ]);
        }

        $query = "UPDATE notifications
                  SET is_read = 1
                  WHERE user_id = :user_id
                  AND school_id = :school_id
                  AND is_read = 0";

        return $this->query($query, [
            'user_id'   => $user_id,
            'school_id' => $school_id
        ]);
    }


    /*
    =====================================================
    GET SINGLE NOTIFICATION
    =====================================================
    */
    public function getNotificationById(
        $notification_id,
        $user_id,
        $school_id = null
    ) {
        if ($school_id === null || $school_id === '') {

            $query = "SELECT
                        notification_id,
                        user_id,
                        school_id,
                        title,
                        message,
                        type,
                        reference_id,
                        is_read,
                        created_at
                      FROM notifications
                      WHERE notification_id = :notification_id
                      AND user_id = :user_id
                      LIMIT 1";

            $result = $this->query($query, [
                'notification_id' => $notification_id,
                'user_id'         => $user_id
            ]);

            return $result[0] ?? false;
        }

        $query = "SELECT
                    notification_id,
                    user_id,
                    school_id,
                    title,
                    message,
                    type,
                    reference_id,
                    is_read,
                    created_at
                  FROM notifications
                  WHERE notification_id = :notification_id
                  AND user_id = :user_id
                  AND school_id = :school_id
                  LIMIT 1";

        $result = $this->query($query, [
            'notification_id' => $notification_id,
            'user_id'         => $user_id,
            'school_id'       => $school_id
        ]);

        return $result[0] ?? false;
    }
}