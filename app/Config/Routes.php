<?php

namespace Config;

$routes = Services::routes();

// Default
$routes->get('/', 'Home::index');
// $routes->get('/demo-info', 'Home::demoInfo');

// =====================
// Dashboard
// =====================
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/stream', 'Dashboard::stream');
$routes->get('/dashboard/switch-role', 'Dashboard::switchRole');

// =====================
// Incidents (CRUD)
// =====================
$routes->get('/incidents', 'Incidents::index');
$routes->get('/incidents/create', 'Incidents::create');
$routes->post('/incidents/store', 'Incidents::store');
$routes->get('/incidents/show/(:num)', 'Incidents::show/$1');
$routes->get('/incidents/edit/(:num)', 'Incidents::edit/$1');
$routes->post('/incidents/update/(:num)', 'Incidents::update/$1');
$routes->post('/incidents/delete/(:num)', 'Incidents::delete/$1');

// =====================
// Reports
// =====================
$routes->get('/reports', 'Reports::index');
$routes->get('/reports/incidentsExcel', 'Reports::incidentsExcel');
// kalau mau nanti ditambah PDF
$routes->get('/reports/incidentsPdf', 'Reports::incidentsPdf');

// =====================
// New Menus
// =====================
$routes->get('/logs', 'Logs::index');
$routes->get('/analytics', 'Analytics::index');
$routes->get('/compliance', 'Compliance::index');
$routes->get('/integrations', 'Integrations::index');
$routes->get('/certificates', 'Certificates::index');
$routes->get('/signatures', 'Signatures::index');
$routes->get('/jamming', 'Jamming::index');
$routes->get('/pentest', 'Pentest::index');
$routes->get('/master-data', 'MasterData::index');
$routes->get('/web-monitor', 'WebMonitor::index');
$routes->post('/web-monitor/store', 'WebMonitor::store');
$routes->post('/web-monitor/delete/(:num)', 'WebMonitor::delete/$1');
$routes->get('/web-monitor/check', 'WebMonitor::check');
$routes->get('/web-monitor/check/(:num)', 'WebMonitor::check/$1');
$routes->get('/reports/incidentsExcel', 'Reports::incidentsExcel');
// kalau mau nanti ditambah PDF
$routes->get('/reports/incidentsPdf', 'Reports::incidentsPdf');

// =====================
// Threat Intelligence
// =====================
$routes->get('/threats', 'Threats::index');
$routes->get('/threats/create', 'Threats::create');
$routes->post('/threats/store', 'Threats::store');
$routes->get('/threats/show/(:num)', 'Threats::show/$1');
$routes->get('/threats/edit/(:num)', 'Threats::edit/$1');
$routes->post('/threats/update/(:num)', 'Threats::update/$1');
$routes->post('/threats/delete/(:num)', 'Threats::delete/$1');
$routes->get('/threats/search', 'Threats::search');

// =====================
// Security Alerts
// =====================
$routes->get('/alerts', 'Alerts::index');
$routes->get('/alerts/create', 'Alerts::create');
$routes->post('/alerts/store', 'Alerts::store');
$routes->get('/alerts/show/(:num)', 'Alerts::show/$1');
$routes->get('/alerts/acknowledge/(:num)', 'Alerts::acknowledge/$1');
$routes->get('/alerts/close/(:num)', 'Alerts::close/$1');
$routes->post('/alerts/delete/(:num)', 'Alerts::delete/$1');

// =====================
// Asset Management
// =====================
$routes->get('/asset-management', 'Assets::index');
$routes->get('/asset-management/create', 'Assets::create');
$routes->post('/asset-management/store', 'Assets::store');
$routes->get('/asset-management/show/(:num)', 'Assets::show/$1');
$routes->get('/asset-management/edit/(:num)', 'Assets::edit/$1');
$routes->post('/asset-management/update/(:num)', 'Assets::update/$1');
$routes->post('/asset-management/delete/(:num)', 'Assets::delete/$1');

