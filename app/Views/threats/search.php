<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-search text-red-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Search and analyze threat intelligence database</p>
            </div>
            <div class="flex space-x-3">
                <a href="/threats/create" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Add New IOC
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Threats
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Advanced Search Form -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-filter mr-2 text-gray-600"></i>
                        Advanced Search & Filters
                    </h2>
                </div>

                <form action="/threats/search" method="GET" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Search Query -->
                        <div class="md:col-span-2 lg:col-span-2">
                            <label for="q" class="block text-sm font-medium text-gray-700 mb-2">
                                Search Terms
                            </label>
                            <input type="text" 
                                   id="q" 
                                   name="q" 
                                   value="<?= esc($query ?? '') ?>"
                                   placeholder="Search IOC values, descriptions, sources..."
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- IOC Type Filter -->
                        <div>
                            <label for="ioc_type" class="block text-sm font-medium text-gray-700 mb-2">
                                IOC Type
                            </label>
                            <select id="ioc_type" 
                                    name="ioc_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">All Types</option>
                                <option value="IP">IP Address</option>
                                <option value="Domain">Domain</option>
                                <option value="Hash">File Hash</option>
                                <option value="URL">URL</option>
                                <option value="Email">Email</option>
                            </select>
                        </div>

                        <!-- Severity Filter -->
                        <div>
                            <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">
                                Severity
                            </label>
                            <select id="severity" 
                                    name="severity" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">All Severities</option>
                                <option value="Critical">Critical</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">All Statuses</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Investigating">Investigating</option>
                            </select>
                        </div>

                        <!-- Confidence Filter -->
                        <div>
                            <label for="confidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Confidence
                            </label>
                            <select id="confidence" 
                                    name="confidence" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">All Levels</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                        <!-- Threat Type Filter -->
                        <div>
                            <label for="threat_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Threat Type
                            </label>
                            <select id="threat_type" 
                                    name="threat_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">All Types</option>
                                <option value="Malware C&C">Malware C&C</option>
                                <option value="Botnet">Botnet</option>
                                <option value="Phishing">Phishing</option>
                                <option value="APT">APT</option>
                                <option value="Ransomware">Ransomware</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Actions -->
                    <div class="mt-6 pt-6 border-t border-gray-200 flex justify-between items-center">
                        <div class="flex space-x-4">
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                <i class="fas fa-search mr-2"></i>
                                Search Threats
                            </button>
                            <button type="button" 
                                    onclick="clearFilters()"
                                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Clear Filters
                            </button>
                        </div>
                        <div class="text-sm text-gray-500">
                            <?= isset($threats) ? count($threats) : '0' ?> threats found
                        </div>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <?php if (isset($query) && $query): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list-ul mr-2 text-gray-600"></i>
                        Search Results for "<?= esc($query) ?>"
                    </h3>
                </div>

                <?php if (empty($threats)): ?>
                <div class="p-12 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-search text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No threats found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your search terms or filters</p>
                    <button onclick="clearFilters()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                        Clear Search
                    </button>
                </div>
                <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IOC Details</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Threat Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Severity</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Confidence</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($threats as $threat): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-mono text-sm text-gray-900 break-all"><?= esc($threat['ioc_value']) ?></div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Source: <?= esc($threat['source']) ?: 'Unknown' ?>
                                        </div>
                                        <?php if (isset($threat['tags']) && $threat['tags']): ?>
                                        <div class="mt-1">
                                            <?php $tags = explode(',', $threat['tags']); ?>
                                            <?php foreach(array_slice($tags, 0, 3) as $tag): ?>
                                                <span class="inline-flex px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded mr-1">
                                                    <?= esc(trim($tag)) ?>
                                                </span>
                                            <?php endforeach; ?>
                                            <?php if (count($tags) > 3): ?>
                                                <span class="text-xs text-gray-500">+<?= count($tags) - 3 ?> more</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['ioc_type']) {
                                            case 'IP': echo 'bg-blue-100 text-blue-800'; break;
                                            case 'Domain': echo 'bg-green-100 text-green-800'; break;
                                            case 'Hash': echo 'bg-purple-100 text-purple-800'; break;
                                            case 'URL': echo 'bg-orange-100 text-orange-800'; break;
                                            case 'Email': echo 'bg-red-100 text-red-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($threat['ioc_type']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900"><?= esc($threat['threat_type']) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['severity']) {
                                            case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                            case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                            case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($threat['severity']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['confidence']) {
                                            case 'High': echo 'bg-green-100 text-green-800'; break;
                                            case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Low': echo 'bg-red-100 text-red-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($threat['confidence']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['status']) {
                                            case 'Active': echo 'bg-red-100 text-red-800'; break;
                                            case 'Inactive': echo 'bg-gray-100 text-gray-800'; break;
                                            case 'Investigating': echo 'bg-yellow-100 text-yellow-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <i class="fas fa-circle text-xs mr-1"></i>
                                        <?= esc($threat['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="/threats/<?= $threat['id'] ?>" 
                                           class="text-blue-600 hover:text-blue-800 transition-colors" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/threats/<?= $threat['id'] ?>/edit" 
                                           class="text-yellow-600 hover:text-yellow-800 transition-colors" 
                                           title="Edit Threat">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="blockThreat(<?= $threat['id'] ?>)"
                                                class="text-red-600 hover:text-red-800 transition-colors" 
                                                title="Block IOC">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Quick Search Examples -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                        Quick Search Examples
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <button onclick="quickSearch('192.168')" 
                                class="text-left p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                            <div class="font-semibold text-blue-900">IP Range Search</div>
                            <div class="text-sm text-blue-700">192.168.*</div>
                            <div class="text-xs text-blue-600 mt-1">Find all IPs in range</div>
                        </button>
                        
                        <button onclick="quickSearch('malware')" 
                                class="text-left p-4 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                            <div class="font-semibold text-red-900">Malware IOCs</div>
                            <div class="text-sm text-red-700">malware</div>
                            <div class="text-xs text-red-600 mt-1">Find malware-related threats</div>
                        </button>
                        
                        <button onclick="quickSearch('apt')" 
                                class="text-left p-4 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors">
                            <div class="font-semibold text-purple-900">APT Groups</div>
                            <div class="text-sm text-purple-700">apt</div>
                            <div class="text-xs text-purple-600 mt-1">Find APT-related threats</div>
                        </button>
                        
                        <button onclick="quickSearch('phishing')" 
                                class="text-left p-4 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition-colors">
                            <div class="font-semibold text-orange-900">Phishing</div>
                            <div class="text-sm text-orange-700">phishing</div>
                            <div class="text-xs text-orange-600 mt-1">Find phishing indicators</div>
                        </button>
                        
                        <button onclick="quickSearch('.com')" 
                                class="text-left p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                            <div class="font-semibold text-green-900">Domain Search</div>
                            <div class="text-sm text-green-700">*.com domains</div>
                            <div class="text-xs text-green-600 mt-1">Find .com domains</div>
                        </button>
                        
                        <button onclick="quickSearch('c2')" 
                                class="text-left p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="font-semibold text-gray-900">C&C Servers</div>
                            <div class="text-sm text-gray-700">c2, command</div>
                            <div class="text-xs text-gray-600 mt-1">Find C&C infrastructure</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
function clearFilters() {
    document.getElementById('q').value = '';
    document.getElementById('ioc_type').value = '';
    document.getElementById('severity').value = '';
    document.getElementById('status').value = '';
    document.getElementById('confidence').value = '';
    document.getElementById('threat_type').value = '';
    
    // Remove search results by redirecting to base search page
    window.location.href = '/threats/search';
}

function quickSearch(term) {
    document.getElementById('q').value = term;
    document.querySelector('form').submit();
}

function blockThreat(threatId) {
    if (confirm('Are you sure you want to block this threat IOC?')) {
        alert('Threat IOC blocking initiated (Demo Mode)');
    }
}

// Enhanced search with Enter key
document.getElementById('q').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.querySelector('form').submit();
    }
});

// Auto-complete for search terms (demo)
document.getElementById('q').addEventListener('input', function() {
    // In production, this would show search suggestions
    console.log('Search suggestions would appear here');
});
</script>

<?= $this->endSection() ?>