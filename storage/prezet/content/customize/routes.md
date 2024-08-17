---
title: Customizing Prezet Routes
date: 2024-05-09
category: Customization
excerpt: This post explains how to customize Prezet's default routes.
image: /prezet/img/ogimages/customize-routes.webp
---

When you run the `prezet:install` command the `routes/prezet.php` file is copied to your application. This file contains all the routes used by Prezet. The installer also appends a line to your `routes/web.php` file to include these routes.

## Default Routes

On a new install the contents of the `routes/prezet.php` file will look like this:

```php
Route::get('prezet/img/{path}', ImageController::class)
    ->name('prezet.image')
    ->where('path', '.*');

Route::get('/prezet/ogimage/{slug}', OgimageController::class)
    ->name('prezet.ogimage')
    ->where('slug', '.*');

Route::get('prezet', IndexController::class)
    ->name('prezet.index');

Route::get('prezet/{slug}', ShowController::class)
    ->name('prezet.show')
    ->where('slug', '.*');
```

## Customizing the Path

One of the most common customizations is changing the base path for your blog. By default, Prezet uses 'prezet' as the base path to avoid conflict with any existing routes. Here's how you can change it:

1. Open the `routes/prezet.php` file.
2. Replace 'prezet' with your desired path (e.g., 'blog' or 'articles').

For example, to change the base path to 'blog':

```php
Route::get('blog', IndexController::class)
    ->name('prezet.index');

Route::get('blog/{slug}', ShowController::class)
    ->name('prezet.show')
    ->where('slug', '.*');
```

## Using Root Path

If you want Prezet to handle your root path (e.g., for a documentation site), you can modify the routes like this:

```php
Route::get('/', IndexController::class)
    ->name('prezet.index');

Route::get('{slug}', ShowController::class)
    ->name('prezet.show')
    ->where('slug', '.*');
```

## Customizing Other Routes

You can also customize the image and OG image routes if needed. Just make sure to update the paths consistently across all routes.

Note that Prezet uses named routes for some internal functionality so be sure to leave the route names unchanged.