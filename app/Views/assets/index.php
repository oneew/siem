<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
            <i class="fas fa-network-wired text-green-500 mr-2"></i> Manajemen Aset (Asset Discovery)
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lakukan pemindaian jaringan (*Ping Sweep* / Nmap) untuk menemukan perangkat yang terhubung dalam subnet.</p>
    </div>
</div>

<div class="card p-6 mb-6 border border-gray-200 dark:border-siem-darkborder rounded-xl bg-white dark:bg-siem-darkcard shadow-sm">
    <form id="scanForm" onsubmit="runScan(event)" class="flex gap-4 items-end">
        <div class="flex-1">
            <label class="form-label text-sm text-gray-700 dark:text-gray-300">Target Subnet (CIDR)</label>
            <input type="text" name="subnet" required class="form-input bg-gray-50 dark:bg-siem-darkbg border border-gray-300 dark:border-siem-darkborder w-full p-2.5 rounded-lg text-sm text-gray-800 dark:text-gray-200" placeholder="e.g. 192.168.1.0/24" value="192.168.1.0/24">
        </div>
        <button type="submit" id="scanBtn" class="btn btn-primary whitespace-nowrap px-6">
            <i class="fas fa-satellite-dish mr-2"></i> Mulai Pemindaian
        </button>
    </form>
</div>

<div class="card overflow-hidden border border-gray-200 dark:border-siem-darkborder rounded-xl bg-white dark:bg-siem-darkcard shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full modern-table text-left" id="assetsTable">
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">IP Address</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Hostname</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">MAC Address</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">OS Name</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Open Ports</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody id="assetsBody" class="divide-y divide-gray-100 dark:divide-siem-darkborder">
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-laptop-network text-4xl mb-3 block opacity-50"></i>
                        Belum ada pemindaian yang dilakukan. Masukkan subnet dan mulai pemindaian.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function runScan(e) {
        e.preventDefault();
        const form = document.getElementById('scanForm');
        const btn = document.getElementById('scanBtn');
        const tbody = document.getElementById('assetsBody');
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memindai Jaringan...';
        btn.disabled = true;

        // Show Skeleton Loading
        tbody.innerHTML = Array(4).fill(0).map(() => `
            <tr class="animate-pulse">
                <td class="px-6 py-4"><div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-24 skeleton"></div></td>
                <td class="px-6 py-4"><div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-32 skeleton"></div></td>
                <td class="px-6 py-4"><div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-36 skeleton"></div></td>
                <td class="px-6 py-4"><div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-28 skeleton"></div></td>
                <td class="px-6 py-4"><div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-16 skeleton"></div></td>
                <td class="px-6 py-4"><div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full w-16 skeleton"></div></td>
            </tr>
        `).join('');

        const formData = new FormData(form);

        fetch('/assets/scan', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            btn.innerHTML = '<i class="fas fa-satellite-dish mr-2"></i> Mulai Pemindaian';
            btn.disabled = false;

            if (data.status === 'success') {
                tbody.innerHTML = '';
                data.data.forEach(asset => {
                    const statusClass = asset.status === 'Online' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400';
                    const osIcon = asset.os.includes('Windows') ? 'fa-windows text-blue-500' : (asset.os.includes('Linux') ? 'fa-linux text-yellow-500' : 'fa-desktop text-gray-500');

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50 dark:hover:bg-siem-darkbg transition-colors animate-fade-in text-sm text-gray-700 dark:text-gray-300">
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 dark:text-blue-400 font-medium">${asset.ip}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">${asset.hostname}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs">${asset.mac}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-2"><i class="fab ${osIcon}"></i> ${asset.os}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs"><span class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">${asset.ports}</span></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 text-[10px] font-bold uppercase rounded-full ${statusClass}">${asset.status}</span>
                            </td>
                        </tr>
                    `;
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>