<?php

class TimetableModel extends Model
{
    /* =====================================================
       GET ALL TIMETABLE ENTRIES BY SCHOOL
    ===================================================== */

    public function getAllBySchool($school_id)
    {
        $query = "SELECT

                    t.id,
                    t.school_id,
                    t.class,
                    t.division,
                    t.day,
                    t.period,
                    t.subject_id,
                    t.teacher_id,
                    t.room,
                    t.status,
                    t.created_at,
                    t.updated_at,

                    sub.name AS subject_name,
                    sub.code AS subject_code,

                    st.user_id,

                    u.firstname,
                    u.lastname,
                    u.email

                  FROM timetable t

                  INNER JOIN subjects sub
                      ON t.subject_id = sub.id
                      AND sub.school_id = t.school_id

                  INNER JOIN staff st
                      ON t.teacher_id = st.staff_id
                      AND st.school_id = t.school_id

                  INNER JOIN users u
                      ON st.user_id = u.user_id

                  WHERE t.school_id = :school_id

                  ORDER BY
                      FIELD(
                          t.day,
                          'Monday',
                          'Tuesday',
                          'Wednesday',
                          'Thursday',
                          'Friday',
                          'Saturday',
                          'Sunday'
                      ),
                      t.period ASC,
                      t.class ASC,
                      t.division ASC";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }


    /* =====================================================
       GET TIMETABLE BY CLASS
    ===================================================== */

    public function getByClass(
        $school_id,
        $class,
        $division
    ) {
        $query = "SELECT

                    t.id,
                    t.school_id,
                    t.class,
                    t.division,
                    t.day,
                    t.period,
                    t.subject_id,
                    t.teacher_id,
                    t.room,
                    t.status,

                    sub.name AS subject_name,
                    sub.code AS subject_code,

                    st.user_id,

                    u.firstname,
                    u.lastname

                  FROM timetable t

                  INNER JOIN subjects sub
                      ON t.subject_id = sub.id
                      AND sub.school_id = t.school_id

                  INNER JOIN staff st
                      ON t.teacher_id = st.staff_id
                      AND st.school_id = t.school_id

                  INNER JOIN users u
                      ON st.user_id = u.user_id

                  WHERE t.school_id = :school_id
                  AND t.class = :class
                  AND t.division = :division

                  ORDER BY
                      FIELD(
                          t.day,
                          'Monday',
                          'Tuesday',
                          'Wednesday',
                          'Thursday',
                          'Friday',
                          'Saturday',
                          'Sunday'
                      ),
                      t.period ASC";

        return $this->query($query, [
            'school_id' => $school_id,
            'class'     => $class,
            'division'  => $division
        ]);
    }


    /* =====================================================
       GET TIMETABLE BY ID
    ===================================================== */

    public function getById($id, $school_id)
    {
        $query = "SELECT

                    t.id,
                    t.school_id,
                    t.class,
                    t.division,
                    t.day,
                    t.period,
                    t.subject_id,
                    t.teacher_id,
                    t.room,
                    t.status,
                    t.created_at,
                    t.updated_at,

                    sub.name AS subject_name,
                    sub.code AS subject_code,

                    st.user_id,

                    u.firstname,
                    u.lastname,
                    u.email

                  FROM timetable t

                  INNER JOIN subjects sub
                      ON t.subject_id = sub.id
                      AND sub.school_id = t.school_id

                  INNER JOIN staff st
                      ON t.teacher_id = st.staff_id
                      AND st.school_id = t.school_id

                  INNER JOIN users u
                      ON st.user_id = u.user_id

                  WHERE t.id = :id
                  AND t.school_id = :school_id

                  LIMIT 1";

        $result = $this->query($query, [
            'id'        => $id,
            'school_id' => $school_id
        ]);

        return $result[0] ?? false;
    }


    /* =====================================================
       CREATE TIMETABLE ENTRY
    ===================================================== */

    public function createEntry(
        $school_id,
        $class,
        $division,
        $day,
        $period,
        $subject_id,
        $teacher_id,
        $room = null
    ) {
        $query = "INSERT INTO timetable
                    (
                        school_id,
                        class,
                        division,
                        day,
                        period,
                        subject_id,
                        teacher_id,
                        room,
                        status
                    )

                  VALUES
                    (
                        :school_id,
                        :class,
                        :division,
                        :day,
                        :period,
                        :subject_id,
                        :teacher_id,
                        :room,
                        1
                    )";

        return $this->query($query, [
            'school_id'  => $school_id,
            'class'      => $class,
            'division'   => $division,
            'day'        => $day,
            'period'     => $period,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id,
            'room'       => $room
        ]);
    }


    /* =====================================================
       UPDATE TIMETABLE ENTRY
    ===================================================== */

    public function updateEntry(
        $id,
        $school_id,
        $class,
        $division,
        $day,
        $period,
        $subject_id,
        $teacher_id,
        $room = null
    ) {
        $query = "UPDATE timetable

                  SET
                      class = :class,
                      division = :division,
                      day = :day,
                      period = :period,
                      subject_id = :subject_id,
                      teacher_id = :teacher_id,
                      room = :room

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id'         => $id,
            'school_id'  => $school_id,
            'class'      => $class,
            'division'   => $division,
            'day'        => $day,
            'period'     => $period,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id,
            'room'       => $room
        ]);
    }


    /* =====================================================
       CHECK CLASS SLOT
    ===================================================== */

    public function slotExists(
        $school_id,
        $class,
        $division,
        $day,
        $period,
        $exclude_id = null
    ) {
        $query = "SELECT id

                  FROM timetable

                  WHERE school_id = :school_id
                  AND class = :class
                  AND division = :division
                  AND day = :day
                  AND period = :period";

        $params = [
            'school_id' => $school_id,
            'class'     => $class,
            'division'  => $division,
            'day'       => $day,
            'period'    => $period
        ];

        if ($exclude_id !== null) {

            $query .= " AND id != :exclude_id";

            $params['exclude_id'] = $exclude_id;
        }

        $query .= " LIMIT 1";

        $result = $this->query($query, $params);

        return !empty($result);
    }


    /* =====================================================
       CHECK TEACHER CONFLICT
    ===================================================== */

    public function teacherConflict(
        $school_id,
        $teacher_id,
        $day,
        $period,
        $exclude_id = null
    ) {
        $query = "SELECT id

                  FROM timetable

                  WHERE school_id = :school_id
                  AND teacher_id = :teacher_id
                  AND day = :day
                  AND period = :period";

        $params = [
            'school_id' => $school_id,
            'teacher_id' => $teacher_id,
            'day'       => $day,
            'period'    => $period
        ];

        if ($exclude_id !== null) {

            $query .= " AND id != :exclude_id";

            $params['exclude_id'] = $exclude_id;
        }

        $query .= " LIMIT 1";

        $result = $this->query($query, $params);

        return !empty($result);
    }


    /* =====================================================
       ACTIVATE
    ===================================================== */

    public function activate($id, $school_id)
    {
        $query = "UPDATE timetable

                  SET status = 1

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id'        => $id,
            'school_id' => $school_id
        ]);
    }


    /* =====================================================
       DEACTIVATE
    ===================================================== */

    public function deactivate($id, $school_id)
    {
        $query = "UPDATE timetable

                  SET status = 0

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id'        => $id,
            'school_id' => $school_id
        ]);
    }


    /* =====================================================
       DELETE
    ===================================================== */

    public function deleteEntry($id, $school_id)
    {
        $query = "DELETE FROM timetable

                  WHERE id = :id
                  AND school_id = :school_id

                  LIMIT 1";

        return $this->query($query, [
            'id'        => $id,
            'school_id' => $school_id
        ]);
    }
}