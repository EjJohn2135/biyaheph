<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'booking_id' => ['type'=>'INT','unsigned'=>true],
            'stripe_payment_id' => ['type'=>'VARCHAR','constraint'=>255],
            'amount' => ['type'=>'DECIMAL','constraint'=>'10,2'],
            'currency' => ['type'=>'VARCHAR','constraint'=>10, 'default' => 'php'],
            'status' => ['type'=>'VARCHAR','constraint'=>50],
            'created_at datetime default current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
