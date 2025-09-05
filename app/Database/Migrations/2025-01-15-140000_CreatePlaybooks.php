<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlaybooks extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['Manual', 'Automated', 'Semi-Automated'],
                'default'    => 'Manual',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'severity_level' => [
                'type'       => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High', 'Critical'],
                'default'    => 'Medium',
                'null'       => false,
            ],
            'steps' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'trigger_conditions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'estimated_time' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'required_tools' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Active', 'Inactive', 'Draft'],
                'default'    => 'Draft',
                'null'       => false,
            ],
            'execution_count' => [
                'type'     => 'INT',
                'default'  => 0,
                'null'     => false,
            ],
            'success_rate' => [
                'type'     => 'DECIMAL',
                'constraint' => '5,2',
                'default'  => 0.00,
                'null'     => false,
            ],
            'last_executed' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'updated_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
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
        $this->forge->addKey(['category', 'type']);
        $this->forge->addKey(['severity_level', 'status']);
        $this->forge->addKey('status');
        $this->forge->createTable('playbooks');
    }

    public function down()
    {
        $this->forge->dropTable('playbooks');
    }
}