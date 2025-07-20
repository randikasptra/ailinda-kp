<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['username', 'password', 'role','email','create_at','update_at'];
    protected $allowedFields = ['username', 'password', 'role', 'email', 'created_at', 'updated_at'];

}
