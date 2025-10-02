<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\AlertModel;
use App\Models\ThreatModel;
use App\Models\AssetModel;

class Debug extends BaseController
{
    public function printAllData()
    {
        $incidentModel = new IncidentModel();
        $alertModel = new AlertModel();
        $threatModel = new ThreatModel();
        $assetModel = new AssetModel();

        // Get all data needed for reports
        $incidents = $incidentModel->orderBy('created_at', 'DESC')->findAll();
        $alerts = $alertModel->orderBy('created_at', 'DESC')->findAll();
        $threats = $threatModel->orderBy('created_at', 'DESC')->findAll();
        $assets = $assetModel->orderBy('created_at', 'DESC')->findAll();

        echo "<h1>Debug Data</h1>";

        echo "<h2>Incidents</h2>";
        echo "<pre>";
        print_r($incidents);
        echo "</pre>";

        echo "<h2>Alerts</h2>";
        echo "<pre>";
        print_r($alerts);
        echo "</pre>";

        echo "<h2>Threats</h2>";
        echo "<pre>";
        print_r($threats);
        echo "</pre>";

        echo "<h2>Assets</h2>";
        echo "<pre>";
        print_r($assets);
        echo "</pre>";
    }
}
