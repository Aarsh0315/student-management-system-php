<?php

class AnnouncementModel extends Model
{
    /* =====================================================
       GET ALL ANNOUNCEMENTS
    ===================================================== */

    public function getAllAnnouncements($school_id = null)
    {
        $query = "
            SELECT
                a.announcement_id,
                a.school_id,
                a.title,
                a.description,
                a.announcement_date,
                a.status,
                a.created_by,
                a.created_at,
                a.updated_at,

                s.school_name,

                u.firstname,
                u.lastname

            FROM announcements a

            INNER JOIN schools s
                ON a.school_id = s.id

            LEFT JOIN users u
                ON a.created_by = u.user_id
        ";

        $params = [];

        if ($school_id !== null) {
            $query .= "
                WHERE a.school_id = :school_id
            ";

            $params['school_id'] = $school_id;
        }

        $query .= "
            ORDER BY
                a.announcement_date DESC,
                a.created_at DESC
        ";

        return $this->query($query, $params);
    }


    /* =====================================================
       GET ANNOUNCEMENT BY ID
    ===================================================== */

    public function getAnnouncementById(
        $announcement_id,
        $school_id = null
    ) {
        $query = "
            SELECT
                a.announcement_id,
                a.school_id,
                a.title,
                a.description,
                a.announcement_date,
                a.status,
                a.created_by,
                a.created_at,
                a.updated_at,

                s.school_name,

                u.firstname,
                u.lastname

            FROM announcements a

            INNER JOIN schools s
                ON a.school_id = s.id

            LEFT JOIN users u
                ON a.created_by = u.user_id

            WHERE a.announcement_id = :announcement_id
        ";

        $params = [
            'announcement_id' => $announcement_id
        ];

        if ($school_id !== null) {
            $query .= "
                AND a.school_id = :school_id
            ";

            $params['school_id'] = $school_id;
        }

        $result = $this->query($query, $params);

        return $result[0] ?? null;
    }


    /* =====================================================
       CREATE ANNOUNCEMENT
    ===================================================== */

    public function createAnnouncement($data)
    {
        $query = "
            INSERT INTO announcements (
                school_id,
                title,
                description,
                announcement_date,
                status,
                created_by
            )
            VALUES (
                :school_id,
                :title,
                :description,
                :announcement_date,
                :status,
                :created_by
            )
        ";

        return $this->query($query, [
            'school_id' => $data['school_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'announcement_date' => $data['announcement_date'],
            'status' => $data['status'],
            'created_by' => $data['created_by']
        ]);
    }


    /* =====================================================
       UPDATE ANNOUNCEMENT
    ===================================================== */

    public function updateAnnouncement(
        $announcement_id,
        $school_id,
        $data
    ) {
        $query = "
            UPDATE announcements

            SET
                title = :title,
                description = :description,
                announcement_date = :announcement_date,
                status = :status

            WHERE announcement_id = :announcement_id
            AND school_id = :school_id
        ";

        return $this->query($query, [
            'title' => $data['title'],
            'description' => $data['description'],
            'announcement_date' => $data['announcement_date'],
            'status' => $data['status'],
            'announcement_id' => $announcement_id,
            'school_id' => $school_id
        ]);
    }


    /* =====================================================
       DELETE ANNOUNCEMENT
    ===================================================== */

    public function deleteAnnouncement(
        $announcement_id,
        $school_id
    ) {
        $query = "
            DELETE FROM announcements

            WHERE announcement_id = :announcement_id
            AND school_id = :school_id
        ";

        return $this->query($query, [
            'announcement_id' => $announcement_id,
            'school_id' => $school_id
        ]);
    }


    /* =====================================================
       GET RECENT ANNOUNCEMENTS
    ===================================================== */

    public function getRecentAnnouncements(
        $school_id,
        $limit = 5
    ) {
        $limit = (int) $limit;

        $query = "
            SELECT
                announcement_id,
                title,
                description,
                announcement_date,
                status,
                created_at

            FROM announcements

            WHERE school_id = :school_id
            AND status = 'active'

            ORDER BY
                announcement_date DESC,
                created_at DESC

            LIMIT $limit
        ";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }
}