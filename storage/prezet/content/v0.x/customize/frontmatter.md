---
title: Customizing Prezet Front Matter
date: 2024-05-09
category: Customization
excerpt: This post explains how to customize the frontmatter in Prezet.
image: /prezet/img/ogimages/customize-frontmatter.webp
---

Prezet makes it easy to customize the frontmatter of your markdown files. To learn more about how Prezet uses frontmatter data, see this article: [Frontmatter Data](/features/frontmatter).

This guide will walk you through the process of extending the package's default `FrontmatterData` class and updating `config/prezet.php` to use your custom class.

## The Default FrontmatterData Class

Out of the box, Prezet uses the bundled `FrontmatterData` class to define and validate the structure of your frontmatter. You can find the contents of the default class here: [FrontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/FrontmatterData.php).

For type safety, this class makes use of the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package. For more advanced customization options, you may want to refer to the package's documentation.

## Customizing the FrontmatterData Class

Customizing front matter allows you to tailor your blog's metadata to your specific needs. You can add fields for author information, custom taxonomies, or any content-specific data beyond Prezet's defaults by following the steps below.

### 1. Create a Custom FrontmatterData Class

Create a new class that extends the default `FrontmatterData` class and add it to your application, for example: `app/Data/CustomFrontmatterData.php`:

```php
<?php

namespace App\Data;

use BenBjurstrom\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    // Add new properties
    #[Rules(['required', 'string'])]
    public string $author;
}
```

In this example, we've added an `author` field

### 2. Update the Prezet Configuration File

Update the `data.frontmatter` key within the `config/prezet.php` file so Prezet knows to use your custom class:

```php
return [
    // ... other config options ...

    'data' => [
        'frontmatter' => App\Data\CustomFrontmatterData::class,
    ],

    // ... rest of the config ...
];
```

### 3. Update the Prezet Index

After customizing your front matter, it's crucial to update the Prezet index:

```bash
php artisan prezet:index
```

This command updates the SQLite index with your new front matter structure, ensuring Prezet recognizes and can use your custom fields.

For more information about the SQLite index and its purposes, refer to the [SQLite Index](/index) documentation.

## Using Your Custom Frontmatter

Now that you've customized the frontmatter, you can use the new structure in your markdown files:

```markdown
---
title: My Custom Post
slug: my-custom-post
date: 2024-05-10
author: Jane Doe
category: Technology
tags: [php, laravel, prezet]
excerpt: This is an optional excerpt for my custom post.
draft: false
---

Your markdown content goes here...
```

To display your custom front matter properties in your blog, you'll need to update the blade views to include them. See the [Customizing Blade Views](/customize/blade-views) documentation for more information.
