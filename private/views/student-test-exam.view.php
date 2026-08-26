<?php

$test =
    $data['test'] ?? null;

$questions =
    $data['questions'] ?? [];

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
        <?= htmlspecialchars(
            $test->title ?? 'Exam'
        ) ?>
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-test-exam.view.css?v=1"
    >

</head>


<body>


<main class="exam-page">


    <!-- ========================================
         EXAM HEADER
    ========================================= -->

    <header class="exam-header">

        <div>

            <h1>
                <?= htmlspecialchars(
                    $test->title ?? 'Test'
                ) ?>
            </h1>

            <p>
                <?= count($questions) ?>
                Questions
            </p>

        </div>


        <div class="exam-timer">

            <span>
                Time Remaining
            </span>

            <strong id="timer">
                Loading...
            </strong>

        </div>

    </header>



    <!-- ========================================
         EXAM BODY
    ========================================= -->

    <section class="exam-container">


        <!-- QUESTION NAVIGATION -->

        <aside class="question-navigation">

            <h3>
                Questions
            </h3>


            <div class="question-numbers">

                <?php foreach (
                    $questions as $index => $question
                ): ?>

                    <button
                        type="button"
                        class="question-number
                        <?= $index === 0
                            ? 'active'
                            : '' ?>"
                        data-question="<?= $index ?>"
                    >

                        <?= $index + 1 ?>

                    </button>

                <?php endforeach; ?>

            </div>

        </aside>



        <!-- QUESTIONS -->

        <div class="questions-area">


            <?php foreach (
                $questions as $index => $question
            ): ?>


                <div
                    class="question-card
                    <?= $index === 0
                        ? 'active'
                        : '' ?>"
                    data-question="<?= $index ?>"
                >


                    <div class="question-top">

                        <span>
                            Question
                            <?= $index + 1 ?>
                            of
                            <?= count($questions) ?>
                        </span>

                        <span>
                            <?= htmlspecialchars(
                                $question->marks ?? 0
                            ) ?>
                            Mark(s)
                        </span>

                    </div>


                    <h2>

                        <?= htmlspecialchars(
                            $question->question
                            ?? ''
                        ) ?>

                    </h2>


                    <?php if (
                        ($question->question_type ?? 'mcq')
                        === 'mcq'
                    ): ?>


                        <div class="options">


                            <?php
                            $options = [
                                'A' => $question->option_a ?? '',
                                'B' => $question->option_b ?? '',
                                'C' => $question->option_c ?? '',
                                'D' => $question->option_d ?? ''
                            ];
                            ?>


                            <?php foreach (
                                $options as $letter => $option
                            ): ?>

                                <label class="option">

                                    <input
                                        type="radio"
                                        name="answers[<?= $question->question_id ?>]"
                                        value="<?= $letter ?>"
                                    >

                                    <span class="option-letter">
                                        <?= $letter ?>
                                    </span>

                                    <span class="option-text">

                                        <?= htmlspecialchars(
                                            $option
                                        ) ?>

                                    </span>

                                </label>

                            <?php endforeach; ?>


                        </div>


                    <?php endif; ?>


                </div>


            <?php endforeach; ?>



            <!-- ========================================
                 QUESTION CONTROLS
            ========================================= -->

            <div class="question-controls">

                <button
                    type="button"
                    id="previousBtn"
                    class="exam-control-btn"
                    disabled
                >
                    ← Previous
                </button>


                <button
                    type="button"
                    id="nextBtn"
                    class="exam-control-btn primary"
                >
                    Next →
                </button>


                <button
                    type="button"
                    id="submitBtn"
                    class="submit-exam-btn"
                >
                    Submit Test
                </button>

            </div>


        </div>


    </section>


</main>



<script>

/*
========================================
EXAM DATA
========================================
*/

const totalQuestions =
    <?= count($questions) ?>;

const durationMinutes =
    <?= (int) ($test->duration ?? 0) ?>;


/*
========================================
QUESTION ELEMENTS
========================================
*/

const questionCards =
    document.querySelectorAll(
        '.question-card'
    );

const questionButtons =
    document.querySelectorAll(
        '.question-number'
    );

let currentQuestion = 0;


/*
========================================
SHOW QUESTION
========================================
*/

function showQuestion(index)
{
    questionCards.forEach(
        function(card, cardIndex) {

            card.classList.toggle(
                'active',
                cardIndex === index
            );

        }
    );


    questionButtons.forEach(
        function(button, buttonIndex) {

            button.classList.toggle(
                'active',
                buttonIndex === index
            );

        }
    );


    document.getElementById(
        'previousBtn'
    ).disabled =
        index === 0;


    document.getElementById(
        'nextBtn'
    ).style.display =
        index === totalQuestions - 1
            ? 'none'
            : 'inline-flex';


    document.getElementById(
        'submitBtn'
    ).style.display =
        index === totalQuestions - 1
            ? 'inline-flex'
            : 'none';


    currentQuestion = index;
}


/*
========================================
QUESTION NUMBER CLICK
========================================
*/

questionButtons.forEach(
    function(button) {

        button.addEventListener(
            'click',
            function() {

                showQuestion(
                    Number(
                        button.dataset.question
                    )
                );

            }
        );

    }
);


/*
========================================
NEXT
========================================
*/

document
    .getElementById('nextBtn')
    .addEventListener(
        'click',
        function() {

            if (
                currentQuestion
                <
                totalQuestions - 1
            ) {

                showQuestion(
                    currentQuestion + 1
                );

            }

        }
    );


/*
========================================
PREVIOUS
========================================
*/

document
    .getElementById('previousBtn')
    .addEventListener(
        'click',
        function() {

            if (
                currentQuestion > 0
            ) {

                showQuestion(
                    currentQuestion - 1
                );

            }

        }
    );


/*
========================================
TIMER
========================================
*/

let remainingSeconds =
    durationMinutes * 60;


const timerElement =
    document.getElementById(
        'timer'
    );


function updateTimer()
{

    const minutes =
        Math.floor(
            remainingSeconds / 60
        );

    const seconds =
        remainingSeconds % 60;


    timerElement.textContent =
        String(minutes).padStart(2, '0')
        + ':'
        +
        String(seconds).padStart(2, '0');


    if (
        remainingSeconds <= 0
    ) {

        clearInterval(
            timerInterval
        );

        alert(
            'Time is over. The test will be submitted.'
        );

        return;

    }


    remainingSeconds--;

}


updateTimer();


const timerInterval =
    setInterval(
        updateTimer,
        1000
    );


/*
========================================
SUBMIT BUTTON
========================================
*/

document
    .getElementById('submitBtn')
    .addEventListener(
        'click',
        function() {

            const confirmed =
                confirm(
                    'Are you sure you want to submit the test?'
                );


            if (!confirmed) {

                return;

            }


            alert(
                'Submission system will be connected next.'
            );

        }
    );


/*
========================================
INITIAL QUESTION
========================================
*/

showQuestion(0);

</script>


</body>

</html>