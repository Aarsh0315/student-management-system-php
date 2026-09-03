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


    <!-- ========================================
         EXAM CSS
    ========================================= -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-test-exam.view.css?v=4"
    >

</head>


<body>


<!-- ========================================
     CAMERA
========================================= -->

<div class="exam-camera-box">

    <video
        id="examCamera"
        autoplay
        playsinline
        muted
    ></video>


    <div
        id="examCameraStatus"
        class="exam-camera-status"
    >

        <span></span>

        Camera starting...

    </div>

</div>



<!-- ========================================
     EXAM PAGE
========================================= -->

<main class="exam-page">


    <!-- ========================================
         EXAM HEADER
    ========================================= -->

    <header class="exam-header">


        <div class="exam-test-info">

    <h1>
        <?= htmlspecialchars($test->title ?? 'Test') ?>
    </h1>

    <p>
        Test ID:
        <strong>
            <?= htmlspecialchars($test->test_id ?? '-') ?>
        </strong>
    </p>

    <span>
        <?= count($questions) ?> Questions
    </span>

</div>



        <!-- ========================================
             TIMER
        ========================================= -->

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


        <!-- ========================================
             QUESTION NAVIGATION
        ========================================= -->

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



        <!-- ========================================
             QUESTIONS
        ========================================= -->

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


                    <!-- ========================================
                         QUESTION TOP
                    ========================================= -->

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



                    <!-- ========================================
                         QUESTION
                    ========================================= -->

                    <h2>

                        <?= htmlspecialchars(
                            $question->question
                            ?? ''
                        ) ?>

                    </h2>



                    <!-- ========================================
                         MCQ OPTIONS
                    ========================================= -->

                    <?php if (
                        ($question->question_type ?? 'mcq')
                        === 'mcq'
                    ): ?>


                        <div class="options">


                            <?php

                            $options = [

                                'A' =>
                                    $question->option_a
                                    ?? '',

                                'B' =>
                                    $question->option_b
                                    ?? '',

                                'C' =>
                                    $question->option_c
                                    ?? '',

                                'D' =>
                                    $question->option_d
                                    ?? ''

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



<!-- ========================================
     SECURE EXAM OVERLAY
========================================= -->

<style>

#secureExamOverlay {

    position: fixed;

    inset: 0;

    z-index: 999999;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 20px;

    box-sizing: border-box;

    background: #0f172a;
}


.secure-exam-dialog {

    width: 100%;

    max-width: 430px;

    padding: 32px;

    box-sizing: border-box;

    background: #ffffff;

    border-radius: 16px;

    text-align: center;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.25);
}


.secure-exam-dialog h2 {

    margin: 0 0 10px;

    color: #172033;

    font-size: 22px;
}


.secure-exam-dialog p {

    margin: 0 0 22px;

    color: #64748b;

    font-size: 13px;

    line-height: 1.6;
}


#beginSecureExam {

    min-width: 170px;

    padding: 12px 20px;

    background: #2563eb;

    color: #ffffff;

    border: 1px solid #2563eb;

    border-radius: 8px;

    font-family: inherit;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;
}


#beginSecureExam:hover {

    background: #1d4ed8;

    border-color: #1d4ed8;
}


#beginSecureExam:disabled {

    opacity: 0.7;

    cursor: wait;
}

</style>



<!-- ========================================
     SUBMIT CONFIRMATION MODAL
======================================== -->

<div
    id="submitConfirmModal"
    class="submit-confirm-overlay"
    aria-hidden="true"
>

    <div
        class="submit-confirm-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="submitConfirmTitle"
    >

        <h2 id="submitConfirmTitle">
            Submit Test?
        </h2>

        <p>
            Are you sure you want to submit the test?
            You will not be able to change your answers after submission.
        </p>

        <div class="submit-confirm-actions">

            <button
                type="button"
                id="cancelSubmitBtn"
                class="cancel-submit-btn"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmSubmitBtn"
                class="confirm-submit-btn"
            >
                Yes, Submit Test
            </button>

        </div>

    </div>

