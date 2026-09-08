<?php

class EventModel extends Model
{
    public function getAllEvents($school_id)
    {
        $query = "
            SELECT
                e.event_id,
                e.school_id,
                e.title,
                e.description,
                e.event_date,
                e.start_time,
                e.end_time,
                e.location,
                e.status,
                e.created_by,
                e.created_at,
                u.firstname,
                u.lastname
            FROM events e
            LEFT JOIN users u
                ON e.created_by = u.user_id
            WHERE e.school_id = :school_id
            ORDER BY e.event_date ASC, e.start_time ASC
        ";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }

    public function getEventById($event_id, $school_id)
    {
        $query = "
            SELECT
                e.event_id,
                e.school_id,
                e.title,
                e.description,
                e.event_date,
                e.start_time,
                e.end_time,
                e.location,
                e.status,
                e.created_by,
                e.created_at,
                u.firstname,
                u.lastname
            FROM events e
            LEFT JOIN users u
                ON e.created_by = u.user_id
            WHERE e.event_id = :event_id
              AND e.school_id = :school_id
            LIMIT 1
        ";

        $result = $this->query($query, [
            'event_id' => $event_id,
            'school_id' => $school_id
        ]);

        return !empty($result) ? $result[0] : null;
    }

    public function createEvent($data)
    {
        $query = "
            INSERT INTO events
            (
                school_id,
                title,
                description,
                event_date,
                start_time,
                end_time,
                location,
                status,
                created_by
            )
            VALUES
            (
                :school_id,
                :title,
                :description,
                :event_date,
                :start_time,
                :end_time,
                :location,
                :status,
                :created_by
            )
        ";

        return $this->query($query, [
            'school_id'   => $data['school_id'],
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'event_date'  => $data['event_date'],
            'start_time'  => $data['start_time'] ?? null,
            'end_time'    => $data['end_time'] ?? null,
            'location'    => $data['location'] ?? null,
            'status'      => $data['status'] ?? 'active',
            'created_by'  => $data['created_by'] ?? null
        ]);
    }

    public function updateEvent($event_id, $school_id, $data)
    {
        $query = "
            UPDATE events
            SET
                title = :title,
                description = :description,
                event_date = :event_date,
                start_time = :start_time,
                end_time = :end_time,
                location = :location,
                status = :status
            WHERE event_id = :event_id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'event_id'    => $event_id,
            'school_id'   => $school_id,
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'event_date'  => $data['event_date'],
            'start_time'  => $data['start_time'] ?? null,
            'end_time'    => $data['end_time'] ?? null,
            'location'    => $data['location'] ?? null,
            'status'      => $data['status'] ?? 'active'
        ]);
    }

    public function deleteEvent($event_id, $school_id)
    {
        $query = "
            DELETE FROM events
            WHERE event_id = :event_id
              AND school_id = :school_id
        ";

        return $this->query($query, [
            'event_id'  => $event_id,
            'school_id' => $school_id
        ]);
    }

    public function getUpcomingEvents($school_id, $limit = 5)
    {
        $limit = (int) $limit;

        $query = "
            SELECT
                event_id,
                title,
                description,
                event_date,
                start_time,
                end_time,
                location,
                status
            FROM events
            WHERE school_id = :school_id
              AND status = 'active'
              AND event_date >= CURDATE()
            ORDER BY event_date ASC, start_time ASC
            LIMIT $limit
        ";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }
}