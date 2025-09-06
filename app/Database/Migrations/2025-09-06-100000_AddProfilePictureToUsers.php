<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfilePictureToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'role'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'profile_picture');
    }
}