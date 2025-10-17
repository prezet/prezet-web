---
title: Prezet is SEO Ready Out of the Box
date: 2024-05-05
category: Features
excerpt: Prezet automatically generates meta tags for your pages based on the front matter of your markdown files.
image: /prezet/img/ogimages/features-seo.webp
author: benbjurstrom
---

Prezet comes with built-in Search Engine Optimization (SEO) features, automatically generating meta tags for your pages based on the front matter of your markdown files. This ensures that your content is well-optimized for search engines and social media platforms right from the start.

## How It Works

Prezet includes a built-in SEO service that generates comprehensive meta tags from your markdown frontmatter. When you install a Prezet template, the published views automatically configure SEO tags for each page.

The template's `show.blade.php` view sets SEO values using frontmatter data:

```php
@seo([
    'title' => $frontmatter->title,
    'description' => $frontmatter->excerpt,
    'url' => route('prezet.show', ['slug' => $frontmatter->slug]),
    'image' => $frontmatter->image,
])
```

The template then includes a meta component that renders all the SEO tags:

```blade
<x-prezet::meta />
```

This component generates:
- Standard meta tags (title, description, keywords)
- Open Graph tags for social media sharing
- Twitter Card tags
- Canonical URL links

## Frontmatter Fields

The following frontmatter fields are used to generate SEO meta tags:

- `title`: Page title and og:title tags
- `excerpt`: Meta description and og:description tags
- `image`: og:image and Twitter card image tags

For more information on frontmatter, see the [Front Matter](/features/frontmatter) documentation.

## Customization

You can customize SEO tags by modifying the published template views in your project. The `show.blade.php` template is published when you install a Prezet template, giving you full control over which frontmatter fields are used for SEO.

For advanced customization, you can create your own FrontmatterData class to include additional fields. See the [Customizing Front Matter](/customize/frontmatter) guide for details. Any data added to your custom class can be passed to the SEO service via the blade template.

You can also add custom meta tags or modify existing ones by using the SEO service methods:

```php
@seo([
    'title' => $frontmatter->title,
    'description' => $frontmatter->excerpt,
    'url' => route('prezet.show', ['slug' => $frontmatter->slug]),
    'image' => $frontmatter->image,
    'keywords' => 'laravel, markdown, blog',
    'twitter.creator' => '@yourhandle',
])
```

## Open Graph Images

Open Graph images appear when your pages are shared on social media platforms or messaging apps, enhancing visibility and engagement.

Prezet includes a command to automatically generate OG images for your posts. See the [OG Image Generation](/features/ogimage) documentation for details.

## SEO Metadata Preview

Prezet includes a blade component that uses JavaScript to preview the title, description, and og:image tags of the current page, helping you verify that the correct information is being displayed.

You can use this component in your templates:

    ```html +parse
    <x-prezet::meta></x-prezet::meta>
    ```

Here's what it looks like on this page:

```html +parse
<x-prezet::meta></x-prezet::meta>
```
