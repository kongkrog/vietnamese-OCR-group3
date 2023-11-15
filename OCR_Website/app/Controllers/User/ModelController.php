<?php

namespace App\Controllers\User;

use App\Common\ResultUtils;
use App\Controllers\BaseController;
use App\Services\LoginServices;
use App\Services\UserServices;
use App\Services\ModelServices;

class ModelController extends BaseController
{
    /**
     * Undocumented function
     *
     * @var userServices
     * @var loginServices
     * @var modelServices
     */
    private $userServices;
    private $loginServices;
    private $modelServices;

    public function __construct()
    {
        $this->userServices = new UserServices();
        $this->loginServices = new LoginServices();
        $this->modelServices = new ModelServices();
    }

    public function predict()
    {
        ini_set('max_execution_time', 1200);

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

        $fail = ["Fail to predict"];
        if (empty($output)) {
            $outputMessage = [
                "outputPredict"=> $fail,
                'currentSection' => 'useSection',
                'imagePath'=> $targetFile,
            ];
            return view('user/index', $output);
        }
        $outputMessage = [
            "outputPredict"=> $output,
            'currentSection' => 'useSection',
            'imagePath'=> $targetFile,
        ];

        return view('user/index', $outputMessage);

        
    }

}