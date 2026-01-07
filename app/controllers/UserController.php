<?php

class UserController extends Controller
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

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/task");
            exit;
        }
    }

    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAll();
        $this->view('user/index', compact('users'));
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->findById($id);
        
        if (!$user) {
            header("Location: " . BASE_URL . "/user");
            exit;
        }
        
        $this->view('user/edit', compact('user'));
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/user");
            exit;
        }

        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die("CSRF token validation failed");
        }

        $role = $_POST['role'] ?? 'user';

        $userModel = new User();
        $userModel->updateRole($id, $role);

        header("Location: " . BASE_URL . "/user");
        exit;
    }

    public function delete($id)
    {
        $userModel = new User();
        $userModel->delete($id);
        header("Location: " . BASE_URL . "/user");
        exit;
    }
}
