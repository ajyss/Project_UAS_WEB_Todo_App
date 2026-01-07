<?php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    protected function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model;
    }
}
