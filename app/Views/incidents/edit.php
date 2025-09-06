<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-edit text-yellow-600 mr-3"></i>
                Edit Incident #<?= esc($incident['id']) ?>
            </h1>
            <p class="text-gray-600 mt-1">Update incident details and status</p>
        </div>
    </div>
</div>

<!-- Edit Incident Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-file-edit mr-2 text-gray-600"></i>
            Incident Information
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/incidents/update/<?= $incident['id'] ?>" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Incident Title
                    </label>
                    <input type="text" 
                           name="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           value="<?= esc($incident['title']) ?>" 
                           required 
                           placeholder="Brief but descriptive title">
                    <p class="mt-1 text-sm text-gray-500">Provide a clear and concise title for the incident</p>
                </div>
                
                <!-- Description Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Description
                    </label>
                    <textarea name="description" 
                              rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                              placeholder="Detailed description of the incident..."><?= esc($incident['description']) ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Include all relevant details about the incident</p>
                </div>

                <!-- Source IP Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Source IP Address
                    </label>
                    <input type="text" 
                           name="source_ip" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           value="<?= esc($incident['source_ip'] ?? '') ?>" 
                           placeholder="192.168.1.100">
                    <p class="mt-1 text-sm text-gray-500">IP address of the threat source</p>
                </div>
                
                <!-- Severity Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Severity Level
                    </label>
                    <select name="severity" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                            required>
                        <option value="">Select Severity</option>
                        <option value="Low" <?= (isset($incident['severity']) && $incident['severity'] == 'Low') ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= (isset($incident['severity']) && $incident['severity'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= (isset($incident['severity']) && $incident['severity'] == 'High') ? 'selected' : '' ?>>High</option>
                        <option value="Critical" <?= (isset($incident['severity']) && $incident['severity'] == 'Critical') ? 'selected' : '' ?>>Critical</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Assess the impact level of this incident</p>
                </div>
                
                <!-- Status Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Current Status
                    </label>
                    <select name="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                            required>
                        <option value="">Select Status</option>
                        <option value="Open" <?= (isset($incident['status']) && $incident['status'] == 'Open') ? 'selected' : '' ?>>Open</option>
                        <option value="In Progress" <?= (isset($incident['status']) && $incident['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                        <option value="Closed" <?= (isset($incident['status']) && $incident['status'] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Current investigation status</p>
                </div>
                
                <!-- Resolution Notes Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Resolution Notes
                    </label>
                    <textarea name="resolution_notes" 
                              rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                              placeholder="Notes about how the incident was resolved..."><?= esc($incident['resolution_notes'] ?? '') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Document how this incident was resolved</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="/incidents/show/<?= $incident['id'] ?>" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-md">
                    <i class="fas fa-sync mr-2"></i>
                    Update Incident
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>