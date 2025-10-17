---
title: Syntax Highlighting with Phiki
date: 2025-05-21
category: Customization
excerpt: Learn how to enhance your Prezet blog with syntax highlighting using Phiki, a powerful and easy-to-use solution built into Prezet 1.1+.
image: /prezet/img/ogimages/features-syntax-highlighting.webp
legacy: true
---

Starting with Prezet v1.1, syntax highlighting is provided out of the box using [phikiphp/phiki](https://github.com/phikiphp/phiki), a modern PHP-based syntax highlighter that's fully integrated with the CommonMark ecosystem. This guide explains how to configure and use this feature to make your code blocks visually appealing and readable.

## How It Works

Phiki is automatically included and configured in Prezet v1.1+. When you write code blocks in your markdown files Phiki will apply syntax highlighting based on the language you specify. This happens when the markdown file is parsed and rendered into HTML.

For example, here's a PHP code block rendered with Phiki using MaterialTheme:

```php
public function handle(): int
{
    // Add the prezet disk to the filesystems config
    $this->addStorageDisk();
    $this->copyContentStubs();
    $this->publishVendorFiles();
    $this->copyTailwindFiles();
    $this->installNodeDependencies();

    return self::SUCCESS;
}
```

## Available Configuration Options

The Phiki extension is pre-configured in Prezet v1.1+. You can find it in your `config/prezet.php` file among the CommonMark extensions:

```php
'extensions' => [
    League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
    League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
    League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
    League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
    Prezet\Prezet\Extensions\MarkdownBladeExtension::class,
    Prezet\Prezet\Extensions\MarkdownImageExtension::class,
    Phiki\CommonMark\PhikiExtension::class,
],
```

You can customize Phiki's behavior through the `phiki` key in the `config` section:

```php
'config' => [
    // Other config settings...
    
    'phiki' => [
        'theme' => \Phiki\Theme\Theme::NightOwl,
        'with_gutter' => false,
        'with_wrapper' => true
    ]
],
```

### Configuration Options

- **`theme`**: Determines the color scheme used for syntax highlighting. Phiki comes with several built-in themes (see below).
- **`with_gutter`**: When set to `true`, line numbers will be displayed alongside your code.
- **`with_wrapper`**: When set to `true`, wraps the code block in a container with additional styling.

You can read more about each configuration option here: [github.com/phikiphp/phiki](https://github.com/phikiphp/phiki?tab=readme-ov-file#commonmark-integration)

## Available Themes

Phiki provides several built-in themes that you can use for your code blocks. To change the theme, update the `theme` option in your `config/prezet.php` file:

```php
'phiki' => [
    'theme' => \Phiki\Theme\Theme::GitHub,  // Change to your preferred theme
    // other options...
],
```

You can find a list of available themes here: [github.com/phikiphp/../Theme.php](https://github.com/phikiphp/phiki/blob/1.x/src/Theme/Theme.php)
