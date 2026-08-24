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
        CHECK DUPLICATE EMAIL
        ========================================
        */

        $existingUser =
            $this->findByEmail(
                $data['email']
            );


        if ($existingUser) {
            return false;
        }


        /*
        ========================================
        GENERATE USER ID
        ========================================
        */

        $user_id =
            $this->generateUserId();


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
    profile_image,
    school_id,
    rank,
    password,
    status
)

                  VALUES
                    (
                        :user_id,
                        :firstname,
                        :lastname,
                        :email,
                        :gender,
                        :profile_image,
                        :school_id,
                        :rank,
                        :password,
                        :status
                    )";


        /*
        ========================================
        ADD GENERATED ID
        ========================================
        */

        $data['user_id'] =
            $user_id;


        /*
        ========================================
        CREATE USER
        ========================================
        */

        return $this->query(
            $query,
            $data
        );
    }


    /* =====================================================
       GET ALL USERS
    ===================================================== */

    public function getAllUsers()
    {
        $query = "SELECT
                    users.user_id,
                    users.firstname,
                    users.lastname,
                    users.email,
                    users.gender,
                    users.rank,
                    users.status,
                    users.school_id,

                    schools.school_name,
                    schools.school_id AS school_code

                  FROM users

                  LEFT JOIN schools
                  ON users.school_id = schools.id

                  ORDER BY users.user_id DESC";

        return $this->query($query);
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
}