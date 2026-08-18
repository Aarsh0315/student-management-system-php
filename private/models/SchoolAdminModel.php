<?php

class SchoolAdminModel extends Model
{
    public function getAllAdmins()
    {
        $query = "SELECT
                    u.user_id,
                    u.firstname,
                    u.lastname,
                    u.email,
                    u.gender,
                    u.school_id,
                    u.rank,
                    u.status,

                    s.school_name,
                    s.school_id AS school_code

                  FROM users u

                  LEFT JOIN schools s
                  ON u.school_id = s.id

                  WHERE u.rank = 'admin'

                  ORDER BY u.user_id DESC";

        return $this->query($query);
    }


    public function getAdminDetails($user_id)
    {
        $query = "SELECT
                    u.user_id,
                    u.firstname,
                    u.lastname,
                    u.email,
                    u.gender,
                    u.school_id,
                    u.rank,
                    u.status,

                    s.school_name,
                    s.school_id AS school_code

                  FROM users u

                  LEFT JOIN schools s
                  ON u.school_id = s.id

                  WHERE u.user_id = :user_id
                  AND u.rank = 'admin'

                  LIMIT 1";

        $result = $this->query($query, [
            'user_id' => $user_id
        ]);

        return $result[0] ?? false;
    }
}