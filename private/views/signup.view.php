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

    <title>My School - Sign Up</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/signup.view.css?v=5"
    >

</head>


<body>


<div class="signup-page">


    <!-- BACKGROUND -->

    <div class="background-shape shape-one"></div>

    <div class="background-shape shape-two"></div>

    <div class="background-dots"></div>


    <!-- MAIN CONTAINER -->

    <div class="signup-container">


        <!-- =====================================
             LEFT BRAND PANEL
        ====================================== -->

        <section class="signup-visual">


            <div class="visual-content">


                <!-- BRAND -->

                <div class="brand">

                    <div class="brand-logo">
                        <span>MS</span>
                    </div>

                    <div class="brand-name">

                        <strong>
                            My School
                        </strong>

                        <small>
                            Management System
                        </small>

                    </div>

                </div>


                <!-- HERO -->

                <div class="visual-hero">

                    <span class="visual-label">
                        GET STARTED
                    </span>

                    <h1>
                        Build a better
                        <span>school experience.</span>
                    </h1>

                    <p>
                        Create your account and connect with
                        a simple, secure platform built to bring
                        your school community together.
                    </p>

                </div>


                <!-- FEATURES -->

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
                                Manage everything from one place.
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
                                Personalized access for every user.
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
                                Your school information stays protected.
                            </p>

                        </div>

                    </div>


                </div>


            </div>


            <!-- FOOTER -->

            <div class="visual-footer">

                <span>
                    © <?= date('Y') ?> My School
                </span>

                <span>
                    Secure • Simple • Smart
                </span>

            </div>


        </section>



        <!-- =====================================
             RIGHT FORM
        ====================================== -->

        <section class="signup-form-section">


            <div class="signup-card">


                <!-- MOBILE BRAND -->

                <div class="mobile-brand">

                    <div class="brand-logo">
                        <span>MS</span>
                    </div>

                    <div>

                        <strong>
                            My School
                        </strong>

                        <small>
                            Management System
                        </small>

                    </div>

                </div>


                <!-- HEADER -->

                <div class="signup-header">

                    <span class="signup-small">
                        ACCOUNT SETUP
                    </span>

                    <h2>
                        Create your account
                    </h2>

                    <p>
                        Fill in your details to get started.
                    </p>

                </div>


                <!-- ERROR -->

                <?php if (!empty($error)): ?>

                    <div
                        class="signup-error"
                        role="alert"
                    >

                        <div class="error-icon">
                            !
                        </div>

                        <div>

                            <strong>
                                Registration failed
                            </strong>

                            <span>
                                <?= htmlspecialchars($error) ?>
                            </span>

                        </div>

                    </div>

                <?php endif; ?>


                <!-- FORM -->

                <form
                    method="POST"
                    action=""
                    class="signup-form"
                >


                    <!-- NAME -->

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

                                <svg viewBox="0 0 24 24">

                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />

                                    <path d="m4 7 8 6 8-6" />

                                </svg>

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

                            <div class="select-wrapper">

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

                        </div>


                        <div class="form-group">

                            <label for="rank">
                                User Type
                            </label>

                            <div class="select-wrapper">

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


                    </div>


                    <!-- PASSWORD -->

                    <div class="form-row">


                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">

                                    <svg viewBox="0 0 24 24">

                                        <rect
                                            x="4"
                                            y="10"
                                            width="16"
                                            height="11"
                                            rx="2"
                                        />

                                        <path
                                            d="M8 10V7a4 4 0 0 1 8 0v3"
                                        />

                                    </svg>

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

                                    <svg viewBox="0 0 24 24">

                                        <rect
                                            x="4"
                                            y="10"
                                            width="16"
                                            height="11"
                                            rx="2"
                                        />

                                        <path
                                            d="M8 10V7a4 4 0 0 1 8 0v3"
                                        />

                                    </svg>

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

                        <span class="custom-checkbox"></span>

                        <span>
                            I agree to the
                            <a href="#">
                                terms and conditions
                            </a>.
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


                <!-- LOGIN -->

                <div class="login-divider">

                    <span></span>

                    <p>
                        Already have an account?
                    </p>

                    <span></span>

                </div>


                <a
                    href="<?= ROOT ?>/login"
                    class="login-link"
                >
                    Sign in to your account
                </a>


                <!-- SECURITY -->

                <div class="security-note">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M12 3 4 6v5c0 5.2 3.4 9.8 8 11 4.6-1.2 8-5.8 8-11V6l-8-3z"
                        />

                        <path d="m9 12 2 2 4-4" />

                    </svg>

                    <span>
                        Your information is securely protected
                    </span>

                </div>


            </div>


        </section>


    </div>


</div>


</body>

</html>