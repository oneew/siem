<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight">
            <i class="fas fa-magic text-indigo-500 mr-2"></i> <?= esc($title) ?>
        </h1>
        <p class="text-sm text-gray-500 mt-1">Delegasikan eksekusi *Playbook* remediasi dan *Patch Management* kepada Agen AI secara otomatis.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <?php if(!empty($remediations)): ?>
        <?php foreach($remediations as $rem): ?>
        
        <?php 
            $bordercolor = 'border-gray-200';
            $badgeBg = 'bg-gray-100';
            $badgeText = 'text-gray-800';
            
            if ($rem['urgency'] === 'Critical') {
                $bordercolor = 'border-red-500';
                $badgeBg = 'bg-red-100';
                $badgeText = 'text-red-800';
            } elseif ($rem['urgency'] === 'High') {
                $bordercolor = 'border-orange-500';
                $badgeBg = 'bg-orange-100';
                $badgeText = 'text-orange-800';
            }
            
            $isApplied = $rem['status'] === 'Applied';
        ?>

        <div class="bg-white rounded-xl shadow-sm border <?= $isApplied ? 'border-green-300 opacity-70' : $bordercolor ?> overflow-hidden flex flex-col transition hover:shadow-md">
            <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-start justify-between">
                <div>
                    <span class="text-xs font-bold px-2 py-1 rounded <?= $badgeBg ?> <?= $badgeText ?> uppercase tracking-wider mb-2 inline-block">
                        <?= esc($rem['urgency']) ?> URGENCY
                    </span>
                    <h3 class="text-lg font-bold text-gray-800 <?= $isApplied ? 'line-through text-gray-400' : '' ?>"><?= esc($rem['threat']) ?></h3>
                    <p class="text-sm font-medium text-gray-600 mt-1"><i class="fas fa-server text-gray-400 mr-1"></i> <?= esc($rem['asset']) ?></p>
                </div>
                
                <?php if($isApplied): ?>
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 shadow-sm" title="Remediation Applied">
                        <i class="fas fa-check-double"></i>
                    </div>
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex flex-col items-center justify-center text-indigo-600 shadow-sm border border-indigo-200" title="AI Confidence Level">
                        <span class="text-[10px] font-bold"><?= $rem['ai_confidence'] ?></span>
                        <i class="fas fa-robot text-[8px] mt-0.5"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="p-5 flex-1 bg-white">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2">AI Suggested Action</p>
                <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 text-sm text-blue-800 mb-4 leading-relaxed">
                    <?= esc($rem['recommended_action']) ?>
                </div>
                
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2">Auto-Generated Script</p>
                <div class="bg-gray-900 rounded-lg p-3 relative group">
                    <pre class="text-green-400 font-mono text-xs overflow-x-auto whitespace-pre-wrap"><code><?= esc($rem['auto_script']) ?></code></pre>
                    <button class="absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white p-1.5 rounded opacity-0 group-hover:opacity-100 transition shadow"
                            onclick="navigator.clipboard.writeText('<?= addslashes($rem['auto_script']) ?>'); Swal.fire({toast:true, position:'top-end', icon:'success', title:'Script disalin!', showConfirmButton:false, timer:1500});">
                        <i class="fas fa-copy text-xs"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <?php if($isApplied): ?>
                        <span class="text-xs font-bold text-green-600"><i class="fas fa-check-circle mr-1"></i> Auto-Patched</span>
                    <?php else: ?>
                        <span class="text-xs font-bold text-yellow-600"><i class="fas fa-clock mr-1"></i> Action Required</span>
                    <?php endif; ?>
                </div>
                
                <?php if(!$isApplied): ?>
                <button onclick="applyRemediation('<?= $rem['id'] ?>', this)" class="bg-indigo-600 text-white font-medium text-sm py-2 px-4 rounded hover:bg-indigo-700 transition flex justify-center items-center shadow-sm">
                    <i class="fas fa-play mr-2"></i> Eksekusi AI
                </button>
                <?php endif; ?>
            </div>
        </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-shield-alt text-4xl mb-3 text-gray-300 block"></i>
            Tidak ada remediasi otomatis yang tertunda. Sistem keamanan dalam keadaan prima.
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function applyRemediation(remId, btnElement) {
    Swal.fire({
        title: 'Eksekusi Otomasi Mitigation?',
        text: "Sistem akan menjalankan playbook Ansible/Bash secara Remote ke Target Asset yang ditentukan.",
        icon: 'warning',
        showCancelButton: true,
        confirmColor: '#4f46e5',
        cancelColor: '#6b7280',
        confirmButtonText: 'Ya, Jalankan AI'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const originalBtnHtml = btnElement.innerHTML;
            btnElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btnElement.disabled = true;

            fetch('/ainexus/remediation/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'id=' + encodeURIComponent(remId)
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Remediasi Berhasil!',
                        text: 'Skrip telah dijalankan ke target. Silakan verifikasi status keamanan pasca eksploitasi.',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Gagal', data.message, 'error');
                    btnElement.innerHTML = originalBtnHtml;
                    btnElement.disabled = false;
                }
            })
            .catch(err => {
                Swal.fire('Error', 'Kesalahan jalur komunikasi Node Management.', 'error');
                btnElement.innerHTML = originalBtnHtml;
                btnElement.disabled = false;
            });
        }
    });
}
</script>

<?= $this->endSection() ?>
