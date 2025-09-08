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

<!-- Edit Incident Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-file-edit mr-2 text-gray-600"></i>
            Incident Information
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/incidents/update/<?= $incident['id'] ?>" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Incident Title
                    </label>
                    <input type="text" 
                           name="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           value="<?= old('title', esc($incident['title'])) ?>" 
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
                              placeholder="Detailed description of the incident..." required><?= old('description', esc($incident['description'])) ?></textarea>
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
                           value="<?= old('source_ip', esc($incident['source_ip'] ?? '')) ?>" 
                           required
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
                        <option value="Low" <?= (old('severity', $incident['severity'] ?? '') == 'Low') ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= (old('severity', $incident['severity'] ?? '') == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= (old('severity', $incident['severity'] ?? '') == 'High') ? 'selected' : '' ?>>High</option>
                        <option value="Critical" <?= (old('severity', $incident['severity'] ?? '') == 'Critical') ? 'selected' : '' ?>>Critical</option>
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
                        <option value="Open" <?= (old('status', $incident['status'] ?? '') == 'Open') ? 'selected' : '' ?>>Open</option>
                        <option value="In Progress" <?= (old('status', $incident['status'] ?? '') == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                        <option value="Closed" <?= (old('status', $incident['status'] ?? '') == 'Closed') ? 'selected' : '' ?>>Closed</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Current investigation status</p>
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
                    <p class="mt-1 text-sm text-gray-500">Upload additional evidence files (Max 5 files, 5MB each)</p>
                    
                    <!-- Existing evidence files -->
                    <?php 
                    $evidenceFiles = json_decode($incident['evidence_collected'] ?? '[]', true);
                    if (!empty($evidenceFiles) && is_array($evidenceFiles)): ?>
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Current Evidence Files:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <?php foreach ($evidenceFiles as $index => $file): ?>
                                    <div class="border border-gray-200 rounded-lg p-3 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-xs text-gray-600 truncate max-w-[120px] mr-2"><?= esc($file) ?></div>
                                            <a href="<?= base_url('uploads/incidents/' . $file) ?>" 
                                               target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 text-xs">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" 
                                                   name="delete_files[]" 
                                                   value="<?= esc($file) ?>" 
                                                   class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-xs text-red-600">Delete</span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Resolution Notes Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Resolution Notes
                    </label>
                    <textarea name="resolution_notes" 
                              rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                              placeholder="Notes about how the incident was resolved..."><?= old('resolution_notes', esc($incident['resolution_notes'] ?? '')) ?></textarea>
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