<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAssetIdToAlerts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('alerts', [
            'asset_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'id'
            ],
            'assigned_to' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'asset_id'
            ]
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('asset_id', 'assets', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropColumn('alerts', ['asset_id', 'assigned_to']);
    }
}
