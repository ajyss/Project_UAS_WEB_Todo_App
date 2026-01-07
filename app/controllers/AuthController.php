<?php

class AuthController extends Controller
{
    protected function generateCsrfToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function validateCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/task");
            exit;
        }

        require "../app/views/auth/login.php";
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/auth");
            exit;
        }

        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id'   => $user['id'],
                'name' => $user['name'],
                'role' => $user['role']
            ];

            header("Location: " . BASE_URL . "/task");
            exit;
        }

        $_SESSION['error'] = "Email atau password salah";
        header("Location: " . BASE_URL . "/auth");
        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "/auth");
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('auth/register');
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = "All fields are required";
            header("Location: " . BASE_URL . "/auth/register");
            exit;
        }

        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: " . BASE_URL . "/auth/register");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters";
            header("Location: " . BASE_URL . "/auth/register");
            exit;
        }

        $userModel = new User();
        
        // Check if email exists
        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = "Email already exists";
            header("Location: " . BASE_URL . "/auth/register");
            exit;
        }

        // Create user
        $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: " . BASE_URL . "/auth");
        exit;
    }
}
