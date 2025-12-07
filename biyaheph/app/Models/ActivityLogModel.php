<?php


namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id', 'name', 'role', 'action', 'details',
        'ip_address', 'mac_address', 'user_agent', 'created_at'
    ];
    public $timestamps = false;
}