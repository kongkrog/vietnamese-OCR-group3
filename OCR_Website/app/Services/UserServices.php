<?php

namespace App\Services;
use App\Services\BaseServices;
use App\Models\UserModel;
use App\Common;
use App\Common\ResultUtils;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class UserServices extends BaseServices
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

    public function getAllUsersData()
    {
        /**
         * Get all Data
         */
        return $this->users->findAll();
    }

    public function getUserByID($id){
        /**
         * Get all info User by ID
         */
        return $this->users->where("user_id",$id)->first();
    }

    public function addUserInfo($requestData)
    {
        /**
         * Add new User Info
         */
        $validation = $this->validateAddUser($requestData);
        if ($validation -> getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors(),
            ];
        }
        $dataSave = $requestData->getPost();
        unset($dataSave['password_confirm']);
        $dataSave['password'] = password_hash($dataSave['password'], PASSWORD_BCRYPT);
        try {
            $this->users->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Thêm dữ liệu thành công'],
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['success' => $e -> getMessage()],
            ];
        };
    }

    public function updateUserInfo($requestData){
        /**
         * Update user info into db
         */
        $validation = $this->validateEditUser($requestData);
        if ($validation -> getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors(),
            ];
        }
        $dataSave = $requestData->getPost();
        if (!empty($requestData->getPost()['change_password'])) {
            unset($dataSave['password_confirm']);
            unset($dataSave['change_password']);
            $dataSave['password'] = password_hash($dataSave['password'], PASSWORD_BCRYPT);
        } else{
            unset($dataSave['password']);
            unset($dataSave['password_confirm']);
        }
        
        try {
            $this->users->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Cập nhật dữ liệu thành công'],
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['success' => $e -> getMessage()],
            ];
        };
    }
    private function validateAddUser($requestData){
        $rule =[
            'email' => 'valid_email|is_unique[users.email]',
            'name' => 'max_length[100]',
            'password' => 'max_length[100]|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];
        $messages = [
            'email' => [
                'valid_email' => 'Email không đúng định dạng, Vui lòng kiểm tra lại',
                'is_unique' =>'Email đã được đăng ký, Vui lòng kiểm tra lại',
            ],
            'name' => [
                'max_length'=> 'Tên không được dài quá 100 kí tự',
            ],
            'password' => [
                'max_length'=> 'Mật Khẩu không được dài quá 100 kí tự',
                'min_length'=> 'Mật khẩu phải trên 6 kí tự',
            ],
            'password_confirm' => [
                'matches'=> 'Mật Khẩu không khớp, Vui lòng nhập lại',
            ]
        ];
        $this -> validation -> setRules($rule, $messages);
        $this -> validation -> withRequest($requestData) -> run();

        return $this->validation;
    }

    private function validateEditUser($requestData){
        $rule =[
            'email' => 'valid_email|is_unique[users.email,id,'.$requestData->getPost()['id'].']',
            'name' => 'max_length[100]',
        ];
        $messages = [
            'email' => [
                'valid_email' => 'Tài khoản {field} {value} không đúng định dạng, Vui lòng kiểm tra lại',
                'is_unique' =>'Tài khoản {field} {value} đã được đăng ký, Vui lòng kiểm tra lại',
            ],
            'name' => [
                'max_length'=> 'Tên không được dài quá {param} kí tự',
            ],
        ];

        if (!empty($requestData->getPost()['change_password'])) {
            $rule['password'] = 'max_length[30]|min_length[6]';
            $rule['password-confirm'] = 'matches[password]'; 

            $messages['password'] = [
                'max_length'=> 'Mật Khẩu không được dài quá {param} kí tự',
                'min_length'=> 'Mật khẩu phải trên {param} kí tự',
            ];
            $messages['password_confirm'] = [
                'matches'=> 'Mật Khẩu không khớp, Vui lòng nhập lại',
            ];
        }
               


        $this -> validation -> setRules($rule, $messages);
        $this -> validation -> withRequest($requestData) -> run();

        return $this->validation;
    }
}