</div>


<script>

/* =========================================================
   EXAM CONFIGURATION
========================================================= */


const totalQuestions =
    <?= count($questions) ?>;


const durationMinutes =
    <?= (int) ($test->duration ?? 0) ?>;


const submitUrl =
    "<?= ROOT ?>/studenttests/submit/<?= urlencode(
        $test->test_id
    ) ?>";

const csrfToken = "<?= htmlspecialchars(CSRF::token(), ENT_QUOTES, 'UTF-8') ?>";

const integrityEventUrl = "<?= ROOT ?>/studenttests/event";


function logExamEvent(eventType) {

    fetch(integrityEventUrl, {

        method: "POST",

        keepalive: true,

        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body:
            "csrf_token=" + encodeURIComponent(csrfToken) +
            "&test_id=" + encodeURIComponent("<?= $test->test_id ?>") +
            "&event_type=" + encodeURIComponent(eventType)

    }).catch(() => {
        // Do not interrupt the exam if event logging fails
    });

}

const testsUrl =
    "<?= ROOT ?>/studenttests";



/* =========================================================
   QUESTION NAVIGATION
========================================================= */


const questionCards =
    document.querySelectorAll(
        '.question-card'
    );


const questionButtons =
    document.querySelectorAll(
        '.question-number'
    );


let currentQuestion = 0;



function showQuestion(index) {


    questionCards.forEach(
        function(card, i) {

            card.classList.toggle(
                'active',
                i === index
            );

        }
    );


    questionButtons.forEach(
        function(button, i) {

            button.classList.toggle(
                'active',
                i === index
            );

        }
    );


    document
        .getElementById('previousBtn')
        .disabled =
        index === 0;


    document
        .getElementById('nextBtn')
        .style.display =
        index === totalQuestions - 1
            ? 'none'
            : 'inline-flex';


    document
        .getElementById('submitBtn')
        .style.display =
        index === totalQuestions - 1
            ? 'inline-flex'
            : 'none';


    currentQuestion = index;

}



/* =========================================================
   QUESTION NUMBER CLICK
========================================================= */


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



/* =========================================================
   NEXT
========================================================= */


document
    .getElementById('nextBtn')
    .addEventListener(
        'click',
        function() {

            if (
                currentQuestion <
                totalQuestions - 1
            ) {

                showQuestion(
                    currentQuestion + 1
                );

            }

        }
    );



/* =========================================================
   PREVIOUS
========================================================= */


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



/* =========================================================
   TIMER
========================================================= */


let remainingSeconds =
    durationMinutes * 60;


let timerInterval =
    null;


const timerElement =
    document.getElementById(
        'timer'
    );



function updateTimer() {


    const minutes =
        Math.floor(
            remainingSeconds / 60
        );


    const seconds =
        remainingSeconds % 60;


    timerElement.textContent =

        String(minutes)
            .padStart(2, '0')

        + ':'

        +

        String(seconds)
            .padStart(2, '0');


    if (
        remainingSeconds <= 0
    ) {


        if (
            timerInterval !== null
        ) {

            clearInterval(
                timerInterval
            );

        }


        autoSubmitExam();


        return;

    }


    remainingSeconds--;

}



updateTimer();


timerInterval =
    setInterval(
        updateTimer,
        1000
    );



/* =========================================================
   SUBMISSION
========================================================= */


let testSubmitting =
    false;



/*
========================================
COLLECT ANSWERS
========================================
*/


function collectAnswers(
    formData
) {


    document
        .querySelectorAll(
            'input[name^="answers["]:checked'
        )
        .forEach(
            function(input) {

                formData.append(
                    input.name,
                    input.value
                );

            }
        );

}



/*
========================================
MANUAL SUBMIT
========================================
*/


const submitConfirmModal =
    document.getElementById(
        'submitConfirmModal'
    );


const cancelSubmitBtn =
    document.getElementById(
        'cancelSubmitBtn'
    );


