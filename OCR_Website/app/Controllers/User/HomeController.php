<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        $output = [
            'outputPredict' => 'Output predict here',
            'currentSection' => 'notSection',
            'imagePath'=> '',
        ];
        return view('user/index', $output);
    }
    public function reset()
    {   
        return view('user/reset/resetPwdPage');
    }

}
