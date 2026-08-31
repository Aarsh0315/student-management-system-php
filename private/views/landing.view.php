<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="My School is a modern school management system for managing students, teachers, staff, parents, tests, results and school administration."
    >

    <title>
        My School | School Management System
    </title>


    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/landing.view.css?v=2"
    >

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<header class="landing-navbar">

    <div class="landing-container navbar-inner">


        <!-- LOGO -->

        <a
            href="<?= ROOT ?>"
            class="landing-logo"
        >

            <span class="logo-mark">
                MS
            </span>

            <span class="logo-text">
                My School
            </span>

        </a>


        <!-- NAVIGATION -->

        <nav class="landing-nav-links">

            <a href="#features">
                Features
            </a>

            <a href="#modules">
                Modules
            </a>

            <a href="#about">
                About
            </a>

            <a href="#how-it-works">
                How It Works
            </a>

        </nav>


        <!-- ACTIONS -->

        <div class="landing-nav-actions">

            <a
                href="<?= ROOT ?>/login"
                class="nav-login"
            >
                Login
            </a>

            <a
                href="<?= ROOT ?>/signup"
                class="nav-signup"
            >
                Get Started
            </a>

        </div>


    </div>

</header>



<!-- =====================================================
     HERO SECTION
===================================================== -->

<section class="hero-section">

    <div class="landing-container hero-grid">


        <!-- HERO CONTENT -->

        <div class="hero-content">


            <div class="hero-badge">

                <span></span>

                SMART SCHOOL MANAGEMENT

            </div>


            <h1>

                Manage Your School.

                <span>
                    Simplify Everything.
                </span>

            </h1>


            <p class="hero-description">

                My School is a centralized school management
                system designed to help administrators manage
                students, teachers, staff, parents, tests,
                results and school operations from one place.

            </p>


            <div class="hero-buttons">

                <a
                    href="<?= ROOT ?>/signup"
                    class="hero-primary-btn"
                >
                    Get Started
                    <span>→</span>
                </a>


                <a
                    href="#features"
                    class="hero-outline-btn"
                >
                    Explore Platform
                </a>

            </div>


            <div class="hero-trust">

                <span>✓</span>

                Centralized Management

                <span>✓</span>

                Role-Based Access

                <span>✓</span>

                Organized Records

            </div>


        </div>



        <!-- HERO DASHBOARD -->

        <div class="hero-dashboard">


            <div class="dashboard-window">


                <!-- WINDOW HEADER -->

                <div class="window-header">

                    <div class="window-dots">

                        <span></span>
                        <span></span>
                        <span></span>

                    </div>

                    <span>
                        My School Dashboard
                    </span>

                </div>


                <!-- DASHBOARD CONTENT -->

                <div class="window-content">


                    <div class="preview-heading">

                        <div>

                            <small>
                                SCHOOL OVERVIEW
                            </small>

                            <h3>
                                Welcome back, Admin
                            </h3>

                        </div>

                        <span class="online-status">
                            ● Active
                        </span>

                    </div>


                    <!-- STATS -->

                    <div class="preview-stats">


                        <div class="preview-stat">

                            <span class="stat-icon">
                                ST
                            </span>

                            <div>

                                <small>
                                    Students
                                </small>

                                <strong>
                                    1,248
                                </strong>

                            </div>

                        </div>


                        <div class="preview-stat">

                            <span class="stat-icon">
                                TC
                            </span>

                            <div>

                                <small>
                                    Teachers
                                </small>

                                <strong>
                                    86
                                </strong>

                            </div>

                        </div>


                        <div class="preview-stat">

                            <span class="stat-icon">
                                PR
                            </span>

                            <div>

                                <small>
                                    Parents
                                </small>

                                <strong>
                                    1,102
                                </strong>

                            </div>

                        </div>


                        <div class="preview-stat">

                            <span class="stat-icon">
                                TS
                            </span>

                            <div>

                                <small>
                                    Tests
                                </small>

                                <strong>
                                    42
                                </strong>

                            </div>

                        </div>


                    </div>


                    <!-- RECENT ACTIVITY -->

                    <div class="preview-panel">

                        <div class="panel-header">

                            <strong>
                                Recent Activity
                            </strong>

                            <span>
                                View All
                            </span>

                        </div>


                        <div class="activity-item">

                            <span class="activity-circle">
                                ST
                            </span>

                            <div>

                                <strong>
                                    New student added
                                </strong>

                                <small>
                                    Student Management
                                </small>

                            </div>

                            <time>
                                2m
                            </time>

                        </div>


                        <div class="activity-item">

                            <span class="activity-circle">
                                TS
                            </span>

                            <div>

                                <strong>
                                    Test result updated
                                </strong>

                                <small>
                                    Academic Records
                                </small>

                            </div>

                            <time>
                                15m
                            </time>

                        </div>


                        <div class="activity-item">

                            <span class="activity-circle">
                                TC
                            </span>

                            <div>

                                <strong>
                                    Teacher profile updated
                                </strong>

                                <small>
                                    Staff Management
                                </small>

                            </div>

                            <time>
                                1h
                            </time>

                        </div>


                    </div>


                </div>

            </div>


        </div>


    </div>