const confirmSubmitBtn =
    document.getElementById(
        'confirmSubmitBtn'
    );


function openSubmitConfirmation() {

    if (testSubmitting) {
        return;
    }

    submitConfirmModal.classList.add(
        'show'
    );

    submitConfirmModal.setAttribute(
        'aria-hidden',
        'false'
    );

}


function closeSubmitConfirmation() {

    submitConfirmModal.classList.remove(
        'show'
    );

    submitConfirmModal.setAttribute(
        'aria-hidden',
        'true'
    );

}


document
    .getElementById('submitBtn')
    .addEventListener(
        'click',
        function() {

            openSubmitConfirmation();

        }
    );


cancelSubmitBtn.addEventListener(
    'click',
    function() {

        closeSubmitConfirmation();

    }
);


submitConfirmModal.addEventListener(
    'click',
    function(event) {

        if (
            event.target ===
            submitConfirmModal
        ) {

            closeSubmitConfirmation();

        }

    }
);


confirmSubmitBtn.addEventListener(
    'click',
    function() {

        if (testSubmitting) {
            return;
        }

        testSubmitting = true;

        confirmSubmitBtn.disabled = true;

        confirmSubmitBtn.textContent =
            'Submitting...';

        cancelSubmitBtn.disabled = true;

        submitTest();

    }
);


document.addEventListener(
    'keydown',
    function(event) {

        if (
            event.key === 'Escape' &&
            submitConfirmModal.classList.contains('show') &&
            !testSubmitting
        ) {

            closeSubmitConfirmation();

        }

    }
);



/*
========================================
SUBMIT TEST
========================================
*/


function submitTest() {


    if (
        timerInterval !== null
    ) {

        clearInterval(
            timerInterval
        );

    }


    /*
    Disable all buttons
    */

    document
        .querySelectorAll(
            'button'
        )
        .forEach(
            function(button) {

                button.disabled =
                    true;

            }
        );


    /*
    Stop camera
    */

    stopExamCamera();


    /*
    Exit fullscreen
    */

    if (
        document.fullscreenElement
    ) {

        document
            .exitFullscreen()
            .catch(
                function() {}
            );

    }


    logExamEvent('exam_submitted');


    /*
    Create form
    */

    const form =
        document.createElement(
            'form'
        );


    form.method =
        'POST';


    form.action =
        submitUrl;

    const csrfInput =
    document.createElement('input');

    csrfInput.type =
        'hidden';

    csrfInput.name =
        'csrf_token';

    csrfInput.value =
        csrfToken;

    form.appendChild(
        csrfInput
    );


    /*
    Add answers
    */

    document
        .querySelectorAll(
            'input[name^="answers["]:checked'
        )
        .forEach(
            function(input) {


                const hiddenInput =
                    document.createElement(
                        'input'
                    );


                hiddenInput.type =
                    'hidden';


                hiddenInput.name =
                    input.name;


                hiddenInput.value =
                    input.value;


                form.appendChild(
                    hiddenInput
                );

            }
        );


    document.body.appendChild(
        form
    );


    form.submit();

}



/*
========================================
AUTOMATIC SUBMIT
========================================
*/


function autoSubmitExam() {


    if (
        testSubmitting
    ) {

        return;

    }


    testSubmitting =
        true;


    if (
        submitConfirmModal
    ) {

        closeSubmitConfirmation();

    }


    if (
        timerInterval !== null
    ) {

        clearInterval(
            timerInterval
        );

    }


    logExamEvent('exam_submitted');


    /*
    Collect answers
    */

    const formData =
        new FormData();

    formData.append(
    'csrf_token',
    csrfToken
);    


    collectAnswers(
        formData
    );


    /*
    Send answers
    */

    try {

        navigator.sendBeacon(
            submitUrl,
            formData
        );

    }

    catch (error) {

        console.error(
            'Automatic submission failed:',
            error
        );

    }


    /*
    Stop camera
    */

    stopExamCamera();


    /*
    Exit fullscreen
    */

    if (
        document.fullscreenElement
    ) {

        document
            .exitFullscreen()
            .catch(
                function() {}
            );

    }


    /*
    Redirect
    */

    setTimeout(
        function() {

            window.location.href =
                testsUrl;

        },
        500
    );

}



