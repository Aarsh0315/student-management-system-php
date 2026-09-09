<?php

$test = $data['test'] ?? null;

$testId = $test->test_id ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Add Question - My School
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-addquestion.view.css?v=4"
    >

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<?php require "../private/views/includes/nav.view.php"; ?>


<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ======================================== -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher / Test Builder
            </p>

            <h1>
                Add Question
            </h1>

            <p class="welcome-text">

                <?= htmlspecialchars(
                    $test->title ?? 'Test'
                ) ?>

            </p>

        </div>

    </section>


    <!-- ========================================
         QUESTION BUILDER
    ======================================== -->

    <section class="test-form-card">


        <!-- ====================================
             BUILDER HEADER
        ==================================== -->

        <div class="test-form-header">

            <div>

                <span class="builder-label">
                    QUESTION BUILDER
                </span>

                <h2>
                    Create a Question
                </h2>

                <p>
                    Select a question type and configure the question,
                    answers and evaluation settings.
                </p>

            </div>

        </div>


        <form
    method="POST"
    action="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($testId) ?>"
    id="questionForm"
    enctype="multipart/form-data"
>

            <?= CSRF::field() ?>


            <!-- ====================================
                 QUESTION TYPE
            ==================================== -->

            <div class="builder-section">

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            01
                        </span>

                        <div>

                            <h3>
                                Question Type
                            </h3>

                            <p>
                                Choose how students will answer this question.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="question-type-grid">


                    <label class="type-card active">

                        <input
                            type="radio"
                            name="question_type"
                            value="mcq"
                            checked
                        >

                        <span class="type-icon">
                            MCQ
                        </span>

                        <span class="type-content">

                            <strong>
                                Multiple Choice
                            </strong>

                            <small>
                                Select one correct answer
                            </small>

                        </span>

                    </label>


                    <label class="type-card">

                        <input
                            type="radio"
                            name="question_type"
                            value="msq"
                        >

                        <span class="type-icon">
                            MSQ
                        </span>

                        <span class="type-content">

                            <strong>
                                Multiple Select
                            </strong>

                            <small>
                                Select multiple correct answers
                            </small>

                        </span>

                    </label>


                    <label class="type-card">

                        <input
                            type="radio"
                            name="question_type"
                            value="true_false"
                        >

                        <span class="type-icon">
                            T/F
                        </span>

                        <span class="type-content">

                            <strong>
                                True / False
                            </strong>

                            <small>
                                Students choose true or false
                            </small>

                        </span>

                    </label>


                    <label class="type-card">

                        <input
                            type="radio"
                            name="question_type"
                            value="fill_blank"
                        >

                        <span class="type-icon">
                            AB
                        </span>

                        <span class="type-content">

                            <strong>
                                Fill in the Blank
                            </strong>

                            <small>
                                Student enters the answer
                            </small>

                        </span>

                    </label>


                    <label class="type-card">

                        <input
                            type="radio"
                            name="question_type"
                            value="short_answer"
                        >

                        <span class="type-icon">
                            SA
                        </span>

                        <span class="type-content">

                            <strong>
                                Short Answer
                            </strong>

                            <small>
                                Brief written response
                            </small>

                        </span>

                    </label>


                    <label class="type-card">

                        <input
                            type="radio"
                            name="question_type"
                            value="long_answer"
                        >

                        <span class="type-icon">
                            LA
                        </span>

                        <span class="type-content">

                            <strong>
                                Descriptive
                            </strong>

                            <small>
                                Detailed written response
                            </small>

                        </span>

                    </label>


                </div>

            </div>


            <!-- ====================================
                 QUESTION
            ==================================== -->

            <div class="builder-section">

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            02
                        </span>

                        <div>

                            <h3>
                                Question
                            </h3>

                            <p>
                                Write the question students will see.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="form-group">

                    <label for="question">
                        Question Text
                        <span>*</span>
                    </label>

                    <textarea
                        id="question"
                        name="question"
                        rows="5"
                        placeholder="Enter your question here..."
                        required
                    ></textarea>

                </div>

            </div>

            <div class="form-group question-image-upload">

    <label for="question_image">
        Question Image
        <span>(Optional)</span>
    </label>

    <div class="image-upload-box">

        <input
            type="file"
            id="question_image"
            name="question_image"
            accept="image/jpeg,image/png,image/webp"
        >

        <label for="question_image" class="image-upload-label">
            <span class="upload-icon">↑</span>

            <span class="upload-content">
                <strong>Upload Question Image</strong>
                <small>
                    JPG, PNG or WEBP · Maximum 2 MB
                </small>
            </span>
        </label>

    </div>

