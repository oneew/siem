<?= $this->include('partials/header') ?>

<div class="admin-layout">
  <?= $this->include('partials/sidebar') ?>

  <div class="main-content flex-1 flex flex-col overflow-x-hidden">
    <?= $this->include('partials/navbar') ?>

    <div class="flex-1 bg-gray-50 mt-0">
      <?= $this->include('partials/content') ?>
    </div>

    <!-- The footer includes scripts and </body>.
         We must close the wrappers BEFORE </body> inside footer, OR we close them here and let footer NOT render </body> -->
    <?= $this->include('partials/footer') ?>