---
title: Self-Healing Links
date: 2025-10-17
category: Features
excerpt: Self-healing links ensure your URLs never break, even when you rename or reorganize your content.
image: /prezet/img/ogimages/features-self-healing-links.webp
author: benbjurstrom
---

Self-healing links are a powerful feature in Prezet that ensures your document URLs remain accessible even when you rename or reorganize your content. By appending a unique, static key to each document's URL, Prezet can automatically redirect old links to the correct current location.

## How Self-Healing Links Work

When self-healing links are enabled, each document is assigned a unique 8-character key (derived from the document's hash). This key is:

1. **Added to your frontmatter** - The key is stored as a `key` property in your markdown file's YAML frontmatter
2. **Appended to the URL** - The key is added to the end of your document's slug (e.g., `my-article-a1b2c3d4`)
3. **Used for redirects** - If the slug changes but the key remains the same, Prezet automatically redirects to the new URL

### The Redirect Process

When a user visits a URL, Prezet follows this lookup process:

1. **Exact slug match** - First, it checks if the full slug exists in the database
2. **Key-based redirect** - If no exact match is found, it extracts the last segment after the final hyphen and searches for a document with that key
3. **Automatic redirect** - If a matching key is found, it redirects to the document's current slug (301 in production, 302 in development)

This means that even if you completely rename your article from "getting-started-a1b2c3d4" to "quick-start-guide-a1b2c3d4", any links to the old URL will automatically redirect to the new one.

## Enabling Self-Healing Links

To enable self-healing links, set the `keyed` option to `true` in your `config/prezet.php` file:

```php
'slug' => [
    'source' => 'filepath', // or 'title'
    'keyed' => true,        // Enable self-healing links
],
```

Once enabled, run the index command to generate keys for all your documents:

```bash
php artisan prezet:index
```

Prezet will automatically add a `key` property to any documents that don't already have one. The key will be the last 8 characters of the document's current MD5 hash. The next time the index is run, the keys will persist, ensuring it's unique and stable.

## Example: Key Generation

When you run `php artisan prezet:index` with `keyed` set to `true`, any document without a key will have one added to its frontmatter:

**Before:**
```yaml
---
title: Getting Started with Prezet
date: 2025-01-15
category: Documentation
excerpt: Learn how to get started with Prezet
---
```

**After:**
```yaml
---
title: Getting Started with Prezet
date: 2025-01-15
category: Documentation
excerpt: Learn how to get started with Prezet
key: a1b2c3d4
---
```

The resulting URL would be: `/prezet/getting-started-with-prezet-a1b2c3d4`

## Disabling Self-Healing Links

If you later decide to disable self-healing links, simply set `keyed` to `false` in your config:

```php
'slug' => [
    'source' => 'filepath',
    'keyed' => false,
],
```

The keys will remain in your front matter but won't be appended to URLs. You can manually remove them from your markdown files if desired, though they won't cause any issues if left in place.

## Custom Keys

While Prezet automatically generates keys based on the document's hash, you can also manually set a custom key in your frontmatter:

```yaml
---
title: My Important Article
key: my-custom-key
---
```

This can be useful if you're migrating from another system and want to maintain specific URL structures, or if you prefer more readable keys.
