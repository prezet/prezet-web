---
title: Prezet Upgrade Guide
excerpt: Learn how to upgrade your Prezet installation to the latest version.
date: 2025-01-26
category: Getting Started
image: /prezet/img/ogimages/installation.webp
---

## Upgrading To 1.x From 0.x

Upgrade the package to the latest version by running the following command:

```bash
composer require benbjurstrom/prezet:1.0.0-rc1 --with-all-dependencies
```

## High Impact Changes

These changes will be required in all cases.

### Re-publish the configuration file
Significant changes were added to the prezet config file. After updating the package, you should re-publish the configuration file to ensure you have the latest settings or compare your existing configuration with the new one found here: [github.com/benbjurstrom/prezet/../config/prezet.php](https://github.com/benbjurstrom/prezet/blob/main/config/prezet.php)

```bash
php artisan vendor:publish --tag="prezet-config"
```

### Refresh the index
A new flag was added to the prezet:index command that will create a new sqlite database and run the prezet migrations before inserting your markdown data. Run the index command with the `--fresh` option to update the SQLite index with the latest front matter information from your markdown files:
```bash
artisan prezet:index --fresh
```

### Update Blade Templates

As part of the installation process Prezet publishes the default blade templates to your resources/views/vendor/prezet directory. You will need to update them to reflect the latest changes.

**1. Update article.blade.php**
The main change is the $article property is now a DocumentData object instead of a FrontmatterData object. FrontmatterData properties can now be accessed through the DocumentData property. You can find the new article.blade.php file here: [github.com/benbjurstrom/prezet/../components/article.blade.php](https://github.com/benbjurstrom/prezet/blob/main/resources/views/components/article.blade.php).

**2. Update show.blade.php**
Similar to the article component, FrontmatterData is now passed to the show view as a property of DocumentData. You should update all references to the $frontmatter variable to use $document instead. 

Additionally a new stack called `jsonld` was added to the show.blade.php file. This stack is used to add linked data to the page.
```php
@push('jsonld')
    <script type="application/ld+json">{!! $linkedData !!}</script>
@endpush
```

You can find the new show.blade.php file here: [github.com/benbjurstrom/prezet/../views/show.blade.php](https://github.com/benbjurstrom/prezet/blob/main/resources/views/show.blade.php).

**3. Update template.blade.php**
The `@stack('jsonld')` was added to the template.blade.php file. This stack is used to add linked data from show.blade.php.
You can find the new template.blade.php file here: [github.com/benbjurstrom/prezet/../components/template.blade.php](https://github.com/benbjurstrom/prezet/blob/main/resources/views/components/template.blade.php).

## Medium Impact Changes

These changes will only be required if you followed some of the customization guides.

### Action Classes and the Prezet Facade
All action classes have been made non-static and are now accessed through the Prezet facade. This makes it possible to overide any classes. See the Actions documentation for addtional details. 

If you were calling Action classes directly you should switch calling them through the Prezet Facede.

### Updating custom controllers
If you are using custom controllers by following this guide, you should review the changes to the Prezet facade and the new methods available for querying the index.

### Updated FrontmatterData Class
The frontmatter data class has been updated. Specifically  $slug, $hash, $createdAt, and $updatedAt were removed and made available on DocumentData; $date is now a required field and represents the published date of the document. Additionally a nullable property called $author was added. You can find the new FrontmatterData class here: [github.com/benbjurstrom/prezet/../Data/FrontmatterData.php](https://github.com/benbjurstrom/prezet/blob/main/src/Data/FrontmatterData.php)

### New DocumentData Class
A new DocumentData class has been added to the package.

## Low Impact Changes

These changes are optional but may be beneficial to your application.

### Upgrading to Tailwind 4.0
Prezet now uses Tailwind 4.0 when creating a fresh install. If you previously installed prezet and tailwind 3.0 was installed you don't need to upgrade unless you'd like to.

The [Tailwind 4.0 upgrade guide](https://tailwindcss.com/docs/upgrade-guide) is a great resource for this. Tailwing has a migration script that I found to be quite useful. You can run it with the following command npx @tailwindcss/upgrade@next

