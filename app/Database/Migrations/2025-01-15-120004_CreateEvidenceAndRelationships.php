<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEvidenceAndRelationships extends Migration
{
    public function up()
    {
        // Create Evidence table for forensics cases
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'forensics_case_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'evidence_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ],
            'evidence_type' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Digital Image', 
                    'Memory Dump', 
                    'Network Capture', 
                    'Log Files', 
                    'Email Archive', 
                    'Mobile Backup', 
                    'Database Backup', 
                    'Document', 
                    'Other'
                ],
                'default'    => 'Other',
                'null'       => false,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'file_size' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
            ],
            'hash_md5' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
            ],
            'hash_sha1' => [
                'type'       => 'VARCHAR',
                'constraint' => 40,
                'null'       => true,
            ],
            'hash_sha256' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
            ],
            'collected_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'collected_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'chain_of_custody' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'verified' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ],
            'verified_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'description' => [
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
        $this->forge->addKey('forensics_case_id');
        $this->forge->addKey(['evidence_type', 'collected_at']);
        $this->forge->addKey(['hash_md5', 'hash_sha1', 'hash_sha256']);
        $this->forge->createTable('evidence');

        // Create Alert-Asset relationship table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'alert_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'asset_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'relationship_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Source', 'Target', 'Affected', 'Related'],
                'default'    => 'Related',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['alert_id', 'asset_id']);
        $this->forge->createTable('alert_assets');

        // Create Threat-Asset relationship table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'threat_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'asset_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'impact_level' => [
                'type'       => 'ENUM',
                'constraint' => ['Low', 'Medium', 'High', 'Critical'],
                'default'    => 'Medium',
                'null'       => false,
            ],
            'detected_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['threat_id', 'asset_id']);
        $this->forge->createTable('threat_assets');

        // Create Incident-Asset relationship table  
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'incident_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'asset_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'involvement_type' => [
                'type'       => 'ENUM',
                'constraint' => ['Compromised', 'Affected', 'Source', 'Target', 'Witness'],
                'default'    => 'Affected',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['incident_id', 'asset_id']);
        $this->forge->createTable('incident_assets');
    }

    public function down()
    {
        $this->forge->dropTable('incident_assets');
        $this->forge->dropTable('threat_assets');
        $this->forge->dropTable('alert_assets');
        $this->forge->dropTable('evidence');
    }
}