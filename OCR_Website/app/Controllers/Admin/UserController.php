<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Services\UserServices;
use Kint\Zval\Value;

class UserController extends BaseController
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
    public function list(): string
    {
        $data = [];
        $dataLayout['users'] = $this->services->getAllUsersData(); 

        $cssFiles = [
            "https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",
        ];
        $jsFiles = [
            "http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js",
            base_url()."assets/admin/js/datatable.js",
        ];
        $data = $this -> loadMasterLayout($data, 'admin/pages/user/list', 'Danh sách User',$dataLayout, $cssFiles, $jsFiles);
        return view('admin\main', $data);
    }

    public function add(): string
    {
        $data = [];
        $data = $this -> loadMasterLayout($data, 'admin/pages/user/add', 'Thêm Tài Khoản');
        return view('admin\main', $data);
    }

    public function create()
    {
        $result = $this->services->addUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['message']);
    }

    public function edit($user_id)
    {
        $user = $this->services->getUserByID($user_id);
        if(!$user) {
            return redirect('error/404');
        }

        $jsFiles = [
            base_url()."assets/admin/js/event.js",
        ];

        $dataLayout['users'] = $user;
        $data = $this -> loadMasterLayout([], 'admin/pages/user/edit', 'Sửa Tài Khoản', $dataLayout, [], $jsFiles);
        return view('admin\main', $data);
    }

    public function update()
    {
        $result = $this->services->updateUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['message']);
    }
}
