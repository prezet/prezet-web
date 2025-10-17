---
title: Open Graph Image Generation
date: 2024-05-07
category: Features
excerpt: Prezet automates the creation of Open Graph images for your blog posts.
image: /prezet/img/ogimages/features-ogimage.webp
author: benbjurstrom
---

Open Graph images are visual previews that appear when your content is shared on social media platforms. Here's how this page appears when shared on Threads:

```html +parse
<x-prezet::threads
    id="C-yDq7mS5II"
    username="benbjurstrom"
/>
```

## Manual Configuration

Specify an OG image for any post by adding the `image` field to your frontmatter:

```yaml
---
title: My Amazing Blog Post
date: 2024-05-07
category: Blog
excerpt: This is an excerpt of my amazing blog post.
image: /prezet/img/ogimages/custom-ogimage.png
---
```

The `image` field should contain the URL path to your image.

## Automatic Generation

Prezet can automatically generate OG images for your posts, saving time and ensuring visual consistency. For installation requirements, see the [Browsershot documentation](https://spatie.be/docs/browsershot/v4/requirements).

```html +parse
<x-prezet::alert
    type="info"
    title="Puppeteer Requirement"
    body="OG image generation uses Spatie Browsershot, which requires the Puppeteer Node library. See the Browsershot documentation for installation details."
/>
```

### Using the Command

Generate OG images using the `prezet:ogimage` artisan command:

**For a specific file:**
```bash
php artisan prezet:ogimage
```

This prompts you to enter the markdown filename.

**For all files:**
```bash
php artisan prezet:ogimage --all
```

This generates OG images for all markdown files in your content directory.

The command automatically updates your frontmatter with the generated image URL.

```html +parse
<x-prezet::alert
    type="info"
    title="Local Development"
    body="When generating OG images locally, set APP_URL in your .env file to your local development URL."
/>
```

## Customization

You can customize the appearance of your OG images by editing the template blade file published during installation.

### Preview the Template

Preview the OG image template by navigating to:

```
/prezet/ogimage/{slug}
```

Replace `{slug}` with your markdown file's slug. For example, here's the template for this page: [/prezet/ogimage/features/ogimage](/prezet/ogimage/features/ogimage).

### Modify the Template

The OG image template is published to `resources/views/vendor/prezet/ogimage.blade.php` when you install a Prezet template. You can modify this file to change:

- Colors and fonts
- Layout and spacing
- Logos or background images
- Any visual elements

### Adding Custom Data

To include additional frontmatter fields in your OG image:

1. Modify the `OgimageController` to pass additional variables to the view
2. Use these variables in your `ogimage.blade.php` template

OG images should be visually appealing and representative of your content while remaining readable at small sizes.

For more details, see the [Custom Templates](/customize/templates) guide.
