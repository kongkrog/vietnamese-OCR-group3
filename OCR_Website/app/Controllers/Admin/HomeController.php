<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data = [];
        $cssFiles = [
            
        ];
        $jsFiles = [
            
        ];
        $data = $this -> loadMasterLayout($data, 'admin/pages/home', 'Trang chủ', $cssFiles, $jsFiles);
        return view('admin\main', $data);
    }
}
