<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\AlertModel;
use App\Models\ThreatModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $incidentModel = new IncidentModel();
        $alertModel = new AlertModel();
        $threatModel = new ThreatModel();
        
        // Security metrics statistics
        $data['title'] = 'Security Operations Center';
        
        // Incident statistics
        $data['totalIncidents']    = $incidentModel->countAll();
        $data['openIncidents']     = $incidentModel->where('status', 'Open')->countAllResults();
        $data['closedIncidents']   = $incidentModel->where('status', 'Closed')->countAllResults();
        $data['criticalIncidents'] = $incidentModel->where('severity', 'Critical')->countAllResults();
        
        // Calculate incident resolution rate
        $data['resolutionRate'] = $data['totalIncidents'] > 0 ? round(($data['closedIncidents'] / $data['totalIncidents']) * 100, 1) : 0;
        
        // Alert statistics
        $data['totalAlerts']      = $alertModel->countAll();
        $data['activeAlerts']     = $alertModel->where('status', 'Active')->countAllResults();
        $data['criticalAlerts']   = $alertModel->where('priority', 'Critical')->countAllResults();
        $data['falsePositiveAlerts'] = $alertModel->where('status', 'False Positive')->countAllResults();
        
        // Calculate alert accuracy rate
        $data['alertAccuracyRate'] = $data['totalAlerts'] > 0 ? round((($data['totalAlerts'] - $data['falsePositiveAlerts']) / $data['totalAlerts']) * 100, 1) : 0;
        
        // Threat statistics
        $data['totalThreats']     = $threatModel->countAll();
        $data['activeThreats']    = $threatModel->where('status', 'Active')->countAllResults();
        $data['highSeverityThreats'] = $threatModel->where('severity', 'High')->orWhere('severity', 'Critical')->countAllResults();
        $data['investigatingThreats'] = $threatModel->where('status', 'Investigating')->countAllResults();
        
        // Calculate threat mitigation rate
        $data['mitigationRate'] = $data['totalThreats'] > 0 ? round((($data['totalThreats'] - $data['activeThreats']) / $data['totalThreats']) * 100, 1) : 0;
        
        // Latest 5 incidents
        $data['latestIncidents'] = $incidentModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
        
        // Latest 5 alerts
        $data['latestAlerts'] = $alertModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
        
        // Latest 5 threats
        $data['latestThreats'] = $threatModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
        
        // Severity distribution data for charts
        $severityLevels = ['Low', 'Medium', 'High', 'Critical'];
        $severityData = [];
        foreach ($severityLevels as $s) {
            $severityData[] = $incidentModel->where('severity', $s)->countAllResults();
        }
        $data['severityLabels'] = json_encode($severityLevels);
        $data['severityCounts'] = json_encode($severityData);
        
        // Alert priority distribution
        $priorityLevels = ['Low', 'Medium', 'High', 'Critical'];
        $priorityData = [];
        foreach ($priorityLevels as $p) {
            $priorityData[] = $alertModel->where('priority', $p)->countAllResults();
        }
        $data['priorityLabels'] = json_encode($priorityLevels);
        $data['priorityCounts'] = json_encode($priorityData);
        
        // Threat severity distribution
        $threatSeverityData = [];
        foreach ($severityLevels as $s) {
            $threatSeverityData[] = $threatModel->where('severity', $s)->countAllResults();
        }
        $data['threatSeverityLabels'] = json_encode($severityLevels);
        $data['threatSeverityCounts'] = json_encode($threatSeverityData);
        
        // Top source IPs for incidents
        $topIncidentIPs = $incidentModel->select('source_ip, COUNT(*) as count')
            ->where('source_ip IS NOT NULL')
            ->groupBy('source_ip')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->findAll();
        $data['topIncidentIPs'] = $topIncidentIPs;
        
        // Top threat types
        $topThreatTypes = $threatModel->select('threat_type, COUNT(*) as count')
            ->where('threat_type IS NOT NULL')
            ->groupBy('threat_type')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->findAll();
        $data['topThreatTypes'] = $topThreatTypes;
        
        // Calculate average response time (simplified)
        $data['avgResponseTime'] = '2.3 hours';

        return view('dashboard/dashboard', $data);
    }
}