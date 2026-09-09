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

public function getAllParents(
    $search = '',
    $sort = 'id',
    $direction = 'DESC'
) {
    $sortColumns = [
        'id'     => 'u.user_id',
        'name'   => 'u.firstname',
        'email'  => 'u.email',
        'school' => 's.school_name',
        'status' => 'u.status'
    ];

    $orderBy = $sortColumns[$sort] ?? 'u.user_id';

    $direction = strtoupper($direction) === 'ASC'
        ? 'ASC'
        : 'DESC';


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

            GROUP_CONCAT(
                DISTINCT CONCAT(
                    su.firstname,
                    ' ',
                    su.lastname
                )
                ORDER BY su.firstname
                SEPARATOR ', '
            ) AS student_names,

            GROUP_CONCAT(
                DISTINCT st.parent_phone
                ORDER BY st.parent_phone
                SEPARATOR ', '
            ) AS phone

        FROM users u

        LEFT JOIN schools s
            ON u.school_id = s.id

        LEFT JOIN students st
            ON st.parent_id = u.user_id

        LEFT JOIN users su
            ON st.user_id = su.user_id

        WHERE u.rank = 'parent'
    ";


    $params = [];


    /* =========================
       SEARCH
    ========================= */

    if ($search !== '') {

        $query .= "
            AND (
                CONCAT(
                    u.firstname,
                    ' ',
                    u.lastname
                ) LIKE :search

                OR u.email LIKE :search

                OR st.parent_phone LIKE :search

                OR s.school_name LIKE :search

                OR CONCAT(
                    su.firstname,
                    ' ',
                    su.lastname
                ) LIKE :search
            )
        ";

        $params['search'] = '%' . $search . '%';
    }


    $query .= "
        GROUP BY
            u.user_id,
            u.firstname,
            u.lastname,
            u.email,
            u.gender,
            u.rank,
            u.school_id,
            u.status,
            s.school_name

        ORDER BY {$orderBy} {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
}


    /*
    ========================================
    GET PARENTS BY SCHOOL
    ========================================
    */

   public function getParentsBySchool(
    $school_id,
    $search = '',
    $sort = 'id',
    $direction = 'DESC'
) {
    $sortColumns = [
        'id'     => 'u.user_id',
        'name'   => 'u.firstname',
        'email'  => 'u.email',
        'school' => 's.school_name',
        'status' => 'u.status'
    ];

    $orderBy = $sortColumns[$sort] ?? 'u.user_id';

    $direction = strtoupper($direction) === 'ASC'
        ? 'ASC'
        : 'DESC';


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

            GROUP_CONCAT(
                DISTINCT CONCAT(
                    su.firstname,
                    ' ',
                    su.lastname
                )
                ORDER BY su.firstname
                SEPARATOR ', '
            ) AS student_names,

            GROUP_CONCAT(
                DISTINCT st.parent_phone
                ORDER BY st.parent_phone
                SEPARATOR ', '
            ) AS phone

        FROM users u

        LEFT JOIN schools s
            ON u.school_id = s.id

        LEFT JOIN students st
            ON st.parent_id = u.user_id

        LEFT JOIN users su
            ON st.user_id = su.user_id

        WHERE u.rank = 'parent'
          AND u.school_id = :school_id
    ";


    $params = [
        'school_id' => $school_id
    ];


    /* =========================
       SEARCH
    ========================= */

    if ($search !== '') {

        $query .= "
            AND (
                CONCAT(
                    u.firstname,
                    ' ',
                    u.lastname
                ) LIKE :search

                OR u.email LIKE :search

                OR st.parent_phone LIKE :search

                OR CONCAT(
                    su.firstname,
                    ' ',
                    su.lastname
                ) LIKE :search

                OR s.school_name LIKE :search
            )
        ";

        $params['search'] = '%' . $search . '%';
    }


    $query .= "
        GROUP BY
            u.user_id,
            u.firstname,
            u.lastname,
            u.email,
            u.gender,
            u.rank,
            u.school_id,
            u.status,
            s.school_name

        ORDER BY {$orderBy} {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
}


    /*
    ========================================
    GET PARENT BY USER ID + SCHOOL
    SCHOOL ADMIN
    ========================================
    */

    public function getParentByUserIdAndSchool(
        $user_id,
        $school_id
    ) {

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

                s.school_name

            FROM users u

            LEFT JOIN schools s
                ON u.school_id = s.id

            WHERE u.user_id = :user_id

            AND u.school_id = :school_id

            AND u.rank = 'parent'

            LIMIT 1
        ";

        $result = $this->query(
            $query,
            [
                'user_id'   => $user_id,
                'school_id' => $school_id
            ]
        );

        return $result[0] ?? false;
    }


    /*
    ========================================
    GET PARENT CHILDREN BY SCHOOL
    SCHOOL ADMIN
    ========================================
    */

    public function getChildrenBySchool(
        $parent_id,
        $school_id
    ) {

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

            AND s.school_id = :school_id

            ORDER BY s.student_id DESC
        ";

        return $this->query(
            $query,
            [
                'parent_id' => $parent_id,
                'school_id' => $school_id
            ]
        );
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


    /*
    ========================================
    GET TOTAL PARENT COUNT
    SUPER ADMIN DASHBOARD
    ========================================
    */

    public function getTotalParentCount()
    {
        $query = "
            SELECT COUNT(*) AS total

            FROM users

            WHERE rank = 'parent'
        ";

        $result = $this->query($query);

        return $result[0]->total ?? 0;
    }

    /*
========================================
GET PARENT DASHBOARD CHILDREN
========================================
*/

public function getDashboardChildren($parent_id)
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


/*
========================================
GET CHILDREN COUNT
========================================
*/

public function getChildrenCount($parent_id)
{
    $query = "
        SELECT COUNT(*) AS total

        FROM students

        WHERE parent_id = :parent_id
    ";

    $result = $this->query(
        $query,
        [
            'parent_id' => $parent_id
        ]
    );

    return (int) ($result[0]->total ?? 0);
}

/*
========================================
GET CHILD TEST COUNT
PARENT DASHBOARD
========================================
*/

public function getChildrenTestCount($parent_id)
{
    $query = "
        SELECT COUNT(DISTINCT t.test_id) AS total
        FROM tests t

        INNER JOIN students st
            ON t.school_id = st.school_id
            AND t.class = st.class
            AND t.division = st.division

        INNER JOIN parent_student ps
            ON ps.student_id = st.student_id

        WHERE ps.parent_id = :parent_id
        AND t.status = 'active'
    ";

    $result = $this->query(
        $query,
        [
            'parent_id' => $parent_id
        ]
    );

    return (int) ($result[0]->total ?? 0);
}


/*
========================================
GET CHILD RESULT COUNT
PARENT DASHBOARD
========================================
*/

public function getChildrenResultCount($parent_id)
{
    $query = "
        SELECT COUNT(*) AS total

        FROM results r

        INNER JOIN parent_student ps
            ON ps.student_id = r.student_id

        WHERE ps.parent_id = :parent_id
    ";

    $result = $this->query(
        $query,
        [
            'parent_id' => $parent_id
        ]
    );

    return (int) ($result[0]->total ?? 0);
}
}