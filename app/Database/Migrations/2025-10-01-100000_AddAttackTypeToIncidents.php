<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAttackTypeToIncidents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incidents', [
            'attack_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'source_ip'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incidents', 'attack_type');
    }
}
