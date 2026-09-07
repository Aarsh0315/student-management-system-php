<?php




class StudentModel extends Model
{
   public function getAllStudents(
    $search = '',
    $sort = 'student_id',
    $direction = 'DESC',
    $gender = '',
    $status = '',
    $school_id = ''
) {
    $allowedSorts = [
        'student_id' => 'st.student_id',
        'name'       => 'u.firstname',
        'class'      => 'st.class',
        'division'   => 'st.division',
        'school'     => 'sc.school_name',
        'parent'     => 'st.parent_name',
        'email'      => 'u.email',
        'gender'     => 'u.gender',
        'status'     => 'st.status'
    ];

    if (!isset($allowedSorts[$sort])) {
        $sort = 'student_id';
    }

    $sortColumn = $allowedSorts[$sort];

    $direction = strtoupper($direction);

    if (!in_array($direction, ['ASC', 'DESC'], true)) {
        $direction = 'DESC';
    }


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
                  ON st.school_id = sc.id";


    $conditions = [];

    $params = [];


    /* =========================
       SEARCH
    ========================== */

    if ($search !== '') {

        $conditions[] = "(
            st.student_id LIKE :search
            OR st.admission_number LIKE :search
            OR u.firstname LIKE :search
            OR u.lastname LIKE :search
            OR u.email LIKE :search
            OR st.parent_name LIKE :search
            OR st.parent_email LIKE :search
        )";

        $params['search'] = '%' . $search . '%';
    }


    /* =========================
       GENDER
    ========================== */

    $allowedGenders = [
        'Male',
        'Female',
        'Other'
    ];

    if (
        $gender !== '' &&
        in_array($gender, $allowedGenders, true)
    ) {

        $conditions[] = "u.gender = :gender";

        $params['gender'] = $gender;
    }


    /* =========================
       STATUS
    ========================== */

    if (
        $status !== '' &&
        in_array($status, ['active', 'inactive'], true)
    ) {

        $conditions[] = "st.status = :status";

        $params['status'] = $status;
    }


    /* =========================
       SCHOOL
    ========================== */

    if ($school_id !== '') {

        $conditions[] = "st.school_id = :school_id";

        $params['school_id'] = $school_id;
    }


    /* =========================
       WHERE
    ========================== */

    if (!empty($conditions)) {

        $query .= " WHERE " .
            implode(" AND ", $conditions);
    }


    /* =========================
       ORDER
    ========================== */

    $query .= " ORDER BY {$sortColumn} {$direction}";


    return $this->query(
        $query,
        $params
    );
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
public function getStudentsBySchool(
    $school_id,
    $search = '',
    $sort = 'student_id',
    $direction = 'DESC'
) {

    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $allowedSorts = [

        'student_id' => 'st.student_id',
        'name'       => 'u.firstname',
        'class'      => 'st.class',
        'division'   => 'st.division',
        'status'     => 'st.status'

    ];


    if (!isset($allowedSorts[$sort])) {

        $sort = 'student_id';
    }


    $sortColumn =
        $allowedSorts[$sort];


    /*
    ========================================
    DIRECTION
    ========================================
    */

    $direction =
        strtoupper($direction);


    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'DESC';
    }


    /*
    ========================================
    QUERY
    ========================================
    */

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

              WHERE st.school_id = :school_id";


    /*
    ========================================
    SEARCH
    ========================================
    */

    $params = [

        'school_id' => $school_id

    ];


