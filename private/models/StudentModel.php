<?php

class StudentModel extends Model
{
    public function getAllStudents()
    {
        $query = "SELECT
                    st.student_id,
                    st.user_id,
                    st.school_id,
                    st.admission_number,
                    st.class,
                    st.division,
                    st.roll_number,
                    st.date_of_birth,
                    st.admission_date,
                    st.parent_name,
                    st.parent_phone,
                    st.parent_email,
                    st.address,
                    st.status,

                    u.firstname,
                    u.lastname,
                    u.email,
                    u.gender,

                    sc.school_name,
                    sc.school_id AS school_code

                  FROM students st

                  INNER JOIN users u
                  ON st.user_id = u.user_id

                  LEFT JOIN schools sc
                  ON st.school_id = sc.id

                  ORDER BY st.student_id DESC";

        return $this->query($query);
    }

    public function getStudentDetails($student_id)
{
    $query = "SELECT

                st.student_id,
                st.user_id,
                st.school_id,
                st.admission_number,
                st.class,
                st.division,
                st.roll_number,
                st.date_of_birth,
                st.admission_date,
                st.parent_name,
                st.parent_phone,
                st.parent_email,
                st.address,
                st.status,
                st.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM students st

              INNER JOIN users u
              ON st.user_id = u.user_id

              LEFT JOIN schools sc
              ON st.school_id = sc.id

              WHERE st.student_id = :student_id

              LIMIT 1";

    $result = $this->query($query, [
        'student_id' => $student_id
    ]);

    return $result[0] ?? false;
}

public function getStudentCountBySchool($school_id)
{
    $query = "SELECT COUNT(*) AS total
              FROM students
              WHERE school_id = :school_id
              AND status = 'active'";

    $result = $this->query($query, [
        'school_id' => $school_id
    ]);

    return $result[0]->total ?? 0;
}

public function getStudentsBySchool($school_id)
{
    $query = "SELECT
                st.student_id,
                st.user_id,
                st.school_id,
                st.admission_number,
                st.class,
                st.division,
                st.roll_number,
                st.date_of_birth,
                st.admission_date,
                st.parent_name,
                st.parent_phone,
                st.parent_email,
                st.address,
                st.status,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM students st

              INNER JOIN users u
              ON st.user_id = u.user_id

              LEFT JOIN schools sc
              ON st.school_id = sc.id

              WHERE st.school_id = :school_id

              ORDER BY st.student_id DESC";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}

public function getStudentDetailsBySchool($student_id, $school_id)
{
    $query = "SELECT

                st.student_id,
                st.user_id,
                st.school_id,
                st.admission_number,
                st.class,
                st.division,
                st.roll_number,
                st.date_of_birth,
                st.admission_date,
                st.parent_name,
                st.parent_phone,
                st.parent_email,
                st.address,
                st.status,
                st.created_at,

                u.firstname,
                u.lastname,
                u.email,
                u.gender,

                sc.school_name,
                sc.school_id AS school_code

              FROM students st

              INNER JOIN users u
              ON st.user_id = u.user_id

              LEFT JOIN schools sc
              ON st.school_id = sc.id

              WHERE st.student_id = :student_id
              AND st.school_id = :school_id

              LIMIT 1";

    $result = $this->query($query, [
        'student_id' => $student_id,
        'school_id' => $school_id
    ]);

    return $result[0] ?? false;
}

public function createStudent($userData, $studentData)
{
    /*
    ========================================
    CREATE USER
    ========================================
    */

    $userQuery = "INSERT INTO users
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
                        'student',
                        :password,
                        'active'
                    )";

    $this->query($userQuery, $userData);


    /*
    ========================================
    GET CREATED USER ID
    ========================================
    */

    $user = $this->query(
        "SELECT user_id
         FROM users
         WHERE email = :email
         LIMIT 1",
        [
            'email' => $userData['email']
        ]
    );

    if (!$user) {
        return false;
    }

    $user_id = $user[0]->user_id;


    /*
    ========================================
    CREATE STUDENT
    ========================================
    */

    $studentQuery = "INSERT INTO students
                        (
                            user_id,
                            school_id,
                            admission_number,
                            class,
                            division,
                            roll_number,
                            date_of_birth,
                            admission_date,
                            parent_name,
                            parent_phone,
                            parent_email,
                            address,
                            status
                        )
                     VALUES
                        (
                            :user_id,
                            :school_id,
                            :admission_number,
                            :class,
                            :division,
                            :roll_number,
                            :date_of_birth,
                            :admission_date,
                            :parent_name,
                            :parent_phone,
                            :parent_email,
                            :address,
                            'active'
                        )";

    return $this->query(
        $studentQuery,
        [
            'user_id'          => $user_id,
            'school_id'        => $studentData['school_id'],
            'admission_number' => $studentData['admission_number'],
            'class'            => $studentData['class'],
            'division'         => $studentData['division'],
            'roll_number'      => $studentData['roll_number'],
            'date_of_birth'    => $studentData['date_of_birth'],
            'admission_date'   => $studentData['admission_date'],
            'parent_name'      => $studentData['parent_name'],
            'parent_phone'     => $studentData['parent_phone'],
            'parent_email'     => $studentData['parent_email'],
            'address'          => $studentData['address']
        ]
    );
}
}