<?php

class ExamIntegrityModel extends Model
{
    protected $table = "exam_events";


    /*
    =====================================================
    LOG EVENT
    =====================================================
    */

    public function logEvent(
        $test_id,
        $student_id,
        $event_type,
        $event_details = null
    ) {

        $query = "INSERT INTO exam_events
                  (
                      test_id,
                      student_id,
                      event_type,
                      event_details
                  )
                  VALUES
                  (
                      :test_id,
                      :student_id,
                      :event_type,
                      :event_details
                  )";

        return $this->query(
            $query,
            [
                'test_id' =>
                    $test_id,

                'student_id' =>
                    $student_id,

                'event_type' =>
                    $event_type,

                'event_details' =>
                    $event_details
            ]
        );
    }


    /*
    =====================================================
    GET ALL EVENTS
    =====================================================
    */

    public function getEvents(
        $test_id,
        $student_id
    ) {

        $query = "SELECT
                    event_type,
                    event_details,
                    created_at
                  FROM exam_events
                  WHERE test_id = :test_id
                  AND student_id = :student_id
                  ORDER BY created_at ASC";

        return $this->query(
            $query,
            [
                'test_id' =>
                    $test_id,

                'student_id' =>
                    $student_id
            ]
        );
    }


    /*
    =====================================================
    COUNT EVENT
    =====================================================
    */

    public function countEvent(
        $test_id,
        $student_id,
        $event_type
    ) {

        $query = "SELECT
                    COUNT(*) AS total
                  FROM exam_events
                  WHERE test_id = :test_id
                  AND student_id = :student_id
                  AND event_type = :event_type";

        $result = $this->query(
            $query,
            [
                'test_id' =>
                    $test_id,

                'student_id' =>
                    $student_id,

                'event_type' =>
                    $event_type
            ]
        );

        return (int) (
            $result[0]->total ?? 0
        );
    }


    /*
    =====================================================
    GET INTEGRITY SUMMARY
    =====================================================
    */

    public function getIntegritySummary(
        $test_id,
        $student_id
    ) {

        $query = "SELECT

                    COUNT(*) AS total_events,

                    SUM(
                        event_type = 'tab_switch'
                    ) AS tab_switches,

                    SUM(
                        event_type = 'fullscreen_exited'
                    ) AS fullscreen_exits,

                    SUM(
                        event_type = 'copy_attempt'
                    ) AS copy_attempts,

                    SUM(
                        event_type = 'paste_attempt'
                    ) AS paste_attempts,

                    SUM(
                        event_type = 'right_click_attempt'
                    ) AS right_click_attempts,

                    SUM(
                        event_type = 'camera_disconnected'
                    ) AS camera_disconnects

                  FROM exam_events

                  WHERE test_id = :test_id

                  AND student_id = :student_id";

        $result = $this->query(
            $query,
            [
                'test_id' =>
                    $test_id,

                'student_id' =>
                    $student_id
            ]
        );

        return $result[0] ?? false;
    }


    /*
    =====================================================
    CALCULATE RISK
    =====================================================
    */

    public function getRiskLevel(
        $test_id,
        $student_id
    ) {

        $summary =
            $this->getIntegritySummary(
                $test_id,
                $student_id
            );


        if (!$summary) {

            return 'LOW';

        }


        $score = 0;


        /*
        -----------------------------------------
        TAB SWITCH
        -----------------------------------------
        */

        $score +=
            ((int) $summary->tab_switches) * 2;


        /*
        -----------------------------------------
        FULLSCREEN EXIT
        -----------------------------------------
        */

        $score +=
            ((int) $summary->fullscreen_exits) * 3;


        /*
        -----------------------------------------
        COPY
        -----------------------------------------
        */

        $score +=
            ((int) $summary->copy_attempts) * 3;


        /*
        -----------------------------------------
        PASTE
        -----------------------------------------
        */

        $score +=
            ((int) $summary->paste_attempts) * 3;


        /*
        -----------------------------------------
        RIGHT CLICK
        -----------------------------------------
        */

        $score +=
            ((int) $summary->right_click_attempts) * 1;


        /*
        -----------------------------------------
        CAMERA
        -----------------------------------------
        */

        $score +=
            ((int) $summary->camera_disconnects) * 4;


        /*
        -----------------------------------------
        RISK LEVEL
        -----------------------------------------
        */

        if ($score >= 8) {

            return 'HIGH';

        }


        if ($score >= 3) {

            return 'MEDIUM';

        }


        return 'LOW';
    }
}