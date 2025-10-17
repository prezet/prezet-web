---
title: Prezet Content Directory
date: 2025-10-17
category: Getting Started
excerpt: Learn about the Prezet content folder structure and how to configure its location.
image: /prezet/img/ogimages/features-markdown.webp
author: benbjurstrom
slug: content
---

Prezet reads markdown files, images, and metadata from the `prezet` filesystem disk configured in `config/filesystems.php`. By default, the `prezet` disk uses the `local` driver with its root set to the `prezet` directory in your application's base path, but you can configure it to use any supported Laravel storage driver.

## Directory Structure

When you install a [Prezet template](/features/templates), some example content will be added to the `prezet` directory to get you familiar with the expected structure. An example of that content might look like this:

```bash
prezet/
├── content/
│   ├── installation.md
│   ├── configuration.md
│   └── features/
│       └── frontmatter.md
├── images/
│   ├── example-20240509210223449.webp
│   └── ogimages/
│       └── ...
└── SUMMARY.md
```

### content/

Contains your markdown files organized in subdirectories. Each markdown file includes [front matter](/features/frontmatter) and content that's converted to HTML when rendered.

You can organize content in any directory structure. File paths determine the default URL slugs. For example, `content/features/frontmatter.md` would be accessible at `/features/frontmatter`.

### images/

Stores images referenced in your markdown files. When you reference an image, Prezet automatically serves it through the [Image Controller](/features/images) for optimization.

The `ogimages/` subdirectory contains Open Graph images. Learn more about [OG Image Generation](/features/ogimage).

### SUMMARY.md

Defines the navigation structure. Controls the order and organization of content in your template's navigation (sidebar, menu, etc.).

Format:
```markdown
## Section Title
- [Page Title](content/page-name)
- [Another Page](content/folder/page-name)
```

See the [SUMMARY.md documentation](#) for more details.

## Changing the Folder Location

The content folder location is configured in `config/filesystems.php`:

```php
'disks' => [
    'prezet' => [
        'driver' => 'local',
        'root' => base_path('prezet'),
    ],
],
```
