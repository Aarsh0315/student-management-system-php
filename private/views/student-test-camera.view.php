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
        href="<?= ROOT ?>/css/student-test-camera.view.css?v=1"
    >

</head>


<body>


<main class="exam-camera-page">


    <!-- ========================================
         CAMERA CHECK CARD
    ======================================== -->

    <section class="camera-check-card">


        <div class="camera-header">

            <p class="camera-label">
                Examination Security
            </p>

            <h1>
                Camera Check
            </h1>

            <p>
                Allow camera access before
                starting your examination.
            </p>

        </div>



        <!-- ========================================
             CAMERA AREA
        ======================================== -->

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



        <!-- ========================================
             CAMERA STATUS
        ======================================== -->

        <div
            id="cameraStatus"
            class="camera-status"
        >

            <span class="status-dot"></span>

            Camera permission required

        </div>



        <!-- ========================================
             ERROR MESSAGE
        ======================================== -->

        <div
            id="cameraError"
            class="camera-error"
        ></div>



        <!-- ========================================
             ACTION
        ======================================== -->

        <button
            type="button"
            id="cameraButton"
            class="camera-button"
        >
            Enable Camera
        </button>


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


let cameraStream = null;


/*
========================================
ENABLE CAMERA
========================================
*/

cameraButton.addEventListener(
    'click',
    async function () {

        error.textContent = '';

        try {

            cameraStream =
                await navigator.mediaDevices
                    .getUserMedia({
                        video: true,
                        audio: false
                    });


            video.srcObject =
                cameraStream;


            video.style.display =
                'block';


            placeholder.style.display =
                'none';


            status.classList.add(
                'ready'
            );


            status.innerHTML =
                '<span class="status-dot"></span>' +
                ' Camera ready';


            cameraButton.disabled =
                true;


            cameraButton.textContent =
                'Camera Enabled';


            startExamButton.disabled =
                false;

        }

        catch (cameraError) {

            console.error(
                cameraError
            );


            error.textContent =
                'Camera access was denied or is unavailable. ' +
                'Please allow camera permission and try again.';

        }

    }
);


/*
========================================
START EXAM
========================================
*/

startExamButton.addEventListener(
    'click',
    async function () {

        /*
        Request fullscreen
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
        Stop camera for now
        */

        if (cameraStream) {

            cameraStream
                .getTracks()
                .forEach(
                    track => track.stop()
                );

        }


        /*
        Go to exam
        */

        window.location.href =
            "<?= ROOT ?>/studenttests/exam/<?= urlencode($test->test_id) ?>";

    }
);

</script>


</body>

</html>