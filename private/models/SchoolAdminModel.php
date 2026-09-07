<?php

class SchoolAdminModel extends Model
{
    /* =====================================================
       GET ALL SCHOOL ADMINS
    ===================================================== */

    /* =====================================================
   GET ALL SCHOOL ADMINS
===================================================== */

public function getAllSchoolAdmins(
    $search = '',
    $sort = 'id',
    $direction = 'DESC'
) {

    $sortColumns = [

        'id'     => 'u.user_id',
        'name'   => 'u.firstname',
        'school' => 's.school_name',
        'email'  => 'u.email',
        'status' => 'u.status'

    ];


    $orderBy =
        $sortColumns[$sort] ?? 'u.user_id';


    $direction =
        strtoupper($direction) === 'ASC'
        ? 'ASC'
        : 'DESC';


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

              WHERE u.rank = 'admin'";


    $params = [];


    /*
    ========================================
    SEARCH
    ========================================
    */

    if ($search !== '') {

        $query .= "
            AND (
                CONCAT(
                    u.firstname,
                    ' ',
                    u.lastname
                ) LIKE :search1

                OR u.email LIKE :search2

                OR s.school_name LIKE :search3

                OR s.school_id LIKE :search4

                OR u.status LIKE :search5
            )
        ";


        $searchValue =
            '%' . $search . '%';


        $params['search1'] =
            $searchValue;

        $params['search2'] =
            $searchValue;

        $params['search3'] =
            $searchValue;

        $params['search4'] =
            $searchValue;

        $params['search5'] =
            $searchValue;
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "
        ORDER BY {$orderBy} {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
}


    /* =====================================================
       GET SCHOOL ADMIN DETAILS
    ===================================================== */

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