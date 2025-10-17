---
title: Customizing Templates
date: 2025-10-17
category: Customization
excerpt: Learn how to customize your Prezet template's views, styling, routes, and controllers.
image: /prezet/img/ogimages/features-templates.webp
author: benbjurstrom
---

When you install a Prezet template, all its files are published directly to your Laravel application. This means you have complete control over every aspect of how your content is displayed - from the HTML structure to the CSS styling to the route definitions.

The Prezet framework handles the backend (markdown parsing, image optimization, search indexing), while the template controls the frontend presentation. Once installed, the template is yours to modify however you like.

## Template Files

After installation, these files are in your application and ready to customize:

### Controllers
Location: `app/Http/Controllers/Prezet/`

| File | Description |
|------|-------------|
| `IndexController.php` | Lists all documents |
| `ShowController.php` | Displays individual documents |
| `ImageController.php` | Serves optimized images |
| `OgimageController.php` | Generates social media images |
| `SearchController.php` | Handles search requests |

### Views
Location: `resources/views/prezet/`

| File | Description |
|------|-------------|
| `index.blade.php` | Document listing page |
| `show.blade.php` | Individual document page |
| `ogimage.blade.php` | OG image template |

### Components
Location: `resources/views/components/prezet/`

Reusable Blade components used across templates.

### Routes

| File | Description |
|------|-------------|
| `routes/prezet.php` | All Prezet routes |
| `routes/web.php` | Modified to include prezet routes |

### Styling

| File | Description |
|------|-------------|
| `resources/css/prezet.css` | Tailwind CSS configuration |
| `vite.config.js` | Asset compilation settings |

## Common Customizations

### Styling and Layout

The template uses Tailwind CSS configured in `resources/css/prezet.css`. Customize colors, fonts, and spacing:

```css
/* resources/css/prezet.css */
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    :root {
        --color-primary: 59 130 246;
        --font-heading: 'Your Font', sans-serif;
    }
}
```

Modify layout structure in `resources/views/prezet/show.blade.php` to change how documents are displayed.

### Views and Templates

Edit Blade templates to change the HTML structure:

```blade
<!-- resources/views/prezet/show.blade.php -->

@seo([
    'title' => $frontmatter->title,
    'description' => $frontmatter->excerpt,
    'keywords' => implode(', ', $frontmatter->tags),
])

<div class="custom-container">
    <article>{!! $content !!}</article>
    <aside><!-- Custom sidebar --></aside>
</div>
```

### Controllers

Customize controller logic to filter, sort, or enhance content:

```php
// app/Http/Controllers/Prezet/IndexController.php

public function __invoke()
{
    $documents = Document::query()
        ->where('draft', false)
        ->where('category', 'tutorials')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('prezet.index', compact('documents'));
}
```

### Routes

Add custom routes in `routes/prezet.php`:

```php
Route::get('/prezet/category/{category}', CategoryController::class)
    ->name('prezet.category');

Route::get('/prezet/tag/{tag}', TagController::class)
    ->name('prezet.tag');
```

### Components

Create reusable components in `resources/views/components/prezet/`:

```blade
<!-- resources/views/components/prezet/author-bio.blade.php -->
@props(['author'])

<div class="author-bio">
    <img src="{{ $author->image }}" alt="{{ $author->name }}">
    <h3>{{ $author->name }}</h3>
    <p>{{ $author->bio }}</p>
</div>
```

Use in your views:
```blade
<x-prezet::author-bio :author="$author" />
```

## Rebuilding Assets

After modifying CSS or JavaScript, rebuild your assets:

```bash
# Development with hot reload
npm run dev

# Production build
npm run build
```

## Official Templates

Prezet provides two official templates:

- [prezet/blog-template](https://github.com/prezet/blog-template) - Blog-style layout with post listings
- [prezet/docs-template](https://github.com/prezet/docs-template) - Documentation with sidebar navigation

You can switch templates by installing a new one and running its installer, or mix components from both by selectively keeping files from your current setup.
