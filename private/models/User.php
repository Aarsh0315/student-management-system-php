<?php

class User extends Model
{
    protected $table = "users";


    /* =====================================================
       FIND USER BY EMAIL
    ===================================================== */

    public function findByEmail($email)
    {
        $query = "SELECT *
                  FROM $this->table
                  WHERE email = :email
                  LIMIT 1";

        $result = $this->query($query, [
            'email' => $email
        ]);

        return $result[0] ?? false;
    }


    /* =====================================================
       GENERATE NEXT USER ID
       
       Example:
       USR001
       USR002
       USR003
    ===================================================== */

    private function generateUserId()
    {
        $query = "SELECT
                    COALESCE(
                        MAX(
                            CAST(
                                SUBSTRING(user_id, 4)
                                AS UNSIGNED
                            )
                        ),
                        0
                    ) + 1 AS next_number

                  FROM users

                  WHERE user_id LIKE 'USR%'";

        $result = $this->query($query);

        $nextNumber =
            $result[0]->next_number ?? 1;


        return 'USR' . str_pad(
            $nextNumber,
            3,
            '0',
            STR_PAD_LEFT
        );
    }


    /* =====================================================
       CREATE USER
    ===================================================== */

   public function createUser($data)
{
    /*
    ========================================
    GENERATE USER ID
    ========================================
    */

    $idQuery = "SELECT
                    COALESCE(
                        MAX(
                            CAST(
                                SUBSTRING(user_id, 4)
                                AS UNSIGNED
                            )
                        ),
                        0
                    ) + 1 AS next_number
                FROM users
                WHERE user_id LIKE 'USR%'";

    $idResult = $this->query($idQuery);

    $nextNumber =
        $idResult[0]->next_number ?? 1;


    /*
    ========================================
    CREATE USER ID
    ========================================
    */

    $user_id =
        'USR'
        . str_pad(
            $nextNumber,
            3,
            '0',
            STR_PAD_LEFT
        );


    /*
    ========================================
    PROFILE IMAGE
    ========================================
    */

    $profile_image =
        $data['profile_image'] ?? null;


    /*
    ========================================
    INSERT USER
    ========================================
    */

    $query = "INSERT INTO users
    (
        user_id,
        firstname,
        lastname,
        email,
        gender,
        school_id,
        rank,
        password,
        status,
        profile_image
    )
    VALUES
    (
        :user_id,
        :firstname,
        :lastname,
        :email,
        :gender,
        :school_id,
        :rank,
        :password,
        :status,
        :profile_image
    )";


    /*
    ========================================
    ADD USER ID
    ========================================
    */

    $data['user_id'] = $user_id;


    /*
    ========================================
    CREATE USER
    ========================================
    */

    return $this->query(
        $query,
        [
            'user_id' =>
                $data['user_id'],

            'firstname' =>
                $data['firstname'],

            'lastname' =>
                $data['lastname'],

            'email' =>
                $data['email'],

            'gender' =>
                $data['gender'],

            'school_id' =>
                $data['school_id'],

            'rank' =>
                $data['rank'],

            'password' =>
                $data['password'],

            'status' =>
                $data['status'],

            'profile_image' =>
                $profile_image
        ]
    );
}


    /* =====================================================
       GET ALL USERS
    ===================================================== */

    public function getAllUsers(
    $search = '',
    $sort = 'id',
    $direction = 'DESC',
    $role = '',
    $status = ''
) {
    $allowedSorts = [
        'id'        => 'users.id',
        'name'      => 'users.firstname',
        'email'     => 'users.email',
        'school'    => 'schools.school_name',
        'role'      => 'users.rank',
        'gender'    => 'users.gender',
        'status'    => 'users.status'
    ];

    if (!isset($allowedSorts[$sort])) {
        $sort = 'id';
    }

    $sortColumn = $allowedSorts[$sort];

    $direction = strtoupper($direction);

    if (!in_array($direction, ['ASC', 'DESC'], true)) {
        $direction = 'DESC';
    }

    $query = "SELECT
                users.*,
                schools.school_name
              FROM users
              LEFT JOIN schools
                  ON schools.id = users.school_id";

    $conditions = [];
    $params = [];

    /*
    ========================================
    SEARCH
    ========================================
    */

    if ($search !== '') {

        $conditions[] = "(
            users.user_id LIKE :search
            OR users.firstname LIKE :search
            OR users.lastname LIKE :search
            OR users.email LIKE :search
        )";

        $params['search'] = '%' . $search . '%';
    }


    /*
    ========================================
    ROLE FILTER
    ========================================
    */

    $allowedRoles = [
        'super_admin',
        'admin',
        'principal',
        'vice_principal',
        'teacher',
        'student',
        'parent',
        'staff'
    ];

