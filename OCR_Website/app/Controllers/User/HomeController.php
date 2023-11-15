<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        $default = ['Output predict here'];
        $output = [
            'outputPredict' => $default,
            'currentSection' => 'notSection',
            'imagePath'=> '',
        ];
        return view('user/index', $output);
    }

    public function index_logged(): string
    {
        $default = ['Output predict here'];
        $output = [
            'outputPredict' => $default,
            'currentSection' => 'notSection',
            'imagePath'=> '',
        ];
        return view('user/index_logged', $output);
    }
    public function reset()
    {   
        return view('user/reset/resetPwdPage');
    }

}
