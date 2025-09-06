<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEvidenceCollectedToIncidents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incidents', [
            'evidence_collected' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'resolved_at'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incidents', 'evidence_collected');
    }
}