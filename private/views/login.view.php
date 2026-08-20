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
        href="<?= ROOT ?>/css/login.view.css?v=1"
    >

</head>


<body>


<div class="login-page">


    <!-- =========================
         LEFT SIDE
    ========================== -->

    <section class="login-info">

        <div class="login-info-content">


            <div class="brand">

                <div class="brand-icon">
                    🎓
                </div>

                <span>
                    My School
                </span>

            </div>


            <h1>
                Manage your school
                <span>smarter.</span>
            </h1>


            <p>
                A simple and powerful school management
                platform for administrators, teachers,
                students and parents.
            </p>


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
                            Manage your school from one place.
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
                            Keep academic information organized.
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
                            Role-based access for every user.
                        </p>

                    </div>

                </div>


            </div>


        </div>


        <p class="login-copyright">
            © <?= date('Y') ?> My School. All rights reserved.
        </p>

    </section>



    <!-- =========================
         RIGHT SIDE
    ========================== -->

    <section class="login-form-section">


        <div class="login-card">


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
                        ⚠
                    </span>

                    <?= htmlspecialchars($error) ?>

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

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        autocomplete="email"
                        required
                    >

                </div>



                <!-- PASSWORD -->

                <div class="form-group">

                    <div class="password-label">

                        <label for="password">
                            Password
                        </label>

                    </div>


                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                </div>



                <!-- REMEMBER -->

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



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="login-btn"
                >

                    Sign In

                    <span>
                        →
                    </span>

                </button>


            </form>


            <div class="login-footer">

                <p>
                    Don't have an account?
                    
                    <a href="<?= ROOT ?>/signup">
                        Create an account
                    </a>
                </p>

            </div>


        </div>


    </section>


</div>


</body>

</html>