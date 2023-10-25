<?php

namespace App\Services;


class BaseServices
{
    /**
    * @var validation
    */
    public $validation; 
    public function __construct(){
        $this->validation = \Config\Services::validation();
    }

}