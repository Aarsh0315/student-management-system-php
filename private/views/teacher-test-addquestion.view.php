<?php

$test = $data['test'] ?? null;

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


    <!-- DASHBOARD CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/home.view.css?v=2"
    >


    <!-- NAVBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/nav.view.css?v=2"
    >


    <!-- SIDEBAR CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/sidebar.view.css?v=2"
    >


    <!-- ADD QUESTION CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/teacher-test-addquestion.view.css?v=2"
    >


    <!-- FOOTER CSS -->

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/footer.view.css?v=2"
    >

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<?php require "../private/views/includes/nav.view.php"; ?>


<!-- ========================================
     SIDEBAR
======================================== -->

<?php require "../private/views/includes/sidebar.view.php"; ?>


<main class="dashboard">


    <!-- ========================================
         PAGE HEADER
    ========================================= -->

    <section class="welcome">

        <div>

            <p class="welcome-small">
                Teacher
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
         QUESTION FORM
    ========================================= -->

    <section class="test-form-card">


        <!-- FORM HEADER -->

        <div class="test-form-header">

            <h2>
                Multiple Choice Question
            </h2>

            <p>
                Add an MCQ question to this test.
            </p>

        </div>



        <!-- ========================================
             FORM
        ========================================= -->

        <form
            method="POST"
            action="<?= ROOT ?>/teachertests/addquestion/<?= urlencode($test->test_id ?? '') ?>"
        >


            <!-- ========================================
                 QUESTION
            ========================================= -->

            <div class="form-group">

                <label for="question">
                    Question
                </label>

                <textarea
                    id="question"
                    name="question"
                    rows="4"
                    placeholder="Enter your question..."
                    required
                ></textarea>

            </div>



            <!-- ========================================
                 OPTIONS
            ========================================= -->

            <div class="options-section">

                <div class="section-label">
                    Answer Options
                </div>


                <div class="options-grid">


                    <!-- OPTION A -->

                    <div class="form-group">

                        <label for="option_a">
                            Option A
                        </label>

                        <input
                            type="text"
                            id="option_a"
                            name="option_a"
                            placeholder="Enter option A"
                            required
                        >

                    </div>



                    <!-- OPTION B -->

                    <div class="form-group">

                        <label for="option_b">
                            Option B
                        </label>

                        <input
                            type="text"
                            id="option_b"
                            name="option_b"
                            placeholder="Enter option B"
                            required
                        >

                    </div>



                    <!-- OPTION C -->

                    <div class="form-group">

                        <label for="option_c">
                            Option C
                        </label>

                        <input
                            type="text"
                            id="option_c"
                            name="option_c"
                            placeholder="Enter option C"
                            required
                        >

                    </div>



                    <!-- OPTION D -->

                    <div class="form-group">

                        <label for="option_d">
                            Option D
                        </label>

                        <input
                            type="text"
                            id="option_d"
                            name="option_d"
                            placeholder="Enter option D"
                            required
                        >

                    </div>


                </div>

            </div>



            <!-- ========================================
                 CORRECT ANSWER + MARKS
            ========================================= -->

            <div class="form-row">


                <!-- CORRECT ANSWER -->

                <div class="form-group">

                    <label for="correct_answer">
                        Correct Answer
                    </label>

                    <select
                        id="correct_answer"
                        name="correct_answer"
                        required
                    >

                        <option value="">
                            Select correct answer
                        </option>

                        <option value="A">
                            Option A
                        </option>

                        <option value="B">
                            Option B
                        </option>

                        <option value="C">
                            Option C
                        </option>

                        <option value="D">
                            Option D
                        </option>

                    </select>

                </div>



                <!-- MARKS -->

                <div class="form-group">

                    <label for="marks">
                        Marks
                    </label>

                    <input
                        type="number"
                        id="marks"
                        name="marks"
                        min="1"
                        placeholder="Example: 2"
                        required
                    >

                </div>


            </div>



            <!-- ========================================
                 ACTIONS
            ========================================= -->

            <div class="form-actions">


                <a
                    href="<?= ROOT ?>/teachertests/details/<?= urlencode($test->test_id ?? '') ?>"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="create-test-btn"
                >
                    Add Question
                </button>


            </div>


        </form>


    </section>


</main>


<!-- ========================================
     FOOTER
======================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


<!-- ========================================
     JAVASCRIPT
======================================== -->

<script src="<?= ROOT ?>/js/nav.js?v=1"></script>

<script src="<?= ROOT ?>/js/sidebar.js?v=1"></script>


</body>

</html>