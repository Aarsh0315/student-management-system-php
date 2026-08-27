<?php

$test =
    $data['test'] ?? null;

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
        Camera Check -
        <?= htmlspecialchars(
            $test->title ?? 'Test'
        ) ?>
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/student-test-camera.view.css?v=2"
    >

</head>


<body>


<main class="exam-camera-page">


    <!-- =====================================================
         STEP 1 - TEST INSTRUCTIONS
    ====================================================== -->

    <section
        id="instructionsCard"
        class="camera-check-card instructions-card"
    >

        <div class="camera-header">

            <p class="camera-label">
                Examination Security
            </p>

            <h1>
                Before You Start
            </h1>

            <p>
                Please read the instructions carefully
                before continuing to the camera check.
            </p>

        </div>


        <!-- TEST INFORMATION -->

        <div class="test-information">

            <div class="test-information-item">

                <span>
                    Test
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $test->title ?? 'Test'
                    ) ?>
                </strong>

            </div>


            <div class="test-information-item">

                <span>
                    Duration
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $test->duration ?? '0'
                    ) ?>
                    minutes
                </strong>

            </div>


            <div class="test-information-item">

                <span>
                    Total Marks
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $test->total_marks ?? '0'
                    ) ?>
                </strong>

            </div>

        </div>


        <!-- INSTRUCTIONS -->

        <div class="exam-instructions">

            <h3>
                Test Instructions
            </h3>


            <ul>

                <li>
                    Make sure you have a stable internet connection.
                </li>

                <li>
                    Your camera must remain enabled during the examination.
                </li>

                <li>
                    Do not leave the examination screen while attempting the test.
                </li>

                <li>
                    Do not refresh the page or use the browser back button.
                </li>

                <li>
                    Once the test is submitted, you cannot attempt it again.
                </li>

                <li>
                    Make sure you are ready before starting the examination.
                </li>

            </ul>

        </div>


        <!-- AGREEMENT -->

        <label
            class="instruction-checkbox"
        >

            <input
                type="checkbox"
                id="instructionCheckbox"
            >

            <span class="checkbox-mark"></span>

            <span class="checkbox-text">
                I have read and understood the instructions
                and I am ready to start the test.
            </span>

        </label>


        <!-- CONTINUE -->

        <button
            type="button"
            id="continueButton"
            class="continue-button"
            disabled
        >
            Continue
        </button>


    </section>



    <!-- =====================================================
         STEP 2 - CAMERA CHECK
    ====================================================== -->

    <section
        id="cameraCard"
        class="camera-check-card camera-card-hidden"
    >


        <div class="camera-header">

            <p class="camera-label">
                Examination Security
            </p>

            <h1>
                Camera Check
            </h1>

            <p>
                Enable your camera before
                starting the examination.
            </p>

        </div>



        <!-- =================================================
             CAMERA AREA
        ================================================== -->

        <div class="camera-container">

            <video
                id="cameraPreview"
                autoplay
                playsinline
                muted
            ></video>


            <div
                id="cameraPlaceholder"
                class="camera-placeholder"
            >

                <div class="camera-icon">
                    📷
                </div>

                <p>
                    Camera preview will appear here.
                </p>

            </div>

        </div>



        <!-- =================================================
             CAMERA STATUS
        ================================================== -->

        <div
            id="cameraStatus"
            class="camera-status"
        >

            <span class="status-dot"></span>

            Camera is disabled

        </div>



        <!-- =================================================
             ERROR
        ================================================== -->

        <div
            id="cameraError"
            class="camera-error"
        ></div>



        <!-- =================================================
             CAMERA BUTTON
        ================================================== -->

        <button
            type="button"
            id="cameraButton"
            class="camera-button"
        >
            Enable Camera
        </button>



        <!-- =================================================
             START EXAM
        ================================================== -->

        <button
            type="button"
            id="startExamButton"
            class="start-exam-button"
            disabled
        >
            Start Exam
        </button>



        <p class="camera-note">

            Your browser will ask for permission
            to use your camera.

        </p>


    </section>


</main>



<script>

/*
=========================================================
ELEMENTS
=========================================================
*/

const instructionsCard =
    document.getElementById(
        'instructionsCard'
    );


const cameraCard =
    document.getElementById(
        'cameraCard'
    );


const instructionCheckbox =
    document.getElementById(
        'instructionCheckbox'
    );


const continueButton =
    document.getElementById(
        'continueButton'
    );


const video =
    document.getElementById(
        'cameraPreview'
    );


const placeholder =
    document.getElementById(
        'cameraPlaceholder'
    );


const status =
    document.getElementById(
        'cameraStatus'
    );


const error =
    document.getElementById(
        'cameraError'
    );


const cameraButton =
    document.getElementById(
        'cameraButton'
    );


const startExamButton =
    document.getElementById(
        'startExamButton'
    );


/*
=========================================================
CAMERA STREAM
=========================================================
*/

let cameraStream = null;


