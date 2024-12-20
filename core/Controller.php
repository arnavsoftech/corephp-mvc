<?php

class Controller
{
    public function __construct() {}
    public function view($view, $data = [])
    {
        extract($data);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'apps/views/' . $view . '.php';
    }

    public function getJSON(): array
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data == null)  $data = [];
        return $data;
    }

    public function getPost(string $field): string | null
    {
        return $_POST[$field] ?? null;
    }

    public function getGet(string $field): string | null
    {
        return $_GET[$field] ?? null;
    }
}
