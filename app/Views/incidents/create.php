<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-plus-circle text-red-600 mr-3"></i>
                Create New Incident
            </h1>
            <p class="text-gray-600 mt-1">Report and document a new security incident</p>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?= $this->include('components/flash_messages') ?>

<!-- Validation Errors -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
        <p class="font-bold">Validation Errors</p>
        <ul class="list-disc list-inside mt-2">
            <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Create Incident Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-file-medical mr-2 text-gray-600"></i>
            Incident Details
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/incidents/store" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Incident Title
                    </label>
                    <input type="text" 
                           name="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           required 
                           placeholder="Brief but descriptive title"
                           value="<?= old('title') ?>">
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
                              placeholder="Detailed description of the incident..." required><?= old('description') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Include all relevant details about the incident</p>
                </div>

                <!-- Source IP Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Source IP Address
                    </label>
                    <input type="text" 
                           name="source_ip" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           required
                           placeholder="192.168.1.100"
                           value="<?= old('source_ip') ?>">
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
                        <option value="Low" <?= old('severity') == 'Low' ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= old('severity') == 'Medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= old('severity') == 'High' ? 'selected' : '' ?>>High</option>
                        <option value="Critical" <?= old('severity') == 'Critical' ? 'selected' : '' ?>>Critical</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Assess the impact level of this incident</p>
                </div>
                
                <!-- Status Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Initial Status
                    </label>
                    <select name="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                            required>
                        <option value="">Select Status</option>
                        <option value="Open" <?= old('status') == 'Open' || !old('status') ? 'selected' : '' ?>>Open</option>
                        <option value="In Progress" <?= old('status') == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="Closed" <?= old('status') == 'Closed' ? 'selected' : '' ?>>Closed</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Initial status of the incident</p>
                </div>
                
                <!-- Evidence Files -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-paperclip mr-2 text-gray-500"></i>
                        Evidence Files
                    </label>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <input type="file" 
                                   name="evidence_files[]" 
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100"
                                   multiple>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Upload screenshots, logs, or other evidence files (Max 5 files, 5MB each)</p>
                </div>
                
                <!-- Additional Notes -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Notes
                    </label>
                    <textarea name="resolution_notes" 
                              rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                              placeholder="Any additional information or initial observations..."><?= old('resolution_notes') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Optional notes about the incident</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="/incidents" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Create Incident
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Information Panel -->
<div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Incident Reporting Guidelines</h3>
            <div class="mt-2 text-sm text-blue-700">
                <ul class="list-disc list-inside space-y-1">
                    <li>Provide as much detail as possible about the incident</li>
                    <li>Include timestamps if available</li>
                    <li>Upload relevant evidence files (screenshots, logs, etc.)</li>
                    <li>Classify severity accurately to ensure proper response</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>