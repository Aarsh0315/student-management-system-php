<?php

class StudentResultsModel extends Model
{
    /*
    ========================================
    GET STUDENT RESULTS
    ========================================
    */

    public function getStudentResults($student_id)
    {
        $query = "SELECT
                    r.result_id,
                    r.test_id,
                    r.student_id,
                    r.total_marks,
                    r.obtained_marks,
                    r.percentage,
                    r.status,
                    r.created_at,

                    t.title,
                    t.class,
                    t.division,
                    t.duration

                  FROM results r

                  INNER JOIN tests t
                  ON r.test_id = t.test_id

                  WHERE r.student_id = :student_id

                  ORDER BY r.created_at DESC";


        return $this->query(
            $query,
            [
                'student_id' => $student_id
            ]
        );
    }

 /*
========================================
GET RESULT DETAILS
========================================
*/

public function getResultDetails(
    $test_id,
    $student_id
) {

    $query = "SELECT
                q.question_id,
                q.question,
                q.question_type,
                q.option_a,
                q.option_b,
                q.option_c,
                q.option_d,
                q.correct_answer,
                q.marks,

                a.answer AS student_answer

              FROM test_questions q

              LEFT JOIN student_answers a

              ON q.question_id = a.question_id

              AND a.test_id = :test_id

              AND a.student_id = :student_id

              WHERE q.test_id = :question_test_id

              ORDER BY q.id ASC";


    return $this->query(
        $query,
        [
            'test_id'          => $test_id,
            'student_id'       => $student_id,
            'question_test_id' => $test_id
        ]
    );
}

/*
========================================
GET TOTAL RESULT COUNT
SUPER ADMIN DASHBOARD
========================================
*/
/*
========================================
GET TOTAL RESULT COUNT
SUPER ADMIN DASHBOARD
========================================
*/

public function getTotalResultCount()
{
    $query = "
        SELECT COUNT(*) AS total
        FROM results
    ";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}


}