<?php

require_once "../private/core/MailService.php";

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
                                SUPER ADMIN 2FA
                                ========================================
                                */

                                if ($result->rank === 'super_admin') {

                                    $otp = (string) random_int(100000, 999999);

                                    $otpHash = password_hash(
                                        $otp,
                                        PASSWORD_DEFAULT
                                    );

                                    $expiresAt = date(
                                        'Y-m-d H:i:s',
                                        time() + (5 * 60)
                                    );

                                    $user->deleteLoginOtps(
                                        $result->user_id
                                    );

                                    $user->createLoginOtp(
                                        $result->user_id,
                                        $otpHash,
                                        $expiresAt
                                    );

                                    $subject =
                                        "Your My School Management System Login OTP";

                                    $message =
                                        "Hello {$result->firstname},\n\n" .
                                        "Your Super Admin login verification code is: {$otp}\n\n" .
                                        "This OTP will expire in 5 minutes.\n" .
                                        "If you did not attempt to log in, please secure your account.\n\n" .
                                        "Regards,\n" .
                                        "My School Management System";

                                    $mailSent = MailService::send(
                                        $result->email,
                                        $subject,
                                        $message
                                    );

                                    if (!$mailSent) {

                                        $user->deleteLoginOtps(
                                            $result->user_id
                                        );

                                        $data['error'] =
                                            "Unable to send the verification code. Please try again.";

                                    } else {

                                        session_regenerate_id(true);

                                        $_SESSION['2fa_pending'] = true;
                                        $_SESSION['2fa_user_id'] =
                                            $result->user_id;
                                        $_SESSION['2fa_email'] =
                                            $result->email;
                                        $_SESSION['2fa_expires'] =
                                            strtotime($expiresAt);

                                        $data['otp_required'] = true;
                                        $data['otp_email'] =
                                            $result->email;

                                        $data['message'] =
                                            "A verification code has been sent to your email.";
                                    }

                                } else {

                                    /*
                                    ========================================
                                    LOGIN SUCCESS
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

    public function verify()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = [];

        if (
            empty($_SESSION['2fa_pending']) ||
            empty($_SESSION['2fa_user_id']) ||
            empty($_SESSION['2fa_email']) ||
            empty($_SESSION['2fa_expires'])
        ) {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/login");
            exit;
        }

        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            $data['error'] = "Invalid security request. Please try again.";
            $data['otp_required'] = true;
            $data['otp_email'] = $_SESSION['2fa_email'];
            $this->view('login', $data);
            return;
        }

        $otp = trim($_POST['otp'] ?? '');

        if (!preg_match('/^\d{6}$/', $otp)) {
            $data['error'] = "Please enter the 6-digit verification code.";
            $data['otp_required'] = true;
            $data['otp_email'] = $_SESSION['2fa_email'];
            $this->view('login', $data);
            return;
        }

        if (time() > (int) $_SESSION['2fa_expires']) {
            $user = $this->model("User");
            $user->deleteLoginOtps($_SESSION['2fa_user_id']);

            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );

            $data['error'] = "This verification code has expired. Please log in again.";
            $this->view('login', $data);
            return;
        }

        $user = $this->model("User");
        $userId = $_SESSION['2fa_user_id'];
        $otpRecord = $user->getLatestLoginOtp($userId);

        if (!$otpRecord) {
            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );

            $data['error'] = "Verification code not found. Please log in again.";
            $this->view('login', $data);
            return;
        }

        if ((int) $otpRecord->attempts >= 5) {
            $user->deleteLoginOtp($otpRecord->id);

            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );

            $data['error'] = "Too many incorrect attempts. Please log in again.";
            $this->view('login', $data);
            return;
        }

        if (
            strtotime($otpRecord->expires_at) < time() ||
            !password_verify($otp, $otpRecord->otp_hash)
        ) {
            $user->incrementOtpAttempts($otpRecord->id);

            $attemptsUsed = (int) $otpRecord->attempts + 1;
            $attemptsLeft = max(0,  - $attemptsUsed);

            $data['error'] = $attemptsLeft > 0
                ? "Invalid verification code. {$attemptsLeft} attempt(s) remaining."
                : "Too many incorrect attempts. Please log in again.";

            if ($attemptsLeft === 0) {
                $user->deleteLoginOtp($otpRecord->id);

                unset(
                    $_SESSION['2fa_pending'],
                    $_SESSION['2fa_user_id'],
                    $_SESSION['2fa_email'],
                    $_SESSION['2fa_expires']
                );

                $this->view('login', $data);
                return;
            }

            $data['otp_required'] = true;
            $data['otp_email'] = $_SESSION['2fa_email'];
            $this->view('login', $data);
            return;
        }

        $result = $user->findByEmail($_SESSION['2fa_email']);

        if (
            !$result ||
            $result->user_id !== $userId ||
            $result->rank !== 'super_admin' ||
            (isset($result->status) && $result->status !== 'active')
        ) {
            $user->deleteLoginOtp($otpRecord->id);

            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );

            $data['error'] = "Unable to complete login. Please try again.";
            $this->view('login', $data);
            return;
        }

        $user->deleteLoginOtp($otpRecord->id);

        session_regenerate_id(true);

        $_SESSION['user_id'] = $result->user_id;
        $_SESSION['firstname'] = $result->firstname;
        $_SESSION['lastname'] = $result->lastname;
        $_SESSION['email'] = $result->email;
        $_SESSION['gender'] = $result->gender;
        $_SESSION['rank'] = $result->rank;
        $_SESSION['school_id'] = $result->school_id;
        $_SESSION['login_time'] = time();
        $_SESSION['last_activity'] = time();

        unset(
            $_SESSION['2fa_pending'],
            $_SESSION['2fa_user_id'],
            $_SESSION['2fa_email'],
            $_SESSION['2fa_expires']
        );

        header("Location: " . ROOT . "/superadmin");
        exit;
    }

}