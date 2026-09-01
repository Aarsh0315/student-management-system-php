<?php

class ParentSchoolModel extends Model
{
    /*
    ========================================
    GET PARENTS BY SCHOOL
    ========================================
    */

    public function getParents($school_id)
    {
        $query = "
            SELECT *
            FROM users

            WHERE rank = 'parent'

            AND school_id = :school_id

            ORDER BY id DESC
        ";

        return $this->query(
            $query,
            [
                'school_id' => $school_id
            ]
        );
    }
}