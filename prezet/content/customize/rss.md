---
title: Adding an RSS Feed
date: 2025-02-04
category: Customization
excerpt: Learn how to add an RSS feed using Spatie's Laravel Feed package.
image: /prezet/img/ogimages/customize-rss.webp
author: benbjurstrom
---

You can add an RSS feed to your Prezet site using [Spatie's Laravel Feed package](https://github.com/spatie/laravel-feed). This site's feed is available at [prezet.com/feed](https://prezet.com/feed).

## Installation

Install the package:

```bash
composer require spatie/laravel-feed
```

Run the installer to publish the configuration:

```bash
php artisan feed:install
```

This creates `config/feed.php` and publishes views to `public/vendor/feed`. See the [Laravel Feed documentation](https://github.com/spatie/laravel-feed) for configuration options.

## Register Route

Add the feed route to `routes/web.php`:

```php
Route::feeds();
```

## Create Feed Model

Create a model that extends Prezet's `Document` and implements Spatie's `Feedable` interface.

In `app/Models/RssDocument.php`:

```php
<?php

namespace App\Models;

use Prezet\Prezet\Models\Document as DocumentModel;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class RssDocument extends DocumentModel implements Feedable
{
    public $table = 'documents';

    public static function getAllFeedItems()
    {
        return self::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function toFeedItem(): FeedItem
    {
        $authors = config('prezet.authors');
        $author = $authors[$this->frontmatter->author]['name'] ?? 'Unknown';

        return FeedItem::create()
            ->id($this->id)
            ->title($this->frontmatter->title)
            ->summary($this->frontmatter->excerpt)
            ->updated($this->created_at)
            ->link(route('prezet.show', $this->slug))
            ->authorName($author);
    }
}
```

## Add Feed Link

Add a feed link to your template's `<head>` section.

In your Prezet template (e.g., `resources/views/vendor/prezet/components/template.blade.php`):

```html
<link rel="alternate" type="application/atom+xml" title="RSS Feed" href="/feed">
```

This makes your RSS feed discoverable by feed readers and browsers.
