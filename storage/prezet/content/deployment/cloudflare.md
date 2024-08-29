---
title: Optimize Your Laravel Blog with Cloudflare Cache
excerpt: Learn how to use Cloudflare to cache your Prezet-generated HTML pages for improved performance.
slug: cloudflare
date: 2024-07-01
category: Deployment
image: /prezet/img/ogimages/deployment-cloudflare.webp
---

Prezet integrates seamlessly with services like Cloudflare to provide powerful caching capabilities, allowing you to achieve static-site-like performance with the flexibility of a dynamic Laravel application. This guide will walk you through setting up and optimizing Cloudflare caching for your Prezet-powered site.

## Client-Side Caching Issues

Previously, we recommended adding cache control middleware to your routes to signal to cloudflare which routes in your application should be cached. 

However, this approach enables client-side caching which can lead to unexpected issues. For example, a page that's cached in the user's browser might reference a css file that no longer exists. Since there's no way to invalidate the browser's cache on demand the only option would be to change the page's url or wait until the cache expires.

To prevent this, we'll forgo the cache control middleware and rely on Cloudflare's Edge TTL only, giving us total control over cache invalidation.

## Setting Up Cloudflare for Caching

To configure Cloudflare to cache your Prezet site's content:

1. Log into your Cloudflare dashboard and select your domain.
2. Navigate to "Caching" > "Cache Rules" and click "Create cache rule".
3. Configure the rule with these settings:
    - **Rule name:** 
      - "Cache Prezet Content"
    - **When incoming requests match…**
      - Choose either "All incoming requests" if your entire site is semi-static or "Custom filter expression" if you're serving dynamic content alongside Prezet. If you choose the latter, you can specify a path or URL pattern to match the Prezet content.
    - **Cache eligibility:**
      - "Eligible for cache"
    - **Edge TTL:**
      - "Ignore cache-control header and use this TTL". Feel free to set the TTL to a longer duration since you can always manually purge the cache when needed.
4. Click "Save" to activate the rule.

With these settings, Cloudflare will cache your Prezet content for the specified duration. You can always purge the cache manually from the Cloudflare dashboard or use the built-in Prezet command to invalidate the cache when you make updates.

## Purging the Cache

When you deploy new content or make significant changes to your site, you'll want to purge the Cloudflare cache to ensure visitors can see the latest version. Prezet provides a built-in command for this purpose. You can integrate this into your deployment process to ensure the cache is purged whenever you push new content. 

Note that you can also manually purge the cache through the Cloudflare dashboard.

### Prezet Purge Command

```bash
php artisan prezet:purge
```

This command will clear your entire Cloudflare cache for the specified zone. To use it, follow these steps:

1. Add the following to your `config/services.php` file:

```php
'cloudflare' => [
    'token' => env('CLOUDFLARE_TOKEN'),
    'zone_id' => env('CLOUDFLARE_ZONE_ID'),
],
```

2. Add these environment variables to your `.env` file:

```bash
CLOUDFLARE_TOKEN=your_cloudflare_api_token
CLOUDFLARE_ZONE_ID=your_cloudflare_zone_id
```

Note: The `CLOUDFLARE_ZONE_ID` is an MD5 hash, not your domain name. You can find it in the Cloudflare dashboard.


### Creating a Cloudflare API Token

To use the Prezet purge command, you need to create a Cloudflare API token with the correct permissions. Here's how:

1. Log into your Cloudflare dashboard.
2. Go to "My Profile" > "API Tokens".
3. Click "Create Token".
4. Click the Get Started located next to Custom Token
5. Use the following settings:
    - Token name: "Purge cache for (your domain name)"
    - Permissions:
        - Zone - Cache Purge - Purge
    - Zone Resources:
        - Include - Specific zone - Your domain
6. Complete the token creation process and copy the generated token.

This token should be used as the `CLOUDFLARE_TOKEN` in your `.env` file.


## Purging the Cache

When you deploy new content or make significant changes to your site, you'll want to purge the Cloudflare cache to ensure visitors can see the latest version. You can do this manually through the Cloudflare dashboard or automate it as part of your deployment process.

To automate cache purging, you can use Cloudflare's API. Here's an example of how you might implement this in a Laravel command:

```php
use Illuminate\Support\Facades\Http;

public function handle()
{
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.cloudflare.api_token'),
        'Content-Type' => 'application/json',
    ])->post("https://api.cloudflare.com/client/v4/zones/" . config('services.cloudflare.zone_id') . "/purge_cache", [
        'purge_everything' => true
    ]);

    if ($response->successful()) {
        $this->info('Cloudflare cache purged successfully.');
    } else {
        $this->error('Failed to purge Cloudflare cache.');
    }
}
```

You can then call this command as part of your deployment process, ensuring that the cache is purged whenever you push new content.

## Benefits of Cloudflare Caching with Prezet

By combining Prezet with Cloudflare caching, you can achieve several benefits:

1. **Improved Performance**: Cached pages are served directly from Cloudflare's edge network, resulting in faster load times for your visitors.

2. **Reduced Server Load**: With most requests served from cache, your server experiences less load, potentially reducing hosting costs.

3. **Global Content Delivery**: Cloudflare's global network ensures your content is served quickly to visitors around the world.

4. **DDoS Protection**: Cloudflare provides protection against DDoS attacks, adding an extra layer of security to your site.

5. **Flexibility**: Unlike static site generators, you retain the full power of Laravel and can still handle dynamic content when needed.

## Attribution
The idea for this feature came from the video below by Aaron Francis. Be sure to check out that video for more information on how to use Cloudflare to serve static content with Laravel.

```html +parse
<x-prezet::youtube videoid="QiocnnlcXIU" title="SSG is dead. Long live cache." date="2023-11-08T12:00:00+08:00">
    Login
</x-prezet::youtube>
```
