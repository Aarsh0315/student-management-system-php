<?php

class TeacherTests extends Controller
{
    /*
    ========================================
    INDEX
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
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        GET SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this teacher."
            );
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


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
        GET DIRECTION
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
            'title',
            'subject',
            'test_type',
            'class',
            'division',
            'total_marks',
            'duration',
            'status'

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
        GET TESTS
        ========================================
        */

        $tests =
            $testModel->getTestsBySchool(
                $school_id,
                $search,
                $sort,
                $direction
            );


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-tests',
            [

                'tests' =>
                    $tests,

                'search' =>
                    $search,

                'sort' =>
                    $sort,

                'direction' =>
                    $direction

            ]
        );
    }


    /*
    ========================================
    CREATE TEST
    ========================================
    */

    public function create()
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
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        GET SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "No school is assigned to this teacher."
            );
        }


        /*
        ========================================
        GET TEACHER ID
        ========================================
        */

        $teacher_id =
            $_SESSION['user_id'] ?? null;


        /*
        ========================================
        HANDLE FORM SUBMISSION
        ========================================
        */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /*
            ====================================
            CSRF
            ====================================
            */

            if (
                !CSRF::verify(
                    $_POST['csrf_token'] ?? ''
                )
            ) {

                die(
                    "Invalid security token. Please refresh the page and try again."
                );
            }


            /*
            ====================================
            GET FORM DATA
            ====================================
            */

            $title =
                trim(
                    $_POST['title'] ?? ''
                );


            $subject =
                trim(
                    $_POST['subject'] ?? ''
                );


            $test_type =
                trim(
                    $_POST['test_type'] ?? 'quiz'
                );


            $description =
                trim(
                    $_POST['description'] ?? ''
                );


            $instructions =
                trim(
                    $_POST['instructions'] ?? ''
                );


            $class =
                trim(
                    $_POST['class'] ?? ''
                );


            $division =
                trim(
                    $_POST['division'] ?? ''
                );


            $total_marks =
                (int) (
                    $_POST['total_marks'] ?? 0
                );


            $passing_marks =
                (int) (
                    $_POST['passing_marks'] ?? 0
                );


            $negative_marking =
                isset(
                    $_POST['negative_marking']
                )
                ? 1
                : 0;


            $negative_marks =
                (float) (
                    $_POST['negative_marks'] ?? 0
                );


            $shuffle_questions =
                isset(
                    $_POST['shuffle_questions']
                )
                ? 1
                : 0;


            $shuffle_options =
                isset(
                    $_POST['shuffle_options']
                )
                ? 1
                : 0;


            $duration =
                (int) (
                    $_POST['duration'] ?? 0
                );


            $start_date =
                !empty($_POST['start_date'])
                ? $_POST['start_date']
                : null;


            $end_date =
                !empty($_POST['end_date'])
                ? $_POST['end_date']
                : null;


            /*
            ====================================
            VALIDATE TEST TYPE
            ====================================
            */

            $allowedTestTypes = [
                'quiz',
                'practice',
                'exam'
            ];


            if (
                !in_array(
                    $test_type,
                    $allowedTestTypes,
                    true
                )
            ) {

                $test_type = 'quiz';
            }


            /*
            ====================================
            VALIDATE NEGATIVE MARKING
            ====================================
            */

            if (!$negative_marking) {

                $negative_marks = 0;
            }


            if ($negative_marks < 0) {

                $negative_marks = 0;
            }


            /*
            ====================================
            VALIDATE PASSING MARKS
            ====================================
            */

            if (
                $passing_marks < 0 ||
                $passing_marks > $total_marks
            ) {

                die(
                    "Passing marks cannot be greater than total marks."
                );
            }


            /*
            ====================================
            VALIDATION
            ====================================
            */

            if (
                $title === '' ||
                $class === '' ||
                $division === '' ||
                $total_marks <= 0 ||
                $duration <= 0
            ) {

                die(
                    "Please fill all required fields correctly."
                );
            }


            /*
            ====================================
            GENERATE TEST ID
            ====================================
            */

            $test_id =
                'TEST' .
                strtoupper(
                    substr(
                        md5(
                            uniqid(
                                mt_rand(),
                                true
                            )
                        ),
                        0,
                        8
                    )
                );


            /*
            ====================================
            LOAD MODEL
            ====================================
            */

            $testModel =
                $this->model('TeacherTestsModel');


            /*
            ====================================
            PREPARE DATA
            ====================================
            */

            $testData = [

                'test_id' =>
                    $test_id,

                'teacher_id' =>
                    $teacher_id,

                'school_id' =>
                    $school_id,

                'title' =>
                    $title,

                'subject' =>
                    $subject !== ''
                    ? $subject
                    : null,

                'test_type' =>
                    $test_type,

                'description' =>
                    $description !== ''
                    ? $description
                    : null,

                'instructions' =>
                    $instructions !== ''
                    ? $instructions
                    : null,

                'class' =>
                    $class,

                'division' =>
                    $division,

                'total_marks' =>
                    $total_marks,

                'passing_marks' =>
                    $passing_marks,

                'negative_marking' =>
                    $negative_marking,

                'negative_marks' =>
                    $negative_marks,

                'shuffle_questions' =>
                    $shuffle_questions,

                'shuffle_options' =>
                    $shuffle_options,

                'duration' =>
                    $duration,

                'start_date' =>
                    $start_date,

                'end_date' =>
                    $end_date
            ];


            /*
            ====================================
            CREATE TEST
            ====================================
            */

            $created =
                $testModel->createTest(
                    $testData
                );


            /*
            ====================================
            CHECK RESULT
            ====================================
            */

            if (!$created) {

                die(
                    "Failed to create test."
                );
            }


            /*
            ====================================
            REDIRECT
            ====================================
            */

            header(
                "Location: " .
                ROOT .
                "/teachertests/details/" .
                urlencode($test_id)
            );

            exit;
        }


        /*
        ========================================
        LOAD VIEW
        ========================================
        */

        $this->view(
            'teacher-test-create',
            [
                'school_id' => $school_id
            ]
        );
    }


    /*
    ========================================
    TEST DETAILS
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
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        CHECK TEST ID
        ========================================
        */

        if (!$test_id) {

            header(
                "Location: " .
                ROOT .
                "/teachertests"
            );

            exit;
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
                "No school is assigned to this teacher."
            );
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        GET TEST
        ========================================
        */

        $test =
            $testModel->getTestById(
                $test_id,
                $school_id
            );


        /*
        ========================================
        TEST NOT FOUND
        ========================================
        */

        if (!$test) {

            die(
                "Test not found."
            );
        }


        /*
        ========================================
        LOAD QUESTIONS
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
            'teacher-test-details',
            [

                'test' =>
                    $test,

                'questions' =>
                    $questions
            ]
        );
    }


    /*
    ========================================
    ADD QUESTION
    ========================================
    */

    public function addquestion($test_id = null)
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
        TEACHER AUTHENTICATION
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


        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        CHECK TEST ID
        ========================================
        */

        if (!$test_id) {

            header(
                "Location: " .
                ROOT .
                "/teachertests"
            );

            exit;
        }


        /*
        ========================================
        SCHOOL
        ========================================
        */

        $school_id =
            $_SESSION['school_id'] ?? null;


        if (!$school_id) {

            die(
                "School information not found."
            );
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        /*
        IMPORTANT:
        Use the MVC model loader instead of
        new TeacherTestsModel().
        */

        $model =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        GET TEST
        ========================================
        */

        $test =
            $model->getTestById(
                $test_id,
                $school_id
            );


        if (!$test) {

            die(
                "Test not found."
            );
        }


        /*
        ========================================
        SCHOOL SECURITY CHECK
        ========================================
        */

        if (
            (string)$test->school_id !==
            (string)$school_id
        ) {

            die(
                "Unauthorized access."
            );
        }


        /*
        ========================================
        ONLY DRAFT TESTS CAN BE EDITED
        ========================================
        */

        if (
            ($test->status ?? '') !== 'draft'
        ) {

            die(
                "Questions can only be added to draft tests."
            );
        }


        /*
        ========================================
        POST REQUEST
        ========================================
        */

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
        ) {

            /*
            ========================================
            CSRF
            ========================================
            */

            if (
                !CSRF::verify(
                    $_POST['csrf_token'] ?? ''
                )
            ) {

                die(
                    "Invalid security token."
                );
            }


            /*
            ========================================
            QUESTION TYPE
            ========================================
            */

            $question_type =
                trim(
                    $_POST['question_type'] ?? 'mcq'
                );


            $allowedTypes = [

                'mcq',
                'msq',
                'true_false',
                'fill_blank',
                'short_answer',
                'long_answer'

            ];


            if (
                !in_array(
                    $question_type,
                    $allowedTypes,
                    true
                )
            ) {

                die(
                    "Invalid question type."
                );
            }


            /*
            ========================================
            BASIC QUESTION DATA
            ========================================
            */

            $question =
                trim(
                    $_POST['question'] ?? ''
                );


            $option_a =
                trim(
                    $_POST['option_a'] ?? ''
                );


            $option_b =
                trim(
                    $_POST['option_b'] ?? ''
                );


            $option_c =
                trim(
                    $_POST['option_c'] ?? ''
                );


            $option_d =
                trim(
                    $_POST['option_d'] ?? ''
                );


            $correct_answer =
                trim(
                    $_POST['correct_answer'] ?? ''
                );


            $correct_answers =
                $_POST['correct_answers'] ?? [];


            $explanation =
                trim(
                    $_POST['explanation'] ?? ''
                );


            $difficulty =
                trim(
                    $_POST['difficulty'] ?? 'medium'
                );


            $marks =
                (int)(
                    $_POST['marks'] ?? 0
                );


            $question_order =
                (int)(
                    $_POST['question_order'] ?? 0
                );


            /*
            ========================================
            VALIDATE DIFFICULTY
            ========================================
            */

            $allowedDifficulty = [

                'easy',
                'medium',
                'hard'

            ];


            if (
                !in_array(
                    $difficulty,
                    $allowedDifficulty,
                    true
                )
            ) {

                $difficulty = 'medium';
            }


            /*
            ========================================
            MARKS VALIDATION
            ========================================
            */

            if ($marks <= 0) {

                die(
                    "Marks must be greater than 0."
                );
            }


            /*
            ========================================
            QUESTION IMAGE
            ========================================
            */

            $question_image = null;

            $uploadedFilePath = null;


            if (
                isset($_FILES['question_image']) &&
                $_FILES['question_image']['error'] !==
                UPLOAD_ERR_NO_FILE
            ) {

                $file =
                    $_FILES['question_image'];


                /*
                ----------------------------------------
                UPLOAD ERROR
                ----------------------------------------
                */

                if (
                    $file['error'] !==
                    UPLOAD_ERR_OK
                ) {

                    die(
                        "Question image upload failed."
                    );
                }


                /*
                ----------------------------------------
                MAXIMUM SIZE = 2 MB
                ----------------------------------------
                */

                $maxSize =
                    2 * 1024 * 1024;


                if (
                    $file['size'] >
                    $maxSize
                ) {

                    die(
                        "Question image must be 2 MB or smaller."
                    );
                }


                /*
                ----------------------------------------
                VERIFY REAL IMAGE
                ----------------------------------------
                */

                $imageInfo =
                    @getimagesize(
                        $file['tmp_name']
                    );


                if (
                    $imageInfo === false
                ) {

                    die(
                        "The uploaded file is not a valid image."
                    );
                }


                /*
                ----------------------------------------
                ALLOWED MIME TYPES
                ----------------------------------------
                */

                $allowedMimeTypes = [

                    'image/jpeg' =>
                        'jpg',

                    'image/png' =>
                        'png',

                    'image/webp' =>
                        'webp'

                ];


                $mimeType =
                    $imageInfo['mime'] ?? '';


                if (
                    !isset(
                        $allowedMimeTypes[
                            $mimeType
                        ]
                    )
                ) {

                    die(
                        "Only JPG, PNG and WEBP images are allowed."
                    );
                }


                /*
                ----------------------------------------
                CREATE UPLOAD DIRECTORY
                ----------------------------------------
                */

                $uploadDirectory =
                    dirname(
                        __DIR__,
                        2
                    ) .
                    '/public/uploads/questions/';


                if (
                    !is_dir(
                        $uploadDirectory
                    )
                ) {

                    if (
                        !mkdir(
                            $uploadDirectory,
                            0755,
                            true
                        )
                    ) {

                        die(
                            "Unable to create question image directory."
                        );
                    }
                }


                /*
                ----------------------------------------
                GENERATE QUESTION ID
                ----------------------------------------
                */

                $question_id =
                    'QUE' .
                    strtoupper(
                        bin2hex(
                            random_bytes(5)
                        )
                    );


                /*
                ----------------------------------------
                SAFE FILE NAME
                ----------------------------------------
                */

                $extension =
                    $allowedMimeTypes[
                        $mimeType
                    ];


                $fileName =
                    $question_id .
                    '.' .
                    $extension;


                $destination =
                    $uploadDirectory .
                    $fileName;


                /*
                ----------------------------------------
                MOVE IMAGE
                ----------------------------------------
                */

                if (
                    !move_uploaded_file(
                        $file['tmp_name'],
                        $destination
                    )
                ) {

                    die(
                        "Unable to save question image."
                    );
                }


                $uploadedFilePath =
                    $destination;


                /*
                ----------------------------------------
                DATABASE PATH
                ----------------------------------------
                */

                $question_image =
                    'uploads/questions/' .
                    $fileName;
            }


            /*
            ========================================
            GENERATE QUESTION ID
            ========================================
            */

            if ($question_id ?? null) {

                // Question ID already generated
                // during image upload.

            } else {

                $question_id =
                    'QUE' .
                    strtoupper(
                        bin2hex(
                            random_bytes(5)
                        )
                    );
            }


            /*
            ========================================
            QUESTION TEXT / IMAGE VALIDATION
            ========================================
            */

            if (
                $question === '' &&
                $question_image === null
            ) {

                if ($uploadedFilePath &&
                    file_exists($uploadedFilePath)
                ) {

                    unlink(
                        $uploadedFilePath
                    );
                }

                die(
                    "Please enter question text or upload a question image."
                );
            }


            /*
            ========================================
            MCQ
            ========================================
            */

            if (
                $question_type === 'mcq'
            ) {

                if (
                    $option_a === '' ||
                    $option_b === '' ||
                    $option_c === '' ||
                    $option_d === ''
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "All four options are required for MCQ."
                    );
                }


                if (
                    !in_array(
                        $correct_answer,
                        ['A', 'B', 'C', 'D'],
                        true
                    )
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "Please select one correct answer."
                    );
                }


                $correct_answers = [];
            }


            /*
            ========================================
            MSQ
            ========================================
            */

            elseif (
                $question_type === 'msq'
            ) {

                if (
                    $option_a === '' ||
                    $option_b === '' ||
                    $option_c === '' ||
                    $option_d === ''
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "All four options are required for MSQ."
                    );
                }


                $correct_answers =
                    array_values(
                        array_intersect(
                            [
                                'A',
                                'B',
                                'C',
                                'D'
                            ],
                            is_array(
                                $correct_answers
                            )
                            ? $correct_answers
                            : []
                        )
                    );


                if (
                    empty(
                        $correct_answers
                    )
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "Please select at least one correct answer."
                    );
                }


                $correct_answer = null;
            }


            /*
            ========================================
            TRUE / FALSE
            ========================================
            */

            elseif (
                $question_type === 'true_false'
            ) {

                if (
                    !in_array(
                        $correct_answer,
                        [
                            'TRUE',
                            'FALSE'
                        ],
                        true
                    )
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "Please select True or False."
                    );
                }


                $option_a = 'True';
                $option_b = 'False';
                $option_c = null;
                $option_d = null;

                $correct_answers = [];
            }


            /*
            ========================================
            FILL IN THE BLANK
            ========================================
            */

            elseif (
                $question_type === 'fill_blank'
            ) {

                if (
                    $correct_answer === ''
                ) {

                    if (
                        $uploadedFilePath &&
                        file_exists($uploadedFilePath)
                    ) {

                        unlink(
                            $uploadedFilePath
                        );
                    }

                    die(
                        "Please enter the correct answer."
                    );
                }


                $option_a = null;
                $option_b = null;
                $option_c = null;
                $option_d = null;

                $correct_answers = [];
            }


            /*
            ========================================
            SHORT / LONG ANSWER
            ========================================
            */

            elseif (
                $question_type === 'short_answer' ||
                $question_type === 'long_answer'
            ) {

                $option_a = null;
                $option_b = null;
                $option_c = null;
                $option_d = null;

                $correct_answers = [];

                /*
                Manual evaluation.
                Correct answer is optional.
                */
            }


            /*
            ========================================
            QUESTION ORDER
            ========================================
            */

            if (
                $question_order <= 0
            ) {

                $existingQuestions =
                    $model->getQuestionsByTest(
                        $test_id
                    );


                $question_order =
                    count(
                        $existingQuestions
                    ) + 1;
            }


            /*
            ========================================
            QUESTION DATA
            ========================================
            */

            $questionData = [

                'question_id' =>
                    $question_id,

                'test_id' =>
                    $test_id,

                'question' =>
                    $question,

                'question_type' =>
                    $question_type,

                'option_a' =>
                    $option_a,

                'option_b' =>
                    $option_b,

                'option_c' =>
                    $option_c,

                'option_d' =>
                    $option_d,

                'correct_answer' =>
                    $correct_answer,

                'correct_answers' =>
                    $correct_answers,

                'explanation' =>
                    $explanation !== ''
                    ? $explanation
                    : null,

                'difficulty' =>
                    $difficulty,

                'question_image' =>
                    $question_image,

                'question_order' =>
                    $question_order,

                'marks' =>
                    $marks
            ];


            /*
            ========================================
            CREATE QUESTION
            ========================================
            */

            $created =
                $model->createQuestion(
                    $questionData
                );


            /*
            ========================================
            DATABASE FAILURE
            ========================================
            */

            if (!$created) {

                if (
                    $uploadedFilePath &&
                    file_exists(
                        $uploadedFilePath
                    )
                ) {

                    unlink(
                        $uploadedFilePath
                    );
                }


                die(
                    "Unable to create question."
                );
            }


            /*
            ========================================
            SUCCESS
            ========================================
            */

            header(
                "Location: " .
                ROOT .
                "/teachertests/details/" .
                urlencode(
                    $test_id
                )
            );

            exit;
        }


        /*
        ========================================
        SHOW ADD QUESTION PAGE
        ========================================
        */

        $this->view(
            'teacher-test-addquestion',
            [
                'test' =>
                    $test
            ]
        );
    }


    /*
    ========================================
    DELETE TEST
    ========================================
    */

    public function delete($test_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if (($_SESSION['rank'] ?? '') !== 'teacher') {
            header("Location: " . ROOT . "/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/teachertests");
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token. Please refresh the page and try again.");
        }

        if (!$test_id) {
            header("Location: " . ROOT . "/teachertests");
            exit;
        }

        $school_id = $_SESSION['school_id'] ?? null;

        if (!$school_id) {
            die("No school is assigned to this teacher.");
        }

        $testModel = $this->model('TeacherTestsModel');

        $test = $testModel->getTestById($test_id, $school_id);

        if (!$test) {
            die("Test not found.");
        }

        $deleted = $testModel->deleteTest($test_id, $school_id);

        if (!$deleted) {
            die("Failed to delete test.");
        }

        header("Location: " . ROOT . "/teachertests");
        exit;
    }


    /*
    ========================================
    PUBLISH TEST
    ========================================
    */

    public function publish($test_id = null)
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
        CHECK POST REQUEST
        ========================================
        */

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST'
        ) {

            header(
                "Location: " .
                ROOT .
                "/teachertests"
            );

            exit;
        }


        /*
        ========================================
        CHECK CSRF TOKEN
        ========================================
        */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {

            die(
                "Invalid security token. Please refresh the page and try again."
            );
        }


        /*
        ========================================
        CHECK TEACHER
        ========================================
        */

        if (
            ($_SESSION['rank'] ?? '') !== 'teacher'
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
        CHECK TEST ID
        ========================================
        */

        if (!$test_id) {

            header(
                "Location: " .
                ROOT .
                "/teachertests"
            );

            exit;
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
                "No school is assigned to this teacher."
            );
        }


        /*
        ========================================
        LOAD MODEL
        ========================================
        */

        $testModel =
            $this->model('TeacherTestsModel');


        /*
        ========================================
        CHECK TEST
        ========================================
        */

        $test =
            $testModel->getTestById(
                $test_id,
                $school_id
            );


        if (!$test) {

            die(
                "Test not found."
            );
        }


        /*
        ========================================
        CHECK STATUS
        ========================================
        */

        if (
            ($test->status ?? '') !== 'draft'
        ) {

            die(
                "This test has already been published or closed."
            );
        }


        /*
        ========================================
        CHECK QUESTIONS
        ========================================
        */

        $questions =
            $testModel->getQuestionsByTest(
                $test_id
            );


        if (
            empty($questions)
        ) {

            die(
                "You cannot publish a test without questions."
            );
        }


        /*
        ========================================
        CALCULATE QUESTION MARKS
        ========================================
        */

        $questionMarks = 0;


        foreach (
            $questions
            as $question
        ) {

            $questionMarks +=
                (int)(
                    $question->marks ?? 0
                );
        }


        /*
        ========================================
        CHECK TOTAL MARKS
        ========================================
        */

        if (
            $questionMarks !=
            (int)$test->total_marks
        ) {

            die(
                "Question marks must equal the test total marks before publishing."
            );
        }


        /*
        ========================================
        CHECK PASSING MARKS
        ========================================
        */

        if (
            (int)$test->passing_marks >
            (int)$test->total_marks
        ) {

            die(
                "Passing marks cannot be greater than total marks."
            );
        }


        /*
        ========================================
        PUBLISH TEST
        ========================================
        */

        $updated =
            $testModel->publishTest(
                $test_id,
                $school_id
            );


        if (!$updated) {

            die(
                "Failed to publish test."
            );
        }


        /*
        ========================================
        LOAD NOTIFICATION MODEL
        ========================================
        */

        $notificationModel =
            $this->model(
                'NotificationModel'
            );


        /*
        ========================================
        GET STUDENTS FOR TEST
        ========================================
        */

        $studentQuery = "
            SELECT
                s.user_id
            FROM students s
            WHERE s.school_id = :school_id
            AND s.class = :class
            AND s.division = :division
        ";


        $students =
            $testModel->query(
                $studentQuery,
                [

                    'school_id' =>
                        $school_id,

                    'class' =>
                        $test->class,

                    'division' =>
                        $test->division

                ]
            );


        /*
        ========================================
        CREATE NOTIFICATION FOR EACH STUDENT
        ========================================
        */

        foreach (
            $students
            as $student
        ) {

            if (
                empty(
                    $student->user_id
                )
            ) {

                continue;
            }


            $notificationModel->createNotification(

                $student->user_id,

                $school_id,

                'New Test Available',

                'A new test "' .
                $test->title .
                '" has been published for your class. You can now view and take the test.',

                'test',

                $test_id

            );
        }


        /*
        ========================================
        REDIRECT
        ========================================
        */

        header(
            "Location: " .
            ROOT .
            "/teachertests/details/" .
            urlencode(
                $test_id
            )
        );

        exit;
    }
}