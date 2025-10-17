---
title: Prezet Configuration File
excerpt: Learn how to customize the Prezet configuration file to control markdown parsing, slug generation, image optimization, and more.
date: 2025-10-17
category: Getting Started
image: /prezet/img/ogimages/configuration.webp
author: benbjurstrom
---

Prezet's configuration file controls how your markdown content is parsed, displayed, and optimized. This guide walks you through each configuration section and shows you how to customize Prezet to fit your needs.

## Publishing the Config File

The configuration file is published automatically during installation, but you can manually publish it instead by running:

```bash
php artisan vendor:publish --provider="Prezet\Prezet\PrezetServiceProvider" --tag=prezet-config
```

This creates `config/prezet.php` in your project with the following structure:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Filesystem Configuration
    |--------------------------------------------------------------------------
    |
    | This setting determines the filesystem disk used by Prezet to store and
    | retrieve markdown files and images. By default, it uses the 'prezet' disk.
    |
    */

    'filesystem' => [
        'disk' => env('PREZET_FILESYSTEM_DISK', 'prezet'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Slug Configuration
    |--------------------------------------------------------------------------
    |
    | Configure how document slugs are generated. The source can be 'filepath'
    | or 'title'. Note that a slug defined in front matter will take precedence
    | over the generated slug. When 'keyed' is true, the key present in the
    | front matter key will be appended to the slug (e.g., my-post-123).
    |
    */

    'slug' => [
        'source' => 'filepath', // 'filepath' or 'title'
        'keyed' => false, // 'true' or 'false'
    ],

    /*
    |--------------------------------------------------------------------------
    | CommonMark
    |--------------------------------------------------------------------------
    |
    | Configure the CommonMark Markdown parser. You can specify the extensions
    | to be used and their configuration. Extensions are added in the order
    | they are listed.
    |
    */

    'commonmark' => [

        'extensions' => [
            League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
            League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
            League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
            League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
            Prezet\Prezet\Extensions\MarkdownBladeExtension::class,
            Prezet\Prezet\Extensions\MarkdownImageExtension::class,
            Phiki\CommonMark\PhikiExtension::class,
        ],

        'config' => [
            'heading_permalink' => [
                'html_class' => 'prezet-heading',
                'id_prefix' => 'content',
                'apply_id_to_heading' => false,
                'heading_class' => '',
                'fragment_prefix' => 'content',
                'insert' => 'before',
                'min_heading_level' => 2,
                'max_heading_level' => 3,
                'title' => 'Permalink',
                'symbol' => '#',
                'aria_hidden' => false,
            ],
            'external_link' => [
                'internal_hosts' => 'www.example.com', // Don't forget to set this!
                'open_in_new_window' => true,
                'html_class' => 'external-link',
                'nofollow' => 'external',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
            'phiki' => [
                'theme' => \Phiki\Theme\Theme::NightOwl,
                'with_wrapper' => false,
                'with_gutter' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Images
    |--------------------------------------------------------------------------
    |
    | Configure how image tags are handled when converting from markdown.
    |
    | 'widths' defines the various widths for responsive images.
    | 'sizes' indicates the sizes attribute for responsive images.
    | 'zoomable' determines if images are zoomable.
    */

    'image' => [

        'widths' => [
            480, 640, 768, 960, 1536,
        ],

        'sizes' => '92vw, (max-width: 1024px) 92vw, 768px',

        'zoomable' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    | The sitemap origin is used to generate absolute URLs for the sitemap.
    | An origin consists of a scheme/host/port combination, but no path.
    | (e.g., https://example.com:8000) https://www.rfc-editor.org/rfc/rfc6454
    */

    'sitemap' => [
        'origin' => env('PREZET_SITEMAP_ORIGIN', env('APP_URL')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Structured Data
    |--------------------------------------------------------------------------
    |
    | Prezet uses these values for JSON-LD structured data. 'authors' defines
    | named authors you can reference in front matter, and 'publisher' is used
    | as the default publisher for all content.
    |
    */

    // https://schema.org/author
    'authors' => [
        'prezet' => [
            '@type' => 'Person',
            'name' => 'Prezet Author',
            'url' => 'https://prezet.com',
            'image' => 'https://prezet.com/favicon.svg',
        ],
    ],

    // https://schema.org/publisher
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Prezet',
        'url' => 'https://prezet.com',
        'logo' => 'https://prezet.com/favicon.svg',
        'image' => 'https://prezet.com/ogimage.png',
    ],
];
```

## Configuration Sections

### Filesystem

By default, Prezet uses the `prezet` disk for locating markdown files and images. You can change this by editing the `filesystem.disk` value in the config file

Note that the disk configuration itself lives in `config/filesystems.php`, where you can specify whether to use local storage, S3, or another driver.

### Slug Generation

Control how document URLs are automatically generated. Note that a `slug` defined in a file's frontmatter will always override the generated slug.

**Source**:
Choose how the base slug is generated:
- `filepath` - Uses the markdown file's path (default)
- `title` - Uses the document's title from frontmatter

**Keyed**:
When `true`, enables self-healing links. Static key values will be added to your frontmatter and appended to slugs (e.g., `my-post-a1b2c3d4`). See [Self-Healing Links](/features/self-healing-links) for details.

### Markdown Parsing

Prezet uses [league/commonmark](https://commonmark.thephpleague.com/) for markdown parsing. In the `commonmark` array, you can define the **extensions** array to add or remove functionality or provide a `config` array with per-extension options.

#### Heading Permalinks

The [`HeadingPermalinkExtension`](https://commonmark.thephpleague.com/2.7/extensions/heading-permalinks/) automatically generates anchor links for headings. Configure the heading levels, permalink symbol, CSS classes, and link placement.

#### External Links

The [`ExternalLinkExtension`](https://commonmark.thephpleague.com/2.7/extensions/external-links/) adds attributes like `target="_blank"` and `rel="noopener"` to external links. Set `internal_hosts` to your domain so Prezet can distinguish internal from external links.

#### Syntax Highlighting

The `PhikiExtension` provides server-side syntax highlighting with configurable themes and line number gutters. See [Syntax Highlighting](/features/syntax-highlighting) for details.

### Images

Control how markdown images are transformed for responsive delivery:

- **`widths`** - Array of widths for generating `srcset` attributes
- **`sizes`** - The `sizes` attribute for responsive images
- **`zoomable`** - Enable click-to-zoom functionality with Alpine.js

See [Optimized Images](/features/images) for more details on responsive image generation.

### Structured Data

Prezet automatically includes [JSON-LD](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data) metadata for better search engine and social media visibility:

- **`authors`** - Map author keys from frontmatter to schema.org Person objects
- **`publisher`** - Default publisher metadata for all content

See [JSON-LD documentation](/features/jsonld) for implementation details.

## Further Customization

Beyond the configuration file, you can customize:

- [Routes](/customize/routes) - Define custom URL patterns
- [Blade Views](/customize/blade-views) - Customize templates and layouts
- [Controllers](/customize/controllers) - Override default behavior
- [Front Matter](/customize/frontmatter) - Add custom metadata fields
