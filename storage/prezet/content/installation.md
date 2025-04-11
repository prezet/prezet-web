---
title: Prezet Installation Guide
excerpt: Learn how to install and set up Prezet, a powerful markdown blogging package for Laravel.
date: 2024-06-28
category: Getting Started
image: /prezet/img/ogimages/installation.jpg
author: benbjurstrom
---

This guide will walk you through the process of installing Prezet, a powerful markdown blogging framework for Laravel. Follow these steps to set up your project and start creating SEO-friendly blogs, articles, and documentation.

## Step 1: Install the Prezet Framework

Install the core Prezet framework package using Composer:

```bash
composer require prezet/prezet:^1.0.0@rc
```

## Step 2: Run the Framework Installer

Run the Prezet framework installer using the following Artisan command:

```bash
php artisan prezet:install
```

This command sets up the core Prezet functionality, including configuration and necessary service providers.

## Step 3: Install a Frontend Template

The Prezet framework provides the backend engine. You'll need to install a separate template package to provide the frontend (routes, controllers, views, CSS).

Here's an example using the Official Docs Template ([github.com/prezet/docs-template](https://github.com/prezet/docs-template)):

```bash
# Install the template package
composer require prezet/docs-template --dev

# Run the template's installer
php artisan docs-template:install
```

```html +parse
<x-prezet::alert
    type="warning"
    title="Existing Configuration Files"
    body="The template installer might overwrite existing files like vite.config.js and postcss.config.js. Ensure you have backups before proceeding if you have customized these files."
/>
```

## Step 4: Start Your Server

Once the installation is complete, you can start your Laravel development server:

```bash
php artisan serve
```

After starting your server, you can verify the installation by visiting:

[http://localhost:8000/prezet](http://localhost:8000/prezet)

You should now see your new markdown blog powered by Prezet!

## Step 5: Generate the SQLite Index
After installing Prezet and setting up your initial content, it's important to generate the SQLite index. Run the following Artisan command to create and populate the index:

```bash
php artisan prezet:index --fresh
```

For more information about the SQLite index and its purposes, refer to the [Prezet SQLite Index](/index) documentation.

## Next Steps

With Prezet installed, you're ready to start creating content and customizing your blog. Check out the other documentation pages to learn more about:

- [Writing markdown content](features/markdown)
- [Using Blade components in your markdown](features/blade)
- [Optimizing images](features/images)
- [Customizing routes](customize/routes), [front matter](customize/frontmatter), and more

Hope you enjoy blogging with Prezet!
