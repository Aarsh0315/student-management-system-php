<?php

class Login extends Controller
{
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = trim($_POST['email']);

            $password = $_POST['password'];


            /*
            ========================================
            LOAD USER MODEL
            ========================================
            */

            $user = $this->model("User");


            /*
            ========================================
            FIND USER
            ========================================
            */

            $result = $user->findByEmail($email);


            /*
            ========================================
            USER NOT FOUND
            ========================================
            */

            if (!$result) {

                $data['error'] =
                    "This email is not registered.";

            } else {


                /*
                ========================================
                CHECK PASSWORD
                ========================================
                */

                if (
                    password_verify(
                        $password,
                        $result->password
                    )
                ) {


                    /*
                    ========================================
                    START SESSION
                    ========================================
                    */

                    if (
                        session_status()
                        === PHP_SESSION_NONE
                    ) {

                        session_start();

                    }


                    /*
                    ========================================
                    STORE USER INFORMATION
                    ========================================
                    */

                    $_SESSION['user_id'] =
                        $result->user_id;

                    $_SESSION['firstname'] =
                        $result->firstname;

                    $_SESSION['lastname'] =
                        $result->lastname;

                    $_SESSION['email'] =
                        $result->email;

                    $_SESSION['gender'] =
                        $result->gender;

                    $_SESSION['rank'] =
                        $result->rank;

                    $_SESSION['school_id'] =
                        $result->school_id;


                    /*
                    ========================================
                    REDIRECT BASED ON ROLE
                    ========================================
                    */


                    // SUPER ADMIN

                    if (
                        $result->rank
                        === 'super_admin'
                    ) {

                        header(
                            "Location: "
                            . ROOT
                            . "/superadmin"
                        );

                        exit;
                    }


                    // SCHOOL ADMIN

                    if (
                        $result->rank
                        === 'admin'
                    ) {

                        header(
                            "Location: "
                            . ROOT
                            . "/school-admin"
                        );

                        exit;
                    }


                    /*
                    ========================================
                    OTHER USERS
                    ========================================
                    */

                    header(
                        "Location: "
                        . ROOT
                        . "/home"
                    );

                    exit;


                } else {


                    /*
                    ========================================
                    WRONG PASSWORD
                    ========================================
                    */

                    $data['error'] =
                        "Incorrect password.";

                }

            }

        }


        /*
        ========================================
        LOGIN VIEW
        ========================================
        */

        $this->view(
            'login',
            $data
        );
    }
}