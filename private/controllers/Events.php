<?php

class Events extends Controller
{
    /*
    =====================================================
    CHECK SUPER ADMIN
    =====================================================
    */

    private function checkSuperAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['rank']) ||
            $_SESSION['rank'] !== 'super_admin'
        ) {
            header("Location: " . ROOT . "/home");
            exit;
        }
    }


    /*
    =====================================================
    GET ACTIVE SCHOOLS
    =====================================================
    */

    private function getSchools()
    {
        $schoolModel = $this->model('School');

        $schools = $schoolModel->getAllSchools(
            '',
            'school_name',
            'ASC',
            'active'
        );

        return $schools;
    }


    /*
    =====================================================
    EVENTS LIST
    =====================================================
    */

    public function index()
    {
        $this->checkSuperAdmin();

        /*
        -------------------------------------------------
        Get all active schools
        -------------------------------------------------
        */

        $schools = $this->getSchools();

        /*
        -------------------------------------------------
        Events are currently school-specific.
        For the list page, show events from all schools.
        -------------------------------------------------
        */

        $eventModel = $this->model('EventModel');

        $events = [];

        foreach ($schools as $school) {

            $schoolEvents = $eventModel->getAllEvents($school->id);

            if (!empty($schoolEvents)) {

                foreach ($schoolEvents as $event) {

                    $event->school_name = $school->school_name;

                    $events[] = $event;
                }
            }
        }


        /*
        -------------------------------------------------
        Sort all events by date
        -------------------------------------------------
        */

        usort($events, function ($a, $b) {

            $dateA = ($a->event_date ?? '') . ' ' . ($a->start_time ?? '');
            $dateB = ($b->event_date ?? '') . ' ' . ($b->start_time ?? '');

            return strcmp($dateA, $dateB);
        });


        $data = [
            'events' => $events,
            'schools' => $schools
        ];

        $this->view('events/index', $data);
    }


    /*
    =====================================================
    CREATE EVENT
    =====================================================
    */

    public function create()
    {
        $this->checkSuperAdmin();

        $schools = $this->getSchools();

        $user_id = $_SESSION['user_id'] ?? null;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /*
            -------------------------------------------------
            CSRF
            -------------------------------------------------
            */

            if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
                die('Invalid CSRF token.');
            }


            /*
            -------------------------------------------------
            Get form data
            -------------------------------------------------
            */

            $school_id = (int) ($_POST['school_id'] ?? 0);

            $title = trim($_POST['title'] ?? '');

            $description = trim($_POST['description'] ?? '');

            $event_date = $_POST['event_date'] ?? '';

            $start_time = $_POST['start_time'] ?? null;

            $end_time = $_POST['end_time'] ?? null;

            $location = trim($_POST['location'] ?? '');

            $status = $_POST['status'] ?? 'active';


            /*
            -------------------------------------------------
            Validate school
            -------------------------------------------------
            */

            $validSchool = false;

            foreach ($schools as $school) {

                if ((int) $school->id === $school_id) {
                    $validSchool = true;
                    break;
                }
            }


            /*
            -------------------------------------------------
            Validate required fields
            -------------------------------------------------
            */

            if (!$validSchool) {

                $data = [
                    'schools' => $schools,
                    'error' => 'Please select a valid school.'
                ];

                $this->view('events/create', $data);
                return;
            }


            if ($title === '' || $event_date === '') {

                $data = [
                    'schools' => $schools,
                    'error' => 'Event title and event date are required.'
                ];

                $this->view('events/create', $data);
                return;
            }


            /*
            -------------------------------------------------
            Validate status
            -------------------------------------------------
            */

            if (!in_array($status, ['active', 'cancelled'], true)) {
                $status = 'active';
            }


            /*
            -------------------------------------------------
            Create event
            -------------------------------------------------
            */

            $eventModel = $this->model('EventModel');

            $eventModel->createEvent([
                'school_id'   => $school_id,
                'title'       => $title,
                'description' => $description,
                'event_date'  => $event_date,
                'start_time'  => $start_time ?: null,
                'end_time'    => $end_time ?: null,
                'location'    => $location,
                'status'      => $status,
                'created_by'  => $user_id
            ]);


            header("Location: " . ROOT . "/events");
            exit;
        }


        $data = [
            'schools' => $schools
        ];

        $this->view('events/create', $data);
    }


    /*
    =====================================================
    EDIT EVENT
    =====================================================
    */

    public function edit($event_id = null)
    {
        $this->checkSuperAdmin();

        if (!$event_id) {
            header("Location: " . ROOT . "/events");
            exit;
        }


        $eventModel = $this->model('EventModel');

        /*
        -------------------------------------------------
        Find event without using session school_id
        -------------------------------------------------
        */

        $event = null;

        $schools = $this->getSchools();

        foreach ($schools as $school) {

            $foundEvent = $eventModel->getEventById(
                $event_id,
                $school->id
            );

            if ($foundEvent) {

                $foundEvent->school_name = $school->school_name;

                $event = $foundEvent;

                break;
            }
        }


        if (!$event) {
            header("Location: " . ROOT . "/events");
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
                die('Invalid CSRF token.');
            }


            $title = trim($_POST['title'] ?? '');

            $description = trim($_POST['description'] ?? '');

            $event_date = $_POST['event_date'] ?? '';

            $start_time = $_POST['start_time'] ?? null;

            $end_time = $_POST['end_time'] ?? null;

            $location = trim($_POST['location'] ?? '');

            $status = $_POST['status'] ?? 'active';


            if ($title === '' || $event_date === '') {

                $data = [
                    'event' => $event,
                    'schools' => $schools,
                    'error' => 'Event title and event date are required.'
                ];

                $this->view('events/edit', $data);
                return;
            }


            if (!in_array($status, ['active', 'cancelled'], true)) {
                $status = 'active';
            }


            $eventModel->updateEvent(
                $event_id,
                $event->school_id,
                [
                    'title'       => $title,
                    'description' => $description,
                    'event_date'  => $event_date,
                    'start_time'  => $start_time ?: null,
                    'end_time'    => $end_time ?: null,
                    'location'    => $location,
                    'status'      => $status
                ]
            );


            header("Location: " . ROOT . "/events");
            exit;
        }


        $data = [
            'event' => $event,
            'schools' => $schools
        ];

        $this->view('events/edit', $data);
    }


    /*
    =====================================================
    EVENT DETAILS
    =====================================================
    */

    public function details($event_id = null)
    {
        $this->checkSuperAdmin();

        if (!$event_id) {
            header("Location: " . ROOT . "/events");
            exit;
        }


        $eventModel = $this->model('EventModel');

        $event = null;

        $schools = $this->getSchools();


        foreach ($schools as $school) {

            $foundEvent = $eventModel->getEventById(
                $event_id,
                $school->id
            );

            if ($foundEvent) {

                $foundEvent->school_name = $school->school_name;

                $event = $foundEvent;

                break;
            }
        }


        if (!$event) {
            header("Location: " . ROOT . "/events");
            exit;
        }


        $data = [
            'event' => $event
        ];

        $this->view('events/details', $data);
    }


    /*
    =====================================================
    DELETE EVENT
    =====================================================
    */

    public function delete($event_id = null)
    {
        $this->checkSuperAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/events");
            exit;
        }


        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die('Invalid CSRF token.');
        }


        if (!$event_id) {
            header("Location: " . ROOT . "/events");
            exit;
        }


        $eventModel = $this->model('EventModel');

        $schools = $this->getSchools();


        foreach ($schools as $school) {

            $event = $eventModel->getEventById(
                $event_id,
                $school->id
            );

            if ($event) {

                $eventModel->deleteEvent(
                    $event_id,
                    $school->id
                );

                break;
            }
        }


        header("Location: " . ROOT . "/events");
        exit;
    }
}