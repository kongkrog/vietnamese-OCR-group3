<?php

namespace App\Services;
use App\Services\BaseServices;
use App\Models\UserModel;
use App\Common\ResultUtils;
use Exception;

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

    public function getUserByID($email){
        /**
         * Get all info User by ID
         */
        return $this->users->where("email",$email)->first();
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

    public function hasResetInfo($requestData){

        // $requestData = $requestData->getPost();
        $validation = $this->validateResetUser($requestData);
        if ($validation -> getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors(),
            ];
        }
        
        $dataSave = $requestData->getPost();
        $user = $this->users->where("email",$dataSave["resetEmailInput"])->first();
        if (!$user) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['notExist' => 'Email chưa được đăng ký'],
            ];
        }
        if (!password_verify($dataSave['oldPwdInput'], $user['password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['notExist' => 'Mật Khẩu không đúng'],
            ];
        }
        unset($dataSave['resetEmailInput']);
        unset($dataSave['oldPwdInput']);
        unset($dataSave['reNewPwdInput']);
        $dataSave['password'] = password_hash($dataSave['newPwdInput'], PASSWORD_BCRYPT);
        $userID = $user['user_id'];
        try {
            $this->users->update($userID ,['password' => $dataSave['password']]);
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

    private function validateResetUser($requestData){
        $rule =[
            'resetEmailInput' => 'valid_email',
            'oldPwdInput'=> 'max_length[30]|min_length[6]',
            'newPwdInput' => 'max_length[30]|min_length[6]',
            'reNewPwdInput'=> 'matches[newPwdInput]',

        ];
        $messages = [
            'resetEmailInput' => [
                'valid_email' => 'Tài khoản {field} {value} không đúng định dạng, Vui lòng kiểm tra lại',
            ],
            'oldPwdInput' => [
                'max_length'=> 'Mật khẩu quá dài, vui lòng nhập lại',
                'min_length'=> 'Mật khẩu quá ngắn, vui lòng nhập lại',
            ],
            'newPwdInput' => [
                'max_length'=> 'Mật khẩu quá dài, vui lòng nhập lại',
                'min_length'=> 'Mật khẩu quá ngắn, vui lòng nhập lại',
            ],
            'reNewPwdInput'=> [
                'matches' => 'Mật khẩu không khớp, vui lòng nhập lại',
            ],
        ];
               


        $this -> validation -> setRules($rule, $messages);
        $this -> validation -> withRequest($requestData) -> run();

        return $this->validation;
    }

}