/*
=========================================================
STEP 1 - CHECKBOX
=========================================================
*/

instructionCheckbox.addEventListener(
    'change',
    function () {

        continueButton.disabled =
            !instructionCheckbox.checked;

    }
);


/*
=========================================================
CONTINUE TO CAMERA
=========================================================
*/

continueButton.addEventListener(
    'click',
    function () {

        if (
            !instructionCheckbox.checked
        ) {

            return;

        }


        instructionsCard.style.display =
            'none';


        cameraCard.classList.remove(
            'camera-card-hidden'
        );


        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    }
);


/*
=========================================================
ENABLE / DISABLE CAMERA
=========================================================
*/

cameraButton.addEventListener(
    'click',
    async function () {


        /*
        ========================================
        CAMERA CURRENTLY OFF
        ========================================
        */

        if (!cameraStream) {

            error.textContent = '';

            cameraButton.disabled =
                true;


            cameraButton.textContent =
                'Starting Camera...';


            try {

                cameraStream =
                    await navigator.mediaDevices
                        .getUserMedia({

                            video: true,

                            audio: false

                        });


                /*
                ========================================
                SHOW VIDEO
                ========================================
                */

                video.srcObject =
                    cameraStream;


                video.style.display =
                    'block';


                placeholder.style.display =
                    'none';


                /*
                ========================================
                STATUS READY
                ========================================
                */

                status.classList.add(
                    'ready'
                );


                status.innerHTML =
                    '<span class="status-dot"></span>' +
                    ' Camera is enabled';


                /*
                ========================================
                BUTTON = DISABLE
                ========================================
                */

                cameraButton.disabled =
                    false;


                cameraButton.textContent =
                    'Disable Camera';


                cameraButton.classList.add(
                    'enabled'
                );


                /*
                ========================================
                ENABLE START EXAM
                ========================================
                */

                startExamButton.disabled =
                    false;

            }

            catch (cameraError) {

                console.error(
                    cameraError
                );


                cameraStream =
                    null;


                cameraButton.disabled =
                    false;


                cameraButton.textContent =
                    'Enable Camera';


                cameraButton.classList.remove(
                    'enabled'
                );


                startExamButton.disabled =
                    true;


                error.textContent =
                    'Camera access was denied or is unavailable. ' +
                    'Please allow camera permission and try again.';

            }


            return;
        }



        /*
        ========================================
        CAMERA CURRENTLY ON
        ========================================
        */

        disableCamera();

    }
);


/*
=========================================================
DISABLE CAMERA
=========================================================
*/

function disableCamera()
{

    /*
    ========================================
    STOP ALL CAMERA TRACKS
    ========================================
    */

    if (cameraStream) {

        cameraStream
            .getTracks()
            .forEach(
                function(track) {

                    track.stop();

                }
            );

    }


    /*
    ========================================
    REMOVE STREAM
    ========================================
    */

    cameraStream =
        null;


    video.srcObject =
        null;


    /*
    ========================================
    HIDE VIDEO
    ========================================
    */

    video.style.display =
        'none';


    placeholder.style.display =
        'flex';


    /*
    ========================================
    STATUS
    ========================================
    */

    status.classList.remove(
        'ready'
    );


    status.innerHTML =
        '<span class="status-dot"></span>' +
        ' Camera is disabled';


    /*
    ========================================
    BUTTON
    ========================================
    */

    cameraButton.textContent =
        'Enable Camera';


    cameraButton.classList.remove(
        'enabled'
    );


    /*
    ========================================
    START EXAM DISABLED
    ========================================
    */

    startExamButton.disabled =
        true;


    error.textContent = '';

}


/*
=========================================================
START EXAM
=========================================================
*/

startExamButton.addEventListener(
    'click',
    async function () {


        /*
        ========================================
        CAMERA MUST BE ON
        ========================================
        */

        if (!cameraStream) {

            error.textContent =
                'Please enable the camera before starting the exam.';

            return;

        }


        /*
        ========================================
        REQUEST FULLSCREEN
        ========================================
        */

        try {

            await document
                .documentElement
                .requestFullscreen();

        }

        catch (fullscreenError) {

            console.log(
                'Fullscreen request failed.',
                fullscreenError
            );

        }


        /*
        ========================================
        DO NOT STOP CAMERA HERE
        ========================================

        The exam page is responsible for
        continuing the camera.
        */


        /*
        ========================================
        GO TO EXAM
        ========================================
        */

        window.location.href =
            "<?= ROOT ?>/studenttests/exam/<?= urlencode($test->test_id) ?>";

    }
);


/*
=========================================================
PAGE EXIT
=========================================================
*/

window.addEventListener(
    'pagehide',
    function () {

        /*
        Stop local camera when leaving
        the camera check page.
        */

        if (cameraStream) {

            cameraStream
                .getTracks()
                .forEach(
                    function(track) {

                        track.stop();

                    }
                );

        }

    }
);

</script>


</body>

</html>