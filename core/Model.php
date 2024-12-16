<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $appConfig = new AppConfig();
        $db = $appConfig->getDatabaseConfig();
        $this->db = new Database($db['database'], $db['username'], $db['password'], $db['hostname']);
    }
}