</div>


            <!-- ====================================
                 OPTIONS
            ==================================== -->

            <div
                class="builder-section"
                id="optionsSection"
            >

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            03
                        </span>

                        <div>

                            <h3>
                                Answer Options
                            </h3>

                            <p id="optionsDescription">
                                Enter four options and select the correct answer.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="options-builder">


                    <!-- OPTION A -->

                    <div class="answer-option">

                        <div class="answer-marker">
                            A
                        </div>

                        <input
                            type="text"
                            name="option_a"
                            id="option_a"
                            placeholder="Enter option A"
                        >

                        <label class="correct-control">

                            <input
                                type="radio"
                                name="correct_answer"
                                value="A"
                                checked
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                        <label class="msq-control">

                            <input
                                type="checkbox"
                                name="correct_answers[]"
                                value="A"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                    </div>


                    <!-- OPTION B -->

                    <div class="answer-option">

                        <div class="answer-marker">
                            B
                        </div>

                        <input
                            type="text"
                            name="option_b"
                            id="option_b"
                            placeholder="Enter option B"
                        >

                        <label class="correct-control">

                            <input
                                type="radio"
                                name="correct_answer"
                                value="B"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                        <label class="msq-control">

                            <input
                                type="checkbox"
                                name="correct_answers[]"
                                value="B"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                    </div>


                    <!-- OPTION C -->

                    <div class="answer-option">

                        <div class="answer-marker">
                            C
                        </div>

                        <input
                            type="text"
                            name="option_c"
                            id="option_c"
                            placeholder="Enter option C"
                        >

                        <label class="correct-control">

                            <input
                                type="radio"
                                name="correct_answer"
                                value="C"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                        <label class="msq-control">

                            <input
                                type="checkbox"
                                name="correct_answers[]"
                                value="C"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                    </div>


                    <!-- OPTION D -->

                    <div class="answer-option">

                        <div class="answer-marker">
                            D
                        </div>

                        <input
                            type="text"
                            name="option_d"
                            id="option_d"
                            placeholder="Enter option D"
                        >

                        <label class="correct-control">

                            <input
                                type="radio"
                                name="correct_answer"
                                value="D"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                        <label class="msq-control">

                            <input
                                type="checkbox"
                                name="correct_answers[]"
                                value="D"
                            >

                            <span>
                                Correct
                            </span>

                        </label>

                    </div>


                </div>

            </div>


            <!-- ====================================
                 TRUE / FALSE
            ==================================== -->

            <div
                class="builder-section hidden-section"
                id="trueFalseSection"
            >

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            03
                        </span>

                        <div>

                            <h3>
                                Correct Answer
                            </h3>

                            <p>
                                Select the correct response.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="true-false-options">

                    <label class="tf-card">

                        <input
                            type="radio"
                            name="tf_answer"
                            value="TRUE"
                        >

                        <span>
                            True
                        </span>

                    </label>


                    <label class="tf-card">

                        <input
                            type="radio"
                            name="tf_answer"
                            value="FALSE"
                        >

                        <span>
                            False
                        </span>

                    </label>

                </div>

            </div>


            <!-- ====================================
                 FILL BLANK
            ==================================== -->

            <div
                class="builder-section hidden-section"
                id="fillBlankSection"
            >

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            03
                        </span>

                        <div>

                            <h3>
                                Expected Answer
                            </h3>

                            <p>
                                Enter the answer that should be accepted.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="form-group">

                    <label for="fill_answer">
                        Correct Answer
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="fill_answer"
                        name="fill_answer"
                        placeholder="Enter the correct answer"
                    >

                </div>

            </div>


            <!-- ====================================
                 WRITTEN ANSWER INFO
            ==================================== -->

            <div
                class="builder-section hidden-section"
                id="writtenAnswerSection"
            >

                <div class="written-answer-info">

                    <div class="info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Manual Evaluation
                        </strong>

                        <p>
                            This question will require manual evaluation
                            by the teacher after the student submits the test.
                        </p>

                    </div>

                </div>

            </div>


            <!-- ====================================
                 SETTINGS
            ==================================== -->

            <div class="builder-section">

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            04
                        </span>

                        <div>

                            <h3>
                                Question Settings
                            </h3>

                            <p>
                                Configure marks and difficulty.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="settings-grid">


                    <!-- MARKS -->

                    <div class="form-group">

                        <label for="marks">
                            Marks
                            <span>*</span>
                        </label>

                        <input
                            type="number"
                            id="marks"
                            name="marks"
                            min="1"
                            step="1"
                            placeholder="Example: 2"
                            required
                        >

                    </div>


                    <!-- DIFFICULTY -->

                    <div class="form-group">

                        <label for="difficulty">
                            Difficulty
                        </label>

                        <select
                            id="difficulty"
                            name="difficulty"
                        >

                            <option value="easy">
                                Easy
                            </option>

                            <option
                                value="medium"
                                selected
                            >
                                Medium
                            </option>

                            <option value="hard">
                                Hard
                            </option>

                        </select>

                    </div>


                    <!-- ORDER -->

                    <div class="form-group">

                        <label for="question_order">
                            Question Order
                        </label>

                        <input
                            type="number"
                            id="question_order"
                            name="question_order"
                            min="0"
                            placeholder="Auto"
                        >

                    </div>

                </div>

            </div>


            <!-- ====================================
                 EXPLANATION
            ==================================== -->

            <div class="builder-section">

                <div class="section-heading">

                    <div>
                        <span class="section-number">
                            05
                        </span>

                        <div>

                            <h3>
                                Explanation
                            </h3>

                            <p>
                                Optional explanation for the correct answer.
                            </p>

                        </div>
                    </div>

                </div>


                <div class="form-group">

                    <label for="explanation">
                        Answer Explanation
                    </label>

                    <textarea
                        id="explanation"
                        name="explanation"
                        rows="4"
                        placeholder="Explain why this answer is correct..."
                    ></textarea>

                </div>

            </div>


            <!-- ====================================
                 ACTIONS
            ==================================== -->

            <div class="form-actions">

                <a
                    href="<?= ROOT ?>/teachertests/details/<?= urlencode($testId) ?>"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="create-test-btn"
                >
                    Save Question
                </button>

            </div>


        </form>

    </section>


