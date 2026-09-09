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
        href="<?= ROOT ?>/css/student-test-exam.view.css?v=5"
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

<div
    id="integrityWarning"
    class="integrity-warning"
    aria-live="polite"
    aria-hidden="true"
>
    <strong>Exam activity recorded</strong>
    <span>Your activity has been recorded for review.</span>
</div>

<!-- ========================================
     RETURN TO TEST OVERLAY
========================================= -->

<div
    id="returnToTestOverlay"
    class="return-to-test-overlay"
    aria-hidden="true"
>
    <div class="return-to-test-card">
        <div class="return-to-test-icon">!</div>
        <h2>Return to Test</h2>
        <p>
            You have left the examination window.
            Your activity has been recorded.
            Return to the test to continue.
        </p>
        <button type="button" id="returnToTestButton">
            Go to Test
        </button>
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


.return-to-test-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    box-sizing: border-box;
    background: rgba(15, 23, 42, 0.97);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

.return-to-test-overlay.active {
    display: flex;
}

.return-to-test-card {
    width: min(100%, 430px);
    padding: 34px;
    box-sizing: border-box;
    background: #ffffff;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 24px 70px rgba(0, 0, 0, 0.30);
}

.return-to-test-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff4e5;
    color: #b45309;
    font-size: 22px;
    font-weight: 800;
}

.return-to-test-card h2 {
    margin: 0 0 10px;
    color: #172033;
    font-size: 24px;
}

.return-to-test-card p {
    margin: 0 0 22px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.65;
}

#returnToTestButton {
    min-width: 150px;
    padding: 12px 22px;
    border: 1px solid #303641;
    border-radius: 9px;
    background: #303641;
    color: #ffffff;
    font: inherit;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}

#returnToTestButton:hover {
    background: #20252d;
}

/* Keep the camera stream active, but do not show it while the exam is running. */
.exam-page.exam-blurred {
    filter: blur(9px);
    pointer-events: none;
    user-select: none;
}

.exam-camera-box.exam-camera-hidden {
    position: fixed;
    width: 1px;
    height: 1px;
    overflow: hidden;
    opacity: 0;
    pointer-events: none;
    left: -9999px;
    top: -9999px;
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

        /*
         * Detect when the camera is disconnected or
         * permission/device access is lost during the exam.
         */
        examCameraStream.getVideoTracks().forEach(
            function(track) {
                track.addEventListener(
                    'ended',
                    function() {
                        if (examLocked && !testSubmitting) {
                            examCameraStatus.classList.remove('ready');
                            examCameraStatus.classList.add('error');
                            examCameraStatus.innerHTML =
                                '<span></span> Camera Disconnected';

                            logExamEvent('camera_disconnected');
                        }
                    }
                );
            }
        );

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

            Camera access is required before the test starts.

            The test will open in fullscreen mode so the
            examination area is the only visible test interface.

            If you leave the test window or fullscreen mode,
            the question paper will be protected and you will
            be asked to return to the test. Your activity may
            be recorded for teacher review.

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
            Camera must be connected before the test starts.
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
            Fullscreen starts only after camera access succeeds.
            */

            const fullscreenStarted =
                await enterFullscreen();

            if (!fullscreenStarted) {

                stopExamCamera();

                beginSecureExam.disabled =
                    false;

                beginSecureExam.textContent =
                    'Start Secure Exam';

                alert(
                    'Fullscreen could not be started. ' +
                    'Please allow fullscreen and try again.'
                );

                return;
            }


            /*
            Exam is now locked
            */

            examLocked =
                true;

            /*
            Keep the camera stream active but hide its preview.
            The student should see only the test interface.
            */

            const cameraBox =
                document.querySelector('.exam-camera-box');

            if (cameraBox) {
                cameraBox.classList.add('exam-camera-hidden');
            }

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
            showIntegrityWarning();

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

                    if (eventName === 'cut') {
                        logExamEvent('copy_attempt');
                    }

                    showIntegrityWarning();
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

            if (key === 'c') {
                logExamEvent('copy_attempt');
            }

            if (key === 'v') {
                logExamEvent('paste_attempt');
            }

            if (key === 'x') {
                logExamEvent('copy_attempt');
            }

            showIntegrityWarning();
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
   RETURN TO TEST PROTECTION
========================================================= */

const returnToTestOverlay =
    document.getElementById('returnToTestOverlay');

const returnToTestButton =
    document.getElementById('returnToTestButton');


function showReturnToTestOverlay(reason) {

    if (!returnToTestOverlay) {
        return;
    }

    if (reason === 'fullscreen_exited') {
        returnToTestOverlay.querySelector('p').textContent =
            'Fullscreen mode was exited. Your activity has been recorded. Return to the test to continue.';
    } else {
        returnToTestOverlay.querySelector('p').textContent =
            'You have left the examination window. Your activity has been recorded. Return to the test to continue.';
    }

    const examPage =
        document.querySelector('.exam-page');

    if (examPage) {
        examPage.classList.add('exam-blurred');
    }

    returnToTestOverlay.classList.add('active');
    returnToTestOverlay.setAttribute('aria-hidden', 'false');
}


function hideReturnToTestOverlay() {

    if (!returnToTestOverlay) {
        return;
    }

    const examPage =
        document.querySelector('.exam-page');

    if (examPage) {
        examPage.classList.remove('exam-blurred');
    }

    returnToTestOverlay.classList.remove('active');
    returnToTestOverlay.setAttribute('aria-hidden', 'true');
}


if (returnToTestButton) {

    returnToTestButton.addEventListener(
        'click',
        async function() {

            if (testSubmitting || !examLocked) {
                return;
            }

            returnToTestButton.disabled = true;
            returnToTestButton.textContent = 'Returning...';

            const fullscreenStarted =
                await enterFullscreen();

            if (fullscreenStarted) {
                hideReturnToTestOverlay();
            } else {
                alert(
                    'Please click Go to Test again and allow fullscreen mode.'
                );
            }

            returnToTestButton.disabled = false;
            returnToTestButton.textContent = 'Go to Test';
        }
    );
}


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
        }

        if (
            !document.hidden
            &&
            examLocked
            &&
            !testSubmitting
        ) {
            showReturnToTestOverlay('tab_switch');
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
            showIntegrityWarning();
            showReturnToTestOverlay('fullscreen_exited');
        }

    }
);


/* =========================================================
   REFRESH / CLOSE
========================================================= */


window.addEventListener(
    'pagehide',
    function() {
        /*
         * Do not submit automatically here.
         * Browser close/refresh can be triggered by normal
         * navigation and should not destroy the student's attempt.
         */
        if (!examLocked || testSubmitting) {
            return;
        }
    }
);


/* =========================================================
   INITIAL QUESTION
========================================================= */


showQuestion(0);

</script>


</body>

</html>