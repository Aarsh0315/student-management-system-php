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

    <title>My School - Login</title>

    <link
        rel="stylesheet"
        href="<?= ROOT ?>/css/login.view.css?v=6"
    >

</head>


<body>


<div class="login-page">


    <!-- =====================================
         DECORATIVE BACKGROUND
    ====================================== -->

    <div class="background-shape shape-one"></div>

    <div class="background-shape shape-two"></div>

    <div class="background-dots"></div>


    <!-- =====================================
         LOGIN CONTAINER
    ====================================== -->

    <div class="login-container">


        <!-- =====================================
             LEFT BRAND PANEL
        ====================================== -->

        <div class="brand-panel">


            <div class="brand-content">


                <div class="brand-logo">

                    <div class="brand-logo-icon">
                        <span>MS</span>
                    </div>

                    <div class="brand-logo-text">

                        <strong>
                            My School
                        </strong>

                        <span>
                            Management System
                        </span>

                    </div>

                </div>


                <div class="brand-heading">

                    <span class="brand-badge">
                        SCHOOL MANAGEMENT
                    </span>

                    <h1>
                        Everything your
                        <span>school</span>
                        needs.
                    </h1>

                    <p>
                        Manage students, teachers, parents,
                        academics and communication from one
                        simple platform.
                    </p>

                </div>


                <!-- FEATURES -->

                <div class="brand-features">


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>
                            <strong>
                                Smart Management
                            </strong>

                            <span>
                                Manage your school efficiently
                            </span>
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

                            <span>
                                Secure access for every user
                            </span>
                        </div>

                    </div>


                    <div class="feature-item">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <div>
                            <strong>
                                All in One Place
                            </strong>

                            <span>
                                Academics, people and communication
                            </span>
                        </div>

                    </div>


                </div>


            </div>


            <div class="brand-footer">

                <span>
                    © <?= date('Y') ?> My School
                </span>

                <span>
                    Secure • Simple • Smart
                </span>

            </div>


        </div>



        <!-- =====================================
             LOGIN PANEL
        ====================================== -->

        <div class="login-panel">


            <div class="login-content">


                <!-- MOBILE LOGO -->

                <div class="mobile-brand">

                    <div class="brand-logo-icon">
                        <span>MS</span>
                    </div>

                    <div>

                        <strong>
                            My School
                        </strong>

                        <span>
                            Management System
                        </span>

                    </div>

                </div>


                <!-- LOGIN HEADING -->

                <div class="login-heading">

                    <span class="welcome-label">
                        WELCOME BACK
                    </span>

                    <h2>
                        Sign in to your account
                    </h2>

                    <p>
                        Enter your credentials to continue
                        to your dashboard.
                    </p>

                </div>


                <!-- ERROR -->

                <?php if (!empty($error)): ?>

                    <div
                        class="login-error"
                        role="alert"
                    >

                        <div class="error-icon">
                            !
                        </div>

                        <div>

                            <strong>
                                Login failed
                            </strong>

                            <span>
                                <?= htmlspecialchars($error) ?>
                            </span>

                        </div>

                    </div>

                <?php endif; ?>


                <!-- =====================================
                     FORM
                ====================================== -->

                <form
                    method="POST"
                    action="<?= ROOT ?>/login"
                    class="login-form"
                >

                    <?= CSRF::field() ?>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email address
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M4 5h16c1.1 0 2 .9 2 2v10c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V7c0-1.1.9-2 2-2z"
                                    />

                                    <path
                                        d="m4 7 8 6 8-6"
                                    />
                                </svg>
                            </span>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Enter your email address"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

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
                                name="password"
                                id="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                aria-label="Show password"
                            >

                                <svg
                                    id="eyeIcon"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <path
                                        d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                    />

                                </svg>

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

                            <span class="custom-checkbox"></span>

                            <span class="remember-text">
                                Remember me
                            </span>

                        </label>


                        <a
                            href="<?= ROOT ?>/forgotpassword"
                            class="forgot-password"
                        >
                            Forgot password?
                        </a>


                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-btn"
                    >

                        <span>
                            Sign in
                        </span>

                        <span class="button-arrow">
                            →
                        </span>

                    </button>


                </form>


                <!-- SIGNUP -->

                <div class="signup-link">

                    <span>
                        Don't have an account?
                    </span>

                    <a href="<?= ROOT ?>/signup">
                        Create an account
                    </a>

                </div>


                <!-- SECURITY NOTE -->

                <div class="security-note">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >

                        <path
                            d="M12 3 4 6v5c0 5.2 3.4 9.8 8 11 4.6-1.2 8-5.8 8-11V6l-8-3z"
                        />

                        <path
                            d="m9 12 2 2 4-4"
                        />

                    </svg>

                    <span>
                        Your information is securely protected
                    </span>

                </div>


            </div>


        </div>


    </div>


</div>



<!-- =====================================
     PASSWORD TOGGLE
===================================== -->

<script>

function togglePassword()
{

    const password =
        document.getElementById("password");

    const button =
        document.querySelector(".password-toggle");

    const icon =
        document.getElementById("eyeIcon");


    if (password.type === "password") {

        password.type = "text";

        button.setAttribute(
            "aria-label",
            "Hide password"
        );

        icon.innerHTML = `
            <path
                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
            />
            <path
                d="M4 4l16 16"
            />
        `;

    } else {

        password.type = "password";

        button.setAttribute(
            "aria-label",
            "Show password"
        );

        icon.innerHTML = `
            <path
                d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
            />
            <circle
                cx="12"
                cy="12"
                r="2.5"
            />
        `;

    }

}

</script>


</body>

</html>