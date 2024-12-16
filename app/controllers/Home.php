<?php

class Home extends Controller
{
    public function index()
    {
        $userModel = new Usermodel();
        $users = $userModel->getAllUsers();
        $this->view('home/index', ['users' => $users]);
    }

    public function about($name = "", $age = 10, $city = 'Ranchi')
    {
        echo "Name $name, Age $age, City  $city";
        $this->view('home/about');
    }
}
