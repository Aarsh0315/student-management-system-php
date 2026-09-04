<?php

class School extends Model
{
    protected $table = "schools";


    public function getAllSchools(
    $search = '',
    $sort = 'id',
    $direction = 'DESC',
    $status = ''
)

{
    /*
    =================================================
    ALLOWED SORT COLUMNS
    =================================================
    */

    $allowedSorts = [
        'id'          => 'schools.id',
        'school_name' => 'schools.school_name',
        'school_id'   => 'schools.school_id',
        'email'       => 'schools.email',
        'phone'       => 'schools.phone',
        'status'      => 'schools.status'
    ];


    /*
    =================================================
    VALIDATE SORT
    =================================================
    */

    if (!isset($allowedSorts[$sort])) {
        $sort = 'id';
    }

    $sortColumn = $allowedSorts[$sort];


    /*
    =================================================
    VALIDATE DIRECTION
    =================================================
    */

    $direction = strtoupper($direction);

    if (!in_array($direction, ['ASC', 'DESC'], true)) {
        $direction = 'DESC';
    }


    /*
    =================================================
    BASE QUERY + STUDENT COUNT
    =================================================
    */

    $query = "SELECT
                schools.*,
                (
                    SELECT COUNT(students.student_id)
                    FROM students
                    WHERE students.school_id = schools.id
                ) AS student_count
              FROM schools";


    /*
    =================================================
    SEARCH
    =================================================
    */

    $params = [];

    $params = [];

$conditions = [];

if ($search !== '') {

    $conditions[] = "
        schools.school_name LIKE :search
    ";

    $params['search'] = '%' . $search . '%';
}


if ($status !== '' && in_array($status, ['active', 'inactive'], true)) {

    $conditions[] = "
        schools.status = :status
    ";

    $params['status'] = $status;
}


if (!empty($conditions)) {

    $query .= "
        WHERE " . implode(" AND ", $conditions);
}


    /*
    =================================================
    SORT
    =================================================
    */

    $query .= "
        ORDER BY {$sortColumn} {$direction}
    ";


    /*
    =================================================
    EXECUTE
    =================================================
    */

    return $this->query($query, $params);
}


