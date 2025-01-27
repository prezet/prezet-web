---
title: Customizing Prezet Front Matter
date: 2024-05-09
category: Customization
excerpt: This post explains how to customize the front matter in Prezet.
image: /prezet/img/ogimages/customize-frontmatter.webp
---

Prezet makes it easy to customize the front matter of your markdown files. To learn more about how front matter works in general, check out the [Typed Front Matter documentation](/features/frontmatter).

This guide walks you through extending Prezet’s default `FrontmatterData` class and updating `config/prezet.php` so that Prezet recognizes your new front matter fields.

## The Default FrontmatterData Class

Prezet includes a default `FrontmatterData` class that validates essential fields like `title`, `excerpt`, `category`, `draft`, and more. You can review the source code here: [FrontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/FrontmatterData.php).

Key properties include:

- **title** *(string)*  
- **excerpt** *(string)*  
- **category** *(nullable string)*  
- **image** *(nullable string)*  
- **draft** *(boolean)*  
- **date** *(Carbon instance)*  
- **author** *(nullable string)*  
- **tags** *(array)*  

Prezet uses the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package to ensure the fields in your YAML front matter are strictly typed.

## Customizing the FrontmatterData Class

If you want to add new metadata fields—like `reading_time`, `difficulty_level`, or any other custom property—you can do so by following these steps:

### 1. Create a New Class

Create a class in your application that extends `FrontmatterData`. For example: `app/Data/CustomFrontmatterData.php`:

```php
<?php

namespace App\Data;

use BenBjurstrom\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    // Add new properties
    #[Rules(['required', 'integer', 'min:1'])]
    public int $reading_time;
}
```

Here, we added a new field, `reading_time`, representing the estimated time (in minutes) it takes to read an article.

### 2. Update Your Configuration

In `config/prezet.php`, tell Prezet to use your new class instead of the default:

```php
return [
    // ... other settings ...

    'data' => [
        'frontmatter' => App\Data\CustomFrontmatterData::class,
    ],

    // ... rest of config ...
];
```

### 3. Refresh the Prezet Index

Any time you change your front matter schema, run:

```bash
php artisan prezet:index --fresh
```

This command ensures the SQLite index is aware of your updated front matter. If any markdown files fail validation (for example, missing a `reading_time` value), Prezet will display an error message to help you pinpoint and fix the issue.

## Using Your Custom Fields

Once you’ve extended `FrontmatterData`, you can reference the new fields in your markdown files:

```yaml
---
title: My Custom Post
date: 2024-05-10
reading_time: 5
category: Technology
tags: [php, laravel, prezet]
excerpt: A quick introduction to customizing front matter in Prezet.
draft: false
---
```

You can then use `{{ $document->frontmatter->reading_time }}` (or whatever property you’ve introduced) in your Blade templates. For more details on updating Blade templates, see [Customizing Blade Views](/customize/blade-views).
