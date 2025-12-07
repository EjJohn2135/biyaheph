<?php


namespace App\Models;

use CodeIgniter\Model;

class TourAgencyModel extends Model
{
    protected $table = 'tour_agencies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'contact', 'email', 'address', 'photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}