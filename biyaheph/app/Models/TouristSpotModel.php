<?php


namespace App\Models;

use CodeIgniter\Model;

class TouristSpotModel extends Model
{
    protected $table = 'tourist_spots';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'location', 'photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}