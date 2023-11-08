<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('user/index');
    }
    public function reset()
    {   
        return view('user/reset/resetPwdPage');
    }
}
