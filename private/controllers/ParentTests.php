<?php

class ParentTests extends Controller
{
    /*
    ========================================
    PARENT TESTS LIST
    ========================================
    */

   public function index()
{
    /*
    ========================================
    PARENT TESTS LIST
    ========================================
    */


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
    CHECK PARENT ROLE
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
    GET PARENT ID
    ========================================
    */

    $parent_id =
        $_SESSION['user_id'] ?? null;


    /*
    ========================================
    GET SCHOOL ID
    ========================================
    */

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$parent_id) {

        die(
            "Parent user ID not found."
        );

    }


    if (!$school_id) {

        die(
            "No school is assigned to this account."
        );

    }


    /*
    ========================================
    LOAD MODELS
    ========================================
    */

    $parentModel =
        $this->model('ParentModel');


    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    GET CHILDREN
    ========================================
    */

    $children =
        $parentModel->getChildrenBySchool(
            $parent_id,
            $school_id
        );


    /*
    ========================================
    GET TESTS
    ========================================
    */

    $tests = [];


    foreach ($children as $child) {

        $class =
            $child->class ?? null;


        $division =
            $child->division ?? null;


        if (!$class || !$division) {
            continue;
        }


        /*
        ========================================
        GET TESTS FOR CHILD'S CLASS
        ========================================
        */

        $childTests =
            $testModel->getTestsByClassDivision(
                $school_id,
                $class,
                $division
            );


        foreach ($childTests as $test) {

            /*
            Add child information
            */

            $test->student_id =
                $child->student_id;


            $test->student_name =
                trim(
                    ($child->firstname ?? '') .
                    ' ' .
                    ($child->lastname ?? '')
                );


            $tests[] = $test;
        }
    }


    /*
    ========================================
    REMOVE DUPLICATE TESTS
    ========================================
    */

    $uniqueTests = [];


    foreach ($tests as $test) {

        $key =
            ($test->test_id ?? '') .
            '_' .
            ($test->student_id ?? '');


        $uniqueTests[$key] = $test;
    }


    $tests =
        array_values($uniqueTests);


    /*
    ========================================
    GET SEARCH
    ========================================
    */

    $search =
        trim(
            $_GET['search'] ?? ''
        );


    /*
    ========================================
    GET SORT
    ========================================
    */

    $sort =
        $_GET['sort'] ?? 'test_id';


    /*
    ========================================
    GET SORT DIRECTION
    ========================================
    */

    $direction =
        strtoupper(
            $_GET['direction'] ?? 'DESC'
        );


    /*
    ========================================
    ALLOWED SORTS
    ========================================
    */

    $allowedSorts = [
        'test_id',
        'test',
        'child',
        'class',
        'division',
        'total_marks',
        'duration',
        'status',
        'created_at'
    ];


    /*
    ========================================
    VALIDATE SORT
    ========================================
    */

    if (
        !in_array(
            $sort,
            $allowedSorts,
            true
        )
    ) {

        $sort = 'test_id';
    }


    /*
    ========================================
    VALIDATE DIRECTION
    ========================================
    */

    if (
        !in_array(
            $direction,
            ['ASC', 'DESC'],
            true
        )
    ) {

        $direction = 'DESC';
    }


    /*
    ========================================
    SEARCH TESTS
    ========================================
    */

    if ($search !== '') {

        $searchLower =
            strtolower($search);


        $tests =
            array_filter(
                $tests,
                function ($test) use ($searchLower) {

                    $testId =
                        strtolower(
                            (string) (
                                $test->test_id ?? ''
                            )
                        );


                    $title =
                        strtolower(
                            (string) (
                                $test->title ?? ''
                            )
                        );


                    $studentName =
                        strtolower(
                            (string) (
                                $test->student_name ?? ''
                            )
                        );


                    $class =
                        strtolower(
                            (string) (
                                $test->class ?? ''
                            )
                        );


                    $division =
                        strtolower(
                            (string) (
                                $test->division ?? ''
                            )
                        );


                    $status =
                        strtolower(
                            (string) (
                                $test->status ?? ''
                            )
                        );


                    return
                        strpos(
                            $testId,
                            $searchLower
                        ) !== false

                        ||

                        strpos(
                            $title,
                            $searchLower
                        ) !== false

                        ||

                        strpos(
                            $studentName,
                            $searchLower
                        ) !== false

                        ||

                        strpos(
                            $class,
                            $searchLower
                        ) !== false

                        ||

                        strpos(
                            $division,
                            $searchLower
                        ) !== false

                        ||

                        strpos(
                            $status,
                            $searchLower
                        ) !== false;
                }
            );


        $tests =
            array_values($tests);
    }


    /*
    ========================================
    SORT TESTS
    ========================================
    */

