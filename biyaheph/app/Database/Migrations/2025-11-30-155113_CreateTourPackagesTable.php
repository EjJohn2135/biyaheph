<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTourPackagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '150'
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tour_packages');
    }

    public function down()
    {
        $this->forge->dropTable('tour_packages');
    }
}
