---
title: Syntax Highlighting with Phiki
date: 2025-10-17
category: Customization
excerpt: Learn how to enhance your Prezet blog with syntax highlighting using Phiki, a powerful and easy-to-use solution built into Prezet 1.1+.
image: /prezet/img/ogimages/features-syntax-highlighting.webp
---

Prezet v1.1+ includes syntax highlighting out of the box via [phikiphp/phiki](https://github.com/phikiphp/phiki), a modern PHP-based highlighter fully integrated with CommonMark.

## How It Works

Phiki automatically highlights code blocks based on the language you specify. Highlighting happens during markdown parsing when the file is rendered to HTML.

Here's an example of some php code using the MaterialTheme:

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

## Configuration

Phiki is pre-configured in `config/prezet.php` among the CommonMark extensions:

```php
'extensions' => [
    // ...
    Phiki\CommonMark\PhikiExtension::class,
],
```

Customize Phiki through the `phiki` key in the `config` section:

```php
'config' => [
    'phiki' => [
        'theme' => \Phiki\Theme\Theme::NightOwl,
        'with_gutter' => false,
        'with_wrapper' => true
    ]
],
```

### Options

| Option | Description |
|--------|-------------|
| `theme` | Color scheme for syntax highlighting (see available themes below) |
| `with_gutter` | Show line numbers when `true` |
| `with_wrapper` | Wrap code block in a styled container when `true` |

For more details, see the [Phiki CommonMark integration docs](https://github.com/phikiphp/phiki?tab=readme-ov-file#commonmark-integration).

## Themes

Change the theme by updating the `theme` option in `config/prezet.php`:

```php
'phiki' => [
    'theme' => \Phiki\Theme\Theme::GitHub,
],
```

View all available themes in [Theme.php](https://github.com/phikiphp/phiki/blob/1.x/src/Theme/Theme.php).
