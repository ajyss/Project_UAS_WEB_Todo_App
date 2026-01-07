<?php

class Model
{
    protected $db;

    public function __construct()
    {
        // Gunakan Database yang sudah ada (tanpa connect())
        $this->db = new Database();
    }
}
