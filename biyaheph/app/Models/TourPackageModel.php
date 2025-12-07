<?php

namespace App\Models;

use CodeIgniter\Model;

class TourPackageModel extends Model
{
    protected $table = 'tour_packages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'price', 'image'];
    protected $useTimestamps = true;
}
