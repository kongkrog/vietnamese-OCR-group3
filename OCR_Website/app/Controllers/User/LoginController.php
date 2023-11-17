<?php

namespace App\Controllers\User;

use App\Common\ResultUtils;
use App\Controllers\BaseController;
use App\Services\LoginServices;
use App\Services\UserServices;

class LoginController extends BaseController
{
    /**
     * Undocumented function
     *
     * @var userServices
     * @var loginServices
     */
    private $userServices;
    private $loginServices;

    public function __construct()
    {
        $this->userServices = new UserServices();
        $this->loginServices = new LoginServices();
    }
    public function signup(): string
    {
        return view('user\login\signUpPage');
    }
    
    public function create()
    {
        $result = $this->userServices->addUserInfo($this->request);
        if ($result['status'] == 'ERR') {
            // dd($result);
            return view('user\login\signUpFailPage',$result);
        }
        return view('user\login\signUpCompPage');
    }

    public function index()
    {
        view('');
    }
    public function login()
    {
        $result = $this->loginServices->hasLoginInfo($this->request);
        if ($result['status'] === ResultUtils::STATUS_CODE_OK){
            return redirect()->to('home');
        } elseif ($result['status'] === ResultUtils::STATUS_CODE_ERR){
            return view('user\login\signUpFailPage',$result);
            // return redirect('error/404') ->with($result['messageCode'],$result['message']);
            // dd($result);
        }
        return redirect('home');
        
    }

    public function validateReset()
    {
        $result = $this->loginServices->hasResetInfo($this->request);
        // dd($result);
        return view('user\login\signUpFailPage',$result);
        // return redirect()->back()->withInput()->with($result['messageCode'], $result['message']);

    }
}