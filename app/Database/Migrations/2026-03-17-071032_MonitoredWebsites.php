<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MonitoredWebsites extends Migration
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
                'constraint' => '100',
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aman', 'terindikasi', 'tidak_bisa_diakses', 'belum_diperiksa'],
                'default'    => 'belum_diperiksa',
            ],
            'last_checked' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'response_time' => [
                'type' => 'INT', // in milliseconds
                'null' => true,
            ],
            'indicators_found' => [
                'type' => 'TEXT', // JSON array of found keywords like 'judol', 'porn'
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
        $this->forge->createTable('monitored_websites');
    }

    public function down()
    {
        $this->forge->dropTable('monitored_websites');
    }
}
