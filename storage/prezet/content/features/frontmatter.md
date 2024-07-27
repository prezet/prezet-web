---
title: Typed Front Matter
date: 2024-05-06
category: Features
excerpt: 'Prezet automatically optimizes images for the web.'
ogimage: '/prezet/img/ogimages/example.png'
---

Front matter is the YAML metadata at the top of a markdown file enclosed by triple dashes (`---`). Prezet converts front matter into a strongly typed data transfer object (DTO) to ensure consistency and reliability.
 
As an example, here is the front matter for this very post:

```yaml
---
title: Typed Front Matter
date: 2024-05-06
category: Features
excerpt: 'Prezet uses typed front matter for robust content management.'
ogimage: '/prezet/img/ogimages/example.png'
---
```

## How Prezet Uses Front Matter

Prezet utilizes front matter in several ways:

1. **Content Display**: Generates visible elements like titles, dates, and excerpts for your blog.
2. **SEO Optimization**: Renders SEO tags in the page's `<head>`, including title, description, and Open Graph attributes.
3. **Content Organization**: Uses categories and other metadata for structuring and organizing your content.

## Validating Front Matter

To ensure the integrity and consistency of your content, Prezet employs the `FrontmatterData` class to define and validate the structure of your front matter. This class uses the [laravel-validated-dto](https://wendell-adriel.gitbook.io/laravel-validated-dto) package for type safety and validation.

You can find the default `FrontmatterData` class here: [frontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/frontmatterData.php)

If the front matter is missing or does not pass validation, Prezet will throw an error and prevent the post from being rendered.

## Bulk Front Matter Validation

Prezet also provides a convenient way to validate the front matter for all of your posts at once. Anytime you update the prezet index sqlite file prezet also scans all your markdown files and checks that the front matter can be rendered into a valid DTO.

```bash
php artisan prezet:index
```

If any files contain invalid front matter, the command will output detailed error messages along with the file paths, allowing you to quickly identify and correct any issues.

## Customizing Front Matter

While Prezet provides a default structure for front matter, you can customize it to fit your specific needs. For detailed instructions on how to extend or modify the `FrontmatterData` class, please refer to the documentation on [Customizing front matter](/customize/frontmatter).

By leveraging typed front matter, Prezet helps you maintain a robust and consistent content structure, enhancing both the reliability of your blog and the efficiency of your content management workflow.
