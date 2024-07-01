---
title: Customizing Blade Views in Prezet
date: 2024-05-09
category: Customization
excerpt: This guide explains how to customize the blade views in Prezet to tailor your blog's appearance and functionality.
---

Prezet uses Laravel's blade templating engine to render your blog's pages. When you installed the Prezet package, the blade view were published to your application's `resources/views/vendor/prezet` directory. This allows you to easily customize the appearance and functionality of your Prezet-powered blog.

## Blade View File Structure

The blade views are organized within the `resources/views/vendor/prezet` directory as follows:

```plaintext
resources/
└── views/
    └── vendor/
        └── prezet/
            ├── index.blade.php
            ├── ogimage.blade.php
            ├── show.blade.php
            └── components/
                ├── template.blade.php
                ├── meta.blade.php
                └── youtube.blade.php
```


## Customizing Blade Views

To tailor the views to your aesthetic, you can modify these files directly. Here's quick overview of how each file is used and how you might customize it:

### Main Template

1. `components/template.blade.php`

This is the main layout template used by both index.blade.php and show.blade.php. This file contains the overall structure of your blog pages. 

**Important:** This should be one of the first files you customize. By default, it includes Prezet branding, which you'll want to replace with your own.

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
    - Purpose: This file is used to generate Open Graph images for your posts.

### Component Files

These files are example blade components that can be inlined in your markdown files. See the [Blade Components](features/blade) documentation for more details:

1. `components/meta.blade.php`:
    - Purpose: This component handles the display of meta information for your posts. 

2. `components/youtube.blade.php`:
    - Purpose: This component is used to embed YouTube videos in your posts. Modify this if you want to change how videos are displayed or add additional functionality.
