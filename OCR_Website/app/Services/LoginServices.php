<?php

namespace App\Services;
use App\Services\BaseServices;
use App\Models\UserModel;
use App\Common\ResultUtils;

class LoginServices extends BaseServices
{
    private $users;
    public function __construct(){
        /**
         * Construct
         */
        parent::__construct();
        $this->users = new UserModel();
        $this ->users ->protect(false);
    }

    public function hasLoginInfo($requestData){
        $validation = $this->validateLogin($requestData);

        if ($validation -> getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors(),
            ];
        }
        $dataSave = $requestData->getPost();
        $user = $this->users->where('email', $dataSave['email'])->first();

        if(!$user){
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => [
                    'notExist' => 'Email chưa được đăng ký!'
                ],
            ];
        }
        if(!password_verify($dataSave['password'], $user['password'])){
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => [
                    'wrongPass' => 'Mật Khẩu không đúng!'
                ],
            ];
        }

        $session = session();

        unset($user['password']);

        $session ->set('user_login', $user);

        return [
            'status' => ResultUtils::STATUS_CODE_OK,
            'messageCode' => ResultUtils::MESSAGE_CODE_OK,
            'message' => null,
        ];
        
    }

    private function validateLogin($requestData){
        $rule =[
            'email' => 'valid_email',
            'password'=> 'max_length[30]|min_length[6]',
        ];
        $message =[
            'name' => [
                'valid_email' => 'Địa chỉ email không hợp lệ, vui lòng nhập lại',
            ],
            'password' => [
                'max_length'=> 'Mật khẩu quá dài, vui lòng nhập lại',
                'min_length'=> 'Mật khẩu quá ngắn, vui lòng nhập lại',
            ],
        ];
        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }

}