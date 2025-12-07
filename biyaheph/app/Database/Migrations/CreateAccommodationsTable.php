<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccommodationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'description' => ['type' => 'TEXT', 'null' => true],
            'location' => ['type' => 'VARCHAR', 'constraint' => 200],
            'price_per_night' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('accommodations');
    }

    public function down()
    {
        $this->forge->dropTable('accommodations');
    }
}