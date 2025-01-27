---
title: Customizing Actions in Prezet
date: 2025-01-26
category: Customization
excerpt: Learn how to override and extend Prezet's action classes to modify or replace the default functionality.
image: /prezet/img/ogimages/customize-blade-views.webp
---

Prezet uses action classes to handle all of it's internal tasks—such as parsing markdown, fetching images, or updating the search index. These classes live in the `\BenBjurstrom\Prezet\Actions` namespace and are resolved from the Laravel service container. If you'd like to modify or replace one of these actions, you can do so by overriding the underlying class. This guide will walk you through the process of customizing Prezet's actions to fit your needs.

## Default Action Classes

By default, Prezet ships with a number of action classes, including:

- `ParseMarkdown`: Handles markdown parsing with CommonMark.  
- `GetMarkdown`: Fetches the raw markdown from storage.  
- `UpdateIndex`: Updates the SQLite index for searching posts.  
- `GetImage`: Returns images from Prezet’s storage disk with optional resizing.  
- `GenerateOgImage`: Creates a social media-friendly "Open Graph" image.  
- … and many others.

Each one is responsible for a single, discrete operation. You can find them in the `vendor/benbjurstrom/prezet/src/Actions` directory.

## Overriding an Action

To override a Prezet action:

1. **Create a Custom Action Class**  
   In your Laravel application, create a new class that extends (or replicates) the original Prezet action you want to modify. For example, to override `ParseMarkdown`:

   ```php
   <?php

   namespace App\Actions;

   use BenBjurstrom\Prezet\Actions\ParseMarkdown as BaseParseMarkdown;
   use League\CommonMark\Output\RenderedContentInterface;

   class CustomParseMarkdown extends BaseParseMarkdown
   {
       public function handle(string $md): RenderedContentInterface
       {
           // Your custom logic here, for example:
           // 1. Pre-process the markdown string
           $md = $this->addCustomSyntax($md);

           // 2. Call the parent class to do the main parsing
           $result = parent::handle($md);

           // 3. Post-process the HTML if needed
           return $result;
       }

       private function addCustomSyntax(string $md): string
       {
           // ... custom syntax manipulations
           return $md;
       }
   }
   ```

2. **Register Your Action in a Service Provider**  
   Next, bind your new action into the container so that Prezet (and your application) uses it instead of the default one. You can do this in your app’s `AppServiceProvider` or any custom provider:

   ```php
   <?php

   namespace App\Providers;

   use Illuminate\Support\ServiceProvider;
   use BenBjurstrom\Prezet\Actions\ParseMarkdown;
   use App\Actions\CustomParseMarkdown;

   class AppServiceProvider extends ServiceProvider
   {
       public function register(): void
       {
           // Whenever ParseMarkdown::class is requested,
           // return an instance of CustomParseMarkdown::class
           $this->app->bind(ParseMarkdown::class, CustomParseMarkdown::class);
       }

       public function boot(): void
       {
           //
       }
   }
   ```

3. **Test the Override**  
   Now, whenever Prezet internally resolves `ParseMarkdown::class`, your custom class will be used instead. That includes calls made via the `Prezet` facade, such as:

   ```php
   // Prezet::parseMarkdown(...) eventually resolves ParseMarkdown::class
   // which your service container now points to CustomParseMarkdown::class
   $parsed = Prezet::parseMarkdown('# Hello');
   ```

   You can confirm that your custom logic is being invoked by adding a simple `dd()` or logging statement in your custom action.

## Example Use Cases

1. **Adding Additional Parsing Steps**: If you need more advanced processing (e.g., injecting custom shortcodes or applying transformations before converting to HTML), you can add those to `CustomParseMarkdown`.

2. **Custom Image Handling**: If you want to handle images differently, you might override `GetImage` to apply a watermark, change the compression settings, or load images from an external service.

3. **Tweak the Search Index**: By overriding `UpdateIndex`, you can modify how documents are processed and stored, or add additional indexing logic for advanced features.

## Using a Helper Method or Facade

Prezet provides a [facade](/getting-started/facade) with static methods for calling these actions. If you override an action in your application service provider, the facade automatically respects your binding. This means that:

```php
Prezet::updateIndex();
```

now calls **your** custom logic when it resolves `UpdateIndex::class`—no code changes required anywhere else.

For additional customization ideas, check out:

- [Customizing Front Matter](/customize/frontmatter)
- [Customizing Routes](/customize/routes)
- [Customizing Blade Views](/customize/blade-views)
