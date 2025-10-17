---
title: Upgrading to 1.x
date: 2025-10-17
category: Getting Started
excerpt: Guide for upgrading from 1.0.0-rc releases to the stable 1.x version.
image: /prezet/img/ogimages/getting-started-upgrading.webp
author: benbjurstrom
---

This guide covers the main breaking changes when upgrading from release candidate versions (1.0.0-rcx) to the stable 1.x release. For a complete list of changes, see the [v1.0.0 release notes](https://github.com/prezet/prezet/releases/tag/v1.0.0).

## Major Changes

The 1.0.0 release includes several significant improvements:

- **Controllers moved to userspace** - Full customization control (#184)
- **Template packages separated** - Frontend now lives in template packages (#189)
- **SEO package removed** - Built-in SEO service replaces dependency (#180)
- **Service container integration** - Actions, models, and data classes resolved via container (#141, #146, #165)
- **Laravel 12 support** - Compatible with the latest Laravel version (#182)
- **Namespace update** - Package namespace changed from `BenBjurstrom\Prezet` to `Prezet\Prezet` (#191)
- **Command flag renamed** - `--force` flag changed to `--fresh` (#130)

## Update Composer

Update the Prezet package:

```bash
composer require prezet/prezet:^1.0
```

## Update Namespace References

The package namespace changed from `BenBjurstrom\Prezet` to `Prezet\Prezet`. Update any references in your application:

```php
// Before
use BenBjurstrom\Prezet\Data\FrontmatterData;
use BenBjurstrom\Prezet\Actions\UpdateIndex;

// After
use Prezet\Prezet\Data\FrontmatterData;
use Prezet\Prezet\Actions\UpdateIndex;
```

## Move Controllers to Userspace

Controllers are no longer provided by the package. Copy them from a template package to your application:

- [Blog Template Controllers](https://github.com/prezet/blog-template/tree/main/app/Http/Controllers/Prezet)
- [Docs Template Controllers](https://github.com/prezet/docs-template/tree/main/app/Http/Controllers/Prezet)

Place them in: `app/Http/Controllers/Prezet/`

Then update `routes/prezet.php` to reference your controllers:

```php
// Before
use Prezet\Prezet\Http\Controllers\ShowController;

// After
use App\Http\Controllers\Prezet\ShowController;

Route::get('/{slug}', ShowController::class)->name('prezet.show');
```

## Update Meta Component

The SEO package dependency was removed. You'll need to add the meta component from a template package.

Copy `resources/views/components/prezet/meta.blade.php` from either:
- [Blog Template](https://github.com/prezet/blog-template/tree/main/resources/views/components/prezet)
- [Docs Template](https://github.com/prezet/docs-template/tree/main/resources/views/components/prezet)

Place it in: `resources/views/components/prezet/meta.blade.php`

## General Troubleshooting

If you encounter missing files or components:

1. Compare your application with the latest template packages:
   - [prezet/blog-template](https://github.com/prezet/blog-template)
   - [prezet/docs-template](https://github.com/prezet/docs-template)

2. Copy any missing files from the templates to your application

3. If you encounter issues not covered here, please [open an issue](https://github.com/prezet/prezet/issues) with details about your upgrade path

## Need Help?

This guide covers the most common upgrade issues. Since every installation may have customizations, your experience may vary. If you run into problems:

- Check the template packages for reference implementations
- Open an issue on GitHub with your specific error
- Join the discussion on the Prezet repository

The template packages represent the canonical setup and are the best reference when troubleshooting upgrade issues.