    usort(
        $tests,
        function ($a, $b) use (
            $sort,
            $direction
        ) {

            switch ($sort) {

                case 'test_id':

                    $valueA =
                        $a->test_id ?? '';

                    $valueB =
                        $b->test_id ?? '';

                    break;


                case 'test':

                    $valueA =
                        $a->title ?? '';

                    $valueB =
                        $b->title ?? '';

                    break;


                case 'child':

                    $valueA =
                        $a->student_name ?? '';

                    $valueB =
                        $b->student_name ?? '';

                    break;


                case 'class':

                    $valueA =
                        $a->class ?? '';

                    $valueB =
                        $b->class ?? '';

                    break;


                case 'division':

                    $valueA =
                        $a->division ?? '';

                    $valueB =
                        $b->division ?? '';

                    break;


                case 'total_marks':

                    $valueA =
                        (float) (
                            $a->total_marks ?? 0
                        );

                    $valueB =
                        (float) (
                            $b->total_marks ?? 0
                        );

                    break;


                case 'duration':

                    $valueA =
                        (float) (
                            $a->duration ?? 0
                        );

                    $valueB =
                        (float) (
                            $b->duration ?? 0
                        );

                    break;


                case 'status':

                    $valueA =
                        $a->status ?? '';

                    $valueB =
                        $b->status ?? '';

                    break;


                case 'created_at':

                    $valueA =
                        strtotime(
                            $a->created_at ?? '0'
                        );

                    $valueB =
                        strtotime(
                            $b->created_at ?? '0'
                        );

                    break;


                default:

                    $valueA =
                        $a->test_id ?? '';

                    $valueB =
                        $b->test_id ?? '';

                    break;
            }


            /*
            String comparison
            */

            if (
                is_string($valueA) &&
                is_string($valueB)
            ) {

                $comparison =
                    strcasecmp(
                        $valueA,
                        $valueB
                    );

            } else {

                $comparison =
                    $valueA <=> $valueB;
            }


            /*
            Apply direction
            */

            return
                $direction === 'ASC'
                    ? $comparison
                    : -$comparison;
        }
    );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'parent-tests',
        [
            'tests'     => $tests,
            'children'  => $children,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction
        ]
    );
}

    /*
========================================
PARENT TEST DETAILS
========================================
*/

public function details($test_id = null)
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
    CHECK PARENT ROLE
    ========================================
    */

    if (($_SESSION['rank'] ?? '') !== 'parent') {

        header(
            "Location: " .
            ROOT .
            "/home"
        );

        exit;
    }


    /*
    ========================================
    CHECK TEST ID
    ========================================
    */

    if (!$test_id) {

        header(
            "Location: " .
            ROOT .
            "/parenttests"
        );

        exit;
    }


    /*
    ========================================
    GET PARENT INFORMATION
    ========================================
    */

    $parent_id =
        $_SESSION['user_id'] ?? null;

    $school_id =
        $_SESSION['school_id'] ?? null;


    if (!$parent_id || !$school_id) {

        die(
            "Parent account information not found."
        );

    }


    /*
    ========================================
    LOAD MODELS
    ========================================
    */

    $parentModel =
        $this->model('ParentModel');


    $testModel =
        $this->model('TeacherTestsModel');


    /*
    ========================================
    GET CHILDREN
    ========================================
    */

    $children =
        $parentModel->getChildrenBySchool(
            $parent_id,
            $school_id
        );


    /*
    ========================================
    FIND CHILD WHO HAS THIS TEST
    ========================================
    */

    $child = null;

    $test = null;


    foreach ($children as $currentChild) {

        $class =
            $currentChild->class ?? null;

        $division =
            $currentChild->division ?? null;


        if (!$class || !$division) {
            continue;
        }


        $childTests =
            $testModel->getTestsByClassDivision(
                $school_id,
                $class,
                $division
            );


        foreach ($childTests as $currentTest) {

            if (
                ($currentTest->test_id ?? '') ===
                $test_id
            ) {

                $test =
                    $currentTest;

                $child =
                    $currentChild;

                break 2;
            }
        }
    }


    /*
    ========================================
    TEST NOT FOUND
    ========================================
    */

    if (!$test || !$child) {

        header(
            "Location: " .
            ROOT .
            "/parenttests"
        );

        exit;
    }


    /*
    ========================================
    GET QUESTIONS
    ========================================
    */

    $questions =
        $testModel->getQuestionsByTest(
            $test_id
        );


    /*
    ========================================
    LOAD VIEW
    ========================================
    */

    $this->view(
        'parent-test-details',
        [
            'test'      => $test,
            'questions' => $questions,
            'child'     => $child
        ]
    );
}
}