/* =========================================================
   CAMERA
========================================================= */


const examCamera =
    document.getElementById(
        'examCamera'
    );


const examCameraStatus =
    document.getElementById(
        'examCameraStatus'
    );


let examCameraStream =
    null;



async function startExamCamera() {


    if (
        !navigator.mediaDevices
        ||
        !navigator.mediaDevices
            .getUserMedia
    ) {


        examCameraStatus
            .classList
            .add('error');


        examCameraStatus.innerHTML =
            '<span></span> Camera unavailable';

        logExamEvent('camera_disconnected');


        return false;

    }


    try {


        examCameraStream =

            await navigator
                .mediaDevices
                .getUserMedia({

                    video: true,

                    audio: false

                });


        examCamera.srcObject =
            examCameraStream;


        examCameraStatus
            .classList
            .add('ready');


        examCameraStatus.innerHTML =

            '<span></span> Camera Active';

        logExamEvent('camera_connected');


        return true;


    }

    catch (
        cameraError
    ) {


        console.error(
            'Camera error:',
            cameraError
        );


        examCameraStatus
            .classList
            .add('error');


        examCameraStatus.innerHTML =

            '<span></span> Camera Required';

        logExamEvent('camera_disconnected');


        return false;

    }

}



/*
========================================
STOP CAMERA
========================================
*/


function stopExamCamera() {


    if (
        examCameraStream
    ) {


        examCameraStream
            .getTracks()
            .forEach(
                function(track) {

                    track.stop();

                }
            );


        examCameraStream =
            null;

    }

}



/* =========================================================
   SECURE EXAM
========================================================= */


let examLocked =
    false;



/*
========================================
SECURE OVERLAY
========================================
*/


const secureOverlay =
    document.createElement(
        'div'
    );


secureOverlay.id =
    'secureExamOverlay';



secureOverlay.innerHTML = `

    <div class="secure-exam-dialog">

        <h2>
            Secure Examination
        </h2>

        <p>

            Your examination will open
            in fullscreen mode.

            Do not leave the
            examination window.

            Leaving fullscreen or
            switching to another tab
            will submit your test
            automatically.

        </p>

        <button
            type="button"
            id="beginSecureExam"
        >

            Start Secure Exam

        </button>

    </div>

`;



document.body.appendChild(
    secureOverlay
);



const beginSecureExam =
    document.getElementById(
        'beginSecureExam'
    );



/* =========================================================
   FULLSCREEN
========================================================= */


async function enterFullscreen() {


    if (
        document.fullscreenElement
    ) {

        return true;

    }


    if (
        !document
            .documentElement
            .requestFullscreen
    ) {

        return false;

    }


    try {


        await document
            .documentElement
            .requestFullscreen();


        return true;


    }

    catch (
        error
    ) {


        console.error(
            'Fullscreen error:',
            error
        );


        return false;

    }

}



/* =========================================================
   START SECURE EXAM
========================================================= */


beginSecureExam
    .addEventListener(
        'click',
        async function() {


            if (
                examLocked
            ) {

                return;

            }


            beginSecureExam.disabled =
                true;


            beginSecureExam.textContent =
                'Starting...';



            /*
            Fullscreen
            */

            const fullscreenStarted =
                await enterFullscreen();



            if (
                !fullscreenStarted
            ) {


                beginSecureExam.disabled =
                    false;


                beginSecureExam.textContent =
                    'Start Secure Exam';


                alert(
                    'Fullscreen could not be started. ' +
                    'Please click Start Secure Exam again.'
                );


                return;

            }



            /*
            Camera
            */

            const cameraStarted =
                await startExamCamera();



            if (
                !cameraStarted
            ) {


                if (
                    document.fullscreenElement
                ) {

                    await document
                        .exitFullscreen()
                        .catch(
                            function() {}
                        );

                }


                beginSecureExam.disabled =
                    false;


                beginSecureExam.textContent =
                    'Start Secure Exam';


                alert(
                    'Camera access is required to start the examination.'
                );


                return;

            }



            /*
            Exam is now locked
            */

            examLocked =
                true;

            logExamEvent('exam_started');

            secureOverlay.remove();

        }
    );



