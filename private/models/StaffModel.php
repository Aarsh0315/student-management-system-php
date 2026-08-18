<?php

class StaffModel extends Model
{
    public function getAllStaff()
    {
        $query = "SELECT
                    s.staff_id,
                    s.user_id,
                    s.school_id,
                    s.department,
                    s.designation,
                    s.qualification,
                    s.joining_date,
                    s.employment_type,
                    s.phone,
                    s.address,
                    s.status,

                    u.firstname,
                    u.lastname,
                    u.email,

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM staff s

                  INNER JOIN users u
                  ON s.user_id = u.user_id

                  LEFT JOIN schools sc
                  ON s.school_id = sc.id

                  ORDER BY s.staff_id DESC";

        return $this->query($query);
    }

    public function getStaffDetails($staff_id)
{
    $query = "SELECT

                s.staff_id,
                s.user_id,
                s.school_id,
                s.department,
                s.designation,
                s.qualification,
                s.joining_date,
                s.employment_type,
                s.phone,
                s.address,
                s.status,
                s.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
              ON s.user_id = u.user_id

              LEFT JOIN schools sc
              ON s.school_id = sc.id

              WHERE s.staff_id = :staff_id

              LIMIT 1";

    $result = $this->query($query, [
        'staff_id' => $staff_id
    ]);

    return $result[0] ?? false;
}
}