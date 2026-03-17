<?php

namespace App\Controllers;

use App\Models\IncidentModel;

class IncidentController extends BaseController
{
    protected $incidentModel;

    public function __construct()
    {
        $this->incidentModel = new IncidentModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Incident Management (Blue Team)',
            'incidents' => $this->incidentModel->findAll()
        ];
        return view('incidents/v2_index', $data);
    }

    public function create()
    {
        // Return form view
        return view('incidents/v2_form');
    }

    public function store()
    {
        // Boilerplate store logic
        $data = [
            'case_title' => $this->request->getPost('case_title') ?? 'Untitled Case',
            'severity'   => $this->request->getPost('severity') ?? 'Low',
            'status'     => $this->request->getPost('status') ?? 'Open',
            'description'=> $this->request->getPost('description') ?? 'No description provided.'
        ];
        
        $this->incidentModel->insert($data);
        
        // Trigger Webhook if Incident is High or Critical
        if (in_array($data['severity'], ['High', 'Critical'])) {
            $this->sendWebhookNotification($data);
        }

        return redirect()->to('/incidents-v2')->with('success', 'Case created successfully');
    }

    private function sendWebhookNotification($incidentData)
    {
        // Define Discord Webhook URL (Replace with actual or keep mock)
        $webhookUrl = 'https://discord.com/api/webhooks/mock_id/mock_token';
        
        // Ensure cURL is available before trying to send
        if (!function_exists('curl_init')) return;

        $message = "🚨 **" . strtoupper($incidentData['severity']) . " INCIDENT DETECTED** 🚨\n"
                 . "**Case Title:** " . $incidentData['case_title'] . "\n"
                 . "**Status:** " . $incidentData['status'] . "\n"
                 . "**Description:** " . substr($incidentData['description'], 0, 100) . "...";

        $json_data = json_encode([
            "content" => $message,
            "username" => "SIEM Command Center"
        ]);

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 5 second timeout so it doesn't freeze app
        
        $response = curl_exec($ch);
        curl_close($ch);
    }

    public function view_case($id)
    {
        $data['incident'] = $this->incidentModel->find($id);
        if (!$data['incident']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('incidents/v2_view', $data);
    }

    public function close_case($id)
    {
        $this->incidentModel->update($id, [
            'status' => 'Closed',
            'closed_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/incidents-v2')->with('success', 'Case closed successfully');
    }
}
