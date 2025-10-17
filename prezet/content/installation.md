---
title: Prezet Installation Guide
excerpt: Learn how to install and set up Prezet, a powerful markdown blogging package for Laravel.
date: 2025-10-17
category: Getting Started
image: /prezet/img/ogimages/installation.jpg
author: benbjurstrom
---

This guide will walk you through the process of installing Prezet, a powerful markdown blogging framework for Laravel.

## Installation Steps

### 1: Install the Prezet Framework

Install the core Prezet framework package using Composer:

```bash
composer require prezet/prezet
```

### 2: Run the Framework Installer

Run the Prezet framework installer using the following Artisan command:

```bash
php artisan prezet:install
```

This command sets up the core Prezet functionality by:

1. Adding the `prezet` SQLite database connection to `config/database.php`
2. Creating the `prezet` storage disk in `config/filesystems.php`
3. Publishing the Prezet configuration file
4. Building the initial search index from your markdown content

```html +parse
<x-prezet::alert
    type="info"
    body="Note that the installer will not proceed if your git directory is not clean. Use `prezet:install --force` to bypass this restriciton."
/>
```

### 3: Install a Frontend Template

The Prezet framework provides the backend engine. You'll need to install a separate template package to provide the frontend (routes, controllers, views, CSS). These templates also provide some sample content to work with while setting things up.

Check out our official template packages:
- [prezet/docs-template](https://github.com/prezet/docs-template)
- [prezet/blog-template](https://github.com/prezet/blog-template)

```bash
# Install the template package
composer require prezet/blog-template --dev

# Run the template's installer
php artisan blog-template:install
```

```html +parse
<x-prezet::alert
    type="warning"
    title="Existing Configuration Files"
    body="The template installer might overwrite existing files like vite.config.js and postcss.config.js. Ensure you have backups before proceeding if you have customized these files."
/>
```

### 4: Start Your Server

Once the installation is complete, you can start your Laravel development server:

```bash
php artisan serve
```

After starting your server, you can verify the installation by visiting:

[http://localhost:8000/prezet](http://localhost:8000/prezet)

You should now see your new markdown blog powered by Prezet!

## Refreshing the SQLite Index
After installing Prezet and setting up your initial content, it's important to refresh the SQLite index by running the following command:

```bash
php artisan prezet:index --fresh
```

For more information about the SQLite index see the [Prezet Index](/index) documentation.

## Next Steps

Now that Prezet is installed, explore these topics:

**Content Creation:**
- [Markdown Features](/features/markdown) - Writing and formatting content
- [Blade Components](/features/blade) - Using Laravel components in markdown
- [Image Optimization](/features/images) - Responsive image handling

**Customization:**
- [Configuration](/configuration) - Adjust Prezet's behavior
- [Routes](/customize/routes) - Define custom URL patterns
- [Front Matter](/customize/frontmatter) - Add custom metadata fields
