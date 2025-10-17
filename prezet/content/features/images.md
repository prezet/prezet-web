---
title: Image Optimization
date: 2024-05-06
category: Features
excerpt: Learn how Prezet automatically optimizes images using responsive loading techniques.
image: /prezet/img/ogimages/features-images.webp
author: benbjurstrom
---

Prezet automatically optimizes images using responsive loading techniques.

## How It Works

When you reference a local image in markdown, the `MarkdownImageExtension` transforms it into a responsive, optimized version.

For example, this markdown:

```markdown
![Alt text](images-20240509210223449.webp)
```

Becomes this HTML:

```html
<img
    srcset="
        /prezet/img/images-20240509210223449-480w.webp   480w,
        /prezet/img/images-20240509210223449-640w.webp   640w,
        /prezet/img/images-20240509210223449-768w.webp   768w,
        /prezet/img/images-20240509210223449-960w.webp   960w,
        /prezet/img/images-20240509210223449-1536w.webp 1536w
    "
    sizes="92vw, (max-width: 1024px) 92vw, 768px"
    src="/prezet/img/images-20240509210223449.webp"
    alt="Alt text"
/>
```

### Understanding srcset

The `srcset` attribute provides browsers with multiple image sources at different widths, allowing the browser to choose the most appropriate image based on device characteristics.

Each entry consists of:
1. The URL of the image source
2. The intrinsic width in pixels (denoted by the `w` unit)

The browser uses this information with the `sizes` attribute and device characteristics (screen resolution, pixel density) to determine which image to download.

### Understanding sizes

The `sizes` attribute tells the browser how wide the image will be displayed at different viewport sizes:

```html
sizes="(max-width: 1024px) 92vw, 768px"
```

This reads as a series of conditions with a fallback:
- `(max-width: 1024px) 92vw` - If viewport ≤ 1024px, image occupies 92% of viewport width
- `768px` - Otherwise (default), image is 768px wide

The browser uses this with `srcset` to choose the optimal image. For more details, see [The Definitive Guide to Responsive Images on the Web](https://coderpad.io/blog/development/the-definitive-guide-to-responsive-images-on-the-web/#:~:text=Adding%20the%20sizes%20attribute).

## Image Controller

The `src` and `srcset` attributes point to routes defined in your template's `routes/prezet.php` file:

```php
Route::get('prezet/img/{path}', ImageController::class)
    ->name('prezet.image')
    ->where('path', '.*');
```

The `ImageController` (installed with your template) serves optimized images based on the requested width and format. When a browser requests `/prezet/img/images-20240509210223449-480w.webp`, the controller generates and returns a 480px wide WebP image from the original.

This ensures images are served in the most efficient format and size for each user's device and network conditions.

```html +parse
<x-prezet::alert
    type="warning"
    title="Image Route Name"
    body="The route must be named `prezet.image` as this name is used by the Prezet engine to generate image URLs."
/>
```

## Configuration

Customize image settings in `config/prezet.php`:

```php
'image' => [
    'widths' => [480, 640, 768, 960, 1536],
    'sizes' => '92vw, (max-width: 1024px) 92vw, 768px',
    'zoomable' => true
],
```

| Option | Description |
|--------|-------------|
| `widths` | Array of image widths to generate for the `srcset` |
| `sizes` | The `sizes` attribute added to image tags |
| `zoomable` | Enable/disable zoom functionality |

## Disabling Optimization

To disable automatic image optimization, remove `Prezet\Prezet\Extensions\MarkdownImageExtension::class` from the `extensions` array in `config/prezet.php`.
