<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIncidents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true],
            'title'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'      => ['type' => 'TEXT', 'null' => true],
            'source_ip'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'severity'         => ['type' => 'ENUM("Low","Medium","High","Critical")', 'default' => 'Low'],
            'status'           => ['type' => 'ENUM("Open","In Progress","Closed")', 'default' => 'Open'],
            'resolution_notes' => ['type' => 'TEXT', 'null' => true],
            'resolved_at'      => ['type' => 'DATETIME', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('incidents');
    }

    public function down()
    {
        $this->forge->dropTable('incidents');
    }
}
