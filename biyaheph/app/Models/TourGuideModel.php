<?php


namespace App\Models;

use CodeIgniter\Model;

class TourGuideModel extends Model
{
    protected $table = 'tour_guides';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'contact', 'expertise', 'photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}