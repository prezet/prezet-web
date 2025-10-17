---
title: Customizing Blade Views in Prezet
date: 2024-05-09
category: Customization
excerpt: This guide explains how to customize the blade views in Prezet to tailor your blog's appearance and functionality.
image: /prezet/img/ogimages/customize-blade-views.webp
legacy: true
author: benbjurstrom
---

Prezet uses Laravel's blade templating engine to render your blog's pages. When you installed the Prezet package, the blade view were published to your application's `resources/views/vendor/prezet` directory. This allows you to easily customize the appearance and functionality of your Prezet-powered blog.

Should you ever need to re-publish the blade views, you can do so by running the following command:

```bash
php artisan vendor:publish --tag=prezet-views
```

## Blade View File Structure

The published blade views are organized within the `resources/views/vendor/prezet` directory as follows:

```plaintext
resources/
└── views/
    └── vendor/
        └── prezet/
            ├── index.blade.php
            ├── ogimage.blade.php
            ├── show.blade.php
            └── components/
                ├── ...
                ├── alert.blade.php
                ├── logo.blade.php
                ├── template.blade.php
                └── youtube.blade.php
```

## Customizing Blade Views

To tailor the views to your aesthetic, you can modify these files directly. Here's quick overview of how each file is used and how you might customize it:

### Main Template

`components/template.blade.php`

This is the main layout template used by both index.blade.php and show.blade.php. This file contains the overall structure of your blog pages.

### Logo Template

`components/logo.blade.php`

This file is used to display your blog's logo. Customize this file to change the appearance of your logo.

### Routable Views

These views are used to render the main blog pages:

1. `index.blade.php`:
    - Default Route: `GET /prezet`
    - Controller: `IndexController`
    - Purpose: This is the template for your blog's index page. Customize this to change the layout of your blog's main page, including how posts are listed and any additional content you want to display.

2. `show.blade.php`:
    - Default Route: `GET /prezet/{slug}`
    - Controller: `ShowController`
    - Purpose: This template is used for individual blog post pages. Modify this file to change how your blog posts are displayed.

3. `ogimage.blade.php`:
    - Default Route: `GET /prezet/ogimage/{slug}`
    - Controller: `OgimageController`
    - Purpose: This file is used to generate Open Graph images for your posts. See the [OG Image](/features/ogimage) documentation for more information.

### Component Files

These files are example blade components that can be inlined in your markdown files. See the [Blade Components](/features/blade) documentation for more details:

1. `components/alert.blade.php`:
    - Purpose: This component is used to display alert style callouts on your blog. Modify this file to change the appearance of alerts or add additional functionality.

2. `components/youtube.blade.php`:
    - Purpose: This component is used to embed YouTube videos in your posts. Modify this if you want to change how videos are displayed or add additional functionality.
