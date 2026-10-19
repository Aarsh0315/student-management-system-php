
<?php

class Profile extends Controller
{
    /*
    =====================================================
    PROFILE
    =====================================================
    */

    public function index()
    {
        $this->requireLogin();

        $user_id = $_SESSION['user_id'];
        $userModel = $this->model('User');
        $profile = $userModel->findById($user_id);

        if (!$profile) {
            header("Location: " . ROOT . "/home");
            exit;
        }

        $this->view('my-profile', [
            'profile' => $profile
        ]);
    }

    /*
    =====================================================
    EDIT PROFILE
    =====================================================
    */

    public function edit()
    {
        $this->requireLogin();

        $user_id = $_SESSION['user_id'];
        $userModel = $this->model('User');
        $profile = $userModel->findById($user_id);

        if (!$profile) {
            header("Location: " . ROOT . "/profile");
            exit;
        }

        $this->view('profile-edit', [
            'profile' => $profile
        ]);
    }

    /*
    =====================================================
    UPDATE PROFILE
    =====================================================
    */

    public function update()
    {
        $this->requireLogin();

        // Only allow POST requests.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/profile");
            exit;
        }

        // Verify CSRF token.
        if (!CSRF::verify($_POST['csrf_token'] ?? '')) {
            die("Invalid security token. Please refresh the page and try again.");
        }

        // Always update the logged-in user's own account.
        $user_id = $_SESSION['user_id'];

        $userModel = $this->model('User');
        $profile = $userModel->findById($user_id);

        if (!$profile) {
            header("Location: " . ROOT . "/profile");
            exit;
        }

        // Form fields.
        $firstname = trim($_POST['firstname'] ?? '');
        $lastname  = trim($_POST['lastname'] ?? '');
        $gender    = trim($_POST['gender'] ?? '');

        // Validate required fields.
        if ($firstname === '' || $lastname === '') {
            die("First name and last name are required.");
        }

        if (strlen($firstname) > 100 || strlen($lastname) > 100) {
            die("First name and last name must be 100 characters or fewer.");
        }

        // Keep the current image unless a new one is uploaded.
        $profileImage = $profile->profile_image ?? null;
        $newImagePath = null;

        /*
        ========================================
        PROFILE PHOTO UPLOAD
        ========================================
        */

        if (
            isset($_FILES['profile_image']) &&
            $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $file = $_FILES['profile_image'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                die("Unable to upload the profile photo.");
            }

            if ($file['size'] > 2 * 1024 * 1024) {
                die("The profile photo must be 2 MB or smaller.");
            }

            if (!is_uploaded_file($file['tmp_name'])) {
                die("Invalid uploaded file.");
            }

            // Validate the actual file MIME type.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file['tmp_name']);

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp'
            ];

            if (!isset($allowedTypes[$mimeType])) {
                die("Only JPG, PNG, and WebP images are allowed.");
            }

            // Project-root/public/uploads/users/
            $uploadDirectory =
                dirname(__DIR__, 2) .
                DIRECTORY_SEPARATOR . 'public' .
                DIRECTORY_SEPARATOR . 'uploads' .
                DIRECTORY_SEPARATOR . 'users' .
                DIRECTORY_SEPARATOR;

            if (
                !is_dir($uploadDirectory) &&
                !mkdir($uploadDirectory, 0755, true) &&
                !is_dir($uploadDirectory)
            ) {
                die("Unable to create the profile photo directory.");
            }

            if (!is_writable($uploadDirectory)) {
                die("The profile photo directory is not writable.");
            }

            // Generate a unique server-side filename.
            $profileImage =
                'user_' .
                bin2hex(random_bytes(16)) .
                '.' .
                $allowedTypes[$mimeType];

            $newImagePath = $uploadDirectory . $profileImage;

            if (!move_uploaded_file($file['tmp_name'], $newImagePath)) {
                die("Unable to save the profile photo.");
            }
        }

        /*
        ========================================
        SAVE PROFILE DETAILS AND IMAGE
        ========================================
        */

        $result = $userModel->updateProfile(
            $user_id,
            $firstname,
            $lastname,
            $gender,
            $profileImage
        );

        if (!$result) {
            // Remove the newly uploaded file if the database update fails.
            if ($newImagePath !== null && is_file($newImagePath)) {
                unlink($newImagePath);
            }

            die("Unable to update your profile. Please try again.");
        }

        /*
        ========================================
        UPDATE SESSION
        ========================================
        */

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname']  = $lastname;
        $_SESSION['gender']    = $gender;
        $_SESSION['profile_image'] = $profileImage;

        /*
        ========================================
        REDIRECT TO MY PROFILE
        ========================================
        */

        header("Location: " . ROOT . "/profile");
        exit;
    }
}
