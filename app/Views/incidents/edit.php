<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Incident #<?= esc($incident['id']) ?></h3>
        </div>
        <form method="post" action="/incidents/update/<?= $incident['id'] ?>" class="card-content">
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= esc($incident['title']) ?>" required>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?= esc($incident['description']) ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="source_ip" class="block text-sm font-medium text-gray-700">Source IP</label>
                        <input type="text" name="source_ip" id="source_ip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= esc($incident['source_ip']) ?>">
                    </div>
                    <div>
                        <label for="severity" class="block text-sm font-medium text-gray-700">Severity</label>
                        <select name="severity" id="severity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <?php foreach(['Low','Medium','High','Critical'] as $s): ?>
                                <option value="<?= $s ?>" <?= ($incident['severity'] == $s) ? 'selected' : '' ?>><?= $s ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                     <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                             <?php foreach(['Open','In Progress','Closed'] as $s): ?>
                                <option value="<?= $s ?>" <?= ($incident['status'] == $s) ? 'selected' : '' ?>><?= $s ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-6 pt-5 flex justify-end space-x-3">
                <a href="/incidents/show/<?= $incident['id'] ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Incident</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>