<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThreats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ioc_type' => [
                'type' => 'ENUM',
                'constraint' => ['IP', 'Domain', 'Hash', 'URL', 'Email'],
                'null' => false,
            ],
            'ioc_value' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => false,
            ],
            'threat_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'severity' => [
                'type' => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High', 'Critical'],
                'null' => false,
            ],
            'confidence' => [
                'type' => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High'],
                'null' => false,
            ],
            'source' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive', 'Investigating'],
                'default' => 'Active',
            ],
            'first_seen' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_seen' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tags' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('ioc_type');
        $this->forge->addKey('severity');
        $this->forge->addKey('status');
        $this->forge->createTable('threats');
    }

    public function down()
    {
        $this->forge->dropTable('threats');
    }
}
