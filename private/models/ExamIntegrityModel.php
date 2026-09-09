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
    DELETE EVENTS
    =====================================================
    */

    public function deleteEvents(
        $test_id,
        $student_id
    ) {

        $query = "DELETE FROM exam_events
                  WHERE test_id = :test_id
                  AND student_id = :student_id";

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

                    COALESCE(
                        SUM(
                            event_type = 'exam_started'
                        ),
                        0
                    ) AS exam_started,

                    COALESCE(
                        SUM(
                            event_type = 'camera_connected'
                        ),
                        0
                    ) AS camera_connected,

                    COALESCE(
                        SUM(
                            event_type = 'tab_switch'
                        ),
                        0
                    ) AS tab_switches,

                    COALESCE(
                        SUM(
                            event_type = 'fullscreen_entered'
                        ),
                        0
                    ) AS fullscreen_enters,

                    COALESCE(
                        SUM(
                            event_type = 'fullscreen_exited'
                        ),
                        0
                    ) AS fullscreen_exits,

                    COALESCE(
                        SUM(
                            event_type = 'copy_attempt'
                        ),
                        0
                    ) AS copy_attempts,

                    COALESCE(
                        SUM(
                            event_type = 'paste_attempt'
                        ),
                        0
                    ) AS paste_attempts,

                    COALESCE(
                        SUM(
                            event_type = 'right_click_attempt'
                        ),
                        0
                    ) AS right_click_attempts,

                    COALESCE(
                        SUM(
                            event_type = 'camera_disconnected'
                        ),
                        0
                    ) AS camera_disconnects,

                    COALESCE(
                        SUM(
                            event_type = 'exam_submitted'
                        ),
                        0
                    ) AS exam_submitted

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
        CAMERA DISCONNECT
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