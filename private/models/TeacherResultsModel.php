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
public function getResultsBySchool($school_id)
{
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

                u.firstname AS student_firstname,
                u.lastname AS student_lastname,

                st.class AS class,
                st.division AS division,

                s.school_name,
                t.title AS test_title

              FROM results r

              LEFT JOIN students st
                    ON r.student_id = st.student_id

              LEFT JOIN users u
                    ON st.user_id = u.user_id

              LEFT JOIN schools s
                    ON r.school_id = s.id

              LEFT JOIN tests t
                    ON r.test_id = t.test_id

              WHERE r.school_id = :school_id

              ORDER BY r.id DESC";

    return $this->query(
        $query,
        [
            'school_id' => $school_id
        ]
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

public function getAllResults()
{
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


              ORDER BY r.id DESC";

    return $this->query(
        $query
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