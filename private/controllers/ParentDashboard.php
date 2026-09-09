<?php

class ParentDashboard extends Controller
{
    public function index()
    {
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        CHECK LOGIN
        ========================================
        */

        if (!isset($_SESSION['user_id'])) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        CHECK PARENT
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'parent'
        ) {

            header(
                "Location: " .
                ROOT .
                "/home"
            );

            exit;
        }


        /*
        ========================================
        GET PARENT USER ID
        ========================================
        */

        $parent_id =
            $_SESSION['user_id'] ?? null;


        if (!$parent_id) {

            die(
                "Parent user ID not found."
            );
        }


        /*
        ========================================
        GET SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this parent."
            );
        }


        /*
        ========================================
        LOAD PARENT MODEL
        ========================================
        */

        $parentModel =
            $this->model('ParentModel');


        /*
        ========================================
        GET PARENT DETAILS
        ========================================
        */

        $parent =
            $parentModel->getParentByUserId(
                $parent_id
            );


        if (!$parent) {

            die(
                "Parent account not found."
            );
        }


        /*
        ========================================
        GET CHILDREN
        ========================================
        */

        $children =
            $parentModel->getDashboardChildren(
                $parent_id
            );


        /*
        ========================================
        CHILDREN COUNT
        ========================================
        */

        $childCount =
            $parentModel->getChildrenCount(
                $parent_id
            );


        $testCount = 0;
$resultCount = 0;

// Calculate test and result counts from parent's children
if (!empty($children)) {

    $studentTestsModel = $this->model('StudentTestsModel');

    foreach ($children as $child) {

        if (!empty($child->class) && !empty($child->division)) {

            $childTestCount = $studentTestsModel->getStudentTestCount(
                $school_id,
                $child->class,
                $child->division
            );

            $testCount += (int) $childTestCount;
        }

        if (!empty($child->student_id)) {

            $childResultCount = $studentTestsModel->getStudentResultCount(
                $child->student_id
            );

            $resultCount += (int) $childResultCount;
        }
    }
}


        /*
        ========================================
        LOAD EVENT MODEL
        ========================================
        */

        $eventModel =
            $this->model('EventModel');


        /*
        ========================================
        UPCOMING EVENTS
        ========================================
        
        Parent can view events belonging
        to their own school.

        Events created by both:
        - School Admin
        - Teacher

        will be visible because we are filtering
        by school_id, not created_by.
        */

        $upcomingEvents =
            $eventModel->getUpcomingEvents(
                $school_id,
                5
            );


        /*
        ========================================
        LOAD ANNOUNCEMENT MODEL
        ========================================
        */

        $announcementModel =
            $this->model('AnnouncementModel');


        /*
        ========================================
        RECENT ANNOUNCEMENTS
        ========================================
        
        Parent can view announcements belonging
        to their own school.

        Announcements created by both:
        - School Admin
        - Teacher

        will be visible.
        */

        $recentAnnouncements =
            $announcementModel->getRecentAnnouncements(
                $school_id,
                5
            );


        /*
        ========================================
        RECENT ACTIVITY
        ========================================
        
        Keep this empty for now.

        The dashboard view has a fallback that
        displays the parent's children here
        when no activity data is available.
        */

        $recentActivity = [];


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'parent-dashboard',
            [

                /*
                Parent information
                */

                'parent' =>
                    $parent,


                /*
                Children
                */

                'children' =>
                    $children,


                /*
                Children count
                */

                'childCount' =>
                    $childCount,


                /*
                Tests
                */

                'testCount' =>
                    $testCount,


                /*
                Results
                */

                'resultCount' =>
                    $resultCount,


                /*
                Upcoming events
                */

                'upcomingEvents' =>
                    $upcomingEvents,


                /*
                Recent announcements
                */

                'recentAnnouncements' =>
                    $recentAnnouncements,


                /*
                Recent activity
                */

                'recentActivity' =>
                    $recentActivity

            ]
        );
    }
}