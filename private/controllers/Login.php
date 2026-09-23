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
        |--------------------------------------------------------------------------
        | SECURITY SETTINGS
        |--------------------------------------------------------------------------
        */

        $settingsModel = $this->model('SettingsModel');

        $securitySettings = $settingsModel->getAllAsArray();

        $loginProtection =
            ($securitySettings['login_protection'] ?? '1') === '1';

        $captchaProtection =
            ($securitySettings['captcha_protection'] ?? '1') === '1';

        $superAdminOtp =
            ($securitySettings['super_admin_otp'] ?? '1') === '1';

        $failedLoginLimit =
            (int) ($securitySettings['failed_login_limit'] ?? 5);

        $lockoutMinutes =
            (int) ($securitySettings['lockout_minutes'] ?? 15);

        $otpExpiryMinutes =
            (int) ($securitySettings['otp_expiry_minutes'] ?? 5);

        $otpMaxAttempts =
            (int) ($securitySettings['otp_max_attempts'] ?? 5);


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

            $email =
                trim($_POST['email'] ?? '');

            $password =
                $_POST['password'] ?? '';


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

                $user =
                    $this->model("User");


                /*
                ========================================
                FIND USER
                ========================================
                */

                $result =
                    $user->findByEmail($email);


                /*
                ========================================
                USER NOT FOUND
                ========================================
                */

                if (!$result) {

                    // Do not reveal whether the email exists.
                    $data['error'] =
                        "Invalid email or password.";

                } else {

                    /*
                    ========================================
                    CHECK LOGIN LOCK
                    ========================================
                    */

                    $attemptData =
                        $user->getLoginAttempt(
                            $result->user_id
                        );

                    $isLoginLocked = false;


                    if (
                        $loginProtection &&
                        $attemptData &&
                        !empty($attemptData->locked_until) &&
                        strtotime($attemptData->locked_until) > time()
                    ) {

                        $isLoginLocked = true;


                        $remainingSeconds =
                            strtotime(
                                $attemptData->locked_until
                            ) - time();


                        $remainingMinutes =
                            max(
                                1,
                                (int) ceil(
                                    $remainingSeconds / 60
                                )
                            );


                        $data['error'] =
                            "Too many incorrect login attempts. Please try again in {$remainingMinutes} minute(s).";
                    }


                    if ($isLoginLocked) {

                        // Do not verify the password.
                        // Do not continue login.

                    } else {

                        /*
                        ========================================
                        CHECK CAPTCHA REQUIREMENT
                        ========================================
                        */

                        $attemptData =
                            $user->getLoginAttempt(
                                $result->user_id
                            );

                        $failedAttempts =
                            $attemptData
                                ? (int) $attemptData->failed_attempts
                                : 0;


                        /*
                        |--------------------------------------------------------------------------
                        | CAPTCHA
                        |--------------------------------------------------------------------------
                        | Show and require CAPTCHA after
                        | the first failed login attempt.
                        */

                        if (
                            $captchaProtection &&
                            $failedAttempts >= 1
                        ) {

                            $data['captcha_required'] = true;

                            $turnstileToken =
                                $_POST['cf-turnstile-response'] ?? '';


                            if (
                                !$this->verifyTurnstile(
                                    $turnstileToken
                                )
                            ) {

                                $data['error'] =
                                    "Please complete the CAPTCHA verification.";

                                $this->view(
                                    'login',
                                    $data
                                );

                                return;
                            }

                        } else {

                            $data['captcha_required'] = false;
                        }


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

                            /*
                            ========================================
                            FAILED LOGIN ATTEMPT
                            ========================================
                            */

                            $user->recordFailedLogin(
                                $result->user_id
                            );


                            $this->audit(
                                'LOGIN_FAILED',
                                'Failed login attempt.'
                            );


                            if ($captchaProtection) {
                                $data['captcha_required'] = true;
                            }


                            /*
                            ========================================
                            GET UPDATED ATTEMPTS
                            ========================================
                            */

                            $attemptData =
                                $user->getLoginAttempt(
                                    $result->user_id
                                );


                            $failedAttempts =
                                $attemptData
                                    ? (int) $attemptData->failed_attempts
                                    : 1;


                            /*
                            ========================================
                            LOCK AFTER CONFIGURED ATTEMPTS
                            ========================================
                            */

                            if (
                                $loginProtection &&
                                $failedAttempts >= $failedLoginLimit
                            ) {

                                $user->lockLogin(
                                    $result->user_id,
                                    $lockoutMinutes
                                );


                                $data['error'] =
                                    "Too many incorrect login attempts. Your account is temporarily locked for {$lockoutMinutes} minutes.";

                            } else {

                                $attemptsRemaining =
                                    max(
                                        0,
                                        $failedLoginLimit -
                                        $failedAttempts
                                    );


                                $data['error'] =
                                    "Invalid email or password. {$attemptsRemaining} attempt(s) remaining.";
                            }

                        } else {

                            /*
                            ========================================
                            PASSWORD CORRECT
                            ========================================
                            */

                            // Clear previous failed login attempts.
                            $user->resetLoginAttempts(
                                $result->user_id
                            );


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
                                |--------------------------------------------------------------------------
                                | SUPER ADMIN LOGIN
                                |--------------------------------------------------------------------------
                                */

                                if (
                                    $result->rank === 'super_admin' &&
                                    $superAdminOtp
                                ) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | GENERATE OTP
                                    |--------------------------------------------------------------------------
                                    */

                                    $otp =
                                        (string) random_int(
                                            100000,
                                            999999
                                        );


                                    $otpHash =
                                        password_hash(
                                            $otp,
                                            PASSWORD_DEFAULT
                                        );


                                    $expiresAt =
                                        date(
                                            'Y-m-d H:i:s',
                                            time() +
                                            ($otpExpiryMinutes * 60)
                                        );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DELETE OLD OTP
                                    |--------------------------------------------------------------------------
                                    */

                                    $user->deleteLoginOtps(
                                        $result->user_id
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | SAVE NEW OTP
                                    |--------------------------------------------------------------------------
                                    */

                                    $user->createLoginOtp(
                                        $result->user_id,
                                        $otpHash,
                                        $expiresAt
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | SEND OTP EMAIL
                                    |--------------------------------------------------------------------------
                                    */

                                    $subject =
                                        "Your My School Management System Login OTP";


                                    $message =
                                        "Hello {$result->firstname},\n\n" .
                                        "Your Super Admin login verification code is: {$otp}\n\n" .
                                        "This OTP will expire in {$otpExpiryMinutes} minutes.\n" .
                                        "If you did not attempt to log in, please secure your account.\n\n" .
                                        "Regards,\n" .
                                        "My School Management System";


                                    $mailSent =
                                        MailService::send(
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

                                        /*
                                        |--------------------------------------------------------------------------
                                        | START 2FA SESSION
                                        |--------------------------------------------------------------------------
                                        */

                                        session_regenerate_id(true);


                                        $_SESSION['2fa_pending'] =
                                            true;

                                        $_SESSION['2fa_user_id'] =
                                            $result->user_id;

                                        $_SESSION['2fa_email'] =
                                            $result->email;

                                        $_SESSION['2fa_expires'] =
                                            strtotime($expiresAt);


                                        $data['otp_required'] =
                                            true;

                                        $data['otp_email'] =
                                            $result->email;

                                        $data['message'] =
                                            "A verification code has been sent to your email.";
                                    }

                                } else {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | OTHER ROLES / SUPER ADMIN WITHOUT OTP
                                    |--------------------------------------------------------------------------
                                    */

                                    /*
                                    |--------------------------------------------------------------------------
                                    | CHECK SCHOOL STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        !empty(
                                            $result->school_id
                                        )
                                    ) {

                                        $schoolQuery = "
                                            SELECT status
                                            FROM schools
                                            WHERE id = :school_id
                                            LIMIT 1
                                        ";


                                        $schoolResult =
                                            $user->query(
                                                $schoolQuery,
                                                [
                                                    'school_id' =>
                                                        $result->school_id
                                                ]
                                            );


                                        $school =
                                            $schoolResult[0] ?? null;


                                        /*
                                        |--------------------------------------------------------------------------
                                        | SCHOOL NOT FOUND / INACTIVE
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            !$school ||
                                            $school->status !== 'active'
                                        ) {

                                            $data['error'] =
                                                "Your school is currently inactive. Please contact your administrator.";

                                        } else {

                                            /*
                                            |--------------------------------------------------------------------------
                                            | NORMAL LOGIN
                                            |--------------------------------------------------------------------------
                                            */

                                            session_regenerate_id(
                                                true
                                            );


                                            /*
                                            |--------------------------------------------------------------------------
                                            | STORE USER DATA
                                            |--------------------------------------------------------------------------
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

                                            $_SESSION['login_time'] =
                                                time();

                                            $_SESSION['last_activity'] =
                                                time();


                                            $this->audit(
                                                'LOGIN_SUCCESS',
                                                'User logged in successfully.'
                                            );


                                            /*
                                            |--------------------------------------------------------------------------
                                            | REDIRECT BASED ON ROLE
                                            |--------------------------------------------------------------------------
                                            */

                                            if (
                                                $result->rank === 'admin'
                                            ) {

                                                header(
                                                    "Location: " .
                                                    ROOT .
                                                    "/school-admin"
                                                );

                                                exit;
                                            }


                                            if (
                                                $result->rank === 'teacher'
                                            ) {

                                                header(
                                                    "Location: " .
                                                    ROOT .
                                                    "/teacherDashboard"
                                                );

                                                exit;
                                            }


                                            if (
                                                $result->rank === 'student'
                                            ) {

                                                header(
                                                    "Location: " .
                                                    ROOT .
                                                    "/studentDashboard"
                                                );

                                                exit;
                                            }


                                            if (
                                                $result->rank === 'parent'
                                            ) {

                                                header(
                                                    "Location: " .
                                                    ROOT .
                                                    "/parentDashboard"
                                                );

                                                exit;
                                            }


                                            /*
                                            |--------------------------------------------------------------------------
                                            | SUPER ADMIN WITHOUT OTP
                                            |--------------------------------------------------------------------------
                                            */

                                            if (
                                                $result->rank ===
                                                'super_admin'
                                            ) {

                                                header(
                                                    "Location: " .
                                                    ROOT .
                                                    "/superadmin"
                                                );

                                                exit;
                                            }


                                            header(
                                                "Location: " .
                                                ROOT .
                                                "/home"
                                            );

                                            exit;
                                        }

                                    } else {

                                        /*
                                        |--------------------------------------------------------------------------
                                        | NORMAL LOGIN WITHOUT SCHOOL
                                        |--------------------------------------------------------------------------
                                        */

                                        session_regenerate_id(
                                            true
                                        );


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


                                        $this->audit(
                                            'LOGIN_SUCCESS',
                                            'User logged in successfully.'
                                        );


                                        if (
                                            $result->rank ===
                                            'super_admin'
                                        ) {

                                            header(
                                                "Location: " .
                                                ROOT .
                                                "/superadmin"
                                            );

                                            exit;
                                        }


                                        header(
                                            "Location: " .
                                            ROOT .
                                            "/home"
                                        );

                                        exit;
                                    }
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
        /*
        ========================================
        START SESSION
        ========================================
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        |--------------------------------------------------------------------------
        | SECURITY SETTINGS
        |--------------------------------------------------------------------------
        */

        $settingsModel =
            $this->model('SettingsModel');

        $securitySettings =
            $settingsModel->getAllAsArray();


        $otpMaxAttempts =
            (int) (
                $securitySettings['otp_max_attempts']
                ?? 5
            );


        $data = [];


        /*
        ========================================
        CHECK 2FA SESSION
        ========================================
        */

        if (
            empty($_SESSION['2fa_pending']) ||
            empty($_SESSION['2fa_user_id']) ||
            empty($_SESSION['2fa_email']) ||
            empty($_SESSION['2fa_expires'])
        ) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        ONLY POST
        ========================================
        */

        if (
            $_SERVER['REQUEST_METHOD'] !== 'POST'
        ) {

            header(
                "Location: " .
                ROOT .
                "/login"
            );

            exit;
        }


        /*
        ========================================
        CSRF
        ========================================
        */

        if (
            !CSRF::verify(
                $_POST['csrf_token'] ?? ''
            )
        ) {

            $data['error'] =
                "Invalid security request. Please try again.";

            $data['otp_required'] =
                true;

            $data['otp_email'] =
                $_SESSION['2fa_email'];


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        GET OTP
        ========================================
        */

        $otp =
            trim(
                $_POST['otp'] ?? ''
            );


        if (
            !preg_match(
                '/^\d{6}$/',
                $otp
            )
        ) {

            $data['error'] =
                "Please enter the 6-digit verification code.";

            $data['otp_required'] =
                true;

            $data['otp_email'] =
                $_SESSION['2fa_email'];


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        CHECK OTP EXPIRY
        ========================================
        */

        if (
            time() >
            (int) $_SESSION['2fa_expires']
        ) {

            $user =
                $this->model("User");


            $user->deleteLoginOtps(
                $_SESSION['2fa_user_id']
            );


            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );


            $data['error'] =
                "This verification code has expired. Please log in again.";


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        LOAD OTP
        ========================================
        */

        $user =
            $this->model("User");


        $userId =
            $_SESSION['2fa_user_id'];


        $otpRecord =
            $user->getLatestLoginOtp(
                $userId
            );


        if (!$otpRecord) {

            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );


            $data['error'] =
                "Verification code not found. Please log in again.";


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        OTP ATTEMPT LIMIT
        ========================================
        */

        if (
            (int) $otpRecord->attempts >=
            $otpMaxAttempts
        ) {

            $user->deleteLoginOtp(
                $otpRecord->id
            );


            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );


            $data['error'] =
                "Too many incorrect attempts. Please log in again.";


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        VERIFY OTP
        ========================================
        */

        if (
            strtotime(
                $otpRecord->expires_at
            ) < time() ||
            !password_verify(
                $otp,
                $otpRecord->otp_hash
            )
        ) {

            $user->incrementOtpAttempts(
                $otpRecord->id
            );


            $attemptsUsed =
                (int) $otpRecord->attempts + 1;


            $attemptsLeft =
                max(
                    0,
                    $otpMaxAttempts -
                    $attemptsUsed
                );


            $data['error'] =
                $attemptsLeft > 0
                    ? "Invalid verification code. {$attemptsLeft} attempt(s) remaining."
                    : "Too many incorrect attempts. Please log in again.";


            if ($attemptsLeft === 0) {

                $user->deleteLoginOtp(
                    $otpRecord->id
                );


                unset(
                    $_SESSION['2fa_pending'],
                    $_SESSION['2fa_user_id'],
                    $_SESSION['2fa_email'],
                    $_SESSION['2fa_expires']
                );


                $this->view(
                    'login',
                    $data
                );

                return;
            }


            $data['otp_required'] =
                true;

            $data['otp_email'] =
                $_SESSION['2fa_email'];


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        VERIFY USER
        ========================================
        */

        $result =
            $user->findByEmail(
                $_SESSION['2fa_email']
            );


        if (
            !$result ||
            $result->user_id !== $userId ||
            $result->rank !== 'super_admin' ||
            (
                isset($result->status) &&
                $result->status !== 'active'
            )
        ) {

            $user->deleteLoginOtp(
                $otpRecord->id
            );


            unset(
                $_SESSION['2fa_pending'],
                $_SESSION['2fa_user_id'],
                $_SESSION['2fa_email'],
                $_SESSION['2fa_expires']
            );


            $data['error'] =
                "Unable to complete login. Please try again.";


            $this->view(
                'login',
                $data
            );

            return;
        }


        /*
        ========================================
        OTP SUCCESS
        ========================================
        */

        $user->deleteLoginOtp(
            $otpRecord->id
        );


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


        $this->audit(
            'LOGIN_2FA_SUCCESS',
            'Super Admin completed OTP verification and logged in.'
        );


        /*
        ========================================
        CLEAR 2FA SESSION
        ========================================
        */

        unset(
            $_SESSION['2fa_pending'],
            $_SESSION['2fa_user_id'],
            $_SESSION['2fa_email'],
            $_SESSION['2fa_expires']
        );


        /*
        ========================================
        SUPER ADMIN DASHBOARD
        ========================================
        */

        header(
            "Location: " .
            ROOT .
            "/superadmin"
        );

        exit;
    }


    private function verifyTurnstile($token)
    {
        if (empty($token)) {
            return false;
        }


        $securityConfig =
            require __DIR__ .
            '/../config/security.php';


        $secretKey =
            $securityConfig['turnstile']['secret_key']
            ?? '';


        if ($secretKey === '') {
            return false;
        }


        $url =
            'https://challenges.cloudflare.com/turnstile/v0/siteverify';


        $postData =
            http_build_query([
                'secret' =>
                    $secretKey,

                'response' =>
                    $token,

                'remoteip' =>
                    $_SERVER['REMOTE_ADDR'] ?? ''
            ]);


        $ch =
            curl_init($url);


        curl_setopt_array(
            $ch,
            [
                CURLOPT_POST =>
                    true,

                CURLOPT_POSTFIELDS =>
                    $postData,

                CURLOPT_RETURNTRANSFER =>
                    true,

                CURLOPT_TIMEOUT =>
                    10,

                CURLOPT_HTTPHEADER =>
                    [
                        'Content-Type: application/x-www-form-urlencoded'
                    ]
            ]
        );


        $response =
            curl_exec($ch);


        if ($response === false) {

            curl_close($ch);

            return false;
        }


        curl_close($ch);


        $result =
            json_decode(
                $response,
                true
            );


        return !empty(
            $result['success']
        );
    }
}