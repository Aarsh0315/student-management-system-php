<?php

class Login extends Controller
{
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Load User model
            $user = $this->model("User");

            // Find user by email
            $result = $user->findByEmail($email);

            // User doesn't exist
            if (!$result) {

                $data['error'] = "This email is not registered.";

            } else {

                // Check password
                if (password_verify($password, $result->password)) {

                    // Start session
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Store user information in session
                    $_SESSION['user_id'] = $result->id;
                    $_SESSION['firstname'] = $result->firstname;
                    $_SESSION['lastname'] = $result->lastname;
                    $_SESSION['email'] = $result->email;
                    $_SESSION['gender'] = $result->gender;
                    $_SESSION['rank'] = $result->rank;

                    // Login successful
                    if ($result->rank === 'super_admin') {

                        header("Location: " . ROOT . "/superadmin");

                    } else {

                        header("Location: " . ROOT . "/home");

                    }

                    exit;

                } else {

                    $data['error'] = "Incorrect password.";
                }
            }
        }

        $this->view('login', $data);
    }
}