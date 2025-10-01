<?php

namespace Config;

$routes = Services::routes();

// Default
$routes->get('/', 'Home::index');
// $routes->get('/demo-info', 'Home::demoInfo');

// =====================
// Test Comment
// =====================
$routes->get('/test-comment', 'TestComment::insertTestComment');

// =====================
// Dashboard
// =====================
$routes->get('/dashboard', 'Dashboard::index');

// =====================
// Incidents (CRUD)
// =====================
$routes->get('/incidents', 'Incidents::index');
$routes->get('/incidents/create', 'Incidents::create');
$routes->post('/incidents/store', 'Incidents::store');
$routes->get('/incidents/show/(:num)', 'Incidents::show/$1');
$routes->get('/incidents/edit/(:num)', 'Incidents::edit/$1');
$routes->post('/incidents/update/(:num)', 'Incidents::update/$1');  // Changed from PUT to POST to match form method
$routes->post('/incidents/delete/(:num)', 'Incidents::delete/$1');  // Changed from GET to POST to match form method
$routes->post('/incidents/add-comment', 'Incidents::addComment');

// =====================
// Reports
// =====================
$routes->get('/reports', 'Reports::index');
$routes->get('/reports/generate', 'Reports::index'); // Added route for report generation
$routes->get('/reports/incidentsExcel', 'Reports::incidentsExcel');
$routes->get('/reports/incidentsPdf', 'Reports::incidentsPdf');
$routes->get('/reports/incidentsReport', 'Reports::incidentsReport');
$routes->get('/reports/threatsReport', 'Reports::threatsReport');
$routes->get('/reports/executiveDashboard', 'Reports::executiveDashboard');

// =====================
// Threat Intelligence
// =====================
$routes->get('/threats', 'Threats::index');
$routes->get('/threats/create', 'Threats::create');
$routes->post('/threats/store', 'Threats::store');
$routes->get('/threats/show/(:num)', 'Threats::show/$1');
$routes->get('/threats/edit/(:num)', 'Threats::edit/$1');
$routes->post('/threats/(:num)', 'Threats::update/$1');  // Fixed: Changed from /threats/update/(:num) to /threats/(:num) to match form action
$routes->get('/threats/delete/(:num)', 'Threats::delete/$1');  // Changed from POST to GET to match link usage

$routes->get('/threats/search', 'Threats::search');

// =====================
// Security Alerts
// =====================
$routes->get('/alerts', 'Alerts::index');
$routes->get('/alerts/create', 'Alerts::create');
$routes->post('/alerts/store', 'Alerts::store');
$routes->get('/alerts/show/(:num)', 'Alerts::show/$1');
$routes->get('/alerts/edit/(:num)', 'Alerts::edit/$1');
$routes->post('/alerts/(:num)', 'Alerts::update/$1');  // Fixed: Changed from /alerts/update/(:num) to /alerts/(:num) to match form action
$routes->get('/alerts/acknowledge/(:num)', 'Alerts::acknowledge/$1');
$routes->get('/alerts/close/(:num)', 'Alerts::close/$1');
$routes->get('/alerts/escalate/(:num)', 'Alerts::escalate/$1');
$routes->get('/alerts/create-incident/(:num)', 'Alerts::createIncident/$1');
$routes->get('/alerts/delete/(:num)', 'Alerts::delete/$1');  // Changed from POST to GET to match link usage

$routes->get('/alerts/clear-all', 'Alerts::clearAll');

