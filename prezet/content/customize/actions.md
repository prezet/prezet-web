---
title: Customizing Actions in Prezet
date: 2025-01-26
category: Customization
excerpt: Learn how to override and extend Prezet's action classes to modify or replace the default functionality.
image: /prezet/img/ogimages/customize-actions.webp
author: benbjurstrom
---

Prezet uses action classes to handle internal tasks like parsing markdown, fetching images, and updating the search index. These classes are resolved from Laravel's service container, making them easy to override with your own implementations.

## Available Actions

Action classes are located in `vendor/prezet/prezet/src/Actions` and include:

- `ParseMarkdown` - Handles markdown parsing with CommonMark
- `GetMarkdown` - Fetches raw markdown from storage
- `UpdateIndex` - Updates the SQLite index
- `GetImage` - Returns images with optional resizing
- `GenerateOgImage` - Creates Open Graph images

Each action is responsible for a single operation and can be overridden independently.

## How It Works

When you override an action in your service provider, Prezet automatically uses your custom implementation. For example, if you bind a custom `UpdateIndex` class, calling:

```php
Prezet::updateIndex();
```

Will execute your custom logic instead of the default implementation.

## Example: Conditional Heading Indexing

This documentation site uses a custom action to skip heading indexing for legacy documents. This powers the version selector dropdown by allowing legacy docs to exist without interfering with the current documentation's search functionality.

The implementation involves:
1. Adding a custom `legacy` frontmatter field
2. Overriding the `UpdateIndex` action to skip headings for legacy documents

### 1. Create Custom Frontmatter

In `app/Data/CustomFrontmatterData.php`:

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

Mark legacy documents in frontmatter:

```yaml
---
title: Old Documentation
date: 2023-01-01
legacy: true
---
```

### 2. Register Custom Frontmatter

In `app/Providers/AppServiceProvider.php`:

```php
use Prezet\Prezet\Data\FrontmatterData;
use App\Data\CustomFrontmatterData;

public function register(): void
{
    $this->app->bind(FrontmatterData::class, CustomFrontmatterData::class);
}
```

### 3. Override the UpdateIndex Action

In `app/Actions/CustomUpdateIndex.php`:

```php
<?php

namespace App\Actions;

use Prezet\Prezet\Actions\UpdateIndex;
use Prezet\Prezet\Models\Document;

class CustomUpdateIndex extends UpdateIndex
{
    protected function updateHeadings(Document $document, ?string $content): void
    {
        // Skip heading indexing for legacy documents
        if ($document->frontmatter->legacy) {
            return;
        }

        parent::updateHeadings($document, $content);
    }
}
```

### 4. Register Your Custom Action

In `app/Providers/AppServiceProvider.php`:

```php
use Prezet\Prezet\Actions\UpdateIndex;
use App\Actions\CustomUpdateIndex;

public function register(): void
{
    // ...
    $this->app->bind(UpdateIndex::class, CustomUpdateIndex::class);
}
```

Now documents with `legacy: true` won't have their headings indexed, keeping them out of heading-based searches while still being accessible via direct URLs.
