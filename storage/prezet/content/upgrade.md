---
title: Prezet Upgrade Guide
excerpt: Update your Prezet installation from v0.x to v1.0.0, and review important configuration changes, new classes, and updated Blade templates.
date: 2025-01-26
category: Getting Started
image: /prezet/img/ogimages/upgrade.webp
author: benbjurstrom
---

This guide covers upgrading your Prezet installation from **v0.21.1** to **v1.0.0**. Below you'll find all of the breaking changes, added features, and best practices for adopting the new release.

## 1. Update Your Composer Dependency

Run the following command to require **v1.0.0-rc1** (or the stable v1.0.0 version, once available):

```bash
composer require benbjurstrom/prezet:1.0.0-rc2 --with-all-dependencies
```

## 2. Re-Publish The Prezet Configuration File

Significant changes were introduced in the `prezet.php` config file:

```bash
php artisan vendor:publish --tag="prezet-config"
```

Compare any local modifications (like a custom filesystem disk or front matter classes) with the newly published file. In particular, notice that `document` was added to the `data` array, referencing the newly introduced `DocumentData` class. The `'authors'` and `'publisher'` arrays were also added to handle JSON-LD metadata. You can find the complete config here: [github.com/benbjurstrom/prezet/../config/prezet.php](https://github.com/benbjurstrom/prezet/blob/main/config/prezet.php)

## 3. Refresh the SQLite Index

Run the upgraded index command with the new `--fresh` flag to ensure your database is recreated and migrations are applied before repopulating:

```bash
php artisan prezet:index --fresh
```

This regenerates the `prezet.sqlite` file with an updated schema that includes:
- New `key` field for optional unique identifiers
- Unique constraints on `slug`, `filepath`, and `hash` fields
- Optimized indexes for better query performance
- Updated timestamp fields to use timestampTz

## 4. Update Blade Templates

During installation, Prezet published Blade templates to your `resources/views/vendor/prezet` directory. Version **v1.0.0** changes how data is passed to these views:

1. **`article.blade.php`**
    - The `$article` variable is now a `DocumentData` object instead of a `FrontmatterData` object.
    - Access properties like `$article->frontmatter->title` instead of `$article->title`.

2. **`show.blade.php`**
    - Front matter is now accessed via `$document->frontmatter` (an instance of `FrontmatterData`) rather than `$frontmatter`.
    - A new stack named `jsonld` was added to include JSON-LD. You can see this in the updated file as:
      ```php
      @push('jsonld')
          <script type="application/ld+json">{!! $linkedData !!}</script>
      @endpush
      ```
3. **`template.blade.php`**
    - Includes the new `@stack('jsonld')` for injecting structured data from `show.blade.php`.

You can review the latest versions of these templates in [the Prezet repository](https://github.com/benbjurstrom/prezet/blob/main/resources/views/components/).

## 5. Changes To Action Classes

All action classes (e.g., `ParseMarkdown`, `GetImage`, `UpdateIndex`) are now non-static and are resolved through the **Prezet facade**. If you were directly invoking static methods on action classes in your app, please update them to the new approach:

```php
// Old
$parsed = ParseMarkdown::handle($md);

// New
$parsed = Prezet::parseMarkdown($md);
```

This update simplifies custom overrides by letting you bind your own action classes in the service container.

## 6. FrontmatterData & DocumentData Changes

- **FrontmatterData** changes:
  - No longer includes `$hash`, `$createdAt`, or `$updatedAt`
  - Added `$slug` and `$key` as nullable properties
  - `$date` is now required, representing the published date
  - `$author` is nullable for referencing site authors
  - `$tags` is now an array property

- **DocumentData** is introduced to handle:
  - System fields: `id`, `filepath`, `hash`, `createdAt`, `updatedAt`
  - URL fields: `slug`, `key`
  - Content flags: `category`, `draft`
  - Wraps `FrontmatterData` in the `$document->frontmatter` property

- The FrontmatterData class has been removed from the config. If you need to override the default class you can do so by binding your custom `FrontmatterData` class in the service container.

## 7. PostCSS & Tailwind

- The stubbed `postcss.config.js` file was removed, and a simpler approach using Tailwind 4's "just-in-time" features is now favored.
- If you previously installed Tailwind 3.x, you're not forced to upgrade. However, the new defaults rely on [@tailwindcss/vite](https://www.npmjs.com/package/@tailwindcss/vite) instead of separate PostCSS plugins.
- See [Tailwind's official upgrade guide](https://tailwindcss.com/docs/upgrade-guide) for more details on transitioning from older versions if you wish to align with Prezet's new stubs.

## 8. Additional Command Changes
- `prezet:install` command now checks for a clean Git repository unless you use `--force`.
- `prezet:install` prezet will be configured for tailwind v3.x if you use `--tailwind3`.
- `prezet:index` replaced `--force` with `--fresh`.
- `prezet:bref` was removed.
- `prezet:ogimage` now accepts a slug for example `prezet:ogimage my-blog-post`
