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
        href="<?= ROOT ?>/css/login.view.css?v=5"
    >

</head>


<body>


<div class="login-page">


    <!-- =====================================
         LOGIN BOX
    ====================================== -->

    <div class="login-box">


        <!-- USER ICON -->

        <div class="user-icon">

            <span>♙</span>

        </div>


        <!-- TITLE -->

        <div class="login-heading">

            <h1>
                Welcome Back
            </h1>

            <p>
                Sign in to your My School account
            </p>

        </div>


        <!-- ERROR -->

        <?php if (!empty($error)): ?>

            <div class="login-error">

                <span>!</span>

                <?= htmlspecialchars($error) ?>

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


            <!-- EMAIL -->

            <div class="input-group">

                <span class="input-icon">
                    ✉
                </span>

                <input
                    type="email"
                    name="email"
                    placeholder="Email address"
                    autocomplete="email"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="input-group">

                <span class="input-icon">
                    🔒
                </span>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword()"
                    aria-label="Show password"
                >
                    👁
                </button>

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


                <a
                    href="<?= ROOT ?>/forgotpassword"
                    class="forgot-password"
                >
                    Forgot Password?
                </a>

            </div>


            <!-- LOGIN BUTTON -->

            <button
                type="submit"
                class="login-btn"
            >

                <span>
                    LOGIN
                </span>

                <strong>
                    →
                </strong>

            </button>


        </form>


        <!-- =====================================
             SIGNUP
        ====================================== -->

        <div class="signup-link">

            <span>
                Don't have an account?
            </span>

            <a href="<?= ROOT ?>/signup">
                Create an account
            </a>

        </div>


    </div>


</div>


<!-- =====================================
     THEME TOGGLE
===================================== -->

<button
    type="button"
    class="login-theme-toggle"
    id="loginThemeToggle"
    aria-label="Switch theme"
    title="Switch to dark mode"
>
    <span id="loginThemeIcon">☾</span>

    <span id="loginThemeText">
        Dark
    </span>
</button>


<script>

/* =====================================
   PASSWORD TOGGLE
===================================== */

function togglePassword()
{
    const password =
        document.getElementById("password");

    const button =
        document.querySelector(".password-toggle");


    if (password.type === "password") {

        password.type = "text";

        button.innerHTML = "🙈";

        button.setAttribute(
            "aria-label",
            "Hide password"
        );

    } else {

        password.type = "password";

        button.innerHTML = "👁";

        button.setAttribute(
            "aria-label",
            "Show password"
        );

    }
}


/* =====================================
   LOGIN THEME TOGGLE
===================================== */

const loginThemeToggle =
    document.getElementById("loginThemeToggle");

const loginThemeIcon =
    document.getElementById("loginThemeIcon");

const loginThemeText =
    document.getElementById("loginThemeText");


function applyLoginTheme(theme)
{
    document.documentElement.setAttribute(
        "data-theme",
        theme
    );


    if (theme === "dark") {

        loginThemeIcon.textContent = "☀";

        loginThemeText.textContent = "Light";

        loginThemeToggle.setAttribute(
            "aria-label",
            "Switch to light mode"
        );

        loginThemeToggle.setAttribute(
            "title",
            "Switch to light mode"
        );

    } else {

        loginThemeIcon.textContent = "☾";

        loginThemeText.textContent = "Dark";

        loginThemeToggle.setAttribute(
            "aria-label",
            "Switch to dark mode"
        );

        loginThemeToggle.setAttribute(
            "title",
            "Switch to dark mode"
        );

    }
}


/* =====================================
   LOAD SAVED THEME
===================================== */

const savedLoginTheme =
    localStorage.getItem("mySchoolLoginTheme");


if (
    savedLoginTheme === "dark" ||
    savedLoginTheme === "light"
) {

    applyLoginTheme(savedLoginTheme);

} else {

    applyLoginTheme("light");

}


/* =====================================
   THEME BUTTON
===================================== */

loginThemeToggle.addEventListener(
    "click",
    function()
    {

        const currentTheme =
            document.documentElement
                .getAttribute("data-theme");


        const newTheme =
            currentTheme === "dark"
                ? "light"
                : "dark";


        localStorage.setItem(
            "mySchoolLoginTheme",
            newTheme
        );


        applyLoginTheme(newTheme);

    }
);

</script>


</body>

</html>