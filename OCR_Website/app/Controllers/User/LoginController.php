<?php

namespace App\Controllers\User;
use App\Controllers\BaseController;
use App\Services\UserServices;

class LoginController extends BaseController
{
    /**
     * Undocumented function
     *
     * @var Services
     */
    private $services;

    public function __construct()
    {
        $this->services = new UserServices();
    }
    public function signup(): string
    {
        return view('user\login\signUpPage');
    }
    
    public function create()
    {
        $result = $this->services->addUserInfo($this->request);
        if ($result['status'] == 'ERR') {
            return view('user\login\signUpPage');
        }
        return view('user\login\signUpCompPage');
    }

    // public function edit($user_id)
    // {
    //     $user = $this->services->getUserByID($user_id);
    //     if(!$user) {
    //         return redirect('error/404');
    //     }

    //     $dataLayout['users'] = $user;
    //     $data = $this -> loadMasterLayout([], 'admin/pages/user/edit', 'Sửa Tài Khoản', $dataLayout);
    //     return view('admin\main', $data);
    // }

    // public function update()
    // {
    //     $result = $this->services->updateUserInfo($this->request);
    //     return redirect()->back()->withInput()->with($result['messageCode'], $result['message']);
    // }
}