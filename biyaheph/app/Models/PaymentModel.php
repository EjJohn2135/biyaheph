<?php
 namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['booking_id','stripe_payment_id','amount','currency','status'];
    protected $useTimestamps = false;
}