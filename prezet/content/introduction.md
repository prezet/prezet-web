---
title: "Prezet: Markdown Blogging for Laravel"
date: 2025-10-17
category: Getting Started
excerpt: Transform your markdown files into SEO-friendly blogs, articles, and documentation!
image: https://prezet.com/ogimage.png
author: benbjurstrom
content_type: index
---

Prezet is a markdown blogging framework for Laravel that transforms your markdown files into SEO-friendly blogs, articles, and documentation. It provides a powerful backend engine for parsing, indexing, and serving markdown content efficiently.

## Framework Architecture

Prezet uses a two-part architecture:

**Framework Package** (`prezet/prezet`): The core engine that handles markdown parsing, content indexing, image optimization, and SEO features. This is the foundation that powers your content.

**Template Packages**: Separate packages that provide the frontend implementation (routes, controllers, views, CSS). Choose a template that matches your use case:
- [prezet/docs-template](https://github.com/prezet/docs-template) - Documentation sites
- [prezet/blog-template](https://github.com/prezet/blog-template) - Blog sites

This separation allows you to swap templates or create custom frontends while using the same powerful backend.

## Key Features

**SQLite Index**: Indexes your markdown files to support search, pagination, sorting, and filtering. Uses MD5 hashing for efficient change detection.

**Automatic Image Optimization**: Handles image processing, including compression, scaling, and generating responsive `srcset` attributes for fast-loading pages.

**Validated Front Matter**: Define expected front matter fields and automatically cast them into validated Data Transfer Objects (DTOs) for type-safe access in your application.

**Open Graph Images**: Generate dynamic OG images from front matter using a customizable template for better social media sharing.

**Dynamic Table of Contents**: Automatically extracts headings from your markdown content to generate data for a nested table of contents.

**SEO Optimization**: Automatically generate meta tags, JSON-LD structured data, and sitemaps based on front matter for better search engine discoverability.

**Blade Components**: Include Laravel Blade components directly in your markdown for enriched, interactive content.

## Quick Start

Get started with Prezet in three steps:

```bash
# 1. Install the framework
composer require prezet/prezet
php artisan prezet:install

# 2. Install a template (example: docs template)
composer require prezet/docs-template --dev
php artisan docs-template:install

# 3. Index your content
php artisan prezet:index --fresh
```

Start your server and visit `/prezet` to see your markdown content live:

```bash
php artisan serve
```

## How It Works

1. **Create markdown files** in your `prezet/content` directory with YAML front matter
2. **Run the indexer** to parse front matter and build the SQLite search index
3. **Prezet routes** serve your content with automatic SEO, image optimization, and caching
4. **Body content** is parsed on-demand when viewing individual pages (no indexing required)

The index tracks file changes using MD5 hashes, so subsequent updates only process changed files. Delete files from your filesystem and the index automatically cleans up database records.

## Next Steps

Ready to dive deeper? Explore these topics:

**Getting Started:**
- [Installation](/installation) - Complete installation guide
- [Configuration](/configuration) - Configure Prezet for your project
- [Content Management](/content) - Organize your markdown files

**Features:**
- [Front Matter](/features/frontmatter) - Understanding metadata
- [Image Optimization](/features/images) - Responsive image handling
- [SEO Features](/features/seo) - Meta tags and structured data
- [Syntax Highlighting](/features/syntax-highlighting) - Beautiful code blocks

**Customization:**
- [Custom Templates](/customize/templates) - Build your own frontend
- [Routes](/customize/routes) - Define custom URL patterns
- [Front Matter Fields](/customize/frontmatter) - Add custom metadata
