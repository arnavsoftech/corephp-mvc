<?php

class Home extends Controller
{
    public function index()
    {
        $this->view('index', ['name' => 'Name', 'mobile' => '1234']);
    }
}
