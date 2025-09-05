# SIEM Application Templating System

## Overview
This document describes the templating system implemented for the SIEM-CI4 application. The templating system breaks down the layout into modular, reusable components for better maintainability and code organization.

## Directory Structure

```
app/Views/
├── layout.php                 # Main layout file (uses partials)
├── layout_backup.php          # Backup of original layout
├── layout_templated.php       # Alternative templated layout
├── partials/                  # Template partials
│   ├── header.php             # HTML head and opening body
│   ├── sidebar.php            # Navigation sidebar
│   ├── navbar.php             # Top navigation bar
│   ├── content.php            # Content wrapper
│   └── footer.php             # JavaScript and closing tags
└── components/                # Reusable UI components
    ├── flash_messages.php     # Flash message alerts
    ├── breadcrumb.php         # Navigation breadcrumbs
    └── security_status.php    # Security status widget
```

## Template Partials

### 1. Header (`partials/header.php`)
Contains:
- HTML DOCTYPE and head section
- Meta tags and title
- CSS/JS includes (Tailwind, FontAwesome, Chart.js)
- Tailwind configuration
- Opening body tag and layout container

### 2. Sidebar (`partials/sidebar.php`)
Contains:
- Application logo and branding
- Security status dashboard widget
- Navigation menu with security operations
- Analysis & reporting sections
- Administration section (role-based)
- Sidebar footer with version info

### 3. Navbar (`partials/navbar.php`)
Contains:
- Mobile menu toggle
- Page title and breadcrumb
- Quick action buttons
- Security status indicator
- Notification bell
- User profile dropdown
- Flash message integration

### 4. Content (`partials/content.php`)
Contains:
- Main content wrapper
- Dynamic content section using CodeIgniter's renderSection

### 5. Footer (`partials/footer.php`)
Contains:
- Toast notification container
- Enhanced JavaScript functionality
- Profile dropdown logic
- Sidebar toggle functionality
- Flash message auto-hide
- Navigation highlighting
- Closing HTML tags

## Reusable Components

### 1. Flash Messages (`components/flash_messages.php`)
Handles all types of flash messages:
- Success messages (green)
- Error messages (red)
- Warning messages (yellow)
- Info messages (blue)

Features:
- Icons for each message type
- Dismissible with close button
- Consistent styling

### 2. Breadcrumb (`components/breadcrumb.php`)
Dynamic breadcrumb navigation:
- Supports custom breadcrumb arrays
- Falls back to page title
- Home icon and proper hierarchy
- Hover effects

### 3. Security Status (`components/security_status.php`)
Security dashboard widget:
- Critical incidents count
- Active alerts count
- Threat indicators
- Open cases count
- Supports dynamic data via `$security_stats` variable

## Usage Examples

### Basic Layout Usage
```php
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!-- Your page content here -->
<?= $this->endSection() ?>
```

### Using Components in Views
```php
<!-- Include flash messages -->
<?= $this->include('components/flash_messages') ?>

<!-- Include breadcrumb with custom data -->
<?php $breadcrumbs = [
    ['label' => 'Security', 'url' => '/security'],
    ['label' => 'Incidents'] // Current page (no URL)
]; ?>
<?= $this->include('components/breadcrumb') ?>

<!-- Include security status with data -->
<?php $security_stats = [
    'critical' => 5,
    'alerts' => 12,
    'threats' => 8,
    'cases' => 3
]; ?>
<?= $this->include('components/security_status') ?>
```

### Creating New Components
1. Create a new PHP file in `app/Views/components/`
2. Write reusable HTML/PHP code
3. Include it in views using `$this->include('components/component_name')`

Example component structure:
```php
<!-- Component Name -->
<div class="component-wrapper">
    <?php if (isset($component_data)): ?>
        <!-- Component content -->
    <?php endif; ?>
</div>
```

## Benefits

### Maintainability
- Single place to update header/footer across all pages
- Consistent navigation and branding
- Easy to modify global styles and scripts

### Reusability
- Components can be used across multiple views
- Consistent UI patterns
- Reduced code duplication

### Organization
- Clear separation of concerns
- Easier to find and edit specific sections
- Better team collaboration

### Performance
- Smaller individual files
- Better caching potential
- Easier to optimize specific sections

## Best Practices

### Component Design
1. Keep components focused on single responsibility
2. Use meaningful parameter names
3. Provide fallback values for missing data
4. Include proper documentation

### Data Passing
1. Pass data via controller variables
2. Use descriptive variable names
3. Validate data before using in components
4. Provide default values where appropriate

### File Organization
1. Use descriptive filenames
2. Group related components together
3. Follow consistent naming conventions
4. Keep components small and focused

## Migration from Original Layout

The original layout.php has been backed up as `layout_backup.php`. The new system maintains full compatibility with existing views while providing better organization and maintainability.

### What Changed
- Monolithic layout split into logical partials
- Flash messages extracted to reusable component
- Security status widget componentized
- JavaScript consolidated in footer partial
- CSS/JS includes centralized in header

### What Stayed the Same
- All existing functionality preserved
- Same responsive design and styling
- Compatible with all existing views
- Same performance characteristics

## Troubleshooting

### Common Issues
1. **Component not rendering**: Check file path and include syntax
2. **Missing data**: Ensure variables are passed from controller
3. **Styling issues**: Verify CSS classes in components
4. **JavaScript errors**: Check footer.php for script conflicts

### Debugging Tips
1. Use CodeIgniter's built-in error reporting
2. Check browser console for JavaScript errors
3. Verify file permissions for new directories
4. Test components individually before integration

## Future Enhancements

### Planned Components
- Data table component with sorting/filtering
- Modal dialog component
- Chart/graph components
- Form field components
- Pagination component

### Potential Improvements
- Component parameter validation
- Dynamic component loading
- Template inheritance system
- CSS/JS component bundling
- Component testing framework

---

**Note**: This templating system follows CodeIgniter 4 best practices and maintains compatibility with the existing SIEM application architecture.