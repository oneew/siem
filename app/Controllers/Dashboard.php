<?php

namespace App\Controllers;

use App\Models\IncidentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $incidentModel = new IncidentModel();
        
        // Security metrics statistics
        $data['title'] = 'Security Dashboard';
        $data['totalIncidents']    = $incidentModel->countAll();
        $data['openIncidents']     = $incidentModel->where('status', 'Open')->countAllResults();
        $data['closedIncidents']   = $incidentModel->where('status', 'Closed')->countAllResults();
        $data['criticalIncidents'] = $incidentModel->where('severity', 'Critical')->countAllResults();

        // Latest 5 incidents
        $data['latestIncidents'] = $incidentModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        // Severity distribution data for charts
        $severityLevels = ['Low', 'Medium', 'High', 'Critical'];
        $severityData = [];
        foreach ($severityLevels as $s) {
            $severityData[] = $incidentModel->where('severity', $s)->countAllResults();
        }
        $data['severityLabels'] = json_encode($severityLevels);
        $data['severityCounts'] = json_encode($severityData);

        return view('dashboard/dashboard', $data);
    }
}
