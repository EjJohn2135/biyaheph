<?php

namespace App\Models;

use CodeIgniter\Model;

class AccommodationModel extends Model
{
    protected $table = 'accommodations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'location', 'price_per_night', 'photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}