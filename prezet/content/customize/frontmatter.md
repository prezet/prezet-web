---
title: Customizing Frontmatter
date: 2024-05-09
category: Customization
excerpt: Learn how to extend Prezet's frontmatter with custom fields.
image: /prezet/img/ogimages/customize-frontmatter.webp
author: benbjurstrom
---

Prezet makes it easy to add custom fields to your markdown frontmatter. This guide shows you how to extend Prezet's `FrontmatterData` class to add your own typed fields.

Prezet's default frontmatter includes fields like `title`, `excerpt`, `date`, `category`, `image`, `author`, and more. For a complete list, see [FrontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/FrontmatterData.php). For more on how frontmatter works in Prezet, see the [Frontmatter documentation](/features/frontmatter).

## Adding Custom Fields

You can extend the default frontmatter class to add your own fields. This documentation site uses a custom `legacy` field to power the version selector dropdown menu, allowing users to switch between current and legacy documentation.

### 1. Create Your Custom Class

Create a new class that extends `FrontmatterData`:

```php
<?php

namespace App\Data;

use Prezet\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    #[Rules(['nullable', 'bool'])]
    public ?bool $legacy;
}
```

### 2. Use in Your Frontmatter

Add the custom field to your markdown files:

```yaml
---
title: My Old Docs
date: 2023-01-01
legacy: true
---
```

### 3. Register Your Class

Bind your custom class in `app/Providers/AppServiceProvider.php`:

```php
use Prezet\Prezet\Data\FrontmatterData;
use App\Data\CustomFrontmatterData;

public function register(): void
{
    $this->app->bind(FrontmatterData::class, CustomFrontmatterData::class);
}
```

Now Prezet will use your `CustomFrontmatterData` class whenever it processes frontmatter, making your custom fields available throughout the application.
