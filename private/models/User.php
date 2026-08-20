<?php

class User extends Model
{
    protected $table = "users";


    public function findByEmail($email)
    {
        $query = "SELECT * FROM $this->table
                  WHERE email = :email
                  LIMIT 1";

        $result = $this->query($query, [
            'email' => $email
        ]);

        if ($result) {
            return $result[0];
        }

        return false;
    }


    public function createUser($data)
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
        :rank,
        :password,
        :status
    )";

    return $this->query($query, $data);
}

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