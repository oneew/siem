<?php

namespace App\Controllers;

use App\Models\WebsiteMonitorModel;

class WebsiteMonitorController extends BaseController
{
    protected $monitorModel;

    public function __construct()
    {
        $this->monitorModel = new WebsiteMonitorModel();
    }

    public function index()
    {
        $data['title'] = 'Website Monitoring & Defacement Detection';
        $data['websites'] = $this->monitorModel->orderBy('updated_at', 'DESC')->findAll();
        
        return view('monitoring/website/index', $data);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $name = $this->request->getPost('name');
            $url = $this->request->getPost('url');

            // Quick initial curl to get hash
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $html = curl_exec($ch);
            curl_close($ch);

            $expected_hash = md5($html);
            $status = ($html) ? 'Online' : 'Offline';

            $data = [
                'name' => $name,
                'url' => $url,
                'expected_hash' => $expected_hash,
                'last_status' => $status,
                'last_checked' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ];

            if ($this->monitorModel->insert($data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Website successfully added to monitoring.']);
            }
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add website.']);
        }
    }

    public function check_all()
    {
        if ($this->request->isAJAX()) {
            $websites = $this->monitorModel->where('is_active', 1)->findAll();
            $results = [];

            foreach ($websites as $web) {
                $ch = curl_init($web['url']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                $html = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                $status = 'Offline';
                $isDefaced = false;

                if ($httpCode >= 200 && $httpCode < 400 && $html) {
                    $status = 'Online';
                    $current_hash = md5($html);
                    if ($current_hash !== $web['expected_hash']) {
                        $status = 'Defaced / Modified';
                        $isDefaced = true;
                    }
                }

                $this->monitorModel->update($web['id'], [
                    'last_status' => $status,
                    'last_checked' => date('Y-m-d H:i:s')
                ]);

                $results[] = [
                    'id' => $web['id'],
                    'status' => $status,
                    'isDefaced' => $isDefaced
                ];
            }

            return $this->response->setJSON(['status' => 'success', 'data' => $results]);
        }
    }

    public function delete($id)
    {
        if ($this->request->isAJAX()) {
            if ($this->monitorModel->delete($id)) {
                return $this->response->setJSON(['status' => 'success']);
            }
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}
