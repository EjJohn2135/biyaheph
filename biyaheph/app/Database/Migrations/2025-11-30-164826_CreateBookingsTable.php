<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'user_id' => ['type'=>'INT','unsigned'=>true],
            'package_id' => ['type'=>'INT','unsigned'=>true],
            'guests' => ['type'=>'INT','default'=>1],
            'status' => ['type'=>'ENUM','constraint'=>['pending','paid','cancelled'],'default'=>'pending'],
            'total' => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>'0.00'],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
