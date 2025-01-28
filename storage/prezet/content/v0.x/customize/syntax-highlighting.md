---
title: Syntax Highlighting with Torchlight
date: 2024-08-14
category: Customization
excerpt: Learn how to enhance your Prezet blog with syntax highlighting using Torchlight, a powerful and easy-to-use solution.
image: /prezet/img/ogimages/customize-syntax-highlighting.webp
legacy: true
---

This guide will walk you through adding syntax highlighting to your Prezet blog using [Torchlight](https://torchlight.dev), a fast and versatile syntax highlighter supporting over 100 languages and themes.

You can see Torchlight in action throughout this site, as all code snippets on prezet.com are rendered via the Torchlight API.

## Install the Torchlight Package

Begin by installing the Torchlight CommonMark package:

```bash
composer require torchlight/torchlight-commonmark
```

## Configure the Torchlight Markdown Extension

To enable Torchlight in your Prezet blog, add the Torchlight extension to your `config/prezet.php` file:

```php
'commonmark' => [
    'extensions' => [
        League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
        League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
        League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
        League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
        BenBjurstrom\Prezet\Extensions\MarkdownBladeExtension::class,
        BenBjurstrom\Prezet\Extensions\MarkdownImageExtension::class,
        Torchlight\Commonmark\V2\TorchlightExtension::class, // [tl! ++]
    ],
    // ... other configuration options
],
```

## Obtain and Configure Your Torchlight API Key

To use Torchlight, you'll need an API key:

1. Visit [app.torchlight.dev/register](https://app.torchlight.dev/register) to create an account.
2. Create a new project in your Torchlight dashboard.
3. Copy the provided API key.

Add the API key to your `.env` file:

```env
TORCHLIGHT_TOKEN=your-api-key
```

## Using Torchlight in Your Content

With Torchlight set up, you can now use syntax highlighting in your Markdown files. Simply specify the language after the opening triple backticks:


    ```php
    public function handle()
    {
        // Your PHP code here
    }
    ```

Torchlight will automatically apply syntax highlighting to your code blocks turning the above markdown into this:

```php
public function handle()
{
    // Your PHP code here
}
```

## Attribution

If you're using Torchlight's free plan, make sure to include attribution on your site. You can find more information about attribution requirements in the [Torchlight documentation](https://torchlight.dev/docs/).
