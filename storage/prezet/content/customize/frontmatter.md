---
title: Customizing Prezet Front Matter
date: 2024-05-09
category: Customization
excerpt: This post explains how to customize the front matter in Prezet.
image: /prezet/img/ogimages/customize-frontmatter.webp
---

Prezet makes it easy to customize the front matter of your markdown files. To learn more about how front matter works in general, check out the [Typed Front Matter documentation](/features/frontmatter).

This guide walks you through extending Prezet's default `FrontmatterData` class so that Prezet recognizes your custom front matter fields.

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
- **slug** *(nullable string)*  
- **key** *(nullable string)*  
- **tags** *(array)*  

Prezet uses the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package to ensure the fields in your YAML front matter are strictly typed.

## Adding Custom Fields

### 1. Create a Custom Class

In `app/Data/CustomFrontmatterData.php`, you might add a `legacy` field to identify older docs you'd like to handle differently:

```php
<?php

namespace App\Data;

use BenBjurstrom\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    // Mark docs as "legacy: true" in the front matter if they should be excluded from certain features
    #[Rules(['nullable', 'bool'])]
    public ?bool $legacy;
}
```

Then your markdown front matter might look like:

```yaml
---
title: "My Old Docs"
date: 2023-01-01
legacy: true
draft: false
---
```

### 2. Override the Default in the Service Container

In a service provider (e.g., `AppServiceProvider`), bind Prezet's default `FrontmatterData` to your custom class:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BenBjurstrom\Prezet\Data\FrontmatterData;
use App\Data\CustomFrontmatterData;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Swap out the default front matter data for your custom class
        $this->app->bind(FrontmatterData::class, CustomFrontmatterData::class);
    }

    public function boot(): void
    {
        //
    }
}
```

This ensures that any time Prezet processes front matter, it uses your `CustomFrontmatterData`.