---
title: Typed Front Matter
date: 2024-05-06
category: Features
excerpt: Prezet uses typed front matter for robust content management and validation.
image: /prezet/img/ogimages/features-frontmatter.webp
author: benbjurstrom
---

Front matter is YAML metadata at the top of a markdown file, surrounded by triple-dash lines (`---`). Prezet parses and validates this metadata into strongly typed objects for consistent content management.

Example:

```yaml
---
title: My Blog Post
date: 2024-05-06
category: Features
excerpt: A short description of the post
image: /prezet/img/example.png
contentType: article
draft: false
author: jane_doe
tags: [markdown, content]
---
```

## How It's Used

- **Content Display**: Title, excerpt, and metadata are rendered in views
- **SEO Optimization**: Drives meta tags, Open Graph data, and JSON-LD
- **Content Organization**: Category, tags, and draft status enable filtering and organization
- **Content Type**: Determines how content appears in structured data (article, video, category)

## Validation

Prezet validates front matter using the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package. You can view the default class here: [`FrontmatterData.php`](https://github.com/prezet/prezet/blob/main/src/Data/FrontmatterData.php).

### Default Fields

| Field | Type | Required | Default | Description |
|-------|------|----------|-----|-------------|
| **title** | string | Yes | - | Document title |
| **excerpt** | string | Yes | - | Short description (also accepts **description** as alias) |
| **date** | Carbon | Yes | - | Publication date |
| **category** | string | No | null | Content category |
| **image** | string | No | null | Path to image |
| **contentType** | string | No | article | Content type: **article**, **video**, or **category** |
| **draft** | boolean | No | false | Draft status |
| **author** | string | No | null | Author identifier |
| **slug** | string | No | null | URL-friendly identifier |
| **key** | string | No | null | Unique identifier |
| **tags** | array | No | [] | Array of tag strings |

### Field Mapping

Prezet automatically maps common field name variations:
- **description** → **excerpt**
- **content_type** → **contentType**

This allows you to use either naming convention in your front matter.

## Validation Errors

When you run `php artisan prezet:index`, Prezet validates all markdown files. If validation fails, you'll see clear error messages:

Common validation errors:
- Missing required fields (`title`, `excerpt`, `date`)
- Invalid data types (string where date expected)
- Invalid `contentType` value (must be `article`, `video`, or `category`)
- Malformed YAML syntax

## Customization

Extend or modify the `FrontmatterData` class to add custom fields. See [Customizing Front Matter](/customize/frontmatter) for details.

## FrontmatterData vs DocumentData

You may notice some properties appear in both `FrontmatterData` and as top-level properties in `DocumentData` (like `category`, `draft`, `slug`, and `key`). This duplication is intentional:

- **FrontmatterData**: preserves your original markdown metadata
- **DocumentData**: elevates certain properties to database columns for efficient querying

This separation provides strong validation while maintaining fast database lookups.
