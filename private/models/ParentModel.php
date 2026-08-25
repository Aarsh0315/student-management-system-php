<?php

class ParentModel extends Model
{
    /*
    ========================================
    GET ALL PARENTS
    ========================================
    */

    public function getAllParents()
    {
        $query = "
            SELECT
                p.*,
                s.school_name

            FROM parents p

            LEFT JOIN schools s
                ON p.school_id = s.id

            ORDER BY p.created_at DESC
        ";

        return $this->query($query);
    }


    /*
    ========================================
    GET PARENT BY ID
    ========================================
    */

    public function getParentById($parent_id)
    {
        $query = "
            SELECT
                p.*,
                s.school_name

            FROM parents p

            LEFT JOIN schools s
                ON p.school_id = s.id

            WHERE p.parent_id = :parent_id

            LIMIT 1
        ";

        $result = $this->query(
            $query,
            [
                'parent_id' => $parent_id
            ]
        );

        return $result[0] ?? false;
    }


    /*
    ========================================
    GET PARENTS BY SCHOOL
    ========================================
    */

    public function getParentsBySchool($school_id)
    {
        $query = "
            SELECT
                p.*,
                s.school_name

            FROM parents p

            LEFT JOIN schools s
                ON p.school_id = s.id

            WHERE p.school_id = :school_id

            ORDER BY p.created_at DESC
        ";

        return $this->query(
            $query,
            [
                'school_id' => $school_id
            ]
        );
    }

    /*
========================================
CREATE PARENT
========================================
*/

public function createParent($data)
{
    $query = "
        INSERT INTO parents (

            parent_id,
            user_id,
            school_id,
            firstname,
            lastname,
            email,
            phone,
            address,
            status

        )

        VALUES (

            :parent_id,
            :user_id,
            :school_id,
            :firstname,
            :lastname,
            :email,
            :phone,
            :address,
            :status

        )
    ";


    return $this->query(
        $query,
        [
            'parent_id' => $data['parent_id'],

            'user_id' =>
                $data['user_id'],

            'school_id' =>
                $data['school_id'],

            'firstname' =>
                $data['firstname'],

            'lastname' =>
                $data['lastname'],

            'email' =>
                $data['email'],

            'phone' =>
                $data['phone'],

            'address' =>
                $data['address'],

            'status' =>
                $data['status']
        ]
    );
}
}