<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('Templates/beginning');
        echo view('index');
        echo view('Templates/ending');
    }
}
