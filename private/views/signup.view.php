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
        href="<?= ROOT ?>/css/signup.view.css?v=2"
    >

</head>


<body>


<div class="signup-card">


    <!-- =========================
         SCHOOL HEADER
    ========================== -->

    <div class="school-header">

        <div class="school-icon">
            🎓
        </div>

        <h1>
            My School
        </h1>

        <p>
            Create a new account
        </p>

    </div>



    <!-- =========================
         FORM TITLE
    ========================== -->

    <div class="form-heading">

        <p class="form-label">
            Account Setup
        </p>

        <h2>
            Add User
        </h2>

        <p>
            Enter the user's information below.
        </p>

    </div>



    <!-- =========================
         ERROR
    ========================== -->

    <?php if (!empty($error)): ?>

        <div class="error-message">

            <span>
                ⚠
            </span>

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>



    <!-- =========================
         SIGNUP FORM
    ========================== -->

    <form
        method="POST"
        action=""
    >


        <!-- =========================
             FIRST + LAST NAME
        ========================== -->

        <div class="row">


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



        <!-- =========================
             EMAIL
        ========================== -->

        <div class="form-group">

            <label for="email">
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter email address"
                autocomplete="email"
                required
            >

        </div>



        <!-- =========================
             GENDER
        ========================== -->

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



        <!-- =========================
             RANK
        ========================== -->

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

                <option value="admin">
                    Staff
                </option>

                <option value="parent">
                    Parent
                </option>

            </select>

        </div>



        <!-- =========================
             PASSWORD
        ========================== -->

        <div class="row">


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create password"
                    autocomplete="new-password"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password2">
                    Confirm Password
                </label>

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



        <!-- =========================
             SUBMIT
        ========================== -->

        <button
            type="submit"
            class="signup-btn"
        >

            Create Account

            <span>
                →
            </span>

        </button>


    </form>



    <!-- =========================
         LOGIN LINK
    ========================== -->

    <div class="login-link">

        <span>
            Already have an account?
        </span>

        <a href="<?= ROOT ?>/login">
            Sign in
        </a>

    </div>


</div>


</body>

</html>