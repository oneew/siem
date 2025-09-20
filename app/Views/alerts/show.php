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
                <a href="/alerts/edit/<?= $alert['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
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
                        <a href="/alerts/acknowledge/<?= $alert['id'] ?>" 
                           class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center <?= $alert['acknowledged'] ? 'opacity-50 cursor-not-allowed' : '' ?>"
                           <?= $alert['acknowledged'] ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                            <i class="fas fa-check text-xl mb-2"></i>
                            <span class="text-sm font-medium"><?= $alert['acknowledged'] ? 'Acknowledged' : 'Acknowledge' ?></span>
                        </a>
                        
                        <a href="/alerts/escalate/<?= $alert['id'] ?>" 
                           onclick="return confirm('Escalate this alert to higher priority?')"
                           class="bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-arrow-up text-xl mb-2"></i>
                            <span class="text-sm font-medium">Escalate</span>
                        </a>

                        <a href="/alerts/create-incident/<?= $alert['id'] ?>" 
                           onclick="return confirm('Create a new security incident based on this alert?')"
                           class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-exclamation-triangle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Create Incident</span>
                        </a>

                        <a href="/alerts/close/<?= $alert['id'] ?>" 
                           onclick="return confirm('Are you sure you want to close this alert?')"
                           class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-times-circle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Close Alert</span>
                        </a>
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
                                    <a href="https://ipinfo.io/<?= esc($alert['source_ip']) ?>" target="_blank"
                                       class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-green-900">Similar Alerts</div>
                                        <div class="text-sm text-green-800">
                                            <?php
                                            // Count similar alerts in the last 24 hours
                                            $model = new \App\Models\AlertModel();
                                            $similarCount = $model->where('alert_type', $alert['alert_type'])
                                                ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))
                                                ->countAllResults();
                                            ?>
                                            <?= $similarCount ?> similar alerts in last 24h
                                        </div>
                                    </div>
                                    <a href="/alerts?filter_type=<?= urlencode($alert['alert_type']) ?>" 
                                       class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="p-4 bg-purple-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-purple-900">Threat Intelligence</div>
                                        <div class="text-sm text-purple-800">Check threat database</div>
                                    </div>
                                    <a href="/threats?search=<?= urlencode($alert['source_ip'] ?? '') ?>" 
                                       class="text-purple-600 hover:text-purple-800">
                                        <i class="fas fa-shield-alt"></i>
                                    </a>
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
function escalateAlert() {
    showInfoAlert('Alert Escalation', 'Alert escalation functionality would be implemented here.\nIn a production environment, this would update the alert priority and notify the appropriate team.');
}

function createIncident() {
    showInfoAlert('Create Incident', 'Incident creation functionality would be implemented here.\nIn a production environment, this would create a new incident record linked to this alert.');
}

// Auto-refresh alert status
setInterval(function() {
    console.log('Alert status refresh check');
    // In a real implementation, this would check for updates
}, 30000);
</script>

<?= $this->endSection() ?>