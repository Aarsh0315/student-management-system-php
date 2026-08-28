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
        Login - My School
    </title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/login.view.css?v=3"
    >

</head>


<body>


<div class="login-page">


    <!-- ========================================
         MAIN LOGIN CONTAINER
    ========================================= -->

    <div class="login-container">


        <!-- ========================================
             LEFT PANEL
        ========================================= -->

        <section class="login-visual">


            <!-- DECORATIVE ELEMENTS -->

            <div class="visual-circle circle-one"></div>

            <div class="visual-circle circle-two"></div>

            <div class="visual-dots"></div>



            <!-- BRAND -->

            <div class="brand">

                <div class="brand-logo">

                    <span>🎓</span>

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



            <!-- MAIN CONTENT -->

            <div class="visual-content">

                <p class="visual-label">
                    SCHOOL MANAGEMENT
                </p>


                <h1>

                    Manage your school

                    <span>
                        smarter.
                    </span>

                </h1>


                <p class="visual-description">

                    A simple and powerful platform to manage
                    students, teachers, classes, results and
                    everything your school needs.

                </p>


                <!-- FEATURES -->

                <div class="feature-list">


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Easy Management
                            </strong>

                            <p>
                                Manage your entire school
                                from one place.
                            </p>

                        </div>

                    </div>



                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Students & Teachers
                            </strong>

                            <p>
                                Keep academic information
                                organized and accessible.
                            </p>

                        </div>

                    </div>



                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Secure Access
                            </strong>

                            <p>
                                Role-based access for every
                                user in your school.
                            </p>

                        </div>

                    </div>


                </div>

            </div>



            <!-- COPYRIGHT -->

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
             RIGHT LOGIN PANEL
        ========================================= -->

        <section class="login-form-section">


            <div class="login-card">


                <!-- HEADER -->

                <div class="login-header">

                    <p class="login-small">
                        Welcome back
                    </p>


                    <h2>
                        Sign in to your account
                    </h2>


                    <p>
                        Enter your credentials to continue.
                    </p>

                </div>



                <!-- ERROR -->

                <?php if (!empty($error)): ?>

                    <div class="login-error">

                        <span>
                            !
                        </span>

                        <div>

                            <?= htmlspecialchars($error) ?>

                        </div>

                    </div>

                <?php endif; ?>



                <!-- FORM -->

                <form
                    method="POST"
                    action="<?= ROOT ?>/login"
                    class="login-form"
                >


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
                                placeholder="Enter your email"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>



                    <!-- PASSWORD -->

                    <div class="form-group">

                        <div class="password-heading">

                            <label for="password">
                                Password
                            </label>

                            <a
                                href="#"
                                class="forgot-password"
                            >
                                Forgot password?
                            </a>

                        </div>


                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                aria-label="Show password"
                            >
                                ◉
                            </button>

                        </div>

                    </div>



                    <!-- OPTIONS -->

                    <div class="login-options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>

                    </div>



                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-btn"
                    >

                        <span>
                            Sign In
                        </span>

                        <strong>
                            →
                        </strong>

                    </button>


                </form>



                <!-- DIVIDER -->

                <div class="login-divider">

                    <span></span>

                    <p>
                        Don't have an account?
                    </p>

                    <span></span>

                </div>



                <!-- SIGNUP -->

                <a
                    href="<?= ROOT ?>/signup"
                    class="signup-btn"
                >

                    <span>
                        ＋
                    </span>

                    Create an account

                </a>


            </div>


        </section>


    </div>


</div>



<script>

/*
========================================
SHOW / HIDE PASSWORD
========================================
*/

const password =
    document.getElementById('password');

const passwordToggle =
    document.getElementById('passwordToggle');


if (
    password &&
    passwordToggle
) {

    passwordToggle.addEventListener(
        'click',
        function () {

            if (
                password.type === 'password'
            ) {

                password.type = 'text';

                passwordToggle.textContent = '◉';

                passwordToggle.setAttribute(
                    'aria-label',
                    'Hide password'
                );

            } else {

                password.type = 'password';

                passwordToggle.textContent = '◉';

                passwordToggle.setAttribute(
                    'aria-label',
                    'Show password'
                );
            }

        }
    );

}

</script>


</body>

</html>