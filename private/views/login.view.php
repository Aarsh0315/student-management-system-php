<?php

$error = $data['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.view.css">
</head>

<body>

    <div class="login-box">

        <h1>Login</h1>

        <form method="POST">

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit">Login</button>

            <div class="signup-link">
                Don't have an account?
                <a href="signup">Sign Up</a>
            </div>

        </form>

    </div>

</body>

</html>