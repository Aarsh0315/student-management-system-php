<?php

class TeacherResultsModel extends Model
{
    /*
    ========================================
    CREATE RESULT
    ========================================
    */

    public function createResult($resultData)
    {
        $query = "INSERT INTO results
                    (
                        result_id,
                        test_id,
                        student_id,
                        school_id,
                        total_marks,
                        obtained_marks,
                        percentage,
                        status
                    )
                  VALUES
                    (
                        :result_id,
                        :test_id,
                        :student_id,
                        :school_id,
                        :total_marks,
                        :obtained_marks,
                        :percentage,
                        :status
                    )";

        return $this->query(
            $query,
            $resultData
        );
    }


    /*
========================================
GET RESULTS BY SCHOOL
SCHOOL ADMIN
========================================
*/
/*
========================================
GET RESULTS BY SCHOOL
SCHOOL ADMIN
========================================
*/
public function getResultsBySchool(
    $school_id,
    $search = '',
    $sort = 'result_id',
    $direction = 'DESC'
) {

    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $sortColumns = [

        'result_id'      => 'r.id',
        'student'        => 'u.firstname',
        'test'           => 't.title',
        'class'          => 'st.class',
        'total_marks'    => 'r.total_marks',
        'obtained_marks' => 'r.obtained_marks',
        'percentage'     => 'r.percentage',
        'status'         => 'r.status'

    ];


    /*
    ========================================
    VALIDATE SORT
    ========================================
    */

    $orderBy =
        $sortColumns[$sort] ?? 'r.id';


    /*
    ========================================
    VALIDATE DIRECTION
    ========================================
    */

    $direction =
        strtoupper($direction) === 'ASC'
        ? 'ASC'
        : 'DESC';


    /*
    ========================================
    QUERY
    ========================================
    */

    $query = "SELECT

                r.result_id,
                r.test_id,
                r.student_id,
                r.school_id,

                r.total_marks,
                r.obtained_marks,
                r.percentage,
                r.status,
                r.created_at,

                /* STUDENT */

                u.firstname AS student_firstname,
                u.lastname AS student_lastname,

                /* CLASS */

                st.class AS class,
                st.division AS division,

                /* SCHOOL */

                s.school_name,

                /* TEST */

                t.title AS test_title

              FROM results r


              /* STUDENT */

              LEFT JOIN students st
                ON r.student_id = st.student_id


              /* USER */

              LEFT JOIN users u
                ON st.user_id = u.user_id


              /* SCHOOL */

              LEFT JOIN schools s
                ON r.school_id = s.id


              /* TEST */

              LEFT JOIN tests t
                ON r.test_id = t.test_id


              /*
              ========================================
              TEACHER SCHOOL RESTRICTION
              ========================================
              */

              WHERE r.school_id = :school_id";


    /*
    ========================================
    PARAMETERS
    ========================================
    */

    $params = [

        'school_id' => $school_id

    ];


    /*
    ========================================
    SEARCH
    ========================================
    */

    if ($search !== '') {

        $query .= "
            AND (
                r.result_id LIKE :search1

                OR CONCAT(
                    u.firstname,
                    ' ',
                    u.lastname
                ) LIKE :search2

                OR t.title LIKE :search3

                OR st.class LIKE :search4

                OR st.division LIKE :search5

                OR r.status LIKE :search6
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

        $params['search5'] =
            $searchValue;

        $params['search6'] =
            $searchValue;
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "
        ORDER BY
        {$orderBy}
        {$direction}
    ";


    /*
    ========================================
    EXECUTE QUERY
    ========================================
    */

    return $this->query(
        $query,
        $params
    );
}
    /*
    ========================================
    GET RESULT BY ID
    ========================================
    */

    public function getResultById(
        $result_id,
        $school_id
    ) {
        $query = "SELECT
                    result_id,
                    test_id,
                    student_id,
                    school_id,
                    total_marks,
                    obtained_marks,
                    percentage,
                    status,
                    created_at

                  FROM results

                  WHERE result_id = :result_id

                  AND school_id = :school_id

                  LIMIT 1";

        $result = $this->query(
            $query,
            [
                'result_id' => $result_id,
                'school_id' => $school_id
            ]
        );

        return $result[0] ?? false;
    }


   /*
========================================
GET ALL RESULTS
SUPER ADMIN
========================================
*/

/*
========================================
GET ALL RESULTS
SUPER ADMIN
========================================
*/

public function getAllResults(
    $search = '',
    $sort = 'id',
    $direction = 'DESC'
) {

    $sortColumns = [

        'id'             => 'r.id',
        'student'        => 'u.firstname',
        'test'           => 't.title',
        'school'         => 's.school_name',
        'total_marks'    => 'r.total_marks',
        'obtained_marks' => 'r.obtained_marks',
        'percentage'     => 'r.percentage',
        'status'         => 'r.status'

    ];

    $orderBy =
        $sortColumns[$sort] ?? 'r.id';


    $direction =
        strtoupper($direction) === 'ASC'
        ? 'ASC'
        : 'DESC';


    $query = "SELECT

                r.result_id,
                r.test_id,
                r.student_id,
                r.school_id,

                r.total_marks,
                r.obtained_marks,
                r.percentage,
                r.status,
                r.created_at,

                /* STUDENT */

                u.firstname AS student_firstname,
                u.lastname AS student_lastname,

                /* SCHOOL */

                s.school_name,

                /* TEST */

                t.title AS test_title

              FROM results r


              /* STUDENT */

              LEFT JOIN students st
                ON r.student_id = st.student_id


              /* USER */

              LEFT JOIN users u
                ON st.user_id = u.user_id


              /* SCHOOL */

              LEFT JOIN schools s
                ON r.school_id = s.id


              /* TEST */

              LEFT JOIN tests t
                ON r.test_id = t.test_id

              WHERE 1";


    $params = [];


    /*
    ========================================
    SEARCH
    ========================================
    */

    if ($search !== '') {

        $query .= "
            AND (
                r.result_id LIKE :search1

                OR CONCAT(
                    u.firstname,
                    ' ',
                    u.lastname
                ) LIKE :search2

                OR t.title LIKE :search3

                OR s.school_name LIKE :search4

                OR r.status LIKE :search5
            )
        ";

        $searchValue = '%' . $search . '%';

        $params['search1'] = $searchValue;
        $params['search2'] = $searchValue;
        $params['search3'] = $searchValue;
        $params['search4'] = $searchValue;
        $params['search5'] = $searchValue;
    }


    /*
    ========================================
    SORT
    ========================================
    */

    $query .= "
        ORDER BY {$orderBy} {$direction}
    ";


    return $this->query(
        $query,
        $params
    );
}

    /*
    ========================================
    GET RESULT BY ID
    SUPER ADMIN
    ========================================
    */

    public function getResultByIdAdmin(
        $result_id
    ) {
        $query = "SELECT
                    result_id,
                    test_id,
                    student_id,
                    school_id,
                    total_marks,
                    obtained_marks,
                    percentage,
                    status,
                    created_at

                  FROM results

                  WHERE result_id = :result_id

                  LIMIT 1";

        $result = $this->query(
            $query,
            [
                'result_id' => $result_id
            ]
        );

        return $result[0] ?? false;
    }
}