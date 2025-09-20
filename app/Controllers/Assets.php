<?php

namespace App\Controllers;

use App\Models\AssetModel;

class Assets extends BaseController
{
    public function index()
    {
        $model = new AssetModel();
        $data['title'] = 'Asset Management';
        $data['assets'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        // Get statistics
        $data['stats'] = [
            'total_assets' => $model->countAll(),
            'online_assets' => $model->where('status', 'Online')->countAllResults(),
            'critical_assets' => $model->where('criticality', 'Critical')->countAllResults(),
            'vulnerabilities' => $model->where('vulnerability_status', 'Vulnerable')->countAllResults()
        ];
        
        return view('assets/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add New Asset';
        return view('assets/create', $data);
    }

    public function store()
    {
        $model = new AssetModel();
        
        $data = [
            'asset_name' => $this->request->getPost('asset_name'),
            'asset_type' => $this->request->getPost('asset_type'),
            'ip_address' => $this->request->getPost('ip_address'),
            'mac_address' => $this->request->getPost('mac_address'),
            'operating_system' => $this->request->getPost('operating_system'),
            'status' => $this->request->getPost('status'),
            'criticality' => $this->request->getPost('criticality'),
            'location' => $this->request->getPost('location'),
            'owner' => $this->request->getPost('owner'),
            'vulnerability_status' => 'Unknown'
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/asset-management')->with('success', 'Asset added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add asset');
        }
    }

    public function show($id)
    {
        $model = new AssetModel();
        $asset = $model->find($id);
        
        if (!$asset) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Asset not found');
        }
        
        $data['title'] = 'Asset Details';
        $data['asset'] = $asset;
        
        return view('assets/show', $data);
    }

    public function edit($id)
    {
        $model = new AssetModel();
        $asset = $model->find($id);
        
        if (!$asset) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Asset not found');
        }
        
        $data['title'] = 'Edit Asset';
        $data['asset'] = $asset;
        
        return view('assets/edit', $data);
    }

    // Updated to match the new route: /asset-management/(:num) with POST method and _method=PUT
    public function update($id)
    {
        $model = new AssetModel();
        
        $data = [
            'asset_name' => $this->request->getPost('asset_name'),
            'asset_type' => $this->request->getPost('asset_type'),
            'ip_address' => $this->request->getPost('ip_address'),
            'mac_address' => $this->request->getPost('mac_address'),
            'operating_system' => $this->request->getPost('operating_system'),
            'status' => $this->request->getPost('status'),
            'criticality' => $this->request->getPost('criticality'),
            'location' => $this->request->getPost('location'),
            'owner' => $this->request->getPost('owner')
        ];
        
        if ($model->update($id, $data)) {
            return redirect()->to('/asset-management')->with('success', 'Asset updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update asset');
        }
    }

    // Updated to match the new route: /asset-management/delete/(:num) with GET method
    public function delete($id)
    {
        $model = new AssetModel();
        $model->delete($id);
        return redirect()->to('/asset-management')->with('success', 'Asset deleted successfully');
    }
}