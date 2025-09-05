<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlerts extends Migration
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
            'alert_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ],
            'alert_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Authentication', 'Network', 'Malware', 'Data Breach', 'Intrusion', 'System'],
                'default'    => 'System',
                'null'       => false,
            ],
            'priority' => [
                'type'       => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High', 'Critical'],
                'default'    => 'Medium',
                'null'       => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Active', 'Investigating', 'Closed', 'False Positive'],
                'default'    => 'Active',
                'null'       => false,
            ],
            'source_ip' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'destination_ip' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'rule_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'detection_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'acknowledged' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ],
            'acknowledged_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'acknowledged_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'resolved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'resolution_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'false_positive_reason' => [
                'type' => 'TEXT',
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
        $this->forge->addKey(['alert_type', 'priority']);
        $this->forge->addKey(['status', 'acknowledged']);
        $this->forge->addKey('source_ip');
        $this->forge->addKey('detection_time');
        $this->forge->createTable('alerts');
    }

    public function down()
    {
        $this->forge->dropTable('alerts');
    }
}