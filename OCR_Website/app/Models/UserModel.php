<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = "users";
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_id', 'username', 'password', 'email']; 
}