<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        About | My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/about.view.css?v=1"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php require "../private/views/landing.view.php"; ?>



<!-- =====================================================
     ABOUT HERO
===================================================== -->

<section class="about-page-hero">

    <div class="about-page-container">

        <span class="about-label">
            ABOUT MY SCHOOL
        </span>

        <h1>
            Making school management
            <span>simple and organized.</span>
        </h1>

        <p>
            My School is a school management platform designed
            to bring important school activities, people and
            academic information together in one place.
        </p>

    </div>

</section>



<!-- =====================================================
     ABOUT INTRO
===================================================== -->

<section class="about-introduction">

    <div class="about-page-container about-two-column">

        <div class="about-section-title">

            <span>
                OUR PLATFORM
            </span>

            <h2>
                Everything your school
                needs, in one place.
            </h2>

        </div>


        <div class="about-text">

            <p>
                Managing a school involves handling a large
                amount of information every day. Students,
                teachers, parents, administrators, tests and
                results all need to be organized properly.
            </p>

            <p>
                My School provides a centralized digital
                platform that helps schools manage these
                activities more efficiently.
            </p>

            <p>
                Instead of keeping information across
                different systems and records, My School
                brings essential school management functions
                together in one simple platform.
            </p>

        </div>

    </div>

</section>



<!-- =====================================================
     WHAT WE PROVIDE
===================================================== -->

<section class="about-features">

    <div class="about-page-container">

        <div class="about-centered-heading">

            <span>
                WHAT WE PROVIDE
            </span>

            <h2>
                Built around your school.
            </h2>

            <p>
                My School provides tools for managing
                different areas of your school system.
            </p>

        </div>


        <div class="about-feature-grid">


            <!-- SCHOOLS -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ▣
                </div>

                <h3>
                    School Management
                </h3>

                <p>
                    Manage school information and keep
                    administrative records organized.
                </p>

            </div>


            <!-- STUDENTS -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ♙
                </div>

                <h3>
                    Student Management
                </h3>

                <p>
                    Maintain student information and
                    important academic records.
                </p>

            </div>


            <!-- STAFF -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ♟
                </div>

                <h3>
                    Staff Management
                </h3>

                <p>
                    Organize teacher and staff information
                    through one centralized system.
                </p>

            </div>


            <!-- PARENTS -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ◌
                </div>

                <h3>
                    Parent Management
                </h3>

                <p>
                    Keep parent information connected with
                    students and school records.
                </p>

            </div>


            <!-- TESTS -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ✓
                </div>

                <h3>
                    Tests
                </h3>

                <p>
                    Create and manage assessments for
                    students in an organized workflow.
                </p>

            </div>


            <!-- RESULTS -->

            <div class="about-feature-card">

                <div class="about-feature-icon">
                    ≡
                </div>

                <h3>
                    Results
                </h3>

                <p>
                    Manage student results and make
                    academic information easier to access.
                </p>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     WHY MY SCHOOL
===================================================== -->

<section class="about-why">

    <div class="about-page-container">

        <div class="about-two-column">


            <div class="about-section-title">

                <span>
                    WHY MY SCHOOL
                </span>

                <h2>
                    Less complexity.
                    Better organization.
                </h2>

            </div>


            <div class="about-why-list">


                <div class="about-why-item">

                    <span>
                        01
                    </span>

                    <div>

                        <h3>
                            Centralized Information
                        </h3>

                        <p>
                            Keep important school information
                            organized in one platform.
                        </p>

                    </div>

                </div>


                <div class="about-why-item">

                    <span>
                        02
                    </span>

                    <div>

                        <h3>
                            Role-Based Access
                        </h3>

                        <p>
                            Different users can access the
                            features relevant to their role.
                        </p>

                    </div>

                </div>


                <div class="about-why-item">

                    <span>
                        03
                    </span>

                    <div>

                        <h3>
                            Simple Management
                        </h3>

                        <p>
                            Designed to make everyday school
                            management easier and more organized.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     CTA
===================================================== -->

<section class="about-cta">

    <div class="about-page-container">

        <span>
            MY SCHOOL
        </span>

        <h2>
            A simpler way to manage
            your school.
        </h2>

        <p>
            Bring your school's people, information and
            academic activities together in one platform.
        </p>

        <a
            href="<?= ROOT ?>/login"
            class="about-cta-button"
        >
            Get Started
            <span>→</span>
        </a>

    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<?php require "../private/views/includes/footer.view.php"; ?>


</body>

</html>