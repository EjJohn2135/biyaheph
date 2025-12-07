<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'maintenance_mode',
        'maintenance_message',
        'admin_ips',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    /**
     * Get or create settings
     */
    public function getOrCreate()
    {
        $settings = $this->first();

        if (!$settings) {
            $this->insert([
                'maintenance_mode' => 0,
                'maintenance_message' => 'We are currently under maintenance. Please check back soon!',
                'admin_ips' => '',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return $this->first();
        }

        return $settings;
    }
}