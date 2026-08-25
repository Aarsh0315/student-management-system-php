<?php

class ParentModel extends Model
{
    /*
    ========================================
    GET ALL PARENTS
    SUPER ADMIN
    ========================================
    */

    /*
========================================
GET ALL PARENTS
SUPER ADMIN
========================================
*/

public function getAllParents()
{
    $query = "
        SELECT
            u.user_id,
            u.firstname,
            u.lastname,
            u.email,
            u.gender,
            u.rank,
            u.school_id,
            u.status,

            s.school_name,

            (
                SELECT st.parent_phone
                FROM students st
                WHERE st.parent_id = u.user_id
                LIMIT 1
            ) AS phone

        FROM users u

        LEFT JOIN schools s
            ON u.school_id = s.id

        WHERE u.rank = 'parent'

        ORDER BY u.id DESC
    ";

    return $this->query($query);
}

    /*
    ========================================
    GET PARENT BY EMAIL
    ========================================
    */

    public function getParentByEmail($email)
    {
        $query = "
            SELECT
                user_id,
                firstname,
                lastname,
                email,
                gender,
                rank,
                school_id,
                status

            FROM users

            WHERE email = :email

            AND rank = 'parent'

            LIMIT 1
        ";

        $result = $this->query(
            $query,
            [
                'email' => $email
            ]
        );

        return $result[0] ?? false;
    }


    /*
    ========================================
    GET PARENT BY USER ID
    ========================================
    */

    public function getParentByUserId($user_id)
    {
        $query = "
            SELECT
                user_id,
                firstname,
                lastname,
                email,
                gender,
                rank,
                school_id,
                status

            FROM users

            WHERE user_id = :user_id

            AND rank = 'parent'

            LIMIT 1
        ";

        $result = $this->query(
            $query,
            [
                'user_id' => $user_id
            ]
        );

        return $result[0] ?? false;
    }

/*
========================================
GET PARENT'S CHILDREN
========================================
*/

public function getChildren($parent_id)
{
    $query = "
        SELECT
            s.student_id,
            s.user_id,
            s.parent_id,
            s.school_id,
            s.admission_number,
            s.class,
            s.division,
            s.roll_number,
            s.date_of_birth,
            s.admission_date,
            s.address,
            s.status,

            u.firstname,
            u.lastname,
            u.email

        FROM students s

        INNER JOIN users u
            ON s.user_id = u.user_id

        WHERE s.parent_id = :parent_id

        ORDER BY s.student_id DESC
    ";

    return $this->query(
        $query,
        [
            'parent_id' => $parent_id
        ]
    );
}
}