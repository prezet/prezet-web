---
title: Automated Sitemap Generation
date: 2025-10-17
category: Features
excerpt: Automatically generate sitemaps for your Prezet-powered blog.
image: /prezet/img/ogimages/features-sitemap.webp
author: benbjurstrom
---

Prezet automatically generates XML sitemaps using a lightweight fork of the [Spatie sitemap package](https://github.com/benbjurstrom/laravel-sitemap-lite).

## How It Works

The sitemap is automatically generated whenever you run:

```bash
php artisan prezet:index
```

This creates or updates `prezet_sitemap.xml` in your `public` directory, ensuring your sitemap always reflects the current state of your content.

## Configuration

### APP_URL Setting

The sitemap hostname is determined by the `APP_URL` in your `.env` file. Set this to your production hostname before generating the sitemap for your live site. 

### Sitemap Index

You can submit `prezet_sitemap.xml` directly to Google Search Console, or include it in a main sitemap index:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>https://example.com/prezet_sitemap.xml</loc>
  </sitemap>
  <!-- Other sitemaps... -->
</sitemapindex>
```

## Customization

Sitemap generation is handled by the `UpdateSitemapCommand` class. To customize the process (change frequency, priority, video sitemaps, etc.), modify this class.

For advanced options, see the [Spatie sitemap package documentation](https://github.com/spatie/laravel-sitemap).
