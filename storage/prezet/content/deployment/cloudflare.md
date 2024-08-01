---
title: Cloudflare Cache
excerpt: Learn how to use Cloudflare to cache your Prezet-generated HTML pages for improved performance.
slug: cloudflare
date: 2024-07-01
category: Deployment
---

Prezet integrates seamlessly with services like Cloudflare to provide powerful caching capabilities, allowing you to achieve static-site-like performance with the flexibility of a dynamic Laravel application. This guide will walk you through setting up and optimizing Cloudflare caching for your Prezet-powered site.

## Cache Control Middleware

If you look at the [routes/prezet.php](https://github.com/benbjurstrom/prezet/blob/main/routes/prezet.php) file, you'll notice that we're adding the following cache control middleware to every request.

```php
Route::middleware('cache.headers:public;max_age=7200;etag')
    // ... other route configurations
```

This middleware sets the `Cache-Control` header to `public` with a max age of 7200 seconds (2 hours). You can read more about the Cache Control Middleware in the [Laravel documentation](https://laravel.com/docs/responses#cache-control-middleware).

Note that the two-hour TTL is specifically chosen because it's the minimum Edge Cache TTL for Cloudflare's free plan. Of course you can modify this value to suit your needs, see the documentation on [Customizing Prezet's Routes](/customize/routes) routes for more information.

## Setting Up Cloudflare for Caching

To configure Cloudflare to cache your Prezet site's content:

1. Log into your Cloudflare dashboard and select your domain.
2. Navigate to "Caching" > "Cache Rules" and click "Create cache rule".
3. Configure the rule with these settings:
    - Rule name: "Cache Everything With Headers"
    - If: "All incoming requests"
    - Then:
        - Cache eligibility: "Eligible for cache"
        - Edge TTL: "Use cache-control header if present, bypass cache if not"
4. Click "Save" to activate the rule.
![](cloudflare-20240731172637050.webp)
Remember that Prezet sets appropriate cache headers (public, max-age=7200, etag) for its routes. With these settings only you Prezet content will be cached but the rest of your Laravel application (which doesn't use these cache headers) will not.

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

```
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
