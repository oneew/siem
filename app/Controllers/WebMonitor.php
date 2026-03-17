<?php

namespace App\Controllers;

class WebMonitor extends BaseController
{
    public function index()
    {
        $model = new \App\Models\MonitoredWebsiteModel();
        
        $data = [
            'title' => 'Monitoring Website',
            'websites' => $model->orderBy('created_at', 'DESC')->findAll(),
        ];
        
        // Calculate statistics
        $data['stats'] = [
            'total' => count($data['websites']),
            'aman' => 0,
            'terindikasi' => 0,
            'tidak_bisa_diakses' => 0,
            'belum_diperiksa' => 0
        ];
        
        foreach ($data['websites'] as $site) {
            $data['stats'][$site['status']]++;
        }
        
        return view('web_monitor/index', $data);
    }

    public function store()
    {
        $model = new \App\Models\MonitoredWebsiteModel();
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'url'  => 'required|valid_url|is_unique[monitored_websites.url]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $url = $this->request->getPost('url');
        // Ensure URL has http:// or https://
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        $model->save([
            'name' => $this->request->getPost('name'),
            'url'  => $url,
            'status' => 'belum_diperiksa'
        ]);

        return redirect()->to('/web-monitor')->with('success', 'Website berhasil ditambahkan untuk dimonitor.');
    }

    public function delete($id)
    {
        $model = new \App\Models\MonitoredWebsiteModel();
        $model->delete($id);
        
        return redirect()->to('/web-monitor')->with('success', 'Website dihapus dari daftar monitoring.');
    }

    public function check($id = null)
    {
        $model = new \App\Models\MonitoredWebsiteModel();
        
        if ($id) {
            $websites = [$model->find($id)];
        } else {
            $websites = $model->findAll();
        }

        $keywords = ['judol', 'slot', 'gacor', 'porn', 'togel', 'viagra', 'hacked by', 'pwned', 'defaced', 'casino', 'judi', 'bokep', 'situs terlarang', 'taruhan', 'betting', 'maxwin', 'zeus', 'rtp'];
        $checkedCount = 0;

        foreach ($websites as $site) {
            if (!$site) continue;

            $startTime = microtime(true);
            $ch = curl_init($site['url']);
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6); // 6 seconds timeout to prevent long loading
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'SIEM Web Monitor/1.0');
            
            $content = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            $endTime = microtime(true);
            $responseTime = round(($endTime - $startTime) * 1000); // in milliseconds

            $status = 'aman';
            $foundKeywords = [];

            if ($content === false || $httpCode >= 400 || $httpCode == 0) {
                $status = 'tidak_bisa_diakses';
            } else {
                // Check for keywords
                $lowerContent = strtolower($content);
                foreach ($keywords as $keyword) {
                    if (strpos($lowerContent, strtolower($keyword)) !== false) {
                        $foundKeywords[] = $keyword;
                    }
                }

                if (!empty($foundKeywords)) {
                    $status = 'terindikasi';
                }
            }

            // Update database
            $model->update($site['id'], [
                'status' => $status,
                'last_checked' => date('Y-m-d H:i:s'),
                'response_time' => $responseTime,
                'indicators_found' => empty($foundKeywords) ? null : json_encode($foundKeywords)
            ]);
            
            // Generate alert if defaced or down (mock logic)
            if ($status === 'terindikasi' || $status === 'tidak_bisa_diakses') {
                $alertModel = new \App\Models\AlertModel();
                $alertTitle = $status === 'terindikasi' ? 'Indikasi Defacement: ' . $site['name'] : 'Website Down: ' . $site['name'];
                
                try {
                    $alertModel->save([
                        'title' => $alertTitle,
                        'description' => "Monitor mendeteksi status '$status' pada URL: " . $site['url'],
                        'priority' => $status === 'terindikasi' ? 'Critical' : 'High',
                        'type' => 'Web Defacement',
                        'status' => 'Active',
                        'assigned_to' => null
                    ]);
                } catch (\Exception $e) {
                    // Ignore if alert table doesn't exist or similar error during dev
                }
            }

            $checkedCount++;
        }

        if ($id) {
            return redirect()->back()->with('success', 'Website berhasil diperiksa.');
        } else {
            return redirect()->to('/web-monitor')->with('success', "$checkedCount website berhasil diperiksa.");
        }
    }
}
