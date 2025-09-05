<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-bell text-orange-600 mr-3"></i>
                    Security Alert Details
                </h1>
                <p class="text-gray-600 mt-1">Comprehensive alert information and response actions</p>
            </div>
            <div class="flex space-x-3">
                <a href="/alerts/<?= $alert['id'] ?>/edit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Alert
                </a>
                <a href="/alerts" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Alerts
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Alert Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r 
                    <?php 
                    switch($alert['priority']) {
                        case 'Critical': echo 'from-red-600 to-red-700'; break;
                        case 'High': echo 'from-orange-600 to-orange-700'; break;
                        case 'Medium': echo 'from-yellow-600 to-yellow-700'; break;
                        case 'Low': echo 'from-blue-600 to-blue-700'; break;
                        default: echo 'from-gray-600 to-gray-700'; break;
                    }
                    ?> text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold"><?= esc($alert['alert_name']) ?></h2>
                            <p class="text-white text-opacity-90 mt-1"><?= esc($alert['alert_type']) ?> Alert</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full
                                <?php 
                                switch($alert['status']) {
                                    case 'Active': echo 'bg-red-500 text-white'; break;
                                    case 'Investigating': echo 'bg-yellow-500 text-white'; break;
                                    case 'Closed': echo 'bg-green-500 text-white'; break;
                                    case 'False Positive': echo 'bg-gray-500 text-white'; break;
                                    default: echo 'bg-gray-500 text-white'; break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                <?= esc($alert['status']) ?>
                            </span>
                            <div class="text-sm text-white text-opacity-80 mt-2">
                                Alert #<?= $alert['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Alert Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                            Alert Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Alert Type:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($alert['alert_type']) {
                                        case 'Authentication': echo 'bg-blue-100 text-blue-800'; break;
                                        case 'Network': echo 'bg-green-100 text-green-800'; break;
                                        case 'Malware': echo 'bg-red-100 text-red-800'; break;
                                        case 'Data Breach': echo 'bg-purple-100 text-purple-800'; break;
                                        case 'Intrusion': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'System': echo 'bg-gray-100 text-gray-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($alert['alert_type']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Priority:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($alert['priority']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($alert['priority']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Source IP:</span>
                                <span class="font-mono text-gray-900"><?= esc($alert['source_ip']) ?: 'N/A' ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Detection Rule:</span>
                                <span class="text-gray-900"><?= esc($alert['rule_name']) ?: 'Manual Alert' ?></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="font-medium text-gray-600">Acknowledged:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full <?= $alert['acknowledged'] ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                    <i class="fas <?= $alert['acknowledged'] ? 'fa-check' : 'fa-clock' ?> text-xs mr-1"></i>
                                    <?= $alert['acknowledged'] ? 'Acknowledged' : 'Pending' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clock mr-2 text-gray-600"></i>
                            Timeline & Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Alert Created -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Alert Created</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($alert['created_at']) ? 
                                            date('M j, Y \a\t H:i', strtotime($alert['created_at'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-purple-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($alert['updated_at']) ? 
                                            date('M j, Y \a\t H:i', strtotime($alert['updated_at'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Resolution Status -->
                            <?php if (isset($alert['resolved_at']) && $alert['resolved_at']): ?>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Resolved</p>
                                    <p class="text-xs text-gray-500">
                                        <?= date('M j, Y \a\t H:i', strtotime($alert['resolved_at'])) ?>
                                    </p>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation text-orange-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Status: Active</p>
                                    <p class="text-xs text-gray-500">
                                        <?php
                                        $createdTime = strtotime($alert['created_at']);
                                        $now = time();
                                        $diff = $now - $createdTime;
                                        
                                        if ($diff < 3600) {
                                            echo floor($diff / 60) . ' minutes ago';
                                        } elseif ($diff < 86400) {
                                            echo floor($diff / 3600) . ' hours ago';
                                        } else {
                                            echo floor($diff / 86400) . ' days ago';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Description -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                        Alert Description
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed"><?= nl2br(esc($alert['description'])) ?></p>
                </div>
            </div>

            <!-- Response Actions -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-gray-600"></i>
                        Response Actions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button onclick="acknowledgeAlert()" 
                                class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center"
                                <?= $alert['acknowledged'] ? 'disabled' : '' ?>>
                            <i class="fas fa-check text-xl mb-2"></i>
                            <span class="text-sm font-medium"><?= $alert['acknowledged'] ? 'Acknowledged' : 'Acknowledge' ?></span>
                        </button>
                        
                        <button onclick="escalateAlert()" 
                                class="bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-arrow-up text-xl mb-2"></i>
                            <span class="text-sm font-medium">Escalate</span>
                        </button>
                        
                        <button onclick="createIncident()" 
                                class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-exclamation-triangle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Create Incident</span>
                        </button>
                        
                        <button onclick="closeAlert()" 
                                class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-times-circle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Close Alert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Related Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-link mr-2 text-gray-600"></i>
                            Related Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <?php if ($alert['source_ip']): ?>
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-blue-900">IP Geolocation</div>
                                        <div class="text-sm text-blue-800"><?= esc($alert['source_ip']) ?></div>
                                    </div>
                                    <button onclick="lookupIP('<?= esc($alert['source_ip']) ?>')" 
                                            class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-green-900">Similar Alerts</div>
                                        <div class="text-sm text-green-800">3 similar alerts in last 24h</div>
                                    </div>
                                    <button onclick="viewSimilarAlerts()" 
                                            class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="p-4 bg-purple-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-purple-900">Threat Intelligence</div>
                                        <div class="text-sm text-purple-800">Check IOC databases</div>
                                    </div>
                                    <button onclick="checkThreatIntel()" 
                                            class="text-purple-600 hover:text-purple-800">
                                        <i class="fas fa-shield-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Actions -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                            Recommended Actions
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <?php
                            // Generate recommendations based on alert type
                            $recommendations = [];
                            switch($alert['alert_type']) {
                                case 'Authentication':
                                    $recommendations = [
                                        'Review user authentication logs',
                                        'Check for password policy violations',
                                        'Verify user identity and location',
                                        'Consider implementing MFA'
                                    ];
                                    break;
                                case 'Network':
                                    $recommendations = [
                                        'Analyze network traffic patterns',
                                        'Check firewall rules and logs',
                                        'Implement network segmentation',
                                        'Monitor for data exfiltration'
                                    ];
                                    break;
                                case 'Malware':
                                    $recommendations = [
                                        'Isolate affected systems immediately',
                                        'Run full antivirus scan',
                                        'Check file integrity',
                                        'Update security signatures'
                                    ];
                                    break;
                                default:
                                    $recommendations = [
                                        'Investigate alert details thoroughly',
                                        'Document findings and actions taken',
                                        'Monitor for related activities',
                                        'Update security policies if needed'
                                    ];
                                    break;
                            }
                            ?>
                            
                            <?php foreach($recommendations as $index => $recommendation): ?>
                            <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                        <?= $index + 1 ?>
                                    </span>
                                </div>
                                <div class="text-sm text-gray-900"><?= $recommendation ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Alert management functions
function acknowledgeAlert() {
    if (confirm('Acknowledge this security alert?')) {
        alert('Alert acknowledged successfully (Demo Mode)');
        // In production: send AJAX request to update alert
        document.querySelector('[onclick="acknowledgeAlert()"]').disabled = true;
        document.querySelector('[onclick="acknowledgeAlert()"] span').textContent = 'Acknowledged';
    }
}

function escalateAlert() {
    if (confirm('Escalate this alert to higher priority and notify management?')) {
        alert('Alert escalated successfully (Demo Mode)\nNotifications sent to security team leads.');
    }
}

function createIncident() {
    if (confirm('Create a new security incident based on this alert?')) {
        alert('Security incident created successfully (Demo Mode)\nIncident ID: INC-2024-' + Math.floor(Math.random() * 1000));
    }
}

function closeAlert() {
    if (confirm('Mark this alert as resolved and close it?')) {
        alert('Alert closed successfully (Demo Mode)');
        window.location.href = '/alerts';
    }
}

function lookupIP(ip) {
    alert(`IP Geolocation lookup for ${ip} (Demo Mode)\n\nLocation: Unknown\nISP: Demo ISP\nThreat Level: Medium`);
}

function viewSimilarAlerts() {
    alert('Displaying similar alerts (Demo Mode)\n\n3 similar authentication alerts found in the last 24 hours.');
}

function checkThreatIntel() {
    alert('Threat Intelligence Check (Demo Mode)\n\nChecking IOC databases...\nNo matches found in threat intelligence feeds.');
}

// Auto-refresh alert status
setInterval(function() {
    console.log('Alert status refresh triggered');
}, 30000);
</script>

<?= $this->endSection() ?>