</section>



<!-- =====================================================
     PLATFORM STATS
===================================================== -->

<section class="stats-section">

    <div class="landing-container stats-grid">


        <div class="platform-stat">

            <strong>
                8+
            </strong>

            <span>
                Management Modules
            </span>

        </div>


        <div class="platform-stat">

            <strong>
                7+
            </strong>

            <span>
                User Roles
            </span>

        </div>


        <div class="platform-stat">

            <strong>
                100%
            </strong>

            <span>
                Centralized Records
            </span>

        </div>


        <div class="platform-stat">

            <strong>
                24/7
            </strong>

            <span>
                System Accessibility
            </span>

        </div>


    </div>

</section>



<!-- =====================================================
     FEATURES
===================================================== -->

<section
    class="landing-section"
    id="features"
>

    <div class="landing-container">


        <div class="section-heading">

            <span>
                PLATFORM FEATURES
            </span>

            <h2>
                Everything You Need to Run Your School
            </h2>

            <p>
                Bring your school's daily management activities
                together with a simple and organized platform.
            </p>

        </div>


        <div class="features-grid">


            <div class="feature-card">

                <div class="feature-number">
                    01
                </div>

                <h3>
                    Student Management
                </h3>

                <p>
                    Maintain student profiles, personal
                    information, classes, schools and
                    account status in one place.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    02
                </div>

                <h3>
                    Teacher Management
                </h3>

                <p>
                    Organize teacher information, roles,
                    departments and school assignments.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    03
                </div>

                <h3>
                    Staff Management
                </h3>

                <p>
                    Manage school staff records, roles,
                    departments and associated information.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    04
                </div>

                <h3>
                    Parent Management
                </h3>

                <p>
                    Maintain parent information and connect
                    parents with student records.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    05
                </div>

                <h3>
                    Tests & Assessments
                </h3>

                <p>
                    Create and organize tests while keeping
                    academic assessment information structured.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    06
                </div>

                <h3>
                    Results Management
                </h3>

                <p>
                    Record marks, percentages and results
                    while keeping student performance organized.
                </p>

                <a href="#modules">
                    Learn More →
                </a>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     MODULES
===================================================== -->

<section
    class="landing-section modules-section"
    id="modules"