    if ($search !== '') {

        $query .= "
            AND (
                st.student_id LIKE :search
                OR st.admission_number LIKE :search
                OR u.firstname LIKE :search
                OR u.lastname LIKE :search
                OR st.class LIKE :search
                OR st.division LIKE :search
                OR st.parent_name LIKE :search
                OR u.email LIKE :search
            )
        ";


        $params['search'] =
            '%' . $search . '%';
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "
        ORDER BY
        {$sortColumn}
        {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
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
public function getClassesBySchool(
    $school_id,
    $search = '',
    $sort = 'class',
    $direction = 'ASC'
) {
    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $allowedSorts = [
        'class'    => 'class',
        'division' => 'division',
        'students' => 'student_count',
        'status'   => 'status'
    ];


    if (!isset($allowedSorts[$sort])) {

        $sort = 'class';
    }


    $sortColumn =
        $allowedSorts[$sort];


    /*
    ========================================
    DIRECTION
    ========================================
    */

    $direction =
        strtoupper($direction);


    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'ASC';
    }


    /*
    ========================================
    QUERY
    ========================================
    */

    $query = "SELECT

                class,
                division,

                COUNT(*) AS student_count,

                'active' AS status

              FROM students

              WHERE school_id = :school_id

              AND status = 'active'";


    /*
    ========================================
    SEARCH
    ========================================
    */

    $params = [
        'school_id' => $school_id
    ];


    if ($search !== '') {

        $query .= "
            AND (
                class LIKE :search
                OR division LIKE :search
            )
        ";

        $params['search'] =
            '%' . $search . '%';
    }


    /*
    ========================================
    GROUP
    ========================================
    */

    $query .= "

              GROUP BY
                class,
                division";


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "

              ORDER BY
                {$sortColumn}
                {$direction}";


    return $this->query(
        $query,
        $params
    );
}
public function getParentsBySchool(
    $school_id,
    $search = '',
    $sort = 'parent_id',
    $direction = 'DESC'
) {
    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $allowedSorts = [

        'parent_id'    => 'p.user_id',
        'parent_name'  => 'p.firstname',
        'student_name' => 'su.firstname',
        'email'        => 'p.email',
        'phone'        => 'st.parent_phone',
        'status'       => 'p.status'

    ];


    if (!isset($allowedSorts[$sort])) {

        $sort = 'parent_id';
    }


    /*
    ========================================
    DIRECTION
    ========================================
    */

    $direction =
        strtoupper($direction);


    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'DESC';
    }


    $sortColumn =
        $allowedSorts[$sort];


    /*
    ========================================
    QUERY
    ========================================
    */

    $query = "SELECT

                p.user_id AS parent_id,

                p.firstname AS parent_firstname,
                p.lastname AS parent_lastname,

                p.email,

                st.parent_phone AS phone,

                p.status,

                st.student_id,

                su.firstname AS student_firstname,
                su.lastname AS student_lastname

              FROM users p

              INNER JOIN students st
                  ON st.parent_id = p.user_id

              INNER JOIN users su
                  ON st.user_id = su.user_id

              WHERE p.rank = 'parent'

              AND p.school_id = :school_id";


    /*
    ========================================
    SEARCH
    ========================================
    */

    $params = [

        'school_id' => $school_id

    ];


    if ($search !== '') {

        $query .= "

            AND (

                CONCAT(
                    p.firstname,
                    ' ',
                    p.lastname
                ) LIKE :search1

                OR CONCAT(
                    su.firstname,
                    ' ',
                    su.lastname
                ) LIKE :search2

                OR p.email LIKE :search3

                OR st.parent_phone LIKE :search4

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
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "

        ORDER BY
            {$sortColumn}
            {$direction}
    ";


    /*
    ========================================
    EXECUTE
    ========================================
    */

    return $this->query(
        $query,
        $params
    );
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
}public function getAllClasses(
    $search = '',
    $sort = 'class',
    $direction = 'ASC'
) {
    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $allowedSorts = [
        'class'    => 'st.class',
        'division' => 'st.division',
        'students' => 'student_count',
        'status'   => 'status'
    ];


    if (!isset($allowedSorts[$sort])) {

        $sort = 'class';
    }


    $sortColumn =
        $allowedSorts[$sort];


    /*
    ========================================
    DIRECTION
    ========================================
    */

    $direction =
        strtoupper($direction);


    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'ASC';
    }


    /*
    ========================================
    QUERY
    ========================================
    */

    $query = "SELECT

                st.class,
                st.division,
                st.school_id,

                sc.school_name,

                COUNT(*) AS student_count,

                'active' AS status

              FROM students st

              LEFT JOIN schools sc
                ON st.school_id = sc.id

              WHERE st.status = 'active'";


    /*
    ========================================
    SEARCH
    ========================================
    */

    $params = [];


    if ($search !== '') {

        $query .= "
            AND (
                st.class LIKE :search
                OR st.division LIKE :search
                OR sc.school_name LIKE :search
            )
        ";

        $params['search'] =
            '%' . $search . '%';
    }


    /*
    ========================================
    GROUP
    ========================================
    */

    $query .= "

              GROUP BY
                st.class,
                st.division,
                st.school_id,
                sc.school_name";


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "

              ORDER BY
                {$sortColumn}
                {$direction}";


    return $this->query(
        $query,
        $params
    );
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

/*
=====================================================
GET STUDENT BY USER ID AND SCHOOL
=====================================================
*/

public function getStudentByUserIdAndSchool(
    $user_id,
    $school_id
) {
    $query = "SELECT
                st.student_id,
                st.user_id,
                st.school_id,
                st.class,
                st.division,
                st.status,

                u.firstname,
                u.lastname,
                u.email

              FROM students st

              INNER JOIN users u
              ON st.user_id = u.user_id

              WHERE st.user_id = :user_id

              AND st.school_id = :school_id

              AND st.status = 'active'

              LIMIT 1";

    $result = $this->query($query, [
        'user_id'   => $user_id,
        'school_id' => $school_id
    ]);

    return $result[0] ?? false;
}

/* =====================================================
   UPDATE STUDENT
===================================================== */

public function updateStudent(
    $student_id,
    $user_id,
    $userData,
    $studentData
) {

    /*
    =====================================================
    UPDATE USER INFORMATION
    =====================================================
    */

    $userQuery = "UPDATE users
                  SET
                      firstname = :firstname,
                      lastname = :lastname,
                      email = :email,
                      gender = :gender,
                      status = :status
                  WHERE user_id = :user_id
                  LIMIT 1";


    $userResult = $this->query(
        $userQuery,
        [
            'firstname' => $userData['firstname'],
            'lastname'  => $userData['lastname'],
            'email'     => $userData['email'],
            'gender'    => $userData['gender'],
            'status'    => $userData['status'],
            'user_id'   => $user_id
        ]
    );


    /*
    =====================================================
    UPDATE STUDENT INFORMATION
    =====================================================
    */

    $studentQuery = "UPDATE students
                     SET
                         admission_number = :admission_number,
                         class = :class,
                         division = :division,
                         roll_number = :roll_number,
                         date_of_birth = :date_of_birth,
                         admission_date = :admission_date,
                         parent_name = :parent_name,
                         parent_phone = :parent_phone,
                         parent_email = :parent_email,
                         address = :address,
                         school_id = :school_id,
                         status = :status
                     WHERE student_id = :student_id
                     LIMIT 1";


    $studentResult = $this->query(
        $studentQuery,
        [
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

            'parent_name' =>
                $studentData['parent_name'],

            'parent_phone' =>
                $studentData['parent_phone'],

            'parent_email' =>
                $studentData['parent_email'],

            'address' =>
                $studentData['address'],

            'school_id' =>
                $studentData['school_id'],

            'status' =>
                $studentData['status'],

            'student_id' =>
                $student_id
        ]
    );


    /*
    =====================================================
    RETURN RESULT
    =====================================================
    */

    if (
        $userResult === false ||
        $studentResult === false
    ) {

        return false;
    }


    return true;
}

/* =====================================================
   DEACTIVATE STUDENT
===================================================== */

public function deactivateStudent($student_id)
{
    // Get linked user ID
    $studentQuery = "SELECT user_id
                     FROM students
                     WHERE student_id = :student_id
                     LIMIT 1";

    $student = $this->query(
        $studentQuery,
        [
            'student_id' => $student_id
        ]
    );

    if (empty($student)) {
        return false;
    }

    $user_id = $student[0]->user_id;


    // -----------------------------------------------
    // Deactivate student record
    // -----------------------------------------------

    $studentQuery = "UPDATE students
                     SET status = 'inactive'
                     WHERE student_id = :student_id
                     LIMIT 1";

    $studentResult = $this->query(
        $studentQuery,
        [
            'student_id' => $student_id
        ]
    );


    // -----------------------------------------------
    // Deactivate linked user account
    // -----------------------------------------------

    $userQuery = "UPDATE users
                  SET status = 'inactive'
                  WHERE user_id = :user_id
                  LIMIT 1";

    $userResult = $this->query(
        $userQuery,
        [
            'user_id' => $user_id
        ]
    );


    if ($studentResult === false || $userResult === false) {
        return false;
    }


    return true;
}


/* =====================================================
   ACTIVATE STUDENT
===================================================== */
/* =====================================================
   ACTIVATE STUDENT
===================================================== */

public function activateStudent($student_id)
{
    // Get the linked user ID
    $studentQuery = "SELECT user_id
                     FROM students
                     WHERE student_id = :student_id
                     LIMIT 1";

    $student = $this->query(
        $studentQuery,
        [
            'student_id' => $student_id
        ]
    );

    if (empty($student)) {
        return false;
    }

    $user_id = $student[0]->user_id;


    // -----------------------------------------------
    // Activate student record
    // -----------------------------------------------

    $studentQuery = "UPDATE students
                     SET status = 'active'
                     WHERE student_id = :student_id
                     LIMIT 1";

    $studentResult = $this->query(
        $studentQuery,
        [
            'student_id' => $student_id
        ]
    );


    // -----------------------------------------------
    // Activate linked user account
    // -----------------------------------------------

    $userQuery = "UPDATE users
                  SET status = 'active'
                  WHERE user_id = :user_id
                  LIMIT 1";

    $userResult = $this->query(
        $userQuery,
        [
            'user_id' => $user_id
        ]
    );


    // -----------------------------------------------
    // Check both updates
    // -----------------------------------------------

    if ($studentResult === false || $userResult === false) {
        return false;
    }


    return true;
}
}