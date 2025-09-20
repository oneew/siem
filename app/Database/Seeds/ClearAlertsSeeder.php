<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearAlertsSeeder extends Seeder
{
    public function run()
    {
        // Clear all existing alerts
        $this->db->table('alerts')->truncate();
        
        echo "All alerts have been cleared from the database.\n";
        echo "You can now add real alerts through the application interface.\n";
    }
}