>

    <div class="landing-container">


        <div class="section-heading">

            <span>
                SCHOOL MANAGEMENT MODULES
            </span>

            <h2>
                One Platform for Every Important Area
            </h2>

            <p>
                My School brings multiple school management
                areas together into one connected system.
            </p>

        </div>


        <div class="modules-grid">


            <div class="module-item">

                <span>
                    01
                </span>

                <div>
                    <h3>
                        Schools
                    </h3>

                    <p>
                        Manage school information and
                        organizational records.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    02
                </span>

                <div>
                    <h3>
                        School Administrators
                    </h3>

                    <p>
                        Assign and manage administrative
                        access for schools.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    03
                </span>

                <div>
                    <h3>
                        Students
                    </h3>

                    <p>
                        Centralize student profiles and
                        academic information.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    04
                </span>

                <div>
                    <h3>
                        Teachers
                    </h3>

                    <p>
                        Manage teaching staff and their
                        school assignments.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    05
                </span>

                <div>
                    <h3>
                        Staff
                    </h3>

                    <p>
                        Organize non-teaching staff and
                        departmental information.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    06
                </span>

                <div>
                    <h3>
                        Parents
                    </h3>

                    <p>
                        Maintain parent records and
                        student relationships.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    07
                </span>

                <div>
                    <h3>
                        Tests
                    </h3>

                    <p>
                        Organize examinations and
                        assessment records.
                    </p>
                </div>

            </div>


            <div class="module-item">

                <span>
                    08
                </span>

                <div>
                    <h3>
                        Results
                    </h3>

                    <p>
                        Manage marks, percentages and
                        student performance.
                    </p>
                </div>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     ABOUT
===================================================== -->

<section
    class="landing-section about-section"
    id="about"
>

    <div class="landing-container about-grid">


        <div class="about-content">

            <div class="section-heading left-heading">

                <span>
                    ABOUT MY SCHOOL
                </span>

                <h2>
                    Designed to Make School Management Simpler
                </h2>

            </div>


            <p>
                Managing a school involves handling a large
                amount of information every day. Students,
                teachers, staff, parents, examinations and
                results all need to stay organized.
            </p>


            <p>
                My School provides a centralized platform where
                these important records can be managed through
                a structured and easy-to-use interface.
            </p>


            <p>
                With role-based access, each type of user can
                work with the information relevant to their
                responsibilities.
            </p>


        </div>


        <div class="about-card">


            <div class="about-card-top">

                <span>
                    MY SCHOOL
                </span>

                <span class="about-check">
                    ✓
                </span>

            </div>


            <h3>
                One Connected
                School Ecosystem
            </h3>


            <div class="about-list">

                <div>
                    <span>✓</span>
                    Centralized Information
                </div>

                <div>
                    <span>✓</span>
                    Organized Records
                </div>

                <div>
                    <span>✓</span>
                    Role-Based Access
                </div>

                <div>
                    <span>✓</span>
                    Easy Administration
                </div>

            </div>


        </div>


    </div>

</section>



<!-- =====================================================
     USER ROLES
===================================================== -->

<section class="landing-section roles-section">

    <div class="landing-container">


        <div class="section-heading">

            <span>
                ROLE-BASED ACCESS
            </span>

            <h2>
                Built for Every User in Your School
            </h2>

            <p>
                Different users can access the parts of the
                system relevant to their responsibilities.
            </p>

        </div>


        <div class="roles-grid">


            <div class="role-card">

                <strong>
                    SA
                </strong>

                <h3>
                    Super Admin
                </h3>

                <p>
                    Manage the overall platform and
                    school administration.
                </p>

            </div>


            <div class="role-card">

                <strong>
                    A
                </strong>

                <h3>
                    School Admin
                </h3>

                <p>
                    Manage school-level users,
                    records and operations.
                </p>

            </div>


            <div class="role-card">

                <strong>
                    T
                </strong>

                <h3>
                    Teacher
                </h3>

                <p>
                    Access relevant student,
                    tests and academic information.
                </p>

            </div>


            <div class="role-card">

                <strong>
                    S
                </strong>

                <h3>
                    Student
                </h3>

                <p>
                    Access personal information,
                    tests and academic results.
                </p>

            </div>


            <div class="role-card">

                <strong>
                    P
                </strong>

                <h3>
                    Parent
                </h3>

                <p>
                    Access relevant student and
                    academic information.
                </p>

            </div>


            <div class="role-card">

                <strong>
                    ST
                </strong>

                <h3>
                    Staff
                </h3>

                <p>
                    Access information based on
                    assigned responsibilities.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     HOW IT WORKS
