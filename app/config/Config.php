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
            'database' => 'bigdealpro'
        ];
        $live = [
            'hostname' => '',
            'username' => '',
            'password' => '',
            'database' => ''
        ];

        return $this->dbGroup == 'test' ? $test : $live;
    }
}
