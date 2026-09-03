<?php

$error = $data['error'] ?? '';

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
        My School - Sign Up
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/signup.view.css?v=4"
    >

</head>


<body>


<div class="signup-page">


    <!-- ========================================
         MAIN CONTAINER
    ======================================== -->

    <div class="signup-container">


        <!-- ========================================
             LEFT PANEL
        ======================================== -->

        <section class="signup-visual">


            <!-- DECORATION -->

            <div class="visual-circle circle-one"></div>

            <div class="visual-circle circle-two"></div>

            <div class="visual-dots"></div>


            <!-- ========================================
                 BRAND
            ======================================== -->

            <div class="brand">

                <div class="brand-logo">
                    🎓
                </div>

                <div>

                    <strong>
                        My School
                    </strong>

                    <small>
                        School Management System
                    </small>

                </div>

            </div>


            <!-- ========================================
                 CONTENT
            ======================================== -->

            <div class="visual-content">


                <p class="visual-label">
                    GET STARTED
                </p>


                <h1>

                    Create your

                    <span>
                        account.
                    </span>

                </h1>


                <p class="visual-description">

                    Join My School and get access to a
                    simple, secure platform designed to
                    manage your school efficiently.

                </p>


                <!-- ========================================
                     FEATURES
                ======================================== -->

                <div class="feature-list">


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                One School Platform
                            </strong>

                            <p>
                                Everything your school needs
                                in one place.
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Role-Based Access
                            </strong>

                            <p>
                                Access designed for students,
                                teachers and staff.
                            </p>

                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Secure & Organized
                            </strong>

                            <p>
                                Keep your school information
                                safe and organized.
                            </p>

                        </div>

                    </div>


                </div>


            </div>


            <!-- ========================================
                 FOOTER
            ======================================== -->

            <div class="visual-footer">

                <span class="footer-shield">
                    ✓
                </span>

                <span>
                    © <?= date('Y') ?> My School.
                    All rights reserved.
                </span>

            </div>


        </section>



        <!-- ========================================
             RIGHT FORM
        ======================================== -->

        <section class="signup-form-section">


            <div class="signup-card">


                <!-- ========================================
                     HEADER
                ======================================== -->

                <div class="signup-header">

                    <p class="signup-small">
                        Account Setup
                    </p>

                    <h2>
                        Create an account
                    </h2>

                    <p>
                        Enter your information below.
                    </p>

                </div>


                <!-- ========================================
                     ERROR
                ======================================== -->

                <?php if (!empty($error)): ?>

                    <div class="signup-error">

                        <span>
                            !
                        </span>

                        <div>
                            <?= htmlspecialchars($error) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- ========================================
                     FORM
                ======================================== -->

                <form
                    method="POST"
                    action=""
                    class="signup-form"
                >


                    <!-- FIRST + LAST NAME -->

                    <div class="form-row">


                        <div class="form-group">

                            <label for="firstname">
                                First Name
                            </label>

                            <input
                                type="text"
                                id="firstname"
                                name="firstname"
                                placeholder="First name"
                                autocomplete="given-name"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="lastname">
                                Last Name
                            </label>

                            <input
                                type="text"
                                id="lastname"
                                name="lastname"
                                placeholder="Last name"
                                autocomplete="family-name"
                                required
                            >

                        </div>


                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Enter email address"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>


                    <!-- GENDER + USER TYPE -->

                    <div class="form-row">


                        <div class="form-group">

                            <label for="gender">
                                Gender
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                required
                            >

                                <option value="">
                                    Select gender
                                </option>

                                <option value="male">
                                    Male
                                </option>

                                <option value="female">
                                    Female
                                </option>

                                <option value="other">
                                    Other
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label for="rank">
                                User Type
                            </label>

                            <select
                                id="rank"
                                name="rank"
                                required
                            >

                                <option value="">
                                    Select user type
                                </option>

                                <option value="student">
                                    Student
                                </option>

                                <option value="teacher">
                                    Teacher
                                </option>

                                <option value="parent">
                                    Parent
                                </option>

                            </select>

                        </div>


                    </div>


                    <!-- PASSWORDS -->

                    <div class="form-row">


                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    🔒
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Create password"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="password2">
                                Confirm Password
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    🔒
                                </span>

                                <input
                                    type="password"
                                    id="password2"
                                    name="password2"
                                    placeholder="Confirm password"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                        </div>


                    </div>


                    <!-- TERMS -->

                    <label class="terms">

                        <input
                            type="checkbox"
                            name="terms"
                            required
                        >

                        <span>
                            I agree to the terms and conditions.
                        </span>

                    </label>


                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="signup-btn"
                    >

                        <span>
                            Create Account
                        </span>

                        <strong>
                            →
                        </strong>

                    </button>


                </form>


                <!-- ========================================
                     LOGIN
                ======================================== -->

                <div class="login-divider">

                    <span></span>

                    <p>
                        Already have an account?
                    </p>

                    <span></span>

                </div>


                <a
                    href="<?= ROOT ?>/login"
                    class="login-btn"
                >
                    Sign in to your account
                </a>


            </div>


        </section>


    </div>


</div>


</body>

</html>