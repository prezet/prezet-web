---
title: Caching with Cloudflare
excerpt: Learn how to use Cloudflare to cache your Prezet content for improved performance.
date: 2024-07-01
category: Deployment
image: /prezet/img/ogimages/deployment-cloudflare.webp
author: benbjurstrom
---

Prezet works seamlessly with Cloudflare to provide powerful caching capabilities, allowing you to achieve static-site-like performance while maintaining the flexibility of a dynamic Laravel application.

## Why Edge-Only Caching

We rely on Cloudflare's Edge TTL instead of cache control headers to avoid client-side caching issues. When browsers cache pages, they might reference CSS or JavaScript files that no longer exist after deployment. Since there's no way to invalidate browser caches on demand, this can break your site until the cache expires.

By using Edge TTL only, you maintain total control over cache invalidation through Cloudflare's API.

## Setup

Configure Cloudflare to cache your content:

1. Log into your Cloudflare dashboard and select your domain
2. Navigate to "Caching" > "Cache Rules" and click "Create cache rule"
3. Configure the rule:

**Rule name:** Cache Prezet Content

**When incoming requests match:**
- "All incoming requests" if your entire site is static
- "Custom filter expression" if serving dynamic content alongside Prezet

**Cache eligibility:** Eligible for cache

**Edge TTL:** Ignore cache-control header and use this TTL
- Set a longer duration (you can purge anytime)

4. Click "Save" to activate the rule

You can purge the cache manually from the Cloudflare dashboard or use the built-in Prezet command.

## Cache Purging

Prezet provides a command to purge your Cloudflare cache when deploying new content:

```bash
php artisan prezet:purge
```

### Configuration

Add to `config/services.php`:

```php
'cloudflare' => [
    'token' => env('CLOUDFLARE_TOKEN'),
    'zone_id' => env('CLOUDFLARE_ZONE_ID'),
],
```

Add to `.env`:

```bash
CLOUDFLARE_TOKEN=your_cloudflare_api_token
CLOUDFLARE_ZONE_ID=your_cloudflare_zone_id
```

The `CLOUDFLARE_ZONE_ID` is an MD5 hash found in the Cloudflare dashboard, not your domain name.

### Creating an API Token

1. Log into your Cloudflare dashboard
2. Go to "My Profile" > "API Tokens"
3. Click "Create Token"
4. Click "Get Started" next to Custom Token
5. Configure:
   - **Token name:** Purge cache for [your domain]
   - **Permissions:** Zone - Cache Purge - Purge
   - **Zone Resources:** Include - Specific zone - [Your domain]
6. Complete creation and copy the token

Use this token as `CLOUDFLARE_TOKEN` in your `.env` file.

## Automated Purging

Integrate `prezet:purge` into your deployment process to automatically clear the cache when deploying new content.

### GitHub Actions

If using GitHub Actions, you can use [jakejarvis/cloudflare-purge-action](https://github.com/jakejarvis/cloudflare-purge-action). This documentation site uses that action in its deployment pipeline - see our [GitHub workflow](https://github.com/prezet/prezet-web/blob/main/.github/workflows/main.yml#L57).

## Credits

This feature was inspired by Aaron Francis's video on serving static content with Laravel:

```html +parse
<x-prezet::youtube videoid="QiocnnlcXIU" title="SSG is dead. Long live cache." date="2023-11-08T12:00:00+08:00">
    Login
</x-prezet::youtube>
```
