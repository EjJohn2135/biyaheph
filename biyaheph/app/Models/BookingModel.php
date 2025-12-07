<?php


namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'package_id', 
        'number_of_tourists',  // Keep this - migration has it
        'total_price',         // Change back from 'price' - migration has 'total_price'
        'status', 
        'contact_name', 
        'contact_email', 
        'contact_phone', 
        'special_requests'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}