<?php

class StaffModel extends Model
{
    /* =====================================================
       GET ALL STAFF
    ===================================================== */
public function getAllStaff(
    $search = '',
    $sort = 'staff_id',
    $direction = 'DESC',
    $status = '',
    $school_id = ''
) {

    $allowedSorts = [

        'staff_id'        => 's.staff_id',
        'name'            => 'u.firstname',
        'role'            => 's.designation',
        'department'      => 's.department',
        'school'          => 'sc.school_name',
        'email'           => 'u.email',
        'qualification'   => 's.qualification',
        'joining_date'    => 's.joining_date',
        'employment_type' => 's.employment_type',
        'status'          => 's.status'

    ];


    if (!isset($allowedSorts[$sort])) {
        $sort = 'staff_id';
    }


    $sortColumn = $allowedSorts[$sort];


    $direction = strtoupper($direction);

    if (!in_array($direction, ['ASC', 'DESC'], true)) {
        $direction = 'DESC';
    }


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
                u.profile_image,

                sc.school_name,
                sc.school_id AS school_code

              FROM staff s

              INNER JOIN users u
                  ON s.user_id = u.user_id

              LEFT JOIN schools sc
                  ON s.school_id = sc.id";


    $conditions = [];

    $params = [];


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    if ($search !== '') {

        $conditions[] = "(
            s.staff_id LIKE :search_staff_id
            OR s.department LIKE :search_department
            OR s.designation LIKE :search_designation
            OR s.qualification LIKE :search_qualification
            OR s.phone LIKE :search_phone
            OR u.firstname LIKE :search_firstname
            OR u.lastname LIKE :search_lastname
            OR u.email LIKE :search_email
            OR sc.school_name LIKE :search_school
        )";

        $searchValue = '%' . $search . '%';

        $params['search_staff_id'] = $searchValue;
        $params['search_department'] = $searchValue;
        $params['search_designation'] = $searchValue;
        $params['search_qualification'] = $searchValue;
        $params['search_phone'] = $searchValue;
        $params['search_firstname'] = $searchValue;
        $params['search_lastname'] = $searchValue;
        $params['search_email'] = $searchValue;
        $params['search_school'] = $searchValue;
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    if (
        $status !== '' &&
        in_array($status, ['active', 'inactive'], true)
    ) {

        $conditions[] = "s.status = :status";

        $params['status'] = $status;

    }


    /*
    |--------------------------------------------------------------------------
    | SCHOOL
    |--------------------------------------------------------------------------
    */

    if ($school_id !== '') {

        $conditions[] = "s.school_id = :school_id";

        $params['school_id'] = $school_id;

    }


    /*
    |--------------------------------------------------------------------------
    | WHERE
    |--------------------------------------------------------------------------
    */

    if (!empty($conditions)) {

        $query .= " WHERE " . implode(" AND ", $conditions);

    }


    /*
    |--------------------------------------------------------------------------
    | SORT
    |--------------------------------------------------------------------------
    */

    $query .= " ORDER BY {$sortColumn} {$direction}";


    return $this->query(
        $query,
        $params
    );
}
    /* =====================================================
       GET STAFF DETAILS
    ===================================================== */

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
u.profile_image,

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


    /* =====================================================
       STAFF COUNT BY SCHOOL
    ===================================================== */

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


    /* =====================================================
       GET STAFF BY SCHOOL
    ===================================================== */

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
                    u.profile_image,

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


    /* =====================================================
       GET TEACHERS BY SCHOOL
    ===================================================== */

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
                    u.profile_image,

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


    /* =====================================================
       GENERATE USER ID
       
       Example:
       USR001
       USR002
       USR003
    ===================================================== */

    private function generateUserId()
    {
        $query = "SELECT user_id
                  FROM users
                  WHERE user_id LIKE 'USR%'
                  ORDER BY id DESC
                  LIMIT 1";

        $result = $this->query($query);

        if (!$result) {
            return 'USR001';
        }

        $lastId = $result[0]->user_id;

        $number = (int) substr($lastId, 3);

        $number++;

        return 'USR' . str_pad(
            $number,
            3,
            '0',
            STR_PAD_LEFT
        );
    }


