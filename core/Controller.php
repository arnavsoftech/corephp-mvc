<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);
        require_once BASE_PATH . DIRECTORY_SEPARATOR . 'app/views/' . $view . '.php';
    }
}
