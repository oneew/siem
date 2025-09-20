<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-archive text-indigo-600 mr-3"></i>
                    Add Evidence to Case #<?= $case['case_number'] ?>
                </h1>
                <p class="text-gray-600 mt-1"><?= $case['case_name'] ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="/forensics/show/<?= $case['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Case
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-plus-circle mr-2 text-gray-600"></i>
                        Evidence Details
                    </h3>
                </div>

                <form action="/forensics/evidence/<?= $case['id'] ?>" method="POST" enctype="multipart/form-data" class="p-6">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Evidence Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Evidence Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   placeholder="e.g., System Memory Dump, Network Packet Capture"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>

                        <!-- Evidence Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Evidence Type <span class="text-red-500">*</span>
                            </label>
                            <select id="type" 
                                    name="type" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Select Evidence Type</option>
                                <option value="Digital">Digital</option>
                                <option value="Physical">Physical</option>
                                <option value="Documentary">Documentary</option>
                                <option value="Testimonial">Testimonial</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Collection Method -->
                        <div>
                            <label for="collection_method" class="block text-sm font-medium text-gray-700 mb-2">
                                Collection Method
                            </label>
                            <select id="collection_method" 
                                    name="collection_method"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Select Collection Method</option>
                                <option value="Imaging">Imaging</option>
                                <option value="Hashing">Hashing</option>
                                <option value="Screenshot">Screenshot</option>
                                <option value="Photography">Photography</option>
                                <option value="Interview">Interview</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Evidence File -->
                        <div class="md:col-span-2">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Evidence File
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PDF, DOC, XLS, PNG, JPG, ZIP (MAX. 10MB)</p>
                                    </div>
                                    <input id="file" name="file" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Detailed description of the evidence, including collection date, location, and custodian information..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"></textarea>
                        </div>

                        <!-- Hash Value -->
                        <div>
                            <label for="hash_value" class="block text-sm font-medium text-gray-700 mb-2">
                                Hash Value
                            </label>
                            <input type="text" 
                                   id="hash_value" 
                                   name="hash_value"
                                   placeholder="e.g., SHA256 hash value"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>

                        <!-- Hash Algorithm -->
                        <div>
                            <label for="hash_algorithm" class="block text-sm font-medium text-gray-700 mb-2">
                                Hash Algorithm
                            </label>
                            <select id="hash_algorithm" 
                                    name="hash_algorithm"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Select Hash Algorithm</option>
                                <option value="MD5">MD5</option>
                                <option value="SHA1">SHA-1</option>
                                <option value="SHA256">SHA-256</option>
                                <option value="SHA512">SHA-512</option>
                            </select>
                        </div>
                    </div>

                    <!-- Chain of Custody -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-link text-blue-600 mr-2"></i>
                            Chain of Custody
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Collected By -->
                            <div>
                                <label for="collected_by" class="block text-sm font-medium text-gray-700 mb-2">
                                    Collected By
                                </label>
                                <input type="text" 
                                       id="collected_by" 
                                       name="collected_by"
                                       placeholder="Name of person who collected the evidence"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Collection Date -->
                            <div>
                                <label for="collection_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Collection Date
                                </label>
                                <input type="datetime-local" 
                                       id="collection_date" 
                                       name="collection_date"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Custodian -->
                            <div>
                                <label for="custodian" class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Custodian
                                </label>
                                <input type="text" 
                                       id="custodian" 
                                       name="custodian"
                                       placeholder="Name of current evidence custodian"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Storage Location -->
                            <div>
                                <label for="storage_location" class="block text-sm font-medium text-gray-700 mb-2">
                                    Storage Location
                                </label>
                                <input type="text" 
                                       id="storage_location" 
                                       name="storage_location"
                                       placeholder="Physical or digital storage location"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/forensics/show/<?= $case['id'] ?>" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Add Evidence
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Set current datetime for collection date
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('collection_date').value = now.toISOString().slice(0, 16);
});
</script>

<?= $this->endSection() ?>