<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                Incident #<?= esc($incident['id']) ?>
            </h1>
            <p class="text-gray-600 mt-1"><?= esc($incident['title']) ?></p>
        </div>
        <div class="flex space-x-3">
            <a href="/incidents" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Incidents
            </a>
            <a href="/incidents/edit/<?= $incident['id'] ?>" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-md">
                <i class="fas fa-edit mr-2"></i>
                Edit Incident
            </a>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?= $this->include('components/flash_messages') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Incident Overview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Incident Overview
                </h2>
            </div>
            <div class="p-6">
                <div class="prose max-w-none">
                    <p class="text-gray-700"><?= esc($incident['description'] ?? '') ?></p>
                </div>
            </div>
        </div>

        <!-- Evidence Files -->
        <?php if (!empty($incident['evidence_collected'])): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-paperclip mr-2 text-gray-600"></i>
                    Evidence Files
                </h2>
            </div>
            <div class="p-6">
                <?php 
                $evidenceFiles = json_decode($incident['evidence_collected'], true);
                if (!empty($evidenceFiles) && is_array($evidenceFiles)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <?php foreach ($evidenceFiles as $file): ?>
                            <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                                <?php 
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                ?>
                                <?php if ($isImage): ?>
                                    <img src="<?= base_url('uploads/incidents/' . $file) ?>" 
                                         alt="Evidence" 
                                         class="w-full h-32 object-cover rounded mb-2">
                                <?php else: ?>
                                    <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                                        <i class="fas fa-file-alt text-3xl text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="text-xs text-gray-600 truncate"><?= esc($file) ?></div>
                                <a href="<?= base_url('uploads/incidents/' . $file) ?>" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 text-xs mt-1 inline-block">
                                    View File
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No evidence files available.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Timeline & Comments -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Timeline & Comments
                </h2>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <form id="comment-form" class="comment-form">
                        <input type="hidden" name="incident_id" value="<?= $incident['id'] ?>">
                        <textarea name="comment" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                                  rows="3" 
                                  placeholder="Add a comment or update..."></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Post Comment
                        </button>
                    </form>
                </div>
                <div id="comments-container" class="space-y-6">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                        <div class="flex space-x-3 comment-item">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <?php if (!empty($comment['profile_picture'])): ?>
                                    <img src="<?= base_url('uploads/profile_pictures/' . $comment['profile_picture']) ?>" 
                                         alt="Profile" 
                                         class="w-10 h-10 rounded-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-user"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-sm">
                                    <span class="font-semibold text-gray-800"><?= esc($comment['username']) ?></span>
                                    <span class="text-gray-600">commented</span>
                                </p>
                                <p class="text-gray-700 mt-1"><?= esc($comment['comment']) ?></p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?= isset($comment['created_at']) ? date('M j, Y H:i', strtotime($comment['created_at'])) : 'Just now' ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-comment-alt text-3xl mb-3"></i>
                            <p>No comments yet. Be the first to comment!</p>
                        </div>
                    <?php endif; ?>
                    
                    <!-- System-generated timeline events -->
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-cogs text-gray-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800">
                                Incident created with severity <span class="font-semibold"><?= esc($incident['severity'] ?? 'Unknown') ?></span>.
                            </p>
                            <p class="text-xs text-gray-500">
                                <?= isset($incident['created_at']) ? date('M j, Y H:i', strtotime($incident['created_at'])) : 'N/A' ?>
                            </p>
                        </div>
                    </div>
                    
                    <?php if (!empty($incident['resolved_at'])): ?>
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-200 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800">
                                Incident resolved.
                            </p>
                            <p class="text-xs text-gray-500">
                                <?= date('M j, Y H:i', strtotime($incident['resolved_at'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Tasks -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-tasks mr-2 text-gray-600"></i>
                    Related Tasks
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center py-8">
                    <i class="fas fa-tasks text-3xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Task management features will be available in future updates.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Incident Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clipboard-list mr-2 text-gray-600"></i>
                    Incident Details
                </h2>
            </div>
            <div class="p-6 text-sm space-y-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Severity</span>
                    <span class="font-semibold 
                        <?php 
                        $severity = $incident['severity'] ?? 'Low';
                        switch($severity) {
                            case 'Critical': echo 'text-red-600'; break;
                            case 'High': echo 'text-orange-600'; break;
                            case 'Medium': echo 'text-yellow-600'; break;
                            case 'Low': echo 'text-blue-600'; break;
                            default: echo 'text-gray-600'; break;
                        }
                        ?>">
                        <?= esc($severity) ?>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Status</span>
                    <span class="font-semibold 
                        <?php 
                        $status = $incident['status'] ?? 'Open';
                        switch($status) {
                            case 'Closed': echo 'text-green-600'; break;
                            case 'In Progress': echo 'text-yellow-600'; break;
                            case 'Open': echo 'text-red-600'; break;
                            default: echo 'text-gray-600'; break;
                        }
                        ?>">
                        <?= esc($status) ?>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Source IP</span>
                    <span class="font-mono text-gray-800"><?= esc($incident['source_ip'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Created</span>
                    <span class="text-gray-800"><?= isset($incident['created_at']) ? date('M j, Y H:i', strtotime($incident['created_at'])) : 'N/A' ?></span>
                </div>
                <?php if (!empty($incident['resolved_at'])): ?>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Resolved</span>
                    <span class="text-gray-800"><?= date('M j, Y H:i', strtotime($incident['resolved_at'])) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bolt mr-2 text-gray-600"></i>
                    Quick Actions
                </h2>
            </div>
            <div class="p-6 space-y-3">
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-share-alt mr-2 text-gray-500"></i>
                    Share Incident
                </button>
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-print mr-2 text-gray-500"></i>
                    Print Report
                </button>
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-file-export mr-2 text-gray-500"></i>
                    Export Data
                </button>
                <hr class="my-2">
                <a href="/incidents/edit/<?= $incident['id'] ?>" class="w-full text-left px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-edit mr-2 text-yellow-500"></i>
                    Edit Incident
                </a>
                <button class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg transition-colors flex items-center"
                        onclick="confirmDelete(<?= $incident['id'] ?>)">
                    <i class="fas fa-trash-alt mr-2 text-red-500"></i>
                    Delete Incident
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this incident? This action cannot be undone.')) {
        // Create a form dynamically and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/incidents/delete/${id}`;
        
        // Add CSRF token if needed
        const csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '<?= csrf_token() ?>';
        csrfField.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfField);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Handle comment submission
document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(commentForm);
            const submitButton = commentForm.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Posting...';
            submitButton.disabled = true;
            
            // Submit the form via AJAX
            fetch('/incidents/add-comment', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Clear the textarea
                    commentForm.querySelector('textarea[name="comment"]').value = '';
                    
                    // Add the new comment to the list
                    const commentsContainer = document.getElementById('comments-container');
                    const noCommentsMessage = commentsContainer.querySelector('.text-center');
                    if (noCommentsMessage) {
                        noCommentsMessage.remove();
                    }
                    
                    const commentHtml = `
                        <div class="flex space-x-3 comment-item">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm">
                                    <span class="font-semibold text-gray-800">${data.comment.username}</span>
                                    <span class="text-gray-600">commented</span>
                                </p>
                                <p class="text-gray-700 mt-1">${data.comment.comment}</p>
                                <p class="text-xs text-gray-500 mt-1">Just now</p>
                            </div>
                        </div>
                    `;
                    
                    // Insert the new comment after the form but before the system events
                    const systemEvents = commentsContainer.querySelectorAll('.flex.space-x-3:not(.comment-item)');
                    if (systemEvents.length > 0) {
                        systemEvents[0].insertAdjacentHTML('beforebegin', commentHtml);
                    } else {
                        commentsContainer.insertAdjacentHTML('beforeend', commentHtml);
                    }
                    
                    // Show success message
                    alert('Comment added successfully!');
                } else {
                    alert('Failed to add comment: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add comment. Please try again.');
            })
            .finally(() => {
                // Restore button state
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            });
        });
    }
});
</script>

<?= $this->endSection() ?>