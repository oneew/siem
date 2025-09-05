<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
    <div class="flex space-x-2">
        <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left"></i> Back to Playbooks
        </a>
        <a href="<?= base_url('/playbooks/edit/' . $playbook['id']) ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button onclick="confirmDelete(<?= $playbook['id'] ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-trash"></i> Delete
        </button>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= esc($playbook['name']) ?></h2>
            <p class="text-gray-600 mb-4"><?= esc($playbook['description']) ?></p>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Category:</span>
                    <span class="text-gray-900"><?= esc($playbook['category']) ?></span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Type:</span>
                    <span class="px-2 py-1 rounded text-sm font-medium 
                        <?= $playbook['type'] == 'Automated' ? 'bg-green-100 text-green-800' : 
                           ($playbook['type'] == 'Manual' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') ?>">
                        <?= esc($playbook['type']) ?>
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Severity:</span>
                    <span class="px-2 py-1 rounded text-sm font-medium 
                        <?= $playbook['severity_level'] == 'Critical' ? 'bg-red-100 text-red-800' : 
                           ($playbook['severity_level'] == 'High' ? 'bg-orange-100 text-orange-800' : 
                           ($playbook['severity_level'] == 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) ?>">
                        <?= esc($playbook['severity_level']) ?>
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Status:</span>
                    <span class="px-2 py-1 rounded text-sm font-medium 
                        <?= $playbook['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                        <?= esc($playbook['status']) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="space-y-3">
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Created By:</span>
                <span class="text-gray-900"><?= esc($playbook['created_by'] ?? 'System') ?></span>
            </div>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Created At:</span>
                <span class="text-gray-900"><?= date('M j, Y H:i', strtotime($playbook['created_at'])) ?></span>
            </div>
            <?php if (!empty($playbook['updated_at']) && $playbook['updated_at'] != $playbook['created_at']): ?>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Updated At:</span>
                <span class="text-gray-900"><?= date('M j, Y H:i', strtotime($playbook['updated_at'])) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($playbook['updated_by'])): ?>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Updated By:</span>
                <span class="text-gray-900"><?= esc($playbook['updated_by']) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($playbook['estimated_time'])): ?>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Est. Time:</span>
                <span class="text-gray-900"><?= esc($playbook['estimated_time']) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($playbook['execution_count'])): ?>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Executions:</span>
                <span class="text-gray-900"><?= esc($playbook['execution_count']) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($playbook['success_rate'])): ?>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Success Rate:</span>
                <span class="text-gray-900"><?= esc($playbook['success_rate']) ?>%</span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Trigger Conditions</h3>
        <p class="text-gray-700"><?= esc($playbook['trigger_conditions']) ?></p>
    </div>
    
    <div class="border-t border-gray-200 pt-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Required Tools</h3>
        <p class="text-gray-700"><?= esc($playbook['required_tools']) ?></p>
    </div>
    
    <div class="border-t border-gray-200 pt-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Execution Steps</h3>
        <?php if (!empty($playbook['steps'])): ?>
            <?php 
            $steps = json_decode($playbook['steps'], true);
            if (is_array($steps)): 
            ?>
                <div class="space-y-4">
                    <?php foreach ($steps as $index => $step): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-3">
                                <?= $index + 1 ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900"><?= esc($step['action'] ?? '') ?></h4>
                                <?php if (!empty($step['estimated_time'])): ?>
                                    <p class="text-sm text-gray-600">Est. time: <?= esc($step['estimated_time']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-700"><?= esc($playbook['steps']) ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-gray-500 italic">No steps defined for this playbook.</p>
        <?php endif; ?>
    </div>
    
    <div class="border-t border-gray-200 pt-6 mt-6">
        <a href="<?= base_url('/playbooks/execute/' . $playbook['id']) ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-play"></i> Execute Playbook
        </a>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this playbook? This action cannot be undone.')) {
        // Create a form dynamically to submit the delete request
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url('/playbooks/delete/') ?>' + id;
        
        // Add CSRF token
        var csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '<?= csrf_token() ?>';
        csrfField.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfField);
        
        // Add method spoofing for DELETE request
        var methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?= $this->endSection() ?>