    if (
        $role !== '' &&
        in_array($role, $allowedRoles, true)
    ) {

        $conditions[] = "users.rank = :role";

        $params['role'] = $role;
    }


    /*
    ========================================
    STATUS FILTER
    ========================================
    */

    if (
        $status !== '' &&
        in_array($status, ['active', 'inactive'], true)
    ) {

        $conditions[] = "users.status = :status";

        $params['status'] = $status;
    }


    /*
    ========================================
    WHERE
    ========================================
    */

    if (!empty($conditions)) {

        $query .= " WHERE "
            . implode(" AND ", $conditions);
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "
        ORDER BY {$sortColumn} {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
}


    /* =====================================================
       FIND USER BY USER ID
    ===================================================== */

    public function findById($user_id)
    {
        $query = "SELECT *
                  FROM users
                  WHERE user_id = :user_id
                  LIMIT 1";

        $result = $this->query($query, [
            'user_id' => $user_id
        ]);

        return $result[0] ?? false;
    }


    /* =====================================================
       GET USER DETAILS
    ===================================================== */

    public function getUserDetails($user_id)
{
    $query = "SELECT
                u.*,
                s.school_name,
                s.school_id AS school_code

              FROM users u

              LEFT JOIN schools s
              ON u.school_id = s.id

              WHERE u.user_id = :user_id

              LIMIT 1";

    $result = $this->query($query, [
        'user_id' => $user_id
    ]);

    return $result[0] ?? false;
}


    /* =====================================================
       PARENT COUNT BY SCHOOL
    ===================================================== */

    public function getParentCountBySchool($school_id)
    {
        $query = "SELECT COUNT(*) AS total

                  FROM users

                  WHERE school_id = :school_id

                  AND rank = 'parent'

                  AND status = 'active'";

        $result = $this->query($query, [
            'school_id' => $school_id
        ]);

        return $result[0]->total ?? 0;
    }


    /* =====================================================
       GET PARENTS BY SCHOOL
    ===================================================== */

    public function getParentsBySchool($school_id)
    {
        $query = "SELECT
                    user_id,
                    firstname,
                    lastname,
                    email,
                    gender,
                    school_id,
                    rank,
                    status

                  FROM users

                  WHERE school_id = :school_id

                  AND rank = 'parent'

                  ORDER BY user_id DESC";

        return $this->query($query, [
            'school_id' => $school_id
        ]);
    }

    /* =====================================================
   TOTAL USER COUNT
===================================================== */

public function getTotalUserCount()
{
    $query = "SELECT COUNT(*) AS total
              FROM users
              WHERE status = 'active'";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}

/*
=====================================================
GET RECENT USERS
SUPER ADMIN DASHBOARD
=====================================================
*/
/*
=====================================================
GET RECENT USERS
SUPER ADMIN DASHBOARD
=====================================================
*/

public function getRecentUsers($limit = 3)
{
    $limit = (int) $limit;

    $query = "
        SELECT
            id,
            user_id,
            firstname,
            lastname,
            rank
        FROM users
        ORDER BY id DESC
        LIMIT $limit
    ";

    return $this->query($query);
}

/* =====================================================
   FIND ACTIVE USER BY EMAIL
===================================================== */

public function findActiveByEmail($email)
{
    $query = "SELECT *
              FROM $this->table
              WHERE email = :email
              AND status = 'active'
              LIMIT 1";

    $result = $this->query($query, [
        'email' => $email
    ]);

    return $result[0] ?? false;
}

public function updateProfile(
    $user_id,
    $firstname,
    $lastname,
    $gender
) {
    $query = "UPDATE users
              SET firstname = :firstname,
                  lastname = :lastname,
                  gender = :gender
              WHERE user_id = :user_id
              LIMIT 1";

    $this->query($query, [
        'firstname' => $firstname,
        'lastname'  => $lastname,
        'gender'    => $gender,
        'user_id'   => $user_id
    ]);

    return true;
}


public function updateUser($user_id, $data)
{
    $query = "UPDATE users
              SET
                  firstname = :firstname,
                  lastname = :lastname,
                  email = :email,
                  gender = :gender,
                  school_id = :school_id,
                  rank = :rank,
                  status = :status,
                  profile_image = :profile_image
              WHERE user_id = :user_id
              LIMIT 1";

    return $this->query($query, [
        'firstname'      => $data['firstname'],
        'lastname'       => $data['lastname'],
        'email'          => $data['email'],
        'gender'         => $data['gender'],
        'school_id'      => $data['school_id'],
        'rank'           => $data['rank'],
        'status'         => $data['status'],
        'profile_image'  => $data['profile_image'],
        'user_id'        => $user_id
    ]);
}
}