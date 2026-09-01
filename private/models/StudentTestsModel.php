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


    /*
    ========================================
    GET STUDENT TEST ATTEMPT
    ========================================
    */

    public function getStudentAttempt(
        $test_id,
        $student_id
    ) {

        $query = "SELECT
                    id,
                    test_id,
                    student_id,
                    started_at,
                    submitted_at,
                    status

                  FROM student_test_attempts

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
    START STUDENT TEST
    ========================================
    */

    public function startAttempt(
        $test_id,
        $student_id
    ) {

        /*
        Check if an attempt already exists
        */

        $existing = $this->getStudentAttempt(
            $test_id,
            $student_id
        );

        if ($existing) {

            return $existing;
        }


        /*
        Create new attempt
        */

        $query = "INSERT INTO student_test_attempts
                  (
                      test_id,
                      student_id,
                      started_at,
                      status
                  )

                  VALUES
                  (
                      :test_id,
                      :student_id,
                      NOW(),
                      'in_progress'
                  )";

        $this->query(
            $query,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );


        /*
        Return newly created attempt
        */

        return $this->getStudentAttempt(
            $test_id,
            $student_id
        );
    }


    /*
    ========================================
    SUBMIT STUDENT ATTEMPT
    ========================================
    */

    public function submitAttempt(
        $test_id,
        $student_id
    ) {

        $query = "UPDATE student_test_attempts

                  SET
                      status = 'submitted',
                      submitted_at = NOW()

                  WHERE test_id = :test_id

                  AND student_id = :student_id

                  AND status = 'in_progress'";

        return $this->query(
            $query,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );
    }


    /*
    ========================================
    CHECK IF TEST WAS ALREADY ATTEMPTED
    ========================================
    */

    public function hasAttemptedTest(
        $test_id,
        $student_id
    ) {

        $query = "SELECT id

                  FROM student_test_attempts

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

        return !empty($result);
    }


    /*
    ========================================
    CHECK IF ATTEMPT IS IN PROGRESS
    ========================================
    */

    public function isAttemptInProgress(
        $test_id,
        $student_id
    ) {

        $query = "SELECT id

                  FROM student_test_attempts

                  WHERE test_id = :test_id

                  AND student_id = :student_id

                  AND status = 'in_progress'

                  LIMIT 1";

        $result = $this->query(
            $query,
            [
                'test_id'    => $test_id,
                'student_id' => $student_id
            ]
        );

        return !empty($result);
    }

    /*
========================================
GET TOTAL TEST COUNT
SUPER ADMIN DASHBOARD
========================================
*/

/*
========================================
GET TOTAL TEST COUNT
SUPER ADMIN DASHBOARD
========================================
*/

/*
========================================
GET TOTAL TEST COUNT
SUPER ADMIN DASHBOARD
========================================
*/

public function getTotalTestCount()
{
    $query = "
        SELECT COUNT(*) AS total
        FROM tests
    ";

    $result = $this->query($query);

    return $result[0]->total ?? 0;
}
}