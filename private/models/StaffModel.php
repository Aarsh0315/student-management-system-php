<?php

class StaffModel extends Model
{
    public function getAllStaff()
    {
        $query = "SELECT
                    s.staff_id,
                    s.user_id,
                    s.school_id,
                    s.department,
                    s.designation,
                    s.qualification,
                    s.joining_date,
                    s.employment_type,
                    s.phone,
                    s.address,
                    s.status,

                    u.firstname,
                    u.lastname,
                    u.email,

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM staff s

                  INNER JOIN users u
                  ON s.user_id = u.user_id

                  LEFT JOIN schools sc
                  ON s.school_id = sc.id

                  ORDER BY s.staff_id DESC";

        return $this->query($query);
    }

    public function getStaffDetails($staff_id)
{
    $query = "SELECT

                s.staff_id,
                s.user_id,
                s.school_id,
                s.department,
                s.designation,
                s.qualification,
                s.joining_date,
                s.employment_type,
                s.phone,
                s.address,
                s.status,
                s.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
              ON s.user_id = u.user_id

              LEFT JOIN schools sc
              ON s.school_id = sc.id

              WHERE s.staff_id = :staff_id

              LIMIT 1";

    $result = $this->query($query, [
        'staff_id' => $staff_id
    ]);

    return $result[0] ?? false;
}

public function getStaffCountBySchool($school_id)
{
    $query = "SELECT COUNT(*) AS total
              FROM staff
              WHERE school_id = :school_id
              AND status = 'active'";

    $result = $this->query($query, [
        'school_id' => $school_id
    ]);

    return $result[0]->total ?? 0;
}

public function getStaffBySchool($school_id)
{
    $query = "SELECT
                s.staff_id,
                s.user_id,
                s.school_id,
                s.department,
                s.designation,
                s.qualification,
                s.joining_date,
                s.employment_type,
                s.phone,
                s.address,
                s.status,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
              ON s.user_id = u.user_id

              LEFT JOIN schools sc
              ON s.school_id = sc.id

              WHERE s.school_id = :school_id

              ORDER BY s.staff_id DESC";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}


public function getTeachersBySchool($school_id)
{
    $query = "SELECT
                s.staff_id,
                s.user_id,
                s.school_id,
                s.department,
                s.designation,
                s.qualification,
                s.joining_date,
                s.employment_type,
                s.phone,
                s.address,
                s.status,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
              ON s.user_id = u.user_id

              LEFT JOIN schools sc
              ON s.school_id = sc.id

              WHERE s.school_id = :school_id
              AND s.designation = 'Teacher'

              ORDER BY s.staff_id DESC";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}

public function createStaff($userData, $staffData)
{
    /*
    ========================================
    CREATE USER
    ========================================
    */

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

    $userCreated = $this->query($query, $userData);


    if (!$userCreated) {
        return false;
    }


    /*
    ========================================
    GET USER ID
    ========================================
    */

    $user_id = $this->lastInsertId();


    if (!$user_id) {
        return false;
    }


    /*
    ========================================
    CREATE STAFF
    ========================================
    */

    $staffData['user_id'] = $user_id;


    $query = "INSERT INTO staff
              (
                  user_id,
                  school_id,
                  department,
                  designation,
                  qualification,
                  joining_date,
                  employment_type,
                  phone,
                  address,
                  status
              )
              VALUES
              (
                  :user_id,
                  :school_id,
                  :department,
                  :designation,
                  :qualification,
                  :joining_date,
                  :employment_type,
                  :phone,
                  :address,
                  :status
              )";

    return $this->query($query, $staffData);
}

public function getStaffDetailsBySchool($staff_id, $school_id)
{
    $query = "SELECT

                s.staff_id,
                s.user_id,
                s.school_id,
                s.department,
                s.designation,
                s.qualification,
                s.joining_date,
                s.employment_type,
                s.phone,
                s.address,
                s.status,
                s.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
              ON s.user_id = u.user_id

              LEFT JOIN schools sc
              ON s.school_id = sc.id

              WHERE s.staff_id = :staff_id
              AND s.school_id = :school_id

              LIMIT 1";

    $result = $this->query($query, [
        'staff_id' => $staff_id,
        'school_id' => $school_id
    ]);

    return $result[0] ?? false;
}
}