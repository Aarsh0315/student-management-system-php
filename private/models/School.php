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
}