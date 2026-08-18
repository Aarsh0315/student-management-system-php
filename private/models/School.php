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
}