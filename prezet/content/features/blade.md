---
title: Render Blade Components in Markdown
date: 2024-05-07
category: Features
excerpt: Learn how to enhance your Markdown content with dynamic Blade components in Prezet.
image: /prezet/img/ogimages/features-blade.webp
author: benbjurstrom
---

Prezet allows you to seamlessly integrate Blade components into your Markdown files, enabling you to create dynamic, interactive elements within your static content.

## How It Works

Prezet includes the [MarkdownBladeExtension](https://github.com/benbjurstrom/prezet/blob/main/src/Extensions/MarkdownBladeExtension.php), a custom CommonMark extension that looks for fenced code blocks with the `+parse` info word. When found, it renders the content as a Blade component and includes the result in the final HTML output.

For example, this code block in your markdown:

    ```html +parse
    <x-prezet::youtube videoid="dt1ado9wJi8" title="Supercharge Markdown with Laravel"/>
    ```

Renders as an embedded YouTube video:

```html +parse
<x-prezet::youtube videoid="dt1ado9wJi8" title="Supercharge Markdown with Laravel" date="2023-12-15T12:00:00+08:00"/>
```

You can view the source code for the YouTube component in [youtube.blade.php](https://github.com/benbjurstrom/prezet/blob/main/resources/views/components/youtube.blade.php).

## Creating Custom Components

You can create your own Blade components to use in your Markdown files. Here's an example of building a custom alert component:

### 1. Create the Component

```bash
php artisan make:component Alert
```

### 2. Define the Component Logic

In `app/View/Components/Alert.php`:

```php
namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public string $type,
        public string $message
    ) {}

    public function render()
    {
        return view('components.alert');
    }
}
```

### 3. Create the Component View

In `resources/views/components/alert.blade.php`:

```html
<div class="alert alert-{{ $type }}">
    {{ $message }}
</div>
```

### 4. Use in Markdown

Reference your component in any markdown file:

    ```html +parse
    <x-alert type="warning" message="This is a warning message!" />
    ```

This feature allows you to create rich, interactive content while maintaining the simplicity and readability of Markdown.

## Configuration

The MarkdownBladeExtension is enabled by default in Prezet. You can customize its behavior in `config/prezet.php`:

```php
'commonmark' => [
    'extensions' => [
        // ... other extensions
        Prezet\Prezet\Extensions\MarkdownBladeExtension::class,
    ],
],
```

## Credits

This extension was inspired by Aaron Francis's [blog post](https://aaronfrancis.com/2023/rendering-blade-components-in-markdown-e2e74e55) on rendering Blade components in Markdown.
