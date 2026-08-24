<?php

class ParentModel extends Model
{

    /* ========================================
       GET ALL PARENTS FOR SCHOOL
    ======================================== */

    public function getParentsBySchool($school_id)
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

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM users u

                  LEFT JOIN schools sc
                  ON u.school_id = sc.id

                  WHERE u.rank = 'parent'

                  AND u.school_id = :school_id

                  ORDER BY u.user_id DESC";

        return $this->query($query, [

            'school_id' => $school_id

        ]);
    }


    /* ========================================
       GET PARENT DETAILS
    ======================================== */

    public function getParentDetails($user_id)
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

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM users u

                  LEFT JOIN schools sc
                  ON u.school_id = sc.id

                  WHERE u.user_id = :user_id

                  AND u.rank = 'parent'

                  LIMIT 1";

        $result = $this->query($query, [

            'user_id' => $user_id

        ]);

        return $result[0] ?? false;
    }


    /* ========================================
       GET PARENT DETAILS BY SCHOOL
    ======================================== */

    public function getParentDetailsBySchool(
        $user_id,
        $school_id
    ) {

        $query = "SELECT

                    u.user_id,
                    u.firstname,
                    u.lastname,
                    u.email,
                    u.gender,
                    u.school_id,
                    u.rank,
                    u.status,

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM users u

                  LEFT JOIN schools sc
                  ON u.school_id = sc.id

                  WHERE u.user_id = :user_id

                  AND u.school_id = :school_id

                  AND u.rank = 'parent'

                  LIMIT 1";

        $result = $this->query($query, [

            'user_id'   => $user_id,
            'school_id' => $school_id

        ]);

        return $result[0] ?? false;
    }


    /* ========================================
       CREATE PARENT
    ======================================== */

    public function createParent($userData)
    {
        $query = "INSERT INTO users

                    (
                        firstname,
                        lastname,
                        email,
                        gender,
                        school_id,
                        rank,
                        password,
                        status
                    )

                  VALUES

                    (
                        :firstname,
                        :lastname,
                        :email,
                        :gender,
                        :school_id,
                        'parent',
                        :password,
                        'active'
                    )";

        return $this->query(
            $query,
            $userData
        );
    }

}