<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        $defaultMessage = [
            'outputPredict' => ['Output predict here'],
            'currentSection' => 'notSection',
            'imagePath'=> '',
            'session'=> false,
        ];
        $session = session();
        $outputMessage = $session->getFlashdata('output_message');
        if ($session->has('user_login')) {  
            $defaultMessage['session'] = true;
            if (!empty($outputMessage)){
                $outputMessage['session'] = true;
                return view('user/index', $outputMessage);
            }        
            return view('user/index', $defaultMessage);
        } else {
            return view('user/index', $defaultMessage);
        }


        
    }

    public function reset()
    {   
        return view('user/reset/resetPwdPage');
    }

    public function logout()
    {   
        $session = session();
        $session->destroy();
        return redirect('home');
    }

    public function profile(){
        $session = session();
        $userInfo = $session->get('user_login');
        return view('user/profile/userProfilePage', $userInfo);
    }
}
