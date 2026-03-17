<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'SIEM Platform') ?></title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Enhanced Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/enhanced-style.css') ?>">
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class', // Enable class-based dark mode
      theme: {
        extend: {
          colors: {
            siem: {
              primary: '#4f46e5', // Indigo 600
              accent: '#8b5cf6', // Purple 500
              darkbg: '#0f172a', // Slate 900
              darkcard: '#1e293b', // Slate 800
              darkborder: '#334155', // Slate 700
            }
          }
        }
      }
    }
  </script>
  <script>
    // System Theme Initialization to prevent Flash of Unstyled Content (FOUC)
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>
</head>
<body class="bg-gray-50 dark:bg-siem-darkbg min-h-screen flex flex-col transition-colors duration-300 text-gray-900 dark:text-gray-200">
