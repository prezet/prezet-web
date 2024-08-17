---
title: Prezet is SEO Ready Out of the Box
date: 2024-05-05
category: Features
excerpt: Prezet automatically generates meta tags for your pages based on the front matter of your markdown files.
image: /prezet/img/ogimages/features-seo.webp
---

Prezet comes with built-in Search Engine Optimization (SEO) features, automatically generating meta tags for your pages based on the front matter of your markdown files. This ensures that your content is well-optimized for search engines and social media platforms right from the start.

## SEO meta tags

Prezet uses the front matter of your markdown files as the source for key SEO elements. The following front matter fields are used to generate SEO meta tags:

1. `title`: Used for the page title and og:title tags
2. `excerpt`: Used for the meta description and og:description tags
3. `ogimage`: Used for the og:image tag

For more information on how Prezet uses front matter, please refer to the [Front Matter](frontmatter) documentation.

## How it works

Under the hood, Prezet utilizes the [archtechx/laravel-seo](https://github.com/archtechx/laravel-seo) package to generate and manage SEO tags. The `SetSeo` action (located in `Actions/SetSeo.php`) is responsible for passing the front matter data to the SEO package:

```php
<?php

namespace BenBjurstrom\Prezet\Actions;

use BenBjurstrom\Prezet\Data\FrontmatterData;

class SetSeo
{
    public static function handle(FrontmatterData $fm): void
    {
        seo()
            ->title($fm->title)
            ->description($fm->excerpt)
            ->image($fm->ogimage);
    }
}
```

This action is called automatically when rendering your pages, ensuring that the appropriate SEO tags are always included.

## Open Graph Images

An Open Graph (OG) image is a visual representation of a webpage that appears when the page is shared on social media platforms or messaging apps. It helps enhance the visibility and engagement of shared links.

Prezet comes with a command to automatically generate an ogimage for your posts. For more information on how to create and customize Open Graph images for your Prezet site, please refer to the [Ogimage Generation](ogimage) documentation.

## SEO Metadata Preview

To help you visualize the SEO metadata for your pages, Prezet includes a blade component that uses JavaScript to preview the title, description, and og:image tags of the current page, allowing you to easily verify that the correct information is being displayed.

You can use this component in your templates as follows:

    ```html +parse
    <x-prezet::meta></x-prezet::meta>
    ```

Here's what it looks like rendered on this page:

```html +parse
<x-prezet::meta></x-prezet::meta>
```