    public function findBySchoolId($school_id)
    {
        $query = "SELECT *
                  FROM schools
                  WHERE school_id = :school_id
                  LIMIT 1";

        $result = $this->query($query, [
            'school_id' => $school_id
        ]);

        if (!empty($result)) {
            return $result[0];
        }

        return false;
    }

public function getRoleCounts($school_id)
{
    $query = "SELECT
                'student' AS rank,
                COUNT(students.student_id) AS total
              FROM students
              INNER JOIN schools
                  ON schools.id = students.school_id
              WHERE schools.school_id = :student_school_id

              UNION ALL

              SELECT
                users.rank,
                COUNT(*) AS total
              FROM users
              INNER JOIN schools
                  ON schools.id = users.school_id
              WHERE schools.school_id = :user_school_id
              AND users.rank IN (
                  'teacher',
                  'admin',
                  'principal',
                  'vice_principal',
                  'parent',
                  'staff'
              )
              GROUP BY users.rank";

    return $this->query($query, [
        'student_school_id' => $school_id,
        'user_school_id'    => $school_id
    ]);
}

public function createSchool($data)
{
    $query = "INSERT INTO schools
    (
        school_id,
        school_name,
        school_code,
        email,
        phone,
        emergency_contact,
        website,
        address,
        board,
        medium,
        school_type,
        academic_year,
        established_year,
        status
    )
    VALUES
    (
        :school_id,
        :school_name,
        :school_code,
        :email,
        :phone,
        :emergency_contact,
        :website,
        :address,
        :board,
        :medium,
        :school_type,
        :academic_year,
        :established_year,
        :status
    )";

    return $this->query($query, $data);
}

/* =====================================================
   TOTAL SCHOOL COUNT
===================================================== */

public function getTotalSchoolCount()
{
    $query = "SELECT COUNT(*) AS total
              FROM schools
              WHERE status = 'active'";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}

/*
=====================================================
GET RECENT SCHOOLS
SUPER ADMIN DASHBOARD
=====================================================
*/

/*
=====================================================
GET RECENT SCHOOLS
SUPER ADMIN DASHBOARD
=====================================================
*/

public function getRecentSchools($limit = 3)
{
    $limit = (int) $limit;

    $query = "
        SELECT
            id,
            school_id,
            school_name
        FROM schools
        ORDER BY id DESC
        LIMIT $limit
    ";

    return $this->query($query);
}

public function updateSchool($school_id, $data)
{
    $query = "UPDATE schools
              SET
                  school_name = :school_name,
                  school_code = :school_code,
                  email = :email,
                  phone = :phone,
                  emergency_contact = :emergency_contact,
                  website = :website,
                  address = :address,
                  board = :board,
                  medium = :medium,
                  school_type = :school_type,
                  academic_year = :academic_year,
                  established_year = :established_year,
                  status = :status
              WHERE school_id = :school_id
              LIMIT 1";

    return $this->query($query, [
        'school_name'       => $data['school_name'],
        'school_code'       => $data['school_code'],
        'email'             => $data['email'],
        'phone'             => $data['phone'],
        'emergency_contact' => $data['emergency_contact'],
        'website'           => $data['website'],
        'address'           => $data['address'],
        'board'             => $data['board'],
        'medium'            => $data['medium'],
        'school_type'       => $data['school_type'],
        'academic_year'     => $data['academic_year'],
        'established_year'  => $data['established_year'],
        'status'            => $data['status'],
        'school_id'         => $school_id
    ]);
}

public function deactivateSchool($school_id)
{
    /*
    ========================================
    GET INTERNAL SCHOOL ID
    ========================================
    */

    $schoolQuery = "SELECT id
                    FROM schools
                    WHERE school_id = :school_id
                    LIMIT 1";

    $schoolResult = $this->query(
        $schoolQuery,
        [
            'school_id' => $school_id
        ]
    );

    $school = $schoolResult[0] ?? null;

    if (!$school) {
        return false;
    }

    $internalSchoolId = $school->id;


    /*
    ========================================
    DEACTIVATE SCHOOL
    ========================================
    */

    $schoolUpdate = "UPDATE schools
                     SET status = 'inactive'
                     WHERE id = :school_id
                     LIMIT 1";

    $this->query(
        $schoolUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    DEACTIVATE ALL USERS
    ========================================
    */

    $userUpdate = "UPDATE users
                   SET status = 'inactive'
                   WHERE school_id = :school_id";

    $this->query(
        $userUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    DEACTIVATE STUDENT RECORDS
    ========================================
    */

    $studentUpdate = "UPDATE students
                      SET status = 'inactive'
                      WHERE school_id = :school_id";

    $this->query(
        $studentUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    DEACTIVATE STAFF RECORDS
    ========================================
    */

    $staffUpdate = "UPDATE staff
                    SET status = 'inactive'
                    WHERE school_id = :school_id";

    $this->query(
        $staffUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    return true;
}

public function activateSchool($school_id)
{
    /*
    ========================================
    GET INTERNAL SCHOOL ID
    ========================================
    */

    $schoolQuery = "SELECT id
                    FROM schools
                    WHERE school_id = :school_id
                    LIMIT 1";

    $schoolResult = $this->query(
        $schoolQuery,
        [
            'school_id' => $school_id
        ]
    );

    $school = $schoolResult[0] ?? null;

    if (!$school) {
        return false;
    }

    $internalSchoolId = $school->id;


    /*
    ========================================
    ACTIVATE SCHOOL
    ========================================
    */

    $schoolUpdate = "UPDATE schools
                     SET status = 'active'
                     WHERE id = :school_id
                     LIMIT 1";

    $this->query(
        $schoolUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    ACTIVATE USERS
    ========================================
    */

    $userUpdate = "UPDATE users
                   SET status = 'active'
                   WHERE school_id = :school_id";

    $this->query(
        $userUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    ACTIVATE STUDENTS
    ========================================
    */

    $studentUpdate = "UPDATE students
                      SET status = 'active'
                      WHERE school_id = :school_id";

    $this->query(
        $studentUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    /*
    ========================================
    ACTIVATE STAFF
    ========================================
    */

    $staffUpdate = "UPDATE staff
                    SET status = 'active'
                    WHERE school_id = :school_id";

    $this->query(
        $staffUpdate,
        [
            'school_id' => $internalSchoolId
        ]
    );


    return true;
}
}