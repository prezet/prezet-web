---
title: Zoomable Images
date: 2025-10-17
category: Features
excerpt: Interactive image zoom functionality powered by alpinejs-zoomable for examining image details.
image: /prezet/img/ogimages/features-zoomable-images.webp
author: benbjurstrom
---

All images in Prezet are automatically enhanced with zoom functionality via [alpinejs-zoomable](https://github.com/benbjurstrom/alpinejs-zoomable). Click any image to open a fullscreen view where you can zoom and pan to examine details.

This is particularly helpful for screenshots containing text or complex diagrams where readers need to see fine details clearly.

## How It Works

Click the example image below to open the fullscreen viewer:

![Source: GitHub.com](images-20251017113241420.webp)

Features:
- Fullscreen overlay
- Zoom in/out with buttons, mouse wheel, or keyboard (`+` and `-`)
- Pan by dragging
- Close by clicking outside, using the close button, or pressing `Escape`

When you open an image in the fullscreen viewer, it automatically loads the highest resolution version from the srcset for optimal quality.

## Keyboard Shortcuts

| Key | Action |
|-----|--------|
| `Escape` | Close fullscreen view |
| `Tab` | Navigate between controls (focus trap enabled) |

## Configuration

Disable zoom functionality in `config/prezet.php`:

```php
'image' => [
    'widths' => [480, 640, 768, 960, 1536],
    'sizes' => '92vw, (max-width: 1024px) 92vw, 768px',
    'zoomable' => false,
],
```
