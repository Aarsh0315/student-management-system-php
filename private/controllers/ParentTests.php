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
                Add child information so
                parent knows which child
                the test belongs to.
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
        SORT TESTS
        ========================================
        */

        usort(
            $tests,
            function ($a, $b) {

                return strtotime(
                    $b->created_at ?? '0'
                ) <=> strtotime(
                    $a->created_at ?? '0'
                );

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
                'tests'    => $tests,
                'children' => $children
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