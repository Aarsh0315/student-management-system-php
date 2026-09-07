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

    /*
    ========================================
    ALLOWED SORT COLUMNS
    ========================================
    */

    $allowedSorts = [

        'test_id'     => 't.test_id',
        'title'       => 't.title',
        'class'       => 't.class',
        'division'    => 't.division',
        'total_marks' => 't.total_marks',
        'duration'    => 't.duration',
        'status'      => 't.status'

    ];


    if (!isset($allowedSorts[$sort])) {
        $sort = 'test_id';
    }


    $sortColumn = $allowedSorts[$sort];


    /*
    ========================================
    DIRECTION
    ========================================
    */

    $direction = strtoupper($direction);

    if (!in_array(
        $direction,
        ['ASC', 'DESC'],
        true
    )) {
        $direction = 'DESC';
    }


    /*
    ========================================
    QUERY
    ========================================
    */

    $query = "SELECT

                t.test_id,
                t.teacher_id,
                t.school_id,
                t.title,
                t.description,
                t.class,
                t.division,
                t.total_marks,
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


    /*
    ========================================
    SEARCH
    ========================================
    */

    if ($search !== '') {

        $query .= "
            AND (
                t.test_id LIKE :search
                OR t.title LIKE :search
                OR t.class LIKE :search
                OR t.division LIKE :search
                OR t.status LIKE :search
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
    /*
========================================
GET ALL TESTS
========================================
*/
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
                test_id LIKE :search1
                OR title LIKE :search2
                OR class LIKE :search3
                OR division LIKE :search4
                OR status LIKE :search5
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