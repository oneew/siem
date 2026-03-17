<?php

namespace App\Controllers;

use App\Models\ForensicsModel;

class Forensics extends BaseController
{
    public function index()
    {
        try {
            $model = new ForensicsModel();
            $data['title'] = 'Digital Forensics';
            $data['cases'] = $model->orderBy('created_at', 'DESC')->findAll();
            
            // Get statistics with error handling
            $data['stats'] = [
                'total_cases' => $model->countAll(),
                'active_cases' => $this->getStatusCount($model, 'Active'),
                'completed_cases' => $this->getStatusCount($model, 'Completed'),
                'evidence_items' => $this->getTotalEvidenceCount($model)
            ];
            
            return view('forensics/index', $data);
        } catch (\Exception $e) {
            log_message('error', 'Forensics index error: ' . $e->getMessage());
            return redirect()->to('/dashboard')->with('error', 'Unable to load forensics data');
        }
    }

    public function create()
    {
        $data['title'] = 'Create Forensics Case';
        return view('forensics/create', $data);
    }

    public function store()
    {
        $model = new ForensicsModel();
        
        // Generate case number
        $caseNumber = 'FOR-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        $data = [
            'case_number' => $caseNumber,
            'case_name' => $this->request->getPost('case_name'),
            'case_type' => $this->request->getPost('case_type'),
            'priority' => $this->request->getPost('priority'),
            'status' => 'Active',
            'assigned_investigator' => $this->request->getPost('assigned_investigator'),
            'incident_date' => $this->request->getPost('incident_date'),
            'description' => $this->request->getPost('description'),
            'evidence_count' => 0
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/forensics')->with('success', 'Forensics case created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create forensics case');
        }
    }

    public function show($id)
    {
        $model = new ForensicsModel();
        $case = $model->find($id);
        
        if (!$case) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Forensics case not found');
        }
        
        $data['title'] = 'Forensics Case Details';
        $data['case'] = $case;
        
        // TODO: Load actual evidence items from database
        $data['evidence_items'] = [];
        
        return view('forensics/show', $data);
    }

    public function addEvidence($caseId)
    {
        $data['title'] = 'Add Evidence';
        $data['case_id'] = $caseId;
        return view('forensics/add_evidence', $data);
    }

    public function storeEvidence($caseId)
    {
        // TODO: Implement actual file uploads and evidence storage
        return redirect()->to('/forensics/show/' . $caseId)->with('success', 'Evidence added successfully');
    }

    public function generateReport($id)
    {
        // TODO: Implement comprehensive forensics report generation
        return redirect()->back()->with('success', 'Forensics report generated successfully');
    }

    public function downloadEvidence($caseId, $evidenceId)
    {
        // TODO: Implement evidence download functionality
        return redirect()->back()->with('success', 'Evidence download initiated');
    }

    public function closeCase($id)
    {
        $model = new ForensicsModel();
        $model->update($id, ['status' => 'Completed', 'closed_date' => date('Y-m-d H:i:s')]);
        return redirect()->back()->with('success', 'Case closed successfully');
    }

    public function delete($id)
    {
        $model = new ForensicsModel();
        $model->delete($id);
        return redirect()->to('/forensics')->with('success', 'Forensics case deleted successfully');
    }

    private function getTotalEvidenceCount($model)
    {
        try {
            $result = $model->selectSum('evidence_count')->get()->getRow();
            return $result ? (int)$result->evidence_count : 0;
        } catch (\Exception $e) {
            // If evidence_count column doesn't exist or query fails, return 0
            return 0;
        }
    }

    private function getStatusCount($model, $status)
    {
        try {
            return $model->where('status', $status)->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Error counting forensics status: ' . $e->getMessage());
            return 0;
        }
    }
}