// =====================
// Asset Management
// =====================
$routes->get('/asset-management', 'Assets::index');
$routes->get('/asset-management/create', 'Assets::create');
$routes->post('/asset-management/store', 'Assets::store');
$routes->get('/asset-management/show/(:num)', 'Assets::show/$1');
$routes->get('/asset-management/(:num)', 'Assets::show/$1');  // Added route for showing asset details without "show"
$routes->get('/asset-management/edit/(:num)', 'Assets::edit/$1');
$routes->get('/asset-management/(:num)/edit', 'Assets::edit/$1');  // Added route for editing asset details with ID first
$routes->post('/asset-management/(:num)', 'Assets::update/$1');  // Fixed: Changed from /asset-management/update/(:num) to /asset-management/(:num) to match form action
$routes->get('/asset-management/delete/(:num)', 'Assets::delete/$1');  // Changed from POST to GET to match link usage
// =====================
// Digital Forensics
// =====================
$routes->get('/forensics', 'Forensics::index');
$routes->get('/forensics/create', 'Forensics::create');
$routes->get('/forensics/edit/(:num)', 'Forensics::edit/$1');
$routes->post('/forensics/store', 'Forensics::store');
$routes->get('/forensics/show/(:num)', 'Forensics::show/$1');
$routes->post('/forensics/(:num)', 'Forensics::update/$1');  // Added route for updating forensics cases
$routes->get('/forensics/add-evidence/(:num)', 'Forensics::addEvidence/$1');  // Added route for adding evidence
$routes->post('/forensics/evidence/(:num)', 'Forensics::storeEvidence/$1');  // Added route for storing evidence
$routes->get('/forensics/report/(:num)', 'Forensics::generateReport/$1');  // Added route for generating reports
$routes->get('/forensics/close/(:num)', 'Forensics::closeCase/$1');  // Added route for closing cases
$routes->get('/forensics/download/(:num)', 'Forensics::download/$1');
$routes->get('/forensics/delete/(:num)', 'Forensics::delete/$1');  // Already correct

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
$routes->post('/playbooks/(:num)', 'Playbooks::update/$1');  // Fixed: Changed from /playbooks/update/(:num) to /playbooks/(:num) to match form action
$routes->get('/playbooks/delete/(:num)', 'Playbooks::delete/$1');  // Changed from POST to GET to match link usage
$routes->get('/playbooks/execute/(:num)', 'Playbooks::execute/$1');
$routes->get('/playbooks/(:num)/execute', 'Playbooks::execute/$1');
$routes->post('/playbooks/execute/(:num)', 'Playbooks::execute/$1');

// =====================
// Users (CRUD)
// =====================
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/show/(:num)', 'Users::show/$1');
$routes->get('/users/(:num)', 'Users::show/$1');  // Added route for showing user details
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->get('/users/(:num)/edit', 'Users::edit/$1');  // Added route for editing users with ID first
$routes->post('/users/(:num)', 'Users::update/$1');  // Fixed: Changed from /users/update/(:num) to /users/(:num) to match form action
$routes->get('/users/delete/(:num)', 'Users::delete/$1');  // Changed from POST to GET to match link usage
$routes->get('/users/reset/(:num)', 'Users::resetPassword/$1');
$routes->post('/users/profile-picture/(:num)', 'Users::uploadProfilePicture/$1');

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

// Profile Management
$routes->get('/profile', 'Auth::profile', ['filter' => 'auth']);
$routes->post('/profile/update', 'Auth::updateProfile', ['filter' => 'auth']);
$routes->post('/profile/change-password', 'Auth::changePassword', ['filter' => 'auth']);

// Protected routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/incidents', 'Incidents::index');
    $routes->get('/reports', 'Reports::index');
    $routes->get('/reports/generate', 'Reports::index'); // Added protected route for report generation
    $routes->get('/reports/incidentsReport', 'Reports::incidentsReport');
    $routes->get('/reports/threatsReport', 'Reports::threatsReport');
    $routes->get('/reports/executiveDashboard', 'Reports::executiveDashboard');
    $routes->get('/asset-management', 'Assets::index');
    $routes->get('/alerts', 'Alerts::index');
    $routes->get('/threats', 'Threats::index');
    $routes->get('/forensics', 'Forensics::index');
    $routes->get('/playbooks', 'Playbooks::index');
    $routes->get('/test-templating', 'TestTemplating::index');
    $routes->get('/css-test', 'CssTest::index');

    // Only admin
    $routes->group('', ['filter' => 'auth:Admin'], function ($routes) {
        $routes->get('/settings', 'Settings::index');
    });
});
