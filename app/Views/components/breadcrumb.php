<!-- Breadcrumb Component -->
<nav class="flex items-center text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
  <ol class="flex items-center space-x-2">
    <li>
      <a href="/dashboard" class="text-gray-500 hover:text-gray-700 transition-colors">
        <i class="fas fa-home mr-1"></i>
        Dashboard
      </a>
    </li>
    
    <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
      <?php foreach ($breadcrumbs as $breadcrumb): ?>
        <li class="flex items-center">
          <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
          <?php if (isset($breadcrumb['url'])): ?>
            <a href="<?= esc($breadcrumb['url']) ?>" class="text-gray-500 hover:text-gray-700 transition-colors">
              <?= esc($breadcrumb['label']) ?>
            </a>
          <?php else: ?>
            <span class="text-gray-700 font-medium"><?= esc($breadcrumb['label']) ?></span>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    <?php elseif (isset($title) && $title !== 'Dashboard'): ?>
      <li class="flex items-center">
        <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
        <span class="text-gray-700 font-medium"><?= esc($title) ?></span>
      </li>
    <?php endif; ?>
  </ol>
</nav>