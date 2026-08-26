<?php

class StudentTestsModel extends Model
{
    /*
    ========================================
    GET AVAILABLE TESTS
    ========================================
    */

    public function getAvailableTests(
        $school_id,
        $class,
        $division
    ) {

        $query = "SELECT
                    test_id,
                    teacher_id,
                    title,
                    description,
                    class,
                    division,
                    total_marks,
                    duration,
                    start_date,
                    end_date,
                    status

                  FROM tests

                  WHERE school_id = :school_id

                  AND class = :class

                  AND division = :division

                  AND status = 'active'

                  ORDER BY created_at DESC";


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
GET STUDENT RESULT FOR TEST
========================================
*/

public function getStudentResult(
    $test_id,
    $student_id
) {

    $query = "SELECT
                result_id,
                test_id,
                student_id,
                total_marks,
                obtained_marks,
                percentage,
                status,
                created_at

              FROM results

              WHERE test_id = :test_id

              AND student_id = :student_id

              LIMIT 1";

    $result = $this->query(
        $query,
        [
            'test_id'    => $test_id,
            'student_id' => $student_id
        ]
    );

    return $result[0] ?? false;
}

/*
========================================
GET QUESTIONS BY TEST
========================================
*/

public function getQuestionsByTest($test_id)
{
    $query = "SELECT
                question_id,
                test_id,
                question,
                question_type,
                option_a,
                option_b,
                option_c,
                option_d,
                marks

              FROM test_questions

              WHERE test_id = :test_id

              ORDER BY question_id ASC";

    return $this->query(
        $query,
        [
            'test_id' => $test_id
        ]
    );
}
}