CREATE DATABASE todo_app;
USE todo_app;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 email VARCHAR(100),
 password VARCHAR(255),
 role ENUM('admin','user')
);

CREATE TABLE tasks (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 title VARCHAR(150),
 description TEXT,
 status ENUM('pending','completed') DEFAULT 'pending',
 priority ENUM('low','medium','high'),
 due_date DATE,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users VALUES
(1,'Admin','admin@taskflow.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin'),
(2,'User','user@taskflow.com','$2y$10$8K1p/5w6Q2w3r4t5y6u7i8o9p0a1s2d3f4g5h6j7k8l9z0x1c2v3b4n5m6','user');
