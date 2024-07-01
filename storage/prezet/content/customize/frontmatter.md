---
title: Customizing Prezet Frontmatter
date: 2024-05-09
category: Customization
excerpt: 'This post explains how to customize the frontmatter prezet.'
---

Prezet makes it easy to customize the frontmatter of your markdown files. To learn more about how Prezet uses frontmatter data see this article: [Frontmatter Data](content/frontmatter).

This guide will walk you through the process of extending the package's default `FrontmatterData` class and updating `config/prezet.php` to use your custom class.

## The Default FrontmatterData Class

Out of the box, Prezet uses the bundled `FrontmatterData` class to define and validate the structure of your frontmatter. For typesafety this class makes use of the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package. You can find the contents of the default class here: [FrontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/FrontmatterData.php) 


## Create a Custom FrontmatterData Class

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

    #[Rules(['nullable', 'array'])]
    public ?array $tags;

    // Override existing properties
    #[Rules(['nullable', 'string'])]
    public ?string $excerpt;

    // Remove properties by not declaring them
    // For example, $ogimage is not included here
}
```

In this example, we've added `author` and `tags` fields, made `excerpt` optional, and removed the `ogimage` field.

## Step 2: Update the Prezet Configuration file

Update the `data.frontmatter` key within the `config/prezet.php` file to use your custom class:

```php
return [
    // ... other config options ...

    'data' => [
        'frontmatter' => App\Data\CustomFrontmatterData::class,
    ],

    // ... rest of the config ...
];
```

## Using Your Custom Frontmatter

Now that you've customized the frontmatter, you can use the new structure in your markdown files:

```markdown
---
title: My Custom Post
date: 2024-05-10
author: Jane Doe
category: Technology
tags: [php, laravel, prezet]
excerpt: This is an optional excerpt for my custom post.
---

Your markdown content goes here...
```

_⚠️ NOTE: if you've modified any of the default properties make sure you update the vendor privded blade files or seo tags that depend on the default properties_

To learn more about using frontmatter properties within your blade files or seo tags see this page: [Blade Views](content/customize/blade-views).