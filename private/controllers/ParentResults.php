<?php

class ParentResults extends Controller
{
    /*
    ========================================
    RESULTS LIST
    ========================================
    */
public function index()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if (!isset($_SESSION['user_id'])) {

        header("Location: " . ROOT . "/login");
        exit;
    }


    if (($_SESSION['rank'] ?? '') !== 'parent') {

        header("Location: " . ROOT . "/home");
        exit;
    }


    $parent_id = $_SESSION['user_id'] ?? null;

    $school_id = $_SESSION['school_id'] ?? null;


    if (!$parent_id) {

        die("Parent user ID not found.");
    }


    if (!$school_id) {

        die("No school is assigned to this account.");
    }


    /*
    ========================================
    SEARCH
    ========================================
    */

    $search = trim(
        $_GET['search'] ?? ''
    );


    /*
    ========================================
    SORT
    ========================================
    */

    $sort = $_GET['sort'] ?? 'result_id';


    $direction = strtoupper(
        $_GET['direction'] ?? 'DESC'
    );


    $allowedSorts = [

        'result_id',
        'test',
        'child',
        'class',
        'division',
        'total_marks',
        'obtained_marks',
        'percentage',
        'status',
        'created_at'

    ];


    if (!in_array($sort, $allowedSorts, true)) {

        $sort = 'result_id';
    }


    if (!in_array($direction, ['ASC', 'DESC'], true)) {

        $direction = 'DESC';
    }


    /*
    ========================================
    GET RESULTS
    ========================================
    */

    $resultModel = $this->model(
        'StudentResultsModel'
    );


    $results = $resultModel->getParentChildrenResults(

        $parent_id,

        $school_id,

        $search,

        $sort,

        $direction

    );


    /*
    ========================================
    SEND DATA TO VIEW
    ========================================
    */

    $this->view(
        'parent-results',
        [

            'results' => $results,

            'search' => $search,

            'sort' => $sort,

            'direction' => $direction

        ]
    );
}
    /*
    ========================================
    RESULT DETAILS
    ========================================
    */

    public function details($result_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['user_id'])) {

            header("Location: " . ROOT . "/login");
            exit;
        }


        if (($_SESSION['rank'] ?? '') !== 'parent') {

            header("Location: " . ROOT . "/home");
            exit;
        }


        if (!$result_id) {

            header("Location: " . ROOT . "/parentresults");
            exit;
        }


        $parent_id = $_SESSION['user_id'] ?? null;
        $school_id = $_SESSION['school_id'] ?? null;


        if (!$parent_id || !$school_id) {

            die("Parent account information not found.");
        }


        $resultModel = $this->model('StudentResultsModel');


        $result = $resultModel->getParentResultDetails(
            $result_id,
            $parent_id,
            $school_id
        );


        if (!$result) {

            header("Location: " . ROOT . "/parentresults");
            exit;
        }


        /*
        ========================================
        GET QUESTION DETAILS
        ========================================
        */

        $questions = $resultModel->getResultDetails(
            $result->test_id,
            $result->student_id
        );


        $this->view(
            'parent-result-details',
            [
                'result' => $result,
                'questions' => $questions
            ]
        );
    }
}