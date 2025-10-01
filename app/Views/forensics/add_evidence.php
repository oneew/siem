<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-archive text-indigo-600 mr-3"></i>
                    Tambah Barang Bukti ke Kasus #<?= $case['case_number'] ?>
                </h1>
                <p class="text-gray-600 mt-1"><?= $case['case_name'] ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="/forensics/show/<?= $case['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Kasus
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
                        Detail Barang Bukti
                    </h3>
                </div>

                <form action="/forensics/evidence/<?= $case['id'] ?>" method="POST" enctype="multipart/form-data" class="p-6">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Barang Bukti -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Barang Bukti <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                id="name"
                                name="name"
                                required
                                placeholder="contoh: Dump Memori Sistem, Tangkap Paket Jaringan"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>

                        <!-- Jenis Barang Bukti -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Barang Bukti <span class="text-red-500">*</span>
                            </label>
                            <select id="type"
                                name="type"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Jenis Barang Bukti</option>
                                <option value="Digital">Digital</option>
                                <option value="Fisik">Fisik</option>
                                <option value="Dokumentasi">Dokumentasi</option>
                                <option value="Kesaksian">Kesaksian</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Metode Pengumpulan -->
                        <div>
                            <label for="collection_method" class="block text-sm font-medium text-gray-700 mb-2">
                                Metode Pengumpulan
                            </label>
                            <select id="collection_method"
                                name="collection_method"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Metode Pengumpulan</option>
                                <option value="Imaging">Imaging</option>
                                <option value="Hashing">Hashing</option>
                                <option value="Screenshot">Tangkapan Layar</option>
                                <option value="Photography">Fotografi</option>
                                <option value="Interview">Wawancara</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>

                        <!-- Berkas Barang Bukti -->
                        <div class="md:col-span-2">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Berkas Barang Bukti
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span> atau seret dan jatuhkan</p>
                                        <p class="text-xs text-gray-500">PDF, DOC, XLS, PNG, JPG, ZIP (MAX. 10MB)</p>
                                    </div>
                                    <input id="file" name="file" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="description"
                                name="description"
                                rows="3"
                                placeholder="Deskripsi rinci barang bukti, termasuk tanggal, lokasi pengumpulan, dan informasi penjaga barang bukti..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"></textarea>
                        </div>

                        <!-- Nilai Hash -->
                        <div>
                            <label for="hash_value" class="block text-sm font-medium text-gray-700 mb-2">
                                Nilai Hash
                            </label>
                            <input type="text"
                                id="hash_value"
                                name="hash_value"
                                placeholder="contoh: nilai hash SHA256"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>

                        <!-- Algoritma Hash -->
                        <div>
                            <label for="hash_algorithm" class="block text-sm font-medium text-gray-700 mb-2">
                                Algoritma Hash
                            </label>
                            <select id="hash_algorithm"
                                name="hash_algorithm"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Algoritma Hash</option>
                                <option value="MD5">MD5</option>
                                <option value="SHA1">SHA-1</option>
                                <option value="SHA256">SHA-256</option>
                                <option value="SHA512">SHA-512</option>
                            </select>
                        </div>
                    </div>

                    <!-- Rantai Penguasaan -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-link text-blue-600 mr-2"></i>
                            Rantai Penguasaan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Dikumpulkan Oleh -->
                            <div>
                                <label for="collected_by" class="block text-sm font-medium text-gray-700 mb-2">
                                    Dikumpulkan Oleh
                                </label>
                                <input type="text"
                                    id="collected_by"
                                    name="collected_by"
                                    placeholder="Nama orang yang mengumpulkan barang bukti"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Tanggal Pengumpulan -->
                            <div>
                                <label for="collection_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Pengumpulan
                                </label>
                                <input type="datetime-local"
                                    id="collection_date"
                                    name="collection_date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Penjaga Barang Bukti -->
                            <div>
                                <label for="custodian" class="block text-sm font-medium text-gray-700 mb-2">
                                    Penjaga Barang Bukti Saat Ini
                                </label>
                                <input type="text"
                                    id="custodian"
                                    name="custodian"
                                    placeholder="Nama penjaga barang bukti saat ini"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>

                            <!-- Lokasi Penyimpanan -->
                            <div>
                                <label for="storage_location" class="block text-sm font-medium text-gray-700 mb-2">
                                    Lokasi Penyimpanan
                                </label>
                                <input type="text"
                                    id="storage_location"
                                    name="storage_location"
                                    placeholder="Lokasi penyimpanan fisik atau digital"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/forensics/show/<?= $case['id'] ?>"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Tambah Barang Bukti
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Atur tanggal dan jam saat ini untuk field tanggal pengumpulan
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('collection_date').value = now.toISOString().slice(0, 16);
    });
</script>

<?= $this->endSection() ?>