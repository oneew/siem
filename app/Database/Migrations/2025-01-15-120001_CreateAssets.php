<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'asset_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ],
            'asset_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Server', 'Endpoint', 'Network Device', 'Mobile', 'IoT Device', 'Database'],
                'default'    => 'Endpoint',
                'null'       => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'mac_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 17,
                'null'       => true,
            ],
            'operating_system' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Online', 'Offline', 'Maintenance', 'Decommissioned'],
                'default'    => 'Online',
                'null'       => false,
            ],
            'criticality' => [
                'type'       => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High', 'Critical'],
                'default'    => 'Medium',
                'null'       => false,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'owner' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'vulnerability_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Unknown', 'Secure', 'Vulnerable', 'Patching Required'],
                'default'    => 'Unknown',
                'null'       => true,
            ],
            'last_scan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['asset_type', 'status']);
        $this->forge->addKey('ip_address');
        $this->forge->addKey(['criticality', 'vulnerability_status']);
        $this->forge->createTable('assets');
    }

    public function down()
    {
        $this->forge->dropTable('assets');
    }
}