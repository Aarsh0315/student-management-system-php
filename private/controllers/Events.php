<?php

class Events extends Controller
{
    /*
    =====================================================
    CHECK AUTHORIZATION
    =====================================================
    */

    private function checkAccess()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $rank = $_SESSION['rank'] ?? '';

        if (!in_array(
    $rank,
    ['super_admin', 'admin', 'teacher', 'student'],
    true
)) {
    header("Location: " . ROOT . "/home");
    exit;
}
    }


    /*
    =====================================================
    GET ACTIVE SCHOOLS
    SUPER ADMIN ONLY
    =====================================================
    */

    private function getSchools()
    {
        $schoolModel = $this->model('School');

        return $schoolModel->getAllSchools(
            '',
            'school_name',
            'ASC',
            'active'
        );
    }


    /*
    =====================================================
    GET SCHOOL ID FOR CURRENT ADMIN
    =====================================================
    */

    private function getAdminSchoolId()
    {
        return (int) ($_SESSION['school_id'] ?? 0);
    }


    /*
    =====================================================
    EVENTS LIST
    =====================================================
    */

    public function index()
    {
        $this->checkAccess();

        $eventModel = $this->model('EventModel');

        $rank = $_SESSION['rank'] ?? '';

        /*
        -------------------------------------------------
        SUPER ADMIN
        -------------------------------------------------
        */

        if ($rank === 'super_admin') {

            $schools = $this->getSchools();

            $events = [];

            foreach ($schools as $school) {

                $schoolEvents = $eventModel->getAllEvents(
                    $school->id
                );

                if (!empty($schoolEvents)) {

                    foreach ($schoolEvents as $event) {

                        $event->school_name =
                            $school->school_name;

                        $events[] = $event;
                    }
                }
            }


            /*
            -------------------------------------------------
            SORT ALL EVENTS BY DATE
            -------------------------------------------------
            */

            usort($events, function ($a, $b) {

                $dateA =
                    ($a->event_date ?? '') .
                    ' ' .
                    ($a->start_time ?? '');

                $dateB =
                    ($b->event_date ?? '') .
                    ' ' .
                    ($b->start_time ?? '');

                return strcmp($dateA, $dateB);
            });


            $data = [
                'events' => $events,
                'schools' => $schools
            ];

            $this->view('events/index', $data);

            return;
        }


        /*
        -------------------------------------------------
        SCHOOL ADMIN
        -------------------------------------------------
        */

        $school_id = $this->getAdminSchoolId();


        if ($school_id <= 0) {

            $data = [
                'events' => [],
                'schools' => [],
                'error' => 'School information could not be found.'
            ];

            $this->view('events/index', $data);

            return;
        }


        /*
        -------------------------------------------------
        GET ONLY CURRENT SCHOOL EVENTS
        -------------------------------------------------
        */

        $events =
            $eventModel->getAllEvents($school_id);


        $data = [
            'events' => $events,
            'schools' => []
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
        $this->checkAccess();
        $rank = $_SESSION['rank'] ?? '';

        if ($rank === 'student') {
            header("Location: " . ROOT . "/events");
            exit;
}

        $rank = $_SESSION['rank'] ?? '';

        $eventModel = $this->model('EventModel');

        /*
        -------------------------------------------------
        SUPER ADMIN
        -------------------------------------------------
        */

        if ($rank === 'super_admin') {

            $schools = $this->getSchools();

            $user_id =
                $_SESSION['user_id'] ?? null;


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (!CSRF::verify(
                    $_POST['csrf_token'] ?? ''
                )) {
                    die('Invalid CSRF token.');
                }


                $school_id =
                    (int) ($_POST['school_id'] ?? 0);

                $title =
                    trim($_POST['title'] ?? '');

                $description =
                    trim($_POST['description'] ?? '');

                $event_date =
                    $_POST['event_date'] ?? '';

                $start_time =
                    $_POST['start_time'] ?? null;

                $end_time =
                    $_POST['end_time'] ?? null;

                $location =
                    trim($_POST['location'] ?? '');

                $status =
                    $_POST['status'] ?? 'active';


                /*
                -------------------------------------------------
                VALIDATE SCHOOL
                -------------------------------------------------
                */

                $validSchool = false;

                foreach ($schools as $school) {

                    if (
                        (int) $school->id ===
                        $school_id
                    ) {
                        $validSchool = true;
                        break;
                    }
                }


                if (!$validSchool) {

                    $data = [
                        'schools' => $schools,
                        'error' =>
                            'Please select a valid school.'
                    ];

                    $this->view(
                        'events/create',
                        $data
                    );

                    return;
                }


                /*
                -------------------------------------------------
                VALIDATE REQUIRED FIELDS
                -------------------------------------------------
                */

                if (
                    $title === '' ||
                    $event_date === ''
                ) {

                    $data = [
                        'schools' => $schools,
                        'error' =>
                            'Event title and event date are required.'
                    ];

                    $this->view(
                        'events/create',
                        $data
                    );

                    return;
                }


                /*
                -------------------------------------------------
                VALIDATE STATUS
                -------------------------------------------------
                */

                if (
                    !in_array(
                        $status,
                        ['active', 'cancelled'],
                        true
                    )
                ) {
                    $status = 'active';
                }


                /*
                -------------------------------------------------
                CREATE EVENT
                -------------------------------------------------
                */

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


                header(
                    "Location: " .
                    ROOT .
                    "/events"
                );

                exit;
            }


            $data = [
                'schools' => $schools
            ];

            $this->view(
                'events/create',
                $data
            );

            return;
        }


        /*
        -------------------------------------------------
        SCHOOL ADMIN
        -------------------------------------------------
        */

        $school_id =
            $this->getAdminSchoolId();


        if ($school_id <= 0) {

            die(
                'School information could not be found.'
            );
        }


        $user_id =
            $_SESSION['user_id'] ?? null;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )) {
                die('Invalid CSRF token.');
            }


            /*
            -------------------------------------------------
            IMPORTANT:
            SCHOOL ADMIN CANNOT CHOOSE school_id
            -------------------------------------------------
            */

            $title =
                trim($_POST['title'] ?? '');

            $description =
                trim($_POST['description'] ?? '');

            $event_date =
                $_POST['event_date'] ?? '';

            $start_time =
                $_POST['start_time'] ?? null;

            $end_time =
                $_POST['end_time'] ?? null;

            $location =
                trim($_POST['location'] ?? '');

            $status =
                $_POST['status'] ?? 'active';


            if (
                $title === '' ||
                $event_date === ''
            ) {

                $data = [
                    'schools' => [],
                    'error' =>
                        'Event title and event date are required.'
                ];

                $this->view(
                    'events/create',
                    $data
                );

                return;
            }


            if (
                !in_array(
                    $status,
                    ['active', 'cancelled'],
                    true
                )
            ) {
                $status = 'active';
            }


            /*
            -------------------------------------------------
            ALWAYS USE ADMIN'S SESSION SCHOOL
            -------------------------------------------------
            */

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


            header(
                "Location: " .
                ROOT .
                "/events"
            );

            exit;
        }


        /*
        -------------------------------------------------
        SCHOOL ADMIN CREATE VIEW
        -------------------------------------------------
        */

        $data = [
            'schools' => []
        ];

        $this->view(
            'events/create',
            $data
        );
    }


    /*
    =====================================================
    EDIT EVENT
    =====================================================
    */

    public function edit($event_id = null)
    {
        $this->checkAccess();

        $rank = $_SESSION['rank'] ?? '';

        if ($rank === 'student') {
            header("Location: " . ROOT . "/events");
            exit;
}

        if (!$event_id) {

            header(
                "Location: " .
                ROOT .
                "/events"
            );

            exit;
        }


        $eventModel =
            $this->model('EventModel');

        $rank =
            $_SESSION['rank'] ?? '';


        /*
        -------------------------------------------------
        SUPER ADMIN
        -------------------------------------------------
        */

        if ($rank === 'super_admin') {

            $schools =
                $this->getSchools();

            $event = null;


            foreach ($schools as $school) {

                $foundEvent =
                    $eventModel->getEventById(
                        $event_id,
                        $school->id
                    );


                if ($foundEvent) {

                    $foundEvent->school_name =
                        $school->school_name;

                    $event = $foundEvent;

                    break;
                }
            }


            if (!$event) {

                header(
                    "Location: " .
                    ROOT .
                    "/events"
                );

                exit;
            }


            return $this->processEventEdit(
                $event,
                $schools,
                $eventModel,
                true
            );
        }


        /*
        -------------------------------------------------
        SCHOOL ADMIN
        -------------------------------------------------
        */

        $school_id =
            $this->getAdminSchoolId();


        if ($school_id <= 0) {

            die(
                'School information could not be found.'
            );
        }


        /*
        -------------------------------------------------
        GET EVENT ONLY FROM ADMIN'S SCHOOL
        -------------------------------------------------
        */

        $event =
            $eventModel->getEventById(
                $event_id,
                $school_id
            );


        if (!$event) {

            header(
                "Location: " .
                ROOT .
                "/events"
            );

            exit;
        }

        if (
    $rank === 'teacher' &&
    (int)$event->created_by !== (int)$_SESSION['user_id']
) {
    die("You are not allowed to edit this event.");
}


        return $this->processEventEdit(
            $event,
            [],
            $eventModel,
            false
        );
    }


    /*
    =====================================================
    PROCESS EVENT EDIT
    =====================================================
    */

    private function processEventEdit(
        $event,
        $schools,
        $eventModel,
        $isSuperAdmin
    ) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )) {
                die('Invalid CSRF token.');
            }


            $title =
                trim($_POST['title'] ?? '');

            $description =
                trim($_POST['description'] ?? '');

            $event_date =
                $_POST['event_date'] ?? '';

            $start_time =
                $_POST['start_time'] ?? null;

            $end_time =
                $_POST['end_time'] ?? null;

            $location =
                trim($_POST['location'] ?? '');

            $status =
                $_POST['status'] ?? 'active';


            if (
                $title === '' ||
                $event_date === ''
            ) {

                $data = [
                    'event' => $event,
                    'schools' => $schools,
                    'error' =>
                        'Event title and event date are required.'
                ];

                $this->view(
                    'events/edit',
                    $data
                );

                return;
            }


            if (
                !in_array(
                    $status,
                    ['active', 'cancelled'],
                    true
                )
            ) {
                $status = 'active';
            }


            /*
            -------------------------------------------------
            KEEP ORIGINAL SCHOOL ID
            -------------------------------------------------
            */

            $school_id =
                (int) $event->school_id;


            $eventModel->updateEvent(
                $event->event_id,
                $school_id,
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


            header(
                "Location: " .
                ROOT .
                "/events"
            );

            exit;
        }


        $data = [
            'event'   => $event,
            'schools' => $schools
        ];


        $this->view(
            'events/edit',
            $data
        );
    }


    /*
    =====================================================
    EVENT DETAILS
    =====================================================
    */

    public function details($event_id = null)
    {
        $this->checkAccess();

        if (!$event_id) {

            header(
                "Location: " .
                ROOT .
                "/events"
            );

            exit;
        }


        $eventModel =
            $this->model('EventModel');

        $rank =
            $_SESSION['rank'] ?? '';


        /*
        -------------------------------------------------
        SUPER ADMIN
        -------------------------------------------------
        */

        if ($rank === 'super_admin') {

            $schools =
                $this->getSchools();

            $event = null;


            foreach ($schools as $school) {

                $foundEvent =
                    $eventModel->getEventById(
                        $event_id,
                        $school->id
                    );


                if ($foundEvent) {

                    $foundEvent->school_name =
                        $school->school_name;

                    $event = $foundEvent;

                    break;
                }
            }


            if (!$event) {

                header(
                    "Location: " .
                    ROOT .
                    "/events"
                );

                exit;
            }
        }


        /*
        -------------------------------------------------
        SCHOOL ADMIN
        -------------------------------------------------
        */

        else {

            $school_id =
                $this->getAdminSchoolId();


            if ($school_id <= 0) {

                die(
                    'School information could not be found.'
                );
            }


            $event =
                $eventModel->getEventById(
                    $event_id,
                    $school_id
                );


            if (!$event) {

                header(
                    "Location: " .
                    ROOT .
                    "/events"
                );

                exit;
            }
        }


        $data = [
            'event' => $event
        ];


        $this->view(
            'events/details',
            $data
        );
    }


    /*
    =====================================================
    DELETE EVENT
    =====================================================
    */

    public function delete($event_id = null)
{
    $this->checkAccess();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    $rank = $_SESSION['rank'] ?? '';

    if ($rank === 'student') {
        header("Location: " . ROOT . "/events");
        exit;
    }

        header(
            "Location: " .
            ROOT .
            "/events"
        );

        exit;
    }


    if (!CSRF::verify(
        $_POST['csrf_token'] ?? ''
    )) {
        die('Invalid CSRF token.');
    }


    if (!$event_id) {

        header(
            "Location: " .
            ROOT .
            "/events"
        );

        exit;
    }


    $eventModel =
        $this->model('EventModel');

    $rank =
        $_SESSION['rank'] ?? '';


    /*
    -------------------------------------------------
    SUPER ADMIN
    -------------------------------------------------
    */

    if ($rank === 'super_admin') {

        $schools =
            $this->getSchools();


        foreach ($schools as $school) {

            $event =
                $eventModel->getEventById(
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
    }


    /*
    -------------------------------------------------
    SCHOOL ADMIN / TEACHER
    -------------------------------------------------
    */

    else {

        $school_id =
            $this->getAdminSchoolId();


        if ($school_id > 0) {

            /*
            -----------------------------------------
            Verify event belongs to this school
            -----------------------------------------
            */

            $event =
                $eventModel->getEventById(
                    $event_id,
                    $school_id
                );


            if ($event) {

                /*
                -----------------------------------------
                TEACHER CAN DELETE ONLY OWN EVENT
                -----------------------------------------
                */

                if (
                    $rank === 'teacher' &&
                    (int)$event->created_by !== (int)$_SESSION['user_id']
                ) {
                    die("You are not allowed to delete this event.");
                }


                $eventModel->deleteEvent(
                    $event_id,
                    $school_id
                );
            }
        }
    }


    header(
        "Location: " .
        ROOT .
        "/events"
    );

    exit;
}
}