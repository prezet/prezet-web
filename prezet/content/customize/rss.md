---
title: Adding an RSS Feed to Your Prezet Blog
date: 2025-02-04
category: Customization
excerpt: Learn how to add an RSS feed to your Prezet blog using Spatie's Laravel Feed package.
image: /prezet/img/ogimages/customize-rss.webp
author: benbjurstrom
---

If you want your Prezet blog to be syndicated via RSS, you can easily integrate [Spatie's Laravel Feed package](https://github.com/spatie/laravel-feed) to generate an RSS (Atom) feed for your content. You can find the RSS for this website at [prezet.com/feed](https://prezet.com/feed).

This guide walks you through the process of setting up your own RSS feed.

## Step 1. Install the Required Package

The RSS feed functionality is powered by Spatie's Laravel Feed package. If you haven't already added it to your project, run:

```bash
composer require spatie/laravel-feed
```

## Step 2. Run the Package Installer

Run the package installer which will publish the configuration file to your `config` directory and add the necessary views to the `public/vendor/feed`. Execute the following command:

```bash
php artisan feed:install
```

After running this command, a `config/feed.php` file will be generated. You can customize it as needed. For more details, check out the [Spatie Laravel Feed documentation](https://github.com/spatie/laravel-feed).

## Step 3. Update Web Routes

To register the feed route, update your `routes/web.php` file with the following:

```php
Route::feeds();
```

## Step 4. Create the RSS Document Model

Next, create a model that extends Prezet's document model and implements the `Feedable` interface provided by Spatie. For example, create a new file named `RssDocument.php` in your `app/Models` directory:

```php
<?php

namespace App\Models;

use BenBjurstrom\Prezet\Models\Document as DocumentModel;
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

This model defines a `getAllFeedItems` method to fetch the documents that should appear in your feed and a `toFeedItem` method to transform each document into the required RSS item format.

## Step 5. Add a Link to Your Feed

Let your visitors know that an RSS feed is available by adding an alternate link in your site's `<head>` section. For example, in your Blade template (typically found at `resources/views/vendor/prezet/components/template.blade.php`), add the following just before your scripts:

```html
<link rel="alternate" type="application/atom+xml" title="News" href="/feed">
```

## Conclusion

By following these steps, you've successfully integrated an RSS (Atom) feed into your Prezet powered blog. Now your visitors and feed readers can subscribe to stay updated with your latest documentation!