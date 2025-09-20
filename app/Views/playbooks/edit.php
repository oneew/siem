<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
    <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-arrow-left"></i> Back to Playbooks
    </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="<?= base_url('/playbooks/' . $playbook['id']) ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <?= csrf_field() ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="<?= esc($playbook['name']) ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <input type="text" name="category" id="category" value="<?= esc($playbook['category']) ?>" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                <select name="type" id="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Manual" <?= $playbook['type'] == 'Manual' ? 'selected' : '' ?>>Manual</option>
                    <option value="Automated" <?= $playbook['type'] == 'Automated' ? 'selected' : '' ?>>Automated</option>
                    <option value="Semi-Automated" <?= $playbook['type'] == 'Semi-Automated' ? 'selected' : '' ?>>Semi-Automated</option>
                </select>
            </div>
            
            <div>
                <label for="severity_level" class="block text-sm font-medium text-gray-700 mb-1">Severity Level *</label>
                <select name="severity_level" id="severity_level" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Low" <?= $playbook['severity_level'] == 'Low' ? 'selected' : '' ?>>Low</option>
                    <option value="Medium" <?= $playbook['severity_level'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="High" <?= $playbook['severity_level'] == 'High' ? 'selected' : '' ?>>High</option>
                    <option value="Critical" <?= $playbook['severity_level'] == 'Critical' ? 'selected' : '' ?>>Critical</option>
                </select>
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                <select name="status" id="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Active" <?= $playbook['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $playbook['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                    <option value="Draft" <?= $playbook['status'] == 'Draft' ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($playbook['description']) ?></textarea>
        </div>
        
        <div class="mb-6">
            <label for="trigger_conditions" class="block text-sm font-medium text-gray-700 mb-1">Trigger Conditions</label>
            <textarea name="trigger_conditions" id="trigger_conditions" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($playbook['trigger_conditions']) ?></textarea>
        </div>
        
        <div class="mb-6">
            <label for="required_tools" class="block text-sm font-medium text-gray-700 mb-1">Required Tools</label>
            <textarea name="required_tools" id="required_tools" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($playbook['required_tools']) ?></textarea>
        </div>
        
        <div class="mb-6">
            <label for="estimated_time" class="block text-sm font-medium text-gray-700 mb-1">Estimated Time</label>
            <input type="text" name="estimated_time" id="estimated_time" value="<?= esc($playbook['estimated_time']) ?>"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., 2-4 hours">
        </div>
        
        <div class="mb-6">
            <label for="steps" class="block text-sm font-medium text-gray-700 mb-1">Steps (JSON format)</label>
            <textarea name="steps" id="steps" rows="6"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"><?= esc($playbook['steps']) ?></textarea>
            <p class="mt-1 text-sm text-gray-500">Enter steps in JSON format. Each step should have "step", "action", and optionally "estimated_time".</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Playbook
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>