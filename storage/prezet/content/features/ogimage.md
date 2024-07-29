---
title: Ogimage Generation
date: 2024-05-07
category: Features
excerpt: 'Prezet automates the creation of Open Graph images for your blog posts.'
---

An Open Graph (OG) image, or ogimage, is a visual representation of your web page that appears when your content is shared on social media platforms. These images can increase engagement and click-through rates by providing an eye-catching preview of your content.

## Adding OG Images Manually

Prezet makes it easy to specify an ogimage for any blog post by adding the image key to your frontmatter.

For example:

```yaml
---
title: My Amazing Blog Post
date: 2024-05-07
category: Blog
excerpt: 'This is an excerpt of my amazing blog post.'
image: '/prezet/img/custom-ogimage.png'
---
```

The `image` field should contain the URL path to your image, relative to the public directory of your Laravel application.

For more details on working with frontmatter in Prezet, including all available fields and their usage, please refer to the [frontmatter documentation](/features/frontmatter).

## Automatic OG Image Generation

While manually specifying ogimages gives you full control, Prezet also offers automatic ogimage generation to save you time and ensure consistency across your blog. The rest of this document will explain how this automatic generation works and how you can customize it.

### Artisan Command

The `OgimageCommand` is an artisan command that you can run to generate ogimages for your blog posts. You can use it in two ways:

1. Generate an ogimage for a specific markdown file:
   ```
   php artisan prezet:ogimage
   ```
   This will prompt you to enter the name of the markdown file you want to generate an ogimage for.

2. Generate ogimages for all markdown files:
   ```
   php artisan prezet:ogimage --all
   ```
   This will generate ogimages for all markdown files in your `content` directory.

Regardless of the method you choose, the ogimage command will automatically update the frontmatter of your markdown files with the URL of the generated ogimage.

Note the ogimage generation process requires Browsershot to be properly set up in your Laravel environment. Browsershot is a PHP library that provides an easy way to take screenshots of web pages using headless Chrome.

## Customizing the Ogimage Template

Prezet allows you to customize the appearance of your ogimages. Here's how you can modify the ogimage template:

### Preview the Template
You can preview the ogimage template by navigating to the ogimage route in your browser. The route follows this pattern:

   ```
   /prezet/ogimage/{slug}
   ```

   Replace `{slug}` with the slug of your markdown file. For example here's a link to the ogimage template for this post: ['/prezet/ogimage/features/ogimage'](/prezet/ogimage/features/ogimage).

### Modify the Template
The ogimage template was added to your application as part of the installation process. The blade file is located in `resources/views/vendor/prezet/ogimage.blade.php`.

   You can modify this template to change colors, fonts, layout, or add additional elements like logos or images.

4. **Adding More Data**: If you want to include more data from your markdown file in the ogimage, you can modify the `OgimageController` to pass additional variables to the view, and then use these variables in your `ogimage.blade.php` template.

Remember, the ogimage should be visually appealing and representative of your content while being readable at small sizes.

For more information about customizing Prezet's views, including the ogimage template, please refer to the documentation at `/customize/blade-views`.
