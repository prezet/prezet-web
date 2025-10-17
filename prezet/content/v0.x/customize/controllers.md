---
title: Customize Prezet's Controllers
date: 2024-05-09
category: Customization
excerpt: This post explains how to customize the default Prezet controllers.
image: /prezet/img/ogimages/customize-controllers.webp
legacy: true
author: benbjurstrom
---

Prezet provides default controllers that handle the core functionality of the blogging engine. However, you may want to customize these controllers to add your own logic or modify the existing behavior.

## Default Controllers

Prezet uses the following controllers:

- `IndexController`: Handles the index page that lists all articles.
- `ShowController`: Displays individual articles.
- `ImageController`: Manages image serving and optimization.
- `OgimageController`: Handles Open Graph images for social media sharing.

These controllers are located in the `vendor/benbjurstrom/prezet/src/Http/Controllers` directory.

## Overriding a Controller

To override a Prezet controller:

1. Copy the controller you want to customize from the vendor directory to your `app/Http/Controllers` directory.
2. Update the namespace at the top of the file to match your application's namespace.
3. Modify the controller as needed.
4. Finally, update the `routes/prezet.php` file to use your new controller.

Here's an example of overriding the `IndexController`:

1. Copy `vendor/benbjurstrom/prezet/src/Http/Controllers/IndexController.php` to `app/Http/Controllers/PrezetIndexController.php`.

2. Update the namespace in the new file:

```php
namespace App\Http\Controllers;

use BenBjurstrom\Prezet\Http\Controllers\IndexController as BaseIndexController;

class PrezetIndexController extends BaseIndexController
{
    // Your custom logic here
}
```

3. Update the `routes/prezet.php` file:

```php
use App\Http\Controllers\PrezetIndexController;

Route::get('prezet', PrezetIndexController::class)
    ->name('prezet.index');
```

## Customizing Controller Logic

Once you've overridden a controller, you can customize its logic. For example, you might want to add additional data to the view in the `IndexController`:

```php
public function __invoke(Request $request)
{
    $articles = $this->getArticles();
    $featuredArticle = $this->getFeaturedArticle();

    return view('prezet::index', [
        'articles' => $articles,
        'featuredArticle' => $featuredArticle,
    ]);
}

private function getFeaturedArticle()
{
    // Your logic to get a featured article
}
```

Note: If you're only changing how things are displayed, consider customizing the Blade views instead. See the article on [customizing Blade templates](/customize/blade-views) for more information.
