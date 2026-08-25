<?php

class TeacherTestsModel extends Model
{
    /*
    ========================================
    CREATE TEST
    ========================================
    */

    public function createTest($testData)
    {
        $query = "INSERT INTO tests
                    (
                        test_id,
                        teacher_id,
                        school_id,
                        title,
                        description,
                        class,
                        division,
                        total_marks,
                        duration,
                        start_date,
                        end_date,
                        status
                    )
                  VALUES
                    (
                        :test_id,
                        :teacher_id,
                        :school_id,
                        :title,
                        :description,
                        :class,
                        :division,
                        :total_marks,
                        :duration,
                        :start_date,
                        :end_date,
                        'draft'
                    )";

        return $this->query(
            $query,
            $testData
        );
    }


    /*
    ========================================
    GET TESTS BY SCHOOL
    ========================================
    */

    public function getTestsBySchool($school_id)
    {
        $query = "SELECT
                    test_id,
                    teacher_id,
                    school_id,
                    title,
                    description,
                    class,
                    division,
                    total_marks,
                    duration,
                    start_date,
                    end_date,
                    status,
                    created_at

                  FROM tests

                  WHERE school_id = :school_id

                  ORDER BY id DESC";

        return $this->query(
            $query,
            [
                'school_id' => $school_id
            ]
        );
    }

    /*
========================================
GET ALL TESTS
========================================
*/

public function getAllTests()
{
    $query = "SELECT
                test_id,
                teacher_id,
                school_id,
                title,
                description,
                class,
                division,
                total_marks,
                duration,
                start_date,
                end_date,
                status,
                created_at

              FROM tests

              ORDER BY id DESC";

    return $this->query(
        $query
    );
}

    /*
========================================
GET TEST BY ID
========================================
*/

public function getTestById(
    $test_id,
    $school_id
) {
    $query = "SELECT
                test_id,
                teacher_id,
                school_id,
                title,
                description,
                class,
                division,
                total_marks,
                duration,
                start_date,
                end_date,
                status,
                created_at

              FROM tests

              WHERE test_id = :test_id

              AND school_id = :school_id

              LIMIT 1";

    $result = $this->query(
        $query,
        [
            'test_id'   => $test_id,
            'school_id' => $school_id
        ]
    );

    return $result[0] ?? false;
}

/*
========================================
GET TEST BY ID - SUPER ADMIN
========================================
*/

public function getTestByIdAdmin($test_id)
{
    $query = "SELECT
                test_id,
                teacher_id,
                school_id,
                title,
                description,
                class,
                division,
                total_marks,
                duration,
                start_date,
                end_date,
                status,
                created_at

              FROM tests

              WHERE test_id = :test_id

              LIMIT 1";

    $result = $this->query(
        $query,
        [
            'test_id' => $test_id
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
                correct_answer,
                marks,
                created_at

              FROM test_questions

              WHERE test_id = :test_id

              ORDER BY id ASC";

    return $this->query(
        $query,
        [
            'test_id' => $test_id
        ]
    );
}

/*
========================================
CREATE QUESTION
========================================
*/

public function createQuestion($questionData)
{
    $query = "INSERT INTO test_questions
                (
                    question_id,
                    test_id,
                    question,
                    question_type,
                    option_a,
                    option_b,
                    option_c,
                    option_d,
                    correct_answer,
                    marks
                )
              VALUES
                (
                    :question_id,
                    :test_id,
                    :question,
                    :question_type,
                    :option_a,
                    :option_b,
                    :option_c,
                    :option_d,
                    :correct_answer,
                    :marks
                )";

    return $this->query(
        $query,
        $questionData
    );
}

/*
========================================
PUBLISH TEST
========================================
*/

public function publishTest(
    $test_id,
    $school_id
) {

    $query = "UPDATE tests

              SET status = 'active'

              WHERE test_id = :test_id

              AND school_id = :school_id

              AND status = 'draft'";

    return $this->query(
        $query,
        [
            'test_id'   => $test_id,
            'school_id' => $school_id
        ]
    );
}
}