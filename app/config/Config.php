<?php
class AppConfig
{
    public $baseUrl           = 'http://localhost/coreapp/';
    public $defaultController = 'Home';
    public $dbGroup           = 'test';

    public function getDatabaseConfig(): array
    {
        $test = [
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => ''
        ];
        $live = [
            'hostname' => 'localhost',
            'username' => '',
            'password' => '',
            'database' => ''
        ];

        return $this->dbGroup == 'test' ? $test : $live;
    }
}
