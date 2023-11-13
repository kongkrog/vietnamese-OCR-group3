<?php

namespace App\Controllers\User;

use App\Common\ResultUtils;
use App\Controllers\BaseController;
use App\Services\LoginServices;
use App\Services\UserServices;

class ModelController extends BaseController
{
    /**
     * Undocumented function
     *
     * @var userServices
     * @var loginServices
     */
    private $userServices;

    public function __construct()
    {
        $this->userServices = new UserServices();
    }
    public function predict()
    {
        setlocale(LC_ALL, 'en_US.UTF-8');
        putenv("PYTHONIOENCODING=utf-8");
        $result = $_FILES["realInputBtn"];
        $image = $result["tmp_name"];
        $targetDirectory = 'C:/xampp/htdocs/OCR_Website/app/Models/uploads/'; // Specify the directory to store uploaded images
        $targetFile = $targetDirectory . basename($result['name']);
        // $targetFile = $targetDirectory . basename('name');

        move_uploaded_file($image, $targetFile);
        $command = "python C:/xampp/htdocs/OCR_Website/app/Models/__init__.py " . escapeshellarg($targetFile);
        exec($command, $output, $return_var);

        if (empty($output[4])) {
            $output = [
                "outputPredict"=> "Fail to predict",
                'currentSection' => 'useSection',
                'imagePath'=> $targetFile,
            ];
            return view('user/index', $output);
        }
        $output = [
            "outputPredict"=> $output[4],
            'currentSection' => 'useSection',
            'imagePath'=> $targetFile,
        ];
        return view('user/index', $output);

        
    }

}