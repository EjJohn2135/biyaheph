<?php
 namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTourPackagesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tour_packages', [
            'type' => ['type' => 'ENUM', 'constraint' => ['adventure', 'cultural', 'beach', 'mountain', 'religious', 'food', 'other'], 'default' => 'other'],
            'date_from' => ['type' => 'DATE', 'null' => true],
            'date_to' => ['type' => 'DATE', 'null' => true],
            'max_tourists' => ['type' => 'INT', 'constraint' => 11, 'default' => 50],
            'rate_per_tourist' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'details' => ['type' => 'LONGTEXT', 'null' => true],
            'accommodation_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'tour_agency_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'tour_guide_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        ]);

        // Create junction table for package-tourist spots (many-to-many)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'package_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tourist_spot_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('package_id', 'tour_packages', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tourist_spot_id', 'tourist_spots', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('package_tourist_spots');
    }

    public function down()
    {
        $this->forge->dropTable('package_tourist_spots');
        $this->forge->dropColumn('tour_packages', ['type', 'date_from', 'date_to', 'max_tourists', 'rate_per_tourist', 'details', 'accommodation_id', 'tour_agency_id', 'tour_guide_id']);
    }
}