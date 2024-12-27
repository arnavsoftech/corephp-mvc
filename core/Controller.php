<?php

class Controller
{
    public function __construct() {}
    public function view(string $view, array $data = [], bool $return = false): string
    {
        extract($data);
        ob_start();
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'apps/views/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();
        if ($return) return $content;
        echo $content;
        return '';
    }

    public function getJSON(bool $array = true): array
    {
        $data = json_decode(file_get_contents("php://input"), $array);
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
