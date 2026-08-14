<?php

class Signup extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $firstname = trim($_POST['firstname']);
            $lastname  = trim($_POST['lastname']);
            $email     = trim($_POST['email']);
            $gender    = trim($_POST['gender']);
            $rank      = trim($_POST['rank']);
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];


            // Load User model
            $user = $this->model("User");


            // Check password
            if ($password !== $password2) {

                echo "Passwords do not match";
                return;
            }


            // Check if email already exists
            $existingUser = $user->findByEmail($email);

            if ($existingUser) {

                echo "Email already registered";
                return;
            }


            // Hash password
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            // Insert user
            $user->createUser([

                'firstname' => $firstname,
                'lastname'  => $lastname,
                'email'     => $email,
                'gender'    => $gender,
                'rank'      => $rank,
                'password'  => $hashedPassword

            ]);


            // Redirect to login
            header("Location: " . ROOT . "/login");
            exit;
        }


        // Show signup page
        $this->view('signup');
    }
}