/* =========================================================
   BLOCK RIGHT CLICK
========================================================= */


document.addEventListener(
    'contextmenu',
    function(event) {


        if (
            examLocked
        ) {

            event.preventDefault();

            logExamEvent('right_click_attempt');

        }

    }
);



/* =========================================================
   BLOCK COPY / PASTE / CUT
========================================================= */


[
    'copy',
    'paste',
    'cut'
]
.forEach(
    function(eventName) {


        document.addEventListener(
            eventName,
            function(event) {


                if (
                    examLocked
                ) {

                    event.preventDefault();

                    if (eventName === 'copy') {
                        logExamEvent('copy_attempt');
                    }

                    if (eventName === 'paste') {
                        logExamEvent('paste_attempt');
                    }

                }

            }
        );

    }
);



/* =========================================================
   KEYBOARD PROTECTION
========================================================= */


document.addEventListener(
    'keydown',
    function(event) {


        if (
            !examLocked
        ) {

            return;

        }


        const key =
            event.key.toLowerCase();



        /*
        F12 / F11
        */

        if (

            event.key === 'F12'

            ||

            event.key === 'F11'

        ) {


            event.preventDefault();

            return;

        }



        /*
        CTRL shortcuts
        */

        if (

            event.ctrlKey

            &&

            (

                key === 'c'

                ||

                key === 'v'

                ||

                key === 'x'

                ||

                key === 'u'

                ||

                key === 's'

                ||

                key === 'p'

            )

        ) {


            event.preventDefault();

            return;

        }



        /*
        Developer tools
        */

        if (

            event.ctrlKey

            &&

            event.shiftKey

            &&

            (

                key === 'i'

                ||

                key === 'j'

                ||

                key === 'c'

            )

        ) {


            event.preventDefault();

            return;

        }



        /*
        Browser back / forward
        */

        if (

            event.altKey

            &&

            (

                event.key ===
                'ArrowLeft'

                ||

                event.key ===
                'ArrowRight'

            )

        ) {


            event.preventDefault();

        }

    }
);



/* =========================================================
   BACK BUTTON
========================================================= */


history.pushState(
    null,
    '',
    location.href
);



window.addEventListener(
    'popstate',
    function() {


        if (
            !examLocked
            ||
            testSubmitting
        ) {

            return;

        }


        autoSubmitExam();

    }
);



/* =========================================================
   TAB CHANGE
========================================================= */


/*
IMPORTANT:

Do not use "blur".

visibilitychange is used because
blur can trigger accidentally.
*/


document.addEventListener(
    'visibilitychange',
    function() {


        if (

            document.hidden

            &&

            examLocked

            &&

            !testSubmitting

        ) {

            logExamEvent('tab_switch');

            autoSubmitExam();

        }

    }
);



/* =========================================================
   FULLSCREEN EXIT
========================================================= */


document.addEventListener(
    'fullscreenchange',
    function() {

        if (
            document.fullscreenElement
            &&
            examLocked
        ) {

            logExamEvent('fullscreen_entered');

        }


        if (

            !document.fullscreenElement

            &&

            examLocked

            &&

            !testSubmitting

        ) {

            logExamEvent('fullscreen_exited');

            autoSubmitExam();

        }

    }
);



/* =========================================================
   REFRESH / CLOSE
========================================================= */


window.addEventListener(
    'pagehide',
    function() {


        if (

            !examLocked

            ||

            testSubmitting

        ) {

            return;

        }


        autoSubmitExam();

    }
);



/* =========================================================
   INITIAL QUESTION
========================================================= */


showQuestion(0);

</script>


</body>

</html>