<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
    <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-arrow-left"></i> Back to Playbooks
    </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="<?= base_url('/playbooks/store') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <input type="text" name="category" id="category" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                <select name="type" id="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Manual">Manual</option>
                    <option value="Automated">Automated</option>
                    <option value="Semi-Automated">Semi-Automated</option>
                </select>
            </div>
            
            <div>
                <label for="severity_level" class="block text-sm font-medium text-gray-700 mb-1">Severity Level *</label>
                <select name="severity_level" id="severity_level" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="trigger_conditions" class="block text-sm font-medium text-gray-700 mb-1">Trigger Conditions</label>
            <textarea name="trigger_conditions" id="trigger_conditions" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="required_tools" class="block text-sm font-medium text-gray-700 mb-1">Required Tools</label>
            <textarea name="required_tools" id="required_tools" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="estimated_time" class="block text-sm font-medium text-gray-700 mb-1">Estimated Time</label>
            <input type="text" name="estimated_time" id="estimated_time"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., 2-4 hours">
        </div>
        
        <div class="mb-6">
            <label for="steps" class="block text-sm font-medium text-gray-700 mb-1">Steps (JSON format)</label>
            <textarea name="steps" id="steps" rows="6"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                placeholder='[{"step": 1, "action": "Description of step 1", "estimated_time": "15 minutes"}, {"step": 2, "action": "Description of step 2", "estimated_time": "30 minutes"}]'></textarea>
            <p class="mt-1 text-sm text-gray-500">Enter steps in JSON format. Each step should have "step", "action", and optionally "estimated_time".</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Playbook
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>