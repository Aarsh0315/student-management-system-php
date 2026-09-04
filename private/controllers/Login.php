<?php

class Login extends Controller
{
    public function index()
    {
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        ========================================
        LOGIN DATA
        ========================================
        */

        $data = [];


        /*
        ========================================
        HANDLE LOGIN
        ========================================
        */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';


            /*
            ========================================
            VALIDATE INPUT
            ========================================
            */

            if ($email === '' || $password === '') {

                $data['error'] =
                    "Please enter your email and password.";

            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $data['error'] =
                    "Please enter a valid email address.";

            } else {


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
                        "Invalid email or password.";

                } else {


                    /*
                    ========================================
                    CHECK PASSWORD
                    ========================================
                    */

                    if (
                        !isset($result->password) ||
                        !password_verify(
                            $password,
                            $result->password
                        )
                    ) {

                        $data['error'] =
                            "Invalid email or password.";

                    } else {


                        /*
                        ========================================
                        CHECK USER ACCOUNT STATUS
                        ========================================
                        */

                        if (
                            isset($result->status) &&
                            $result->status !== 'active'
                        ) {

                            $data['error'] =
                                "Your account is inactive. Please contact your administrator.";

                        } else {


                            /*
                            ========================================
                            CHECK SCHOOL STATUS
                            SUPER ADMIN HAS NO SCHOOL
                            ========================================
                            */

                            if (
                                $result->rank !== 'super_admin' &&
                                !empty($result->school_id)
                            ) {

                                $schoolQuery = "SELECT
                                                    status
                                                FROM schools
                                                WHERE id = :school_id
                                                LIMIT 1";

                                $schoolResult = $user->query(
                                    $schoolQuery,
                                    [
                                        'school_id' =>
                                            $result->school_id
                                    ]
                                );

                                $school = $schoolResult[0] ?? null;


                                /*
                                ========================================
                                SCHOOL NOT FOUND / INACTIVE
                                ========================================
                                */

                                if (
                                    !$school ||
                                    $school->status !== 'active'
                                ) {

                                    $data['error'] =
                                        "Your school is currently inactive. Please contact your administrator.";

                                } else {

                                    /*
                                    ========================================
                                    LOGIN SUCCESS
                                    ========================================
                                    */

                                    session_regenerate_id(true);


                                    /*
                                    ========================================
                                    STORE USER DATA
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
                                    LOGIN TIMESTAMP
                                    ========================================
                                    */

                                    $_SESSION['login_time'] =
                                        time();

                                    $_SESSION['last_activity'] =
                                        time();


                                    /*
                                    ========================================
                                    REDIRECT BASED ON ROLE
                                    ========================================
                                    */

                                    // SUPER ADMIN

                                    if (
                                        $result->rank === 'super_admin'
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
                                        $result->rank === 'admin'
                                    ) {

                                        header(
                                            "Location: "
                                            . ROOT
                                            . "/school-admin"
                                        );

                                        exit;
                                    }


                                    // TEACHER

                                    if (
                                        $result->rank === 'teacher'
                                    ) {

                                        header(
                                            "Location: "
                                            . ROOT
                                            . "/teacherDashboard"
                                        );

                                        exit;
                                    }


                                    // STUDENT

                                    if (
                                        $result->rank === 'student'
                                    ) {

                                        header(
                                            "Location: "
                                            . ROOT
                                            . "/studentDashboard"
                                        );

                                        exit;
                                    }


                                    // PARENT

                                    if (
                                        $result->rank === 'parent'
                                    ) {

                                        header(
                                            "Location: "
                                            . ROOT
                                            . "/parentDashboard"
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
                                }

                            } else {

                                /*
                                ========================================
                                SUPER ADMIN LOGIN
                                ========================================
                                */

                                session_regenerate_id(true);


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


                                $_SESSION['login_time'] =
                                    time();

                                $_SESSION['last_activity'] =
                                    time();


                                /*
                                ========================================
                                SUPER ADMIN REDIRECT
                                ========================================
                                */

                                if (
                                    $result->rank === 'super_admin'
                                ) {

                                    header(
                                        "Location: "
                                        . ROOT
                                        . "/superadmin"
                                    );

                                    exit;
                                }


                                header(
                                    "Location: "
                                    . ROOT
                                    . "/home"
                                );

                                exit;
                            }
                        }
                    }
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