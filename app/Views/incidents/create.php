<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-plus-circle text-red-600 mr-3"></i>
                Buat Insiden Baru
            </h1>
            <p class="text-gray-600 mt-1">Laporkan dan dokumentasikan insiden keamanan baru</p>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?= $this->include('components/flash_messages') ?>

<!-- Validation Errors -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
        <p class="font-bold">Kesalahan Validasi</p>
        <ul class="list-disc list-inside mt-2">
            <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Information Panel -->
<div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-blue-500 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Panduan Pelaporan Insiden</h3>
            <div class="mt-2 text-sm text-blue-700">
                <ul class="list-disc list-inside space-y-1">
                    <li>Berikan detail sebanyak mungkin tentang insiden</li>
                    <li>Sertakan timestamp jika tersedia</li>
                    <li>Unggah file bukti yang relevan (tangkapan layar, log, dll.)</li>
                    <li>Klasifikasikan tingkat keparahan secara akurat untuk memastikan respon yang tepat</li>
                </ul>
            </div>
        </div>
    </div>
</div><br>

<!-- Create Incident Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-file-medical mr-2 text-gray-600"></i>
            Detail Insiden
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/incidents/store" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Judul Insiden
                    </label>
                    <input type="text"
                        name="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        required
                        placeholder="Judul yang singkat namun deskriptif"
                        value="<?= old('title') ?>">
                    <p class="mt-1 text-sm text-gray-500">Berikan judul yang jelas dan ringkas untuk insiden ini</p>
                </div>

                <!-- Description Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Deskripsi
                    </label>
                    <textarea name="description"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Deskripsi terperinci tentang insiden..." required><?= old('description') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Sertakan semua detail relevan tentang insiden</p>
                </div>

                <!-- Horizontal Row for Source IP, Severity, and Status -->
                <div class="form-group md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Source IP Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Alamat IP Sumber
                            </label>
                            <input type="text"
                                name="source_ip"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required
                                placeholder="192.168.1.100"
                                value="<?= old('source_ip') ?>">
                            <p class="mt-1 text-sm text-gray-500">Alamat IP dari sumber ancaman</p>
                        </div>

                        <!-- Attack Type Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Serangan
                            </label>
                            <select name="attack_type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Pilih Tipe Serangan</option>
                                <option value="Web Defacement" <?= old('attack_type') == 'Web Defacement' ? 'selected' : '' ?>>Web Defacement</option>
                                <option value="Phishing" <?= old('attack_type') == 'Phishing' ? 'selected' : '' ?>>Phishing</option>
                                <option value="Ransomware" <?= old('attack_type') == 'Ransomware' ? 'selected' : '' ?>>Ransomware</option>
                                <option value="DDoS" <?= old('attack_type') == 'DDoS' ? 'selected' : '' ?>>DDoS</option>
                                <option value="Malware" <?= old('attack_type') == 'Malware' ? 'selected' : '' ?>>Malware</option>
                                <option value="SQL Injection" <?= old('attack_type') == 'SQL Injection' ? 'selected' : '' ?>>SQL Injection</option>
                                <option value="Brute Force" <?= old('attack_type') == 'Brute Force' ? 'selected' : '' ?>>Brute Force</option>
                                <option value="Insider Threat" <?= old('attack_type') == 'Insider Threat' ? 'selected' : '' ?>>Insider Threat</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Jenis serangan yang terjadi</p>
                        </div>

                        <!-- Severity Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Tingkat Keparahan
                            </label>
                            <select name="severity"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                                <option value="">Pilih Tingkat Keparahan</option>
                                <option value="Low" <?= old('severity') == 'Low' ? 'selected' : '' ?>>Rendah</option>
                                <option value="Medium" <?= old('severity') == 'Medium' ? 'selected' : '' ?>>Sedang</option>
                                <option value="High" <?= old('severity') == 'High' ? 'selected' : '' ?>>Tinggi</option>
                                <option value="Critical" <?= old('severity') == 'Critical' ? 'selected' : '' ?>>Kritis</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Nilai tingkat dampak dari insiden ini</p>
                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Status Awal
                            </label>
                            <select name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                                <option value="">Pilih Status</option>
                                <option value="Open" <?= old('status') == 'Open' || !old('status') ? 'selected' : '' ?>>Terbuka</option>
                                <option value="In Progress" <?= old('status') == 'In Progress' ? 'selected' : '' ?>>Dalam Proses</option>
                                <option value="Closed" <?= old('status') == 'Closed' ? 'selected' : '' ?>>Diselesaikan</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Status awal insiden</p>
                        </div>
                    </div>
                </div>

                <!-- Evidence Files -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-paperclip mr-2 text-gray-500"></i>
                        File Bukti
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
                    <p class="mt-1 text-sm text-gray-500">Unggah tangkapan layar, log, atau file bukti lainnya (Maks 5 file, 5MB per file)</p>
                </div>

                <!-- Additional Notes -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan Tambahan
                    </label>
                    <textarea name="resolution_notes"
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Informasi tambahan atau observasi awal..."><?= old('resolution_notes') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Catatan opsional tentang insiden</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="/incidents" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Buat Insiden
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>