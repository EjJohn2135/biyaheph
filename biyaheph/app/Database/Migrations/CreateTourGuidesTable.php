<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTourGuidesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'expertise' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tour_guides');
    }

    public function down()
    {
        $this->forge->dropTable('tour_guides');
    }
}