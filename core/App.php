<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->autoload();
        $url = $this->parseUrl();

        if (!isset($url[0])) {
            $this->setDefaultRoute();
        } else if (file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        } else {
            die('404 Page Not Found');
        }
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        $method = @str_replace('-', '_', $url[1]);
        // Load Method
        if (isset($url[1]) && method_exists($this->controller, $method)) {
            $this->method = $method;
            unset($url[1]);
        }

        // Load Params
        $this->params = $url ? array_values($url) : [];

        // Call Controller Method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function setDefaultRoute()
    {
        $appConfig = new AppConfig();
        $this->controller = $appConfig->defaultController;
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    public function autoload()
    {
        include_once BASE_PATH . "app/config/Config.php";
        include_once BASE_PATH . "core/Database.php";
        include_once BASE_PATH . "core/Controller.php";
        include_once BASE_PATH . "core/Model.php";
        include_once BASE_PATH . "core/App.php";

        $modelFiles = scandir(BASE_PATH . 'app/models/');
        foreach ($modelFiles as $file) {
            if ($file == '.' || $file == '..') continue;
            $filePath = BASE_PATH . 'app/models/' . $file;
            if (is_file($filePath)) {
                include $filePath;
            }
        }

        $helperFiles = scandir(BASE_PATH . 'app/helpers/');
        foreach ($helperFiles as $file) {
            if ($file == '.' || $file == '..') continue;
            $filePath = BASE_PATH . 'app/helpers/' . $file;
            if (is_file($filePath)) {
                include $filePath;
            }
        }
    }
}