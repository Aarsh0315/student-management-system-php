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
        $testData['subject'] =
            $testData['subject'] ?? null;

        $testData['test_type'] =
            $testData['test_type'] ?? 'quiz';

        $testData['instructions'] =
            $testData['instructions'] ?? null;

        $testData['passing_marks'] =
            $testData['passing_marks'] ?? 0;

        $testData['negative_marking'] =
            $testData['negative_marking'] ?? 0;

        $testData['negative_marks'] =
            $testData['negative_marks'] ?? 0;

        $testData['shuffle_questions'] =
            $testData['shuffle_questions'] ?? 0;

        $testData['shuffle_options'] =
            $testData['shuffle_options'] ?? 0;


        $query = "INSERT INTO tests
                    (
                        test_id,
                        teacher_id,
                        school_id,
                        title,
                        subject,
                        test_type,
                        description,
                        instructions,
                        class,
                        division,
                        total_marks,
                        passing_marks,
                        negative_marking,
                        negative_marks,
                        shuffle_questions,
                        shuffle_options,
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
                        :subject,
                        :test_type,
                        :description,
                        :instructions,
                        :class,
                        :division,
                        :total_marks,
                        :passing_marks,
                        :negative_marking,
                        :negative_marks,
                        :shuffle_questions,
                        :shuffle_options,
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

    public function getTestsBySchool(
        $school_id,
        $search = '',
        $sort = 'test_id',
        $direction = 'DESC'
    ) {

        $allowedSorts = [

            'test_id'     => 't.test_id',
            'title'       => 't.title',
            'subject'     => 't.subject',
            'test_type'   => 't.test_type',
            'class'       => 't.class',
            'division'    => 't.division',
            'total_marks' => 't.total_marks',
            'duration'    => 't.duration',
            'status'      => 't.status'

        ];


        if (!isset($allowedSorts[$sort])) {
            $sort = 'test_id';
        }


        $sortColumn =
            $allowedSorts[$sort];


        $direction =
            strtoupper($direction);


        if (!in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )) {
            $direction = 'DESC';
        }


        $query = "SELECT

                    t.test_id,
                    t.teacher_id,
                    t.school_id,
                    t.title,
                    t.subject,
                    t.test_type,
                    t.description,
                    t.instructions,
                    t.class,
                    t.division,
                    t.total_marks,
                    t.passing_marks,
                    t.negative_marking,
                    t.negative_marks,
                    t.shuffle_questions,
                    t.shuffle_options,
                    t.duration,
                    t.start_date,
                    t.end_date,
                    t.status,
                    t.created_at

                  FROM tests t

                  WHERE t.school_id = :school_id";


        $params = [
            'school_id' => $school_id
        ];


        if ($search !== '') {

            $query .= "
                AND (
                    t.test_id LIKE :search
                    OR t.title LIKE :search
                    OR t.subject LIKE :search
                    OR t.test_type LIKE :search
                    OR t.class LIKE :search
                    OR t.division LIKE :search
                    OR t.status LIKE :search
                )
            ";

            $params['search'] =
                '%' . $search . '%';
        }


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


    /*
    ========================================
    GET ALL TESTS
    ========================================
    */

    public function getAllTests(
        $search = '',
        $sort = 'id',
        $direction = 'DESC'
    ) {

        $sortColumns = [

            'id'       => 'id',
            'name'     => 'title',
            'subject'  => 'subject',
            'type'     => 'test_type',
            'class'    => 'class',
            'division' => 'division',
            'marks'    => 'total_marks',
            'duration' => 'duration',
            'status'   => 'status'

        ];


        $orderBy =
            $sortColumns[$sort] ?? 'id';


        $direction =
            strtoupper($direction) === 'ASC'
            ? 'ASC'
            : 'DESC';


        $query = "SELECT

                    test_id,
                    teacher_id,
                    school_id,
                    title,
                    subject,
                    test_type,
                    description,
                    instructions,
                    class,
                    division,
                    total_marks,
                    passing_marks,
                    negative_marking,
                    negative_marks,
                    shuffle_questions,
                    shuffle_options,
                    duration,
                    start_date,
                    end_date,
                    status,
                    created_at

                  FROM tests

                  WHERE 1";


        $params = [];


        if ($search !== '') {

            $query .= "
                AND (
                    test_id LIKE :search1
                    OR title LIKE :search2
                    OR subject LIKE :search3
                    OR test_type LIKE :search4
                    OR class LIKE :search5
                    OR division LIKE :search6
                    OR status LIKE :search7
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

            $params['search7'] =
                $searchValue;
        }


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
                    subject,
                    test_type,
                    description,
                    instructions,
                    class,
                    division,
                    total_marks,
                    passing_marks,
                    negative_marking,
                    negative_marks,
                    shuffle_questions,
                    shuffle_options,
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
                    subject,
                    test_type,
                    description,
                    instructions,
                    class,
                    division,
                    total_marks,
                    passing_marks,
                    negative_marking,
                    negative_marks,
                    shuffle_questions,
                    shuffle_options,
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
                correct_answers,
                explanation,
                difficulty,
                question_image,
                question_order,
                marks,
                created_at

              FROM test_questions

              WHERE test_id = :test_id

              ORDER BY question_order ASC, id ASC";


    $questions = $this->query(
        $query,
        [
            'test_id' => $test_id
        ]
    );


    /*
    ========================================
    DECODE MSQ ANSWERS
    ========================================
    */

    foreach ($questions as $question) {

        if (
            isset($question->correct_answers) &&
            $question->correct_answers !== null &&
            $question->correct_answers !== ''
        ) {

            $decoded =
                json_decode(
                    $question->correct_answers,
                    true
                );


            $question->correct_answers =
                is_array($decoded)
                ? $decoded
                : [];

        } else {

            $question->correct_answers = [];
        }
    }


    return $questions;
}
    /*
    ========================================
    CREATE QUESTION
    ========================================
    */

    public function createQuestion($questionData)
    {
        /*
        ========================================
        DEFAULT VALUES
        ========================================
        */

        $questionData['option_a'] =
            $questionData['option_a'] ?? null;

        $questionData['option_b'] =
            $questionData['option_b'] ?? null;

        $questionData['option_c'] =
            $questionData['option_c'] ?? null;

        $questionData['option_d'] =
            $questionData['option_d'] ?? null;

        $questionData['correct_answer'] =
            $questionData['correct_answer'] ?? null;

        $questionData['correct_answers'] =
            $questionData['correct_answers'] ?? null;

        $questionData['explanation'] =
            $questionData['explanation'] ?? null;

        $questionData['difficulty'] =
            $questionData['difficulty'] ?? 'medium';

        $questionData['question_image'] =
            $questionData['question_image'] ?? null;

        $questionData['question_order'] =
            $questionData['question_order'] ?? 0;


        /*
        ========================================
        ENCODE MSQ ANSWERS
        ========================================
        */

        if (
            is_array(
                $questionData['correct_answers']
            )
        ) {

            $questionData['correct_answers'] =
                json_encode(
                    array_values(
                        $questionData['correct_answers']
                    )
                );
        }


        /*
        ========================================
        INSERT QUESTION
        ========================================
        */

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
                    correct_answers,
                    explanation,
                    difficulty,
                    question_image,
                    question_order,
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
                    :correct_answers,
                    :explanation,
                    :difficulty,
                    :question_image,
                    :question_order,
                    :marks
                )";


        return $this->query(
            $query,
            $questionData
        );
    }


    /*
    ========================================
    DELETE TEST
    ========================================
    */

    public function deleteTest(
        $test_id,
        $school_id
    ) {

        /*
        ----------------------------------------
        VERIFY TEST BELONGS TO SCHOOL
        ----------------------------------------
        */

        $testQuery = "SELECT
                        test_id
                      FROM tests
                      WHERE test_id = :test_id
                      AND school_id = :school_id
                      LIMIT 1";

        $test = $this->query(
            $testQuery,
            [
                'test_id'   => $test_id,
                'school_id' => $school_id
            ]
        );

        if (empty($test)) {
            return false;
        }


        /*
        ----------------------------------------
        DELETE RELATED INTEGRITY EVENTS
        ----------------------------------------
        */

        $this->query(
            "DELETE FROM exam_events
             WHERE test_id = :test_id",
            [
                'test_id' => $test_id
            ]
        );


        /*
        ----------------------------------------
        DELETE TEST QUESTIONS
        ----------------------------------------
        */

        $this->query(
            "DELETE FROM test_questions
             WHERE test_id = :test_id",
            [
                'test_id' => $test_id
            ]
        );


        /*
        ----------------------------------------
        DELETE TEST RESULTS
        ----------------------------------------
        */

        $this->query(
            "DELETE FROM results
             WHERE test_id = :test_id",
            [
                'test_id' => $test_id
            ]
        );


        /*
        ----------------------------------------
        DELETE STUDENT ATTEMPTS
        ----------------------------------------
        */

        $this->query(
            "DELETE FROM student_test_attempts
             WHERE test_id = :test_id",
            [
                'test_id' => $test_id
            ]
        );


        /*
        ----------------------------------------
        DELETE TEST
        ----------------------------------------
        */

        $deleted = $this->query(
            "DELETE FROM tests
             WHERE test_id = :test_id
             AND school_id = :school_id
             LIMIT 1",
            [
                'test_id'   => $test_id,
                'school_id' => $school_id
            ]
        );


        return $deleted;
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


    /*
    ========================================
    GET ACTIVE TESTS BY CLASS & DIVISION
    ========================================
    */

    public function getTestsByClassDivision(
        $school_id,
        $class,
        $division
    ) {

        $query = "SELECT

                    test_id,
                    teacher_id,
                    school_id,
                    title,
                    subject,
                    test_type,
                    description,
                    instructions,
                    class,
                    division,
                    total_marks,
                    passing_marks,
                    negative_marking,
                    negative_marks,
                    shuffle_questions,
                    shuffle_options,
                    duration,
                    start_date,
                    end_date,
                    status,
                    created_at

                  FROM tests

                  WHERE school_id = :school_id

                  AND class = :class

                  AND division = :division

                  AND status = 'active'

                  ORDER BY id DESC";


        return $this->query(
            $query,
            [
                'school_id' => $school_id,
                'class'     => $class,
                'division'  => $division
            ]
        );
    }
}