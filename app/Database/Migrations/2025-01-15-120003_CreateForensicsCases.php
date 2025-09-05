<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateForensicsCases extends Migration
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
            'case_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'case_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'case_type' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Malware Analysis', 
                    'Network Forensics', 
                    'Disk Forensics', 
                    'Mobile Forensics', 
                    'Memory Forensics', 
                    'Email Forensics', 
                    'Database Forensics', 
                    'Cloud Forensics', 
                    'Other'
                ],
                'default'    => 'Other',
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
                'constraint' => ['Active', 'In Progress', 'On Hold', 'Completed', 'Archived'],
                'default'    => 'Active',
                'null'       => false,
            ],
            'assigned_investigator' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'incident_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'evidence_count' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
                'null'     => false,
            ],
            'findings' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'recommendations' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'closed_date' => [
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
        $this->forge->addUniqueKey('case_number');
        $this->forge->addKey(['case_type', 'status']);
        $this->forge->addKey(['priority', 'assigned_investigator']);
        $this->forge->addKey('incident_date');
        $this->forge->createTable('forensics_cases');
    }

    public function down()
    {
        $this->forge->dropTable('forensics_cases');
    }
}