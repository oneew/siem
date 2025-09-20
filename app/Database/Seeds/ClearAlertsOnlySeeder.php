<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearAlertsOnlySeeder extends Seeder
{
    public function run()
    {
        // Clear only the alerts table
        $this->db->table('alerts')->truncate();
        
        echo "All alerts have been cleared from the database.\n";
        echo "The alerts table is now empty and ready for real data.\n";
    }
}