<?php

class TaskController extends Controller
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
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/auth");
            exit;
        }
    }

    public function index()
    {
        $task = new Task();

        $page   = $_GET['page'] ?? 1;
        $limit  = 5;
        $offset = ($page - 1) * $limit;
        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? 'all';

        $tasks = $task->paginate($_SESSION['user']['id'], $limit, $offset, $search, $status);
        $total = $task->count($_SESSION['user']['id'], $search, $status);
        $stats = $task->stats($_SESSION['user']['id']);

        // Debug info untuk pagination
        $totalPages = $limit > 0 ? ceil($total / $limit) : 1;

        $this->view('task/index', compact(
            'tasks', 'total', 'limit', 'page', 'search', 'status', 'stats', 'totalPages'
        ));
    }

    // ====== TAMPIL FORM TAMBAH TASK ======
    public function create()
    {
        $this->view('task/create');
    }

    // ====== PROSES SIMPAN TASK ======
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/task");
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $priority = $_POST['priority'] ?? 'medium';
        $due_date = $_POST['due_date'] ?? null;

        if (empty($title)) {
            $_SESSION['error'] = "Title is required";
            header("Location: " . BASE_URL . "/task/create");
            exit;
        }

        $task = new Task();
        $task->create([
            'title' => $title,
            'description' => $description,
            'status' => 'pending',
            'priority' => $priority,
            'due_date' => $due_date,
            'user_id' => $_SESSION['user']['id']
        ]);

        header("Location: " . BASE_URL . "/task");
        exit;
    }

    // ====== DELETE ======
    public function delete($id)
    {
        $task = new Task();
        $task->delete($id, $_SESSION['user']['id']);

        header("Location: " . BASE_URL . "/task");
        exit;
    }

    public function edit($id)
    {
        $taskModel = new Task();
        $task = $taskModel->find($id, $_SESSION['user']['id']);
        
        if (!$task) {
            header("Location: " . BASE_URL . "/task");
            exit;
        }
        
        $this->view('task/edit', compact('task'));
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/task");
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = $_POST['status'] ?? 'pending';
        $priority = $_POST['priority'] ?? 'medium';
        $due_date = $_POST['due_date'] ?? null;

        if (empty($title)) {
            $_SESSION['error'] = "Title is required";
            header("Location: " . BASE_URL . "/task/edit/" . $id);
            exit;
        }

        $taskModel = new Task();
        $taskModel->update($id, $_SESSION['user']['id'], [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'priority' => $priority,
            'due_date' => $due_date
        ]);

        header("Location: " . BASE_URL . "/task");
        exit;
    }
}
