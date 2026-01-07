<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->query($sql, [
            'email' => $email
        ]);

        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES (:name, :email, :password, 'user')";
        $this->db->query($sql, $data);
    }

    public function getAll()
    {
        $sql = "SELECT id, name, email, role FROM users";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $this->db->query($sql, ['id' => $id, 'role' => $role]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

}
