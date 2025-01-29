---
title: Customizing Actions in Prezet
date: 2025-01-26
category: Customization
excerpt: Learn how to override and extend Prezet's action classes to modify or replace the default functionality.
image: /prezet/img/ogimages/customize-actions.webp
---

Prezet uses action classes to handle all of it's internal tasks—such as parsing markdown, fetching images, or updating the search index. These classes live in the `\BenBjurstrom\Prezet\Actions` namespace and are resolved from the Laravel service container. If you'd like to modify or replace one of these actions, you can do so by overriding the underlying class. This guide will walk you through the process of customizing Prezet's actions to fit your needs.

## Default Action Classes

By default, Prezet ships with a number of action classes, including:

- `ParseMarkdown`: Handles markdown parsing with CommonMark.  
- `GetMarkdown`: Fetches the raw markdown from storage.  
- `UpdateIndex`: Updates the SQLite index for searching posts.  
- `GetImage`: Returns images from Prezet’s storage disk with optional resizing.  
- `GenerateOgImage`: Creates a social media-friendly "Open Graph" image.  
- … and many others.

Each one is responsible for a single, discrete operation. You can find them in the `vendor/benbjurstrom/prezet/src/Actions` directory.

## Using a Helper Method or Facade

Prezet provides a [facade](/getting-started/facade) with static methods for calling these actions. If you override an action in your application service provider, the facade automatically respects your binding. This means that:

```php
Prezet::updateIndex();
```

now calls **your** custom logic when it resolves `UpdateIndex::class`—no code changes required anywhere else.

## Example: Skipping Certain Documents From Indexing

This example demonstrates:

1. **Extending the front matter** with a custom property named `legacy`.
2. **Overriding the `UpdateIndex` action** to skip indexing headings for documents marked as legacy.

### 1. Create A Custom `FrontmatterData` Class

In `app/Data/CustomFrontmatterData.php`:

```php
<?php

namespace App\Data;

use BenBjurstrom\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    // We'll use "legacy: true" in the front matter to mark older docs
    #[Rules(['nullable', 'bool'])]
    public ?bool $legacy;
}
```

You might now have front matter like:

```yaml
---
title: "My Old Docs"
date: 2023-01-01
legacy: true
draft: false
---
```

### 2. Bind Your Custom Front Matter Class

In your `AppServiceProvider`, swap the default `FrontmatterData` binding with your own `CustomFrontmatterData`:

```php
use BenBjurstrom\Prezet\Data\FrontmatterData;
use App\Data\CustomFrontmatterData;

public function register(): void
{
    $this->app->bind(FrontmatterData::class, CustomFrontmatterData::class);
}
```

This ensures that any time Prezet resolves the front matter DTO, it uses your version instead.

### 3. Override The `UpdateIndex` Action

Now, let’s say you only want to skip building headings for “legacy” documents so they aren’t searchable. You can override `UpdateIndex` and modify how headings are processed:

```php
<?php

namespace App\Actions;

use BenBjurstrom\Prezet\Actions\UpdateIndex;
use BenBjurstrom\Prezet\Models\Document;

class CustomUpdateIndex extends UpdateIndex
{
    protected function updateHeadings(Document $document, ?string $content): void
    {
        // If the document has "legacy" front matter, skip heading creation
        if ($document->frontmatter->legacy) {
            return;
        }

        // Otherwise, run the normal logic
        parent::updateHeadings($document, $content);
    }
}
```

### 4. Register Your Custom Action

Finally, in your `AppServiceProvider`:

```php
use BenBjurstrom\Prezet\Actions\UpdateIndex;
use App\Actions\CustomUpdateIndex;

public function register(): void
{
    // ...
    $this->app->bind(UpdateIndex::class, CustomUpdateIndex::class);
}
```

Now, whenever `Prezet::updateIndex()` is called, your `CustomUpdateIndex` logic runs. Documents flagged with `legacy: true` in front matter will **not** have their headings processed or indexed, effectively removing them from search queries that rely on headings.

For additional customization ideas, check out:

- [Customizing Front Matter](/customize/frontmatter)
- [Customizing Routes](/customize/routes)
- [Customizing Blade Views](/customize/blade-views)