// =====================
// Digital Forensics
// =====================
$routes->get('/forensics', 'Forensics::index');
$routes->get('/forensics/create', 'Forensics::create');
$routes->post('/forensics/store', 'Forensics::store');
$routes->get('/forensics/show/(:num)', 'Forensics::show/$1');
$routes->get('/forensics/download/(:num)', 'Forensics::download/$1');
$routes->post('/forensics/delete/(:num)', 'Forensics::delete/$1');

// =====================
// Incident Playbooks
// =====================
$routes->get('/playbooks', 'Playbooks::index');
$routes->get('/playbooks/create', 'Playbooks::create');
$routes->post('/playbooks/store', 'Playbooks::store');
$routes->get('/playbooks/show/(:num)', 'Playbooks::show/$1');
$routes->get('/playbooks/(:num)', 'Playbooks::show/$1');
$routes->get('/playbooks/edit/(:num)', 'Playbooks::edit/$1');
$routes->get('/playbooks/(:num)/edit', 'Playbooks::edit/$1');
$routes->post('/playbooks/update/(:num)', 'Playbooks::update/$1');
$routes->post('/playbooks/delete/(:num)', 'Playbooks::delete/$1');
$routes->get('/playbooks/execute/(:num)', 'Playbooks::execute/$1');
$routes->get('/playbooks/(:num)/execute', 'Playbooks::execute/$1');
$routes->post('/playbooks/execute/(:num)', 'Playbooks::execute/$1');

// =====================
// Users (CRUD)
// =====================
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->post('/users/delete/(:num)', 'Users::delete/$1');

// =====================
// Settings
// =====================
$routes->get('/settings', 'Settings::index');
$routes->post('/settings/update', 'Settings::update');

// =====================
// Template Test
// =====================
$routes->get('/test-templating', 'TestTemplating::index');

// =====================
// CSS Test
// =====================
$routes->get('/css-test', 'CssTest::index');

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login/attempt', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

// AI Assistant
$routes->post('/ai-assistant/chat', 'AiAssistant::chat');