    /* =====================================================
       GENERATE STAFF ID

       Example:
       STF001
       STF002
       STF003
    ===================================================== */

    private function generateStaffId()
{
    $query = "SELECT staff_id
              FROM staff
              WHERE staff_id LIKE 'STF%'
              ORDER BY staff_id DESC
              LIMIT 1";

    $result = $this->query($query);

    if (!$result) {
        return 'STF001';
    }

    $lastId = $result[0]->staff_id;

    $number = (int) substr($lastId, 3);

    $number++;

    return 'STF' . str_pad(
        $number,
        3,
        '0',
        STR_PAD_LEFT
    );
}


    /* =====================================================
       CREATE STAFF
    ===================================================== */

    public function createStaff($userData, $staffData)
    {
        /*
        ========================================
        GENERATE USER ID
        ========================================
        */

        $user_id = $this->generateUserId();


        /*
        ========================================
        CREATE USER
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
    :rank,
    :password,
    :status,
    :profile_image
)";


        $userData['user_id'] = $user_id;
        $userData['profile_image'] =
        $userData['profile_image'] ?? null;


        $userCreated = $this->query(
            $userQuery,
            $userData
        );


        if (!$userCreated) {
            return false;
        }


        /*
        ========================================
        GENERATE STAFF ID
        ========================================
        */

        $staff_id = $this->generateStaffId();


        /*
        ========================================
        CREATE STAFF
        ========================================
        */

        $staffQuery = "INSERT INTO staff
                    (
                        staff_id,
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
                        :staff_id,
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


        $staffData['staff_id'] = $staff_id;

        $staffData['user_id'] = $user_id;


        return $this->query(
            $staffQuery,
            $staffData
        );
    }


    /* =====================================================
       STAFF DETAILS BY SCHOOL
    ===================================================== */

    public function getStaffDetailsBySchool(
        $staff_id,
        $school_id
    ) {
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
                    u.profile_image,

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

    /* =====================================================
   TOTAL STAFF COUNT
===================================================== */

public function getTotalStaffCount()
{
    $query = "SELECT COUNT(*) AS total
              FROM staff
              WHERE status = 'active'";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}

/* =====================================================
   UPDATE STAFF
===================================================== */

public function updateStaff(
    $staff_id,
    $user_id,
    $userData,
    $staffData
) {

    /*
    ========================================
    UPDATE USER
    ========================================
    */

    $userQuery = "UPDATE users
                  SET firstname = :firstname,
                      lastname = :lastname,
                      email = :email,
                      gender = :gender,
                      school_id = :school_id,
                      status = :status,
                      profile_image = :profile_image
                  WHERE user_id = :user_id
                  LIMIT 1";

    $userResult = $this->query(
        $userQuery,
        [
            'firstname'     => $userData['firstname'],
            'lastname'      => $userData['lastname'],
            'email'         => $userData['email'],
            'gender'        => $userData['gender'],
            'school_id'     => $userData['school_id'],
            'status'        => $userData['status'],
            'profile_image' => $userData['profile_image'],
            'user_id'       => $user_id
        ]
    );

    if ($userResult === false) {
        return false;
    }


    /*
    ========================================
    UPDATE STAFF
    ========================================
    */

    $staffQuery = "UPDATE staff
                   SET school_id = :school_id,
                       department = :department,
                       designation = :designation,
                       qualification = :qualification,
                       joining_date = :joining_date,
                       employment_type = :employment_type,
                       phone = :phone,
                       address = :address,
                       status = :status
                   WHERE staff_id = :staff_id
                   LIMIT 1";

    $staffResult = $this->query(
        $staffQuery,
        [
            'school_id'       => $staffData['school_id'],
            'department'      => $staffData['department'],
            'designation'     => $staffData['designation'],
            'qualification'   => $staffData['qualification'],
            'joining_date'    => $staffData['joining_date'],
            'employment_type' => $staffData['employment_type'],
            'phone'           => $staffData['phone'],
            'address'         => $staffData['address'],
            'status'          => $staffData['status'],
            'staff_id'        => $staff_id
        ]
    );

    if ($staffResult === false) {
        return false;
    }

    return true;
}
}