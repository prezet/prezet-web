---
title: Understanding Prezet's Configuration File
excerpt: Learn how to install the package's configration file
date: 2024-06-27
category: Getting Started
image: /prezet/img/ogimages/configuration.webp
legacy: true
author: benbjurstrom
---

The configuration file is published as part of the package's installation command, but it can be manually published by running the following command:

```bash
php artisan vendor:publish --provider="BenBjurstrom\Prezet\PrezetServiceProvider" --tag=prezet-config
```

After installation the configuration file will look like this:

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
    | Data Classes
    |--------------------------------------------------------------------------
    |
    | These classes are used to store markdown information in a Validated DTO.
    | You can override the default classes with your own and configure Pezet to
    | use them here.
    |
    */

    'data' => [
        'frontmatter' => BenBjurstrom\Prezet\Data\FrontmatterData::class,
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
            BenBjurstrom\Prezet\Extensions\MarkdownBladeExtension::class,
            BenBjurstrom\Prezet\Extensions\MarkdownImageExtension::class,
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

];
```

## Filesystem Configuration

The `filesystem.disk` key allows you to specify the disk where your markdown files are stored. By default, Prezet uses the `prezet` disk. You can change this by updating the `PREZET_FILESYSTEM_DISK` environment variable in your `.env` file.

## Data Classes

These classes are used to store markdown information in a validated DTO. You can override the default classes here. For example:

```php
'data' => [
    'frontmatter' => BenBjurstrom\Prezet\Data\FrontmatterData::class,
],
```

The `frontmatter` key links to the package's FrontmatterData class. If you want to override it, you would create your own front matter class, add the additional properties that you want, and then update the config file to use that class for the front matter.

To learn more about customizing front matter, see the [Customizing Front Matter](customize/frontmatter) article. If you want to learn more about how Prezet uses front matter, check out the [Front Matter Features](features/frontmatter) article.

## CommonMark Configuration

Here we can configure the CommonMark parser and specify its extensions:

```php
'commonmark' => [
    'extensions' => [
        League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
        League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
        League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
        BenBjurstrom\Prezet\Extensions\MarkdownBladeExtension::class,
        BenBjurstrom\Prezet\Extensions\MarkdownImageExtension::class,
    ],
    // ... config options
],
```

The included extensions are:

1. **CommonMarkCoreExtension**: Provides core CommonMark functionality.
2. **FrontMatterExtension**: Pulls the front matter from a markdown post for processing and SEO tag generation.
3. **HeadingPermalinkExtension**: Creates linkable headings in the body of the markdown content.
4. **MarkdownBladeExtension**: A custom extension that allows you to include Blade components in your markdown files. To learn more about this feature see the documentation on using [Blade Components in Markdown](features/blade).

5. **MarkdownImageExtension**: A custom extension that replaces single image tags with a set of optimized images using srcset. For more information, see the [Optimized Images](features/images) documentation.

### HeadingPermalinkExtension Options

The configuration also includes options for the HeadingPermalinkExtension:

```php
'config' => [
    'heading_permalink' => [
        'html_class' => 'mr-2 scroll-mt-12',
        'id_prefix' => 'content',
        'apply_id_to_heading' => false,
        'heading_class' => '',
        'fragment_prefix' => 'content',
        'insert' => 'before',
        'min_heading_level' => 2,
        'max_heading_level' => 3,
        'title' => 'Permalink',
        'symbol' => '#',
        'aria_hidden' => true,
    ],
],
```

These options control how heading permalinks are generated and styled in the rendered HTML.

## Image Optimization

The last section of the configuration file deals with image optimization settings:

```php
'image' => [
    'widths' => [
        480, 640, 768, 960, 1536,
    ],
    'sizes' => '92vw, (max-width: 1024px) 92vw, 768px',
],
```

- `widths`: Specifies the widths to be used in the srcset for responsive images.
- `sizes`: Provides the sizes attribute to be included in the image tag in your final HTML markup.

For more information on how Prezet optimizes images, see the [Optimized Images](features/images) article.

## Additional Customizations

Prezet offers various customization options beyond the configuration file. Here are some additional resources for customizing different aspects of Prezet:

- [Customizing Routes](customize/routes)
- [Customizing Blade Views](customize/blade-views)
- [Customizing Controllers](customize/controllers)

These articles will guide you through the process of tailoring Prezet to your specific needs.
