<?php

class School extends Model
{
    protected $table = "schools";


    public function getAllSchools()
    {
        $query = "SELECT *
                  FROM schools
                  ORDER BY id DESC";

        return $this->query($query);
    }


    public function findBySchoolId($school_id)
    {
        $query = "SELECT *
                  FROM schools
                  WHERE school_id = :school_id
                  LIMIT 1";

        $result = $this->query($query, [
            'school_id' => $school_id
        ]);

        if (!empty($result)) {
            return $result[0];
        }

        return false;
    }

    public function getRoleCounts($school_id)
{
    $query = "SELECT 
                rank,
                COUNT(*) AS total
              FROM users
              WHERE school_id = :school_id
              GROUP BY rank";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}

public function createSchool($data)
{
    $query = "INSERT INTO schools
    (
        school_id,
        school_name,
        school_code,
        email,
        phone,
        emergency_contact,
        website,
        address,
        board,
        medium,
        school_type,
        academic_year,
        established_year,
        status
    )
    VALUES
    (
        :school_id,
        :school_name,
        :school_code,
        :email,
        :phone,
        :emergency_contact,
        :website,
        :address,
        :board,
        :medium,
        :school_type,
        :academic_year,
        :established_year,
        :status
    )";

    return $this->query($query, $data);
}

/* =====================================================
   TOTAL SCHOOL COUNT
===================================================== */

public function getTotalSchoolCount()
{
    $query = "SELECT COUNT(*) AS total
              FROM schools
              WHERE status = 'active'";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}

/*
=====================================================
GET RECENT SCHOOLS
SUPER ADMIN DASHBOARD
=====================================================
*/

/*
=====================================================
GET RECENT SCHOOLS
SUPER ADMIN DASHBOARD
=====================================================
*/

public function getRecentSchools($limit = 3)
{
    $limit = (int) $limit;

    $query = "
        SELECT
            id,
            school_id,
            school_name
        FROM schools
        ORDER BY id DESC
        LIMIT $limit
    ";

    return $this->query($query);
}
}