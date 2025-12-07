<?php


namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'BIGINT','constraint'=>20,'unsigned'=>true,'auto_increment'=>true],
            'user_id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'null'=>true], // null = broadcast
            'role' => ['type'=>'VARCHAR','constraint'=>50,'null'=>true], // 'admin' or 'tourist' or null
            'title' => ['type'=>'VARCHAR','constraint'=>255],
            'message' => ['type'=>'TEXT','null'=>true],
            'data' => ['type'=>'JSON','null'=>true],
            'is_read' => ['type'=>'TINYINT','constraint'=>1,'default'=>0],
            'created_at' => ['type'=>'DATETIME','default'=>new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP')],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey('role');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}