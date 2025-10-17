---
title: JSON-LD Structured Data
date: 2025-01-26
category: Features
excerpt: Learn how Prezet generates JSON-LD structured data for improved SEO and search visibility.
image: /prezet/img/ogimages/features-jsonld.webp
author: benbjurstrom
---

Prezet automatically generates [JSON-LD](https://json-ld.org/) structured data for your content, improving visibility on search engines and social media. The generated metadata follows the [Google Article Guide](https://developers.google.com/search/docs/appearance/structured-data/article) and includes your article's headline, publishing date, and author information.

## How It Works

Prezet generates JSON-LD structured data through a simple three-step process:

1. **Extract frontmatter** - Key fields like `title`, `date`, `excerpt`, `image`, and `author` are read from your markdown files
2. **Build structured data** - The `GetLinkedData` action compiles this information into JSON-LD format
3. **Inject into template** - The JSON-LD is added to the page `<head>` via the template

When you install a Prezet template, the `show.blade.php` view includes the JSON-LD via the following snippet:

```php
@push('jsonld')
    <script type="application/ld+json">{!! $linkedData !!}</script>
@endpush
```

## Generated Fields

Prezet automatically includes the following structured data fields:

- `headline` - Article title from frontmatter `title`
- `datePublished` - Publication date from frontmatter `date` or file modification date
- `dateModified` - When the document was last updated
- `author` - Author profile from the `authors` array in `config/prezet.php`
- `publisher` - Publisher information from `config/prezet.php`
- `image` - Article image from frontmatter, or publisher default if not set

Example output:

```json
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "My Awesome Blog Post",
  "datePublished": "2024-06-30T12:00:00+00:00",
  "dateModified": "2024-07-01T10:15:27+00:00",
  "author": {
    "@type": "Person",
    "name": "Jane Doe",
    "url": "https://jane.example.com",
    "image": "https://jane.example.com/avatar.jpg"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Prezet",
    "url": "https://prezet.com",
    "logo": "https://prezet.com/favicon.svg",
    "image": "https://prezet.com/ogimage.png"
  },
  "image": "https://jane.example.com/my-featured-image.webp"
}
```

## Configuration

### Author Profiles

Configure author information in `config/prezet.php`. The frontmatter `author` field references these profiles by key:

```php
'authors' => [
    'jane_doe' => [
        '@type' => 'Person',
        'name' => 'Jane Doe',
        'url' => 'https://jane.example.com',
        'image' => 'https://jane.example.com/avatar.jpg',
    ],
    'john_smith' => [
        '@type' => 'Person',
        'name' => 'John Smith',
        'url' => 'https://john.example.com',
        'image' => 'https://john.example.com/avatar.jpg',
    ],
],
```

Reference the author in your markdown frontmatter:

```yaml
---
title: My Awesome Blog Post
author: jane_doe
date: 2024-06-30
image: /blog-images/featured.webp
---
```

### Publisher Information

Update your site or organization details in `config/prezet.php`:

```php
'publisher' => [
    '@type' => 'Organization',
    'name' => 'My Company Name',
    'url' => 'https://mycompany.example.com',
    'logo' => 'https://mycompany.example.com/logo.svg',
    'image' => 'https://mycompany.example.com/ogimage.png',
],
```

## Advanced Customization

For advanced changes like adding custom properties or modifying how fields are generated, you can override the `GetLinkedData` action.

### 1. Create Your Custom Action

```php
// app/Actions/CustomGetLinkedData.php
namespace App\Actions;

use Prezet\Prezet\Actions\GetLinkedData;
use Prezet\Prezet\Data\DocumentData;

class CustomGetLinkedData extends GetLinkedData
{
    public function handle(DocumentData $document): array
    {
        $jsonLd = parent::handle($document);

        // Add custom fields
        $jsonLd['isPartOf'] = [
            '@type' => 'Blog',
            'name'  => 'My Custom Blog',
        ];

        return $jsonLd;
    }
}
```

### 2. Register Your Action

In `app/Providers/AppServiceProvider.php`:

```php
use Prezet\Prezet\Actions\GetLinkedData;
use App\Actions\CustomGetLinkedData;

public function register(): void
{
    $this->app->bind(GetLinkedData::class, CustomGetLinkedData::class);
}
```

Prezet will now use your custom action whenever structured data is generated.

## Validation

Use Google's [Rich Results Test](https://search.google.com/test/rich-results) to validate your JSON-LD structured data. Properly formed structured data can improve your site's appearance in search results and increase user engagement.