</main>


<?php require "../private/views/includes/footer.view.php"; ?>


<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const typeCards =
            document.querySelectorAll(
                '.type-card'
            );

        const typeInputs =
            document.querySelectorAll(
                'input[name="question_type"]'
            );

        const optionsSection =
            document.getElementById(
                'optionsSection'
            );

        const optionsDescription =
            document.getElementById(
                'optionsDescription'
            );

        const trueFalseSection =
            document.getElementById(
                'trueFalseSection'
            );

        const fillBlankSection =
            document.getElementById(
                'fillBlankSection'
            );

        const writtenAnswerSection =
            document.getElementById(
                'writtenAnswerSection'
            );

        const correctControls =
            document.querySelectorAll(
                '.correct-control'
            );

        const msqControls =
            document.querySelectorAll(
                '.msq-control'
            );

        const optionInputs =
            document.querySelectorAll(
                '.answer-option input[type="text"]'
            );

        const correctAnswerInputs =
            document.querySelectorAll(
                'input[name="correct_answer"]'
            );

        const msqAnswerInputs =
            document.querySelectorAll(
                'input[name="correct_answers[]"]'
            );

        const tfAnswerInputs =
            document.querySelectorAll(
                'input[name="tf_answer"]'
            );

        const fillAnswer =
            document.getElementById(
                'fill_answer'
            );


        /*
        ========================================
        UPDATE QUESTION TYPE
        ========================================
        */

        function updateQuestionType(type)
        {
            /*
            Reset sections
            */

            optionsSection
                .classList
                .add('hidden-section');

            trueFalseSection
                .classList
                .add('hidden-section');

            fillBlankSection
                .classList
                .add('hidden-section');

            writtenAnswerSection
                .classList
                .add('hidden-section');


            /*
            Reset option controls
            */

            correctControls.forEach(
                function (control) {

                    control.style.display =
                        'none';
                }
            );


            msqControls.forEach(
                function (control) {

                    control.style.display =
                        'none';
                }
            );


            /*
            MCQ
            */

            if (type === 'mcq') {

                optionsSection
                    .classList
                    .remove('hidden-section');

                optionsDescription.textContent =
                    'Enter four options and select one correct answer.';


                correctControls.forEach(
                    function (control) {

                        control.style.display =
                            'flex';
                    }
                );


                optionInputs.forEach(
                    function (input) {

                        input.required =
                            true;
                    }
                );
            }


            /*
            MSQ
            */

            if (type === 'msq') {

                optionsSection
                    .classList
                    .remove('hidden-section');

                optionsDescription.textContent =
                    'Enter four options and select all correct answers.';


                msqControls.forEach(
                    function (control) {

                        control.style.display =
                            'flex';
                    }
                );


                optionInputs.forEach(
                    function (input) {

                        input.required =
                            true;
                    }
                );
            }


            /*
            TRUE / FALSE
            */

            if (type === 'true_false') {

                trueFalseSection
                    .classList
                    .remove('hidden-section');


                tfAnswerInputs.forEach(
                    function (input) {

                        input.required =
                            true;
                    }
                );


                optionInputs.forEach(
                    function (input) {

                        input.required =
                            false;
                    }
                );
            }


            /*
            FILL BLANK
            */

            if (type === 'fill_blank') {

                fillBlankSection
                    .classList
                    .remove('hidden-section');


                fillAnswer.required =
                    true;


                optionInputs.forEach(
                    function (input) {

                        input.required =
                            false;
                    }
                );
            }


            /*
            WRITTEN ANSWERS
            */

            if (
                type === 'short_answer' ||
                type === 'long_answer'
            ) {

                writtenAnswerSection
                    .classList
                    .remove('hidden-section');


                optionInputs.forEach(
                    function (input) {

                        input.required =
                            false;
                    }
                );
            }
        }


        /*
        ========================================
        TYPE CARD CLICK
        ========================================
        */

        typeCards.forEach(
            function (card) {

                card.addEventListener(
                    'click',
                    function () {

                        typeCards.forEach(
                            function (item) {

                                item.classList
                                    .remove(
                                        'active'
                                    );
                            }
                        );


                        card.classList
                            .add('active');

                    }
                );

            }
        );


        /*
        ========================================
        TYPE CHANGE
        ========================================
        */

        typeInputs.forEach(
            function (input) {

                input.addEventListener(
                    'change',
                    function () {

                        updateQuestionType(
                            this.value
                        );

                    }
                );

            }
        );


        /*
        ========================================
        FORM SUBMIT
        ========================================
        */

        document
            .getElementById('questionForm')
            .addEventListener(
                'submit',
                function (event) {

                    const selectedType =
                        document.querySelector(
                            'input[name="question_type"]:checked'
                        )?.value;


                    /*
                    MSQ validation
                    */

                    if (
                        selectedType === 'msq'
                    ) {

                        const checked =
                            document.querySelectorAll(
                                'input[name="correct_answers[]"]:checked'
                            );


                        if (
                            checked.length === 0
                        ) {

                            event.preventDefault();

                            alert(
                                'Please select at least one correct answer.'
                            );

                            return;
                        }
                    }


                    /*
                    TRUE/FALSE
                    */

                    if (
                        selectedType === 'true_false'
                    ) {

                        const selected =
                            document.querySelector(
                                'input[name="tf_answer"]:checked'
                            );


                        if (!selected) {

                            event.preventDefault();

                            alert(
                                'Please select True or False.'
                            );

                            return;
                        }


                        /*
                        Copy value to controller's
                        correct_answer field.
                        */

                        let hidden =
                            document.getElementById(
                                'trueFalseCorrectAnswer'
                            );


                        if (!hidden) {

                            hidden =
                                document.createElement(
                                    'input'
                                );

                            hidden.type =
                                'hidden';

                            hidden.name =
                                'correct_answer';

                            hidden.id =
                                'trueFalseCorrectAnswer';

                            this.appendChild(
                                hidden
                            );
                        }


                        hidden.value =
                            selected.value;
                    }


                    /*
                    FILL BLANK
                    */

                    if (
                        selectedType === 'fill_blank'
                    ) {

                        let hidden =
                            document.getElementById(
                                'fillBlankCorrectAnswer'
                            );


                        if (!hidden) {

                            hidden =
                                document.createElement(
                                    'input'
                                );

                            hidden.type =
                                'hidden';

                            hidden.name =
                                'correct_answer';

                            hidden.id =
                                'fillBlankCorrectAnswer';

                            this.appendChild(
                                hidden
                            );
                        }


                        hidden.value =
                            fillAnswer.value.trim();
                    }

                }
            );


        /*
        ========================================
        INITIAL STATE
        ========================================
        */

        updateQuestionType('mcq');

    }

);

</script>


</body>

</html>