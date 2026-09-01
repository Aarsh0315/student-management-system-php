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
                    u.profile_image,

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
u.profile_image,

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
u.profile_image,

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
                u.profile_image,

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
    GENERATE PARENT / STUDENT USER IDs
    ========================================
    */

    $userIdQuery = "SELECT
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

    $userIdResult = $this->query(
        $userIdQuery
    );

    $nextUserNumber =
        $userIdResult[0]->next_number ?? 1;


    /*
    ========================================
    PARENT INFORMATION
    ========================================
    */

    $parent_firstname =
        trim(
            $studentData['parent_firstname'] ?? ''
        );

    $parent_lastname =
        trim(
            $studentData['parent_lastname'] ?? ''
        );

    $parent_email =
        trim(
            $studentData['parent_email'] ?? ''
        );

    $parent_phone =
        trim(
            $studentData['parent_phone'] ?? ''
        );


    /*
    ========================================
    FIND EXISTING PARENT
    ========================================
    */

    $parentQuery = "SELECT
                        user_id

                    FROM users

                    WHERE email = :email

                    AND rank = 'parent'

                    LIMIT 1";

    $existingParent =
        $this->query(
            $parentQuery,
            [
                'email' => $parent_email
            ]
        );


    /*
    ========================================
    PARENT USER ID
    ========================================
    */

    $parent_user_id = null;


    /*
    ========================================
    EXISTING PARENT
    ========================================
    */

    if (!empty($existingParent)) {

        $parent_user_id =
            $existingParent[0]->user_id;

    }


    /*
    ========================================
    CREATE NEW PARENT
    ========================================
    */

    else {

        $parent_user_id =
            'USR'
            . str_pad(
                $nextUserNumber,
                3,
                '0',
                STR_PAD_LEFT
            );


        /*
        ========================================
        INCREMENT NEXT USER NUMBER
        ========================================
        */

        $nextUserNumber++;


        /*
        ========================================
        CREATE PARENT USER
        ========================================
        */

        $parentQuery = "INSERT INTO users
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
                            'parent',
                            :password,
                            'active',
                            NULL
                        )";


        $createdParent =
            $this->query(
                $parentQuery,
                [
                    'user_id' =>
                        $parent_user_id,

                    'firstname' =>
                        $parent_firstname,

                    'lastname' =>
                        $parent_lastname,

                    'email' =>
                        $parent_email,

                    'gender' =>
                        $userData['gender'] ?? '',

                    'school_id' =>
                        $studentData['school_id'],

                    /*
                    Same password as student
                    */

                    'password' =>
                        $userData['password']
                ]
            );


        /*
        ========================================
        PARENT CREATION FAILED
        ========================================
        */

        if (!$createdParent) {

            return false;

        }

    }


    /*
    ========================================
    GENERATE STUDENT USER ID
    ========================================
    */

    $userIdQuery = "SELECT
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

    $userIdResult =
        $this->query(
            $userIdQuery
        );


    $nextUserNumber =
        $userIdResult[0]->next_number ?? 1;


    $user_id =
        'USR'
        . str_pad(
            $nextUserNumber,
            3,
            '0',
            STR_PAD_LEFT
        );


    /*
    ========================================
    CREATE STUDENT USER
    ========================================
    */

    $userQuery = "INSERT INTO users
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
                        'student',
                        :password,
                        'active',
                        :profile_image
                    )";


    $userData['user_id'] =
        $user_id;

    $userData['profile_image'] =
        $userData['profile_image'] ?? null;


    $createdUser =
        $this->query(
            $userQuery,
            $userData
        );


    if (!$createdUser) {

        return false;

    }


    /*
    ========================================
    GENERATE STUDENT ID
    ========================================
    */

    $studentIdQuery = "SELECT
                            COALESCE(
                                MAX(
                                    CAST(
                                        SUBSTRING(student_id, 4)
                                        AS UNSIGNED
                                    )
                                ),
                                0
                            ) + 1 AS next_number

                       FROM students

                       WHERE student_id LIKE 'STU%'";


    $studentIdResult =
        $this->query(
            $studentIdQuery
        );


    $nextStudentNumber =
        $studentIdResult[0]->next_number ?? 1;


    $student_id =
        'STU'
        . str_pad(
            $nextStudentNumber,
            3,
            '0',
            STR_PAD_LEFT
        );


    /*
    ========================================
    CREATE STUDENT
    ========================================
    */

    $studentQuery = "INSERT INTO students
                    (
                        student_id,
                        user_id,
                        parent_id,
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
                        :student_id,
                        :user_id,
                        :parent_id,
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


    /*
    ========================================
    INSERT STUDENT
    ========================================
    */

    return $this->query(
        $studentQuery,
        [

            'student_id' =>
                $student_id,

            'user_id' =>
                $user_id,

            /*
            Parent user ID
            */

            'parent_id' =>
                $parent_user_id,

            'school_id' =>
                $studentData['school_id'],

            'admission_number' =>
                $studentData['admission_number'],

            'class' =>
                $studentData['class'],

            'division' =>
                $studentData['division'],

            'roll_number' =>
                $studentData['roll_number'],

            'date_of_birth' =>
                $studentData['date_of_birth'],

            'admission_date' =>
                $studentData['admission_date'],

            /*
            Keep these fields for
            existing student details
            */

            'parent_name' =>
                $parent_firstname
                . ' '
                . $parent_lastname,

            'parent_phone' =>
                $parent_phone,

            'parent_email' =>
                $parent_email,

            'address' =>
                $studentData['address']

        ]
    );
}

