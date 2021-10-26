<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard');
    }
}
