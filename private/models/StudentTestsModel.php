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
}