public function getClassesBySchool($school_id)
{
    $query = "SELECT
                class,
                division,
                COUNT(*) AS student_count
              FROM students
              WHERE school_id = :school_id
              AND status = 'active'
              GROUP BY class, division
              ORDER BY class, division";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}

public function getParentsBySchool($school_id)
{
    $query = "SELECT
                parent_name,
                parent_phone,
                parent_email,
                COUNT(*) AS student_count
              FROM students
              WHERE school_id = :school_id
              AND status = 'active'
              AND parent_name IS NOT NULL
              AND parent_name != ''
              GROUP BY
                parent_name,
                parent_phone,
                parent_email
              ORDER BY parent_name ASC";

    return $this->query($query, [
        'school_id' => $school_id
    ]);
}

/*
========================================
GET PARENT DETAILS BY NAME
TEACHER
========================================
*/

public function getParentDetailsByName(
    $parent_name,
    $school_id
) {

    $query = "SELECT

                s.parent_name,
                s.parent_phone,
                s.parent_email,

                s.student_id,
                s.class,
                s.division,
                s.roll_number,

                u.firstname,
                u.lastname,
                u.email

              FROM students s

              LEFT JOIN users u
                ON s.user_id = u.user_id

              WHERE s.school_id = :school_id

              AND s.status = 'active'

              AND s.parent_name = :parent_name

              ORDER BY
                s.class ASC,
                s.division ASC,
                s.roll_number ASC";


    return $this->query(
        $query,
        [
            'school_id'   => $school_id,
            'parent_name' => $parent_name
        ]
    );
}
public function getAllClasses()
{
    $query = "SELECT
                st.class,
                st.division,
                st.school_id,
                sc.school_name,
                COUNT(*) AS student_count

              FROM students st

              LEFT JOIN schools sc
              ON st.school_id = sc.id

              WHERE st.status = 'active'

              GROUP BY
                st.class,
                st.division,
                st.school_id,
                sc.school_name

              ORDER BY
                st.school_id,
                st.class,
                st.division";

    return $this->query($query);
}

/*
========================================
GET STUDENTS BY CLASS AND DIVISION
TEACHER CLASS DETAILS
========================================
*/

public function getStudentsByClassAndDivision(
    $school_id,
    $class,
    $division
) {

    $query = "SELECT

                st.student_id,
                st.user_id,
                st.class,
                st.division,
                st.roll_number,
                st.admission_number,
                st.status,

                u.firstname,
                u.lastname,
                u.email

              FROM students st

              LEFT JOIN users u
                ON st.user_id = u.user_id

              WHERE st.school_id = :school_id

              AND st.class = :class

              AND st.division = :division

              ORDER BY st.roll_number ASC";

    return $this->query(
        $query,
        [
            'school_id' => $school_id,
            'class'     => $class,
            'division'  => $division
        ]
    );
}

/*
========================================
GET STUDENTS BY CLASS
========================================
*/

public function getStudentsByClass(
    $school_id,
    $class,
    $division
) {

    $query = "SELECT

                st.student_id,
                st.user_id,
                st.parent_id,
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
                u.email

              FROM students st

              LEFT JOIN users u
                ON st.user_id = u.user_id

              WHERE st.school_id = :school_id

              AND st.class = :class

              AND st.division = :division

              ORDER BY st.roll_number ASC";


    return $this->query(
        $query,
        [
            'school_id' => $school_id,
            'class'     => $class,
            'division'  => $division
        ]
    );
}

/* =====================================================
   TOTAL STUDENT COUNT
===================================================== */

public function getTotalStudentCount()
{
    $query = "SELECT COUNT(*) AS total
              FROM students
              WHERE status = 'active'";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}
}