// Protected routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/incidents', 'Incidents::index');
    $routes->get('/reports', 'Reports::index');
    $routes->get('/asset-management', 'Assets::index');
    $routes->get('/alerts', 'Alerts::index');
    $routes->get('/threats', 'Threats::index');
    
    // New Menus
    $routes->get('/logs', 'Logs::index');
    $routes->get('/analytics', 'Analytics::index');
    $routes->get('/compliance', 'Compliance::index');
    $routes->get('/integrations', 'Integrations::index');
    $routes->get('/certificates', 'Certificates::index');
    $routes->get('/signatures', 'Signatures::index');
    $routes->get('/jamming', 'Jamming::index');
    $routes->get('/pentest', 'Pentest::index');
    $routes->get('/master-data', 'MasterData::index');
    $routes->get('/web-monitor', 'WebMonitor::index');
    $routes->get('/forensics', 'Forensics::index');
    $routes->get('/playbooks', 'Playbooks::index');
    $routes->get('/test-templating', 'TestTemplating::index');
    $routes->get('/css-test', 'CssTest::index');

    // TAHAP 3: Boilerplate Modules
    // Incident Management (Blue Team)
    $routes->get('/incidents-v2', 'IncidentController::index');
    $routes->get('/incidents-v2/create', 'IncidentController::create');
    $routes->post('/incidents-v2/store', 'IncidentController::store');
    $routes->get('/incidents-v2/view/(:num)', 'IncidentController::view_case/$1');
    $routes->get('/incidents-v2/close/(:num)', 'IncidentController::close_case/$1');

    // Red Team Playbooks
    $routes->get('/playbooks-v2', 'PlaybookController::index');
    $routes->get('/playbooks-v2/create', 'PlaybookController::create');
    $routes->post('/playbooks-v2/store', 'PlaybookController::store');
    $routes->post('/playbooks-v2/update/(:num)', 'PlaybookController::update/$1');
    $routes->post('/playbooks-v2/delete/(:num)', 'PlaybookController::delete/$1');

    // Red Team - Target Management
    $routes->get('/targets', 'TargetController::index');
    $routes->get('/targets/get_all', 'TargetController::get_all');
    $routes->get('/targets/get/(:num)', 'TargetController::get_target/$1');
    $routes->post('/targets/store', 'TargetController::store');
    $routes->post('/targets/update', 'TargetController::update');
    $routes->post('/targets/delete/(:num)', 'TargetController::delete/$1');

    // Red Team - Vulnerabilities & Findings
    $routes->get('/vulnerabilities', 'VulnerabilityController::index');
    $routes->get('/vulnerabilities/get_all', 'VulnerabilityController::get_all');
    $routes->get('/vulnerabilities/get/(:num)', 'VulnerabilityController::get_vuln/$1');
    $routes->post('/vulnerabilities/store', 'VulnerabilityController::store');
    $routes->post('/vulnerabilities/update', 'VulnerabilityController::update');
    $routes->post('/vulnerabilities/delete/(:num)', 'VulnerabilityController::delete/$1');

    // Red Team - Pentest Reports
    $routes->get('/pentest-reports', 'PentestReportController::index');
    $routes->get('/pentest-reports/generate/(:num)', 'PentestReportController::generate_pdf/$1');

    // DFIR (Forensics) - Malware Analyzer & Evidence Locker
    $routes->get('/dfir/analyzer', 'MalwareAnalyzerController::index');
    $routes->post('/dfir/analyze-malware', 'MalwareAnalyzerController::analyze');

    $routes->get('/evidence-locker', 'EvidenceController::index');
    $routes->get('/dfir/evidence', 'EvidenceController::index'); // Alias for sidebar
    $routes->get('/evidence-locker/get_all', 'EvidenceController::get_all');
    $routes->get('/evidence-locker/get/(:num)', 'EvidenceController::get_evidence/$1');
    $routes->post('/evidence-locker/store', 'EvidenceController::store');
    $routes->post('/evidence-locker/update', 'EvidenceController::update');
    $routes->post('/evidence-locker/delete/(:num)', 'EvidenceController::delete/$1');

    // Persandian & Kriptografi
    $routes->get('/crypto/hash-verifier', 'CryptoController::hash_verifier');

    $routes->get('/certificate', 'CertificateController::index');
    $routes->post('/certificate/sign', 'CertificateController::sign');
    $routes->post('/certificate/verify', 'CertificateController::verify');

    $routes->get('/steganography', 'SteganographyController::index');
    $routes->get('/crypto/stegano', 'SteganographyController::index'); // Alias for sidebar
    $routes->post('/steganography/analyze', 'SteganographyController::analyze');

    // AI Nexus
    $routes->post('upload', 'MalwareAnalyzerController::upload');
    $routes->get('/ainexus/log-analyzer', 'LogAnalyzerController::index');
    $routes->get('/ai/log-analyzer', 'LogAnalyzerController::index'); // Alias for sidebar
    $routes->post('/ainexus/log-analyzer/analyze', 'LogAnalyzerController::analyze');
    
    $routes->get('/ainexus/remediation', 'RemediationController::index');
    $routes->get('/ai/remediation', 'RemediationController::index'); // Alias for sidebar
    $routes->post('/ainexus/remediation/apply', 'RemediationController::applyAction');

    // Monitoring & Enterprise
    $routes->get('/website-monitor', 'WebsiteMonitorController::index');
    $routes->post('/website-monitor/store', 'WebsiteMonitorController::store');
    $routes->post('/website-monitor/check-all', 'WebsiteMonitorController::check_all');
    $routes->post('/website-monitor/delete/(:num)', 'WebsiteMonitorController::delete/$1');

    $routes->get('/osint', 'OSINTController::index');
    $routes->post('/osint/lookup', 'OSINTController::lookup');

    $routes->get('/assets', 'AssetController::index');
    $routes->post('/assets/scan', 'AssetController::scan');



    // Only admin
    $routes->group('', ['filter' => 'auth:Admin'], function($routes) {
        $routes->get('/users', 'Users::index');
        $routes->get('/settings', 'Settings::index');
    });
});
$routes->get('/change-password', 'Auth::changePassword', ['filter' => 'auth']);
$routes->post('/change-password/update', 'Auth::updatePassword', ['filter' => 'auth']);
$routes->get('/users/reset/(:num)', 'Users::resetPassword/$1');