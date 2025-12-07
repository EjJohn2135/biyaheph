<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBugsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'bug_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'LONGTEXT',
            ],
            'steps_to_reproduce' => [
                'type' => 'LONGTEXT',
            ],
            'severity' => [
                'type' => 'ENUM',
                'constraint' => ['critical', 'high', 'medium', 'low'],
                'default' => 'medium',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['open', 'in_progress', 'resolved', 'closed'],
                'default' => 'open',
            ],
            'screenshot' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'reported_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'assigned_to' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'resolved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('reported_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('bugs');
    }

    public function down()
    {
        $this->forge->dropTable('bugs');
    }
}