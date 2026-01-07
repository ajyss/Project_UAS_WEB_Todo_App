<?php

class Task
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tasks (title, description, status, priority, due_date, user_id)
                VALUES (:title, :description, :status, :priority, :due_date, :user_id)";

        $this->db->query($sql, $data);
    }

    public function paginate($userId, $limit, $offset, $search, $status)
    {
        $where = "WHERE user_id = :user_id";
        $params = ['user_id' => $userId];

        if ($search) {
            $where .= " AND title LIKE :search";
            $params['search'] = "%$search%";
        }

        if ($status !== 'all') {
            $where .= " AND status = :status";
            $params['status'] = $status;
        }

        $sql = "SELECT * FROM tasks
                $where
                ORDER BY id DESC
                LIMIT $limit OFFSET $offset";

        return $this->db->query($sql, $params)->fetchAll();
    }

    public function count($userId, $search, $status)
    {
        $where = "WHERE user_id = :user_id";
        $params = ['user_id' => $userId];

        if ($search) {
            $where .= " AND title LIKE :search";
            $params['search'] = "%$search%";
        }

        if ($status !== 'all') {
            $where .= " AND status = :status";
            $params['status'] = $status;
        }

        $sql = "SELECT COUNT(*) as total FROM tasks $where";
        return $this->db->query($sql, $params)->fetch()['total'];
    }

    public function stats($userId)
    {
        $sql = "SELECT
                COUNT(*) total,
                SUM(status='pending') pending,
                SUM(status='completed') completed
                FROM tasks WHERE user_id = :id";

        return $this->db->query($sql, ['id' => $userId])->fetch();
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
        $this->db->query($sql, [
            'id' => $id,
            'user_id' => $userId
        ]);
    }
    public function find($id, $userId)
    {
        $sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
        return $this->db->query($sql, [
            'id' => $id,
            'user_id' => $userId
        ])->fetch();
    }

    public function update($id, $userId, $data)
    {
        $sql = "UPDATE tasks SET
                title = :title,
                description = :description,
                status = :status,
                priority = :priority,
                due_date = :due_date
                WHERE id = :id AND user_id = :user_id";

        $this->db->query($sql, [
            'id'       => $id,
            'user_id'  => $userId,
            'title'    => $data['title'],
            'description' => $data['description'],
            'status'   => $data['status'],
            'priority' => $data['priority'],
            'due_date' => $data['due_date']
        ]);
    }

}