===================================================== -->

<section
    class="landing-section how-section"
    id="how-it-works"
>

    <div class="landing-container">


        <div class="section-heading">

            <span>
                HOW IT WORKS
            </span>

            <h2>
                Simple, Structured and Organized
            </h2>

            <p>
                Get your school management workflow started
                through a straightforward process.
            </p>

        </div>


        <div class="steps-grid">


            <div class="step-card">

                <span class="step-number">
                    01
                </span>

                <h3>
                    Create Your Account
                </h3>

                <p>
                    Register your account and access
                    the My School platform.
                </p>

            </div>


            <div class="step-card">

                <span class="step-number">
                    02
                </span>

                <h3>
                    Configure Your School
                </h3>

                <p>
                    Add your school information and
                    organize your administration.
                </p>

            </div>


            <div class="step-card">

                <span class="step-number">
                    03
                </span>

                <h3>
                    Add Users
                </h3>

                <p>
                    Add students, teachers, staff
                    and parents to the system.
                </p>

            </div>


            <div class="step-card">

                <span class="step-number">
                    04
                </span>

                <h3>
                    Manage & Monitor
                </h3>

                <p>
                    Manage tests, results and school
                    information from one dashboard.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     BENEFITS
===================================================== -->

<section class="benefits-section">

    <div class="landing-container benefits-grid">


        <div>

            <span class="benefits-label">
                WHY MY SCHOOL?
            </span>

            <h2>
                Less Complexity.
                Better Organization.
            </h2>

            <p>
                Keep your school's important information
                structured and accessible through a single
                management platform.
            </p>

        </div>


        <div class="benefits-list">


            <div>
                <span>✓</span>
                Centralized school records
            </div>


            <div>
                <span>✓</span>
                Clear role-based access
            </div>


            <div>
                <span>✓</span>
                Organized academic information
            </div>


            <div>
                <span>✓</span>
                Simple administration workflow
            </div>


        </div>


    </div>

</section>



<!-- =====================================================
     CTA
===================================================== -->

<section class="cta-section">

    <div class="landing-container cta-content">


        <span>
            GET STARTED WITH MY SCHOOL
        </span>


        <h2>
            Bring Your School Management
            Into One Place.
        </h2>


        <p>
            Start managing your school's information
            through a centralized platform.
        </p>


        <div class="cta-buttons">

            <a
                href="<?= ROOT ?>/signup"
                class="cta-primary"
            >
                Create Your Account
                <span>→</span>
            </a>


            <a
                href="<?= ROOT ?>/login"
                class="cta-secondary"
            >
                Already have an account? Login
            </a>

        </div>


    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="landing-footer">

    <div class="landing-container footer-grid">


        <div class="footer-brand">

            <a
                href="<?= ROOT ?>"
                class="landing-logo"
            >

                <span class="logo-mark">
                    MS
                </span>

                <span class="logo-text">
                    My School
                </span>

            </a>


            <p>
                A centralized school management system
                designed to simplify school administration.
            </p>

        </div>


        <div class="footer-column">

            <h4>
                Platform
            </h4>

            <a href="#features">
                Features
            </a>

            <a href="#modules">
                Modules
            </a>

            <a href="#how-it-works">
                How It Works
            </a>

        </div>


        <div class="footer-column">

            <h4>
                Account
            </h4>

            <a href="<?= ROOT ?>/login">
                Login
            </a>

            <a href="<?= ROOT ?>/signup">
                Sign Up
            </a>

        </div>


        <div class="footer-column">

            <h4>
                Information
            </h4>

            <a href="#about">
                About
            </a>

            <a href="#features">
                Features
            </a>

            <a href="#modules">
                School Modules
            </a>

        </div>


    </div>


    <div class="landing-container footer-bottom">

        <span>
            © <?= date('Y') ?> My School. All rights reserved.
        </span>

        <span>
            School Management System
        </span>

    </div>

</footer>


</body>

</html>