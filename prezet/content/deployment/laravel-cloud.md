---
title: Deploying to Laravel Cloud
date: 2025-10-17
category: Deployment
excerpt: Learn how to deploy your Prezet site to Laravel Cloud with custom build commands.
image: /prezet/img/ogimages/deployment-laravel-cloud.webp
author: benbjurstrom
---

Laravel Cloud provides a simple deployment platform for Laravel applications. This documentation site is hosted on Laravel Cloud, demonstrating how well Prezet works with the platform.

## Custom Build Commands

When deploying to Laravel Cloud, you'll need to add custom build commands to create the SQLite database and build the search index.

In your Laravel Cloud project settings, add these custom build commands:

```bash
touch ./database/database.sqlite
php artisan prezet:index --fresh
```

These commands:
1. Create an empty SQLite database file
2. Build the Prezet search index from your markdown content

![Custom Build Commands](laravel-cloud-20251017161847794.webp)

## Container Hibernation with Cloudflare

Laravel Cloud can hibernate containers when they're not in use to save costs. You can leverage Cloudflare's cache to serve your static content while keeping your container hibernated.

When a request hits Cloudflare's cache, your content is served instantly without waking the Laravel Cloud container. Only cache misses or dynamic requests will wake the container.

This approach provides:
- Fast content delivery via Cloudflare's CDN
- Lower costs through container hibernation
- On-demand scaling when needed

See the [Cloudflare Cache guide](/deployment/cloudflare) for detailed setup instructions on configuring Cloudflare to cache your Prezet content.