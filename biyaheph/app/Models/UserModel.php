<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    // ...existing code...
    protected $allowedFields = ['name', 'email', 'password', 'role', 'verification_token', 'approved'];
    protected $useTimestamps = true;
}