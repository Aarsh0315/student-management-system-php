<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My School - Sign Up</title>

    <link rel="stylesheet" href="../public/css/signup.view.css">
</head>

<body>

    <div class="signup-card">

        <!-- School Header -->

        <div class="school-header">

            

            <h1>My School</h1>

            <p>Create a new account</p>

        </div>


        <!-- Signup Form -->

        <h2 class="form-title">Add User</h2>

        <form method="POST">

            <!-- First Name + Last Name -->

            <div class="row">

                <div class="form-group">

                    <label for="firstname">
                        First Name
                    </label>

                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        placeholder="First Name"
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
                        placeholder="Last Name"
                        required
                    >

                </div>

            </div>


            <!-- Email -->

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <!-- Gender -->

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
                        Select Gender
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


            <!-- Role -->

            <div class="form-group">

                <label for="role">
                    Role
                </label>

                <select
                    id="role"
                    name="role"
                    required
                >

                    <option value="">
                        Select Role
                    </option>

                    <option value="student">
                        Student
                    </option>

                    <option value="teacher">
                        Teacher
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>

            </div>


            <!-- Password -->

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                >

            </div>


            <!-- Confirm Password -->

            <div class="form-group">

                <label for="password2">
                    Retype Password
                </label>

                <input
                    type="password"
                    id="password2"
                    name="password2"
                    placeholder="Confirm password"
                    required
                >

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="signup-btn"
            >
                Add User
            </button>

        </form>


        <!-- Login -->

        <div class="login-link">

            Already have an account?

            <a href="login">
                Login
            </a>

        </div>

    </div>

</body>

</html>