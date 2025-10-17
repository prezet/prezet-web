---
title: Prezet SQLite Index
excerpt: Learn about the SQLite index used by Prezet to manage and query markdown content.
date: 2025-10-17
category: Getting Started
image: /prezet/img/ogimages/index-image.png
author: benbjurstrom
---

Prezet maintains an SQLite index to efficiently query your markdown content, powering features like pagination, sorting, and filtering.

## How It Works

When you run `php artisan prezet:index`, Prezet:

1. **Checks for deleted files**: Compares filepaths in the database against your filesystem and removes any documents that no longer exist
2. **Processes each document**: For each markdown file, it checks if the content has changed by comparing MD5 hashes
3. **Updates changed documents**: If the hash differs, updates the document record, regenerates headings, and syncs tags
4. **Cleans up tags**: Removes any orphaned tags that aren't associated with any documents
5. **Generates sitemap**: Updates your sitemap to reflect the current content

Documents with unchanged content (same hash) are skipped entirely, making updates fast even for large content collections.

## Database Location

Prezet uses the `prezet` database connection to store its index. By default this is set to use an SQLite database located at `database/prezet.sqlite`. You can change the database location or driver by modifying the `prezet` connection in `config/database.php`.

```php
'connections' => [
    'prezet' => [
        'driver' => 'sqlite',
        'database' => database_path('prezet.sqlite'),
        'prefix' => '',
        'foreign_key_constraints' => true,
    ],
],
```

## Managing the Index

### Manual Updates

Keep the index synchronized with your markdown content using the `prezet:index` command:

```bash
php artisan prezet:index
```

Run this command whenever you:

1. Add a new markdown file
2. Delete a markdown file
3. Change a markdown file's slug
4. Modify frontmatter and want those changes reflected on index pages
5. Update tags on your documents

The index uses MD5 hashes to detect file changes. If a document's content hasn't changed (same hash), the index skips the update for efficiency. When you delete files from your filesystem, the index automatically removes the corresponding database records.

### Fresh Index Rebuild

The `--fresh` option drops the existing database, runs migrations, and rebuilds the index from scratch:

```bash
php artisan prezet:index --fresh
```

Use this command when you:

1. Update to a new version of Prezet
2. Build the index in a CI/CD pipeline
3. Deploy to an environment where the index sqlite file doesn't exist

### Automatic Updates with Vite

During development, you can watch for changes to your markdown files and media assets, automatically updating the index whenever changes are detected.

Install the `vite-plugin-watch-and-run` package:

```bash
npm install -D vite-plugin-watch-and-run
```

Add the plugin to your `vite.config.js`:

```js
//..
import { watchAndRun } from 'vite-plugin-watch-and-run'

export default defineConfig({
    plugins: [
        //..
        watchAndRun([
            {
                name: 'prezet:index',
                watch: path.resolve('prezet/**/*.(md|jpg|png|webp)'),
                run: 'php artisan prezet:index',
                delay: 1000,
            },
        ]),
    ],
})
```

Start the watcher:

```bash
npm run dev
```

The plugin watches your `prezet` directory for any changes to markdown files or images. When a file is added, modified, or deleted, it automatically runs `php artisan prezet:index` after a 1-second delay. Adjust the `delay` value if you're making rapid changes to multiple files. Customize the `watch` pattern if you've changed your content directory location or want to monitor different file types.

## Sitemap Generation

Prezet automatically generates a sitemap for your website whenever the index updates. This ensures your sitemap always reflects the current state of your content.

For more details, see the [Sitemap Generation](/features/sitemap) guide.

## Querying the Index

Access the Prezet index through the Document model in your custom controllers:

```php
use Prezet\Prezet\Models\Document;

// Get all published documents
$publishedDocs = Document::where('draft', false)->get();

// Find a document by slug
$doc = Document::where('slug', $slug)->firstOrFail();

// Find a document by key
$doc = Document::where('key', $key)->firstOrFail();

// Filter by category
$categoryDocs = Document::where('category', 'tutorials')->get();

// Sort by date
$sortedDocs = Document::orderBy('created_at', 'desc')->get();

// Query with tags (eager load the relationship)
$docsWithTags = Document::with('tags')->get();

// Query with headings
$docWithHeadings = Document::with('headings')->where('slug', $slug)->first();
```

## Database Structure

The Prezet index uses an SQLite database with four main tables:

### Documents

Stores core information about each markdown document:

| Column | Type | Description |
|--------|------|-------------|
| `id` | Integer | Auto-incrementing primary key |
| `key` | String | Optional unique identifier from frontmatter (nullable, unique) |
| `slug` | String | URL-friendly identifier (unique, indexed) |
| `filepath` | String | Path to markdown file relative to content root (unique, indexed) |
| `category` | String | Document category (nullable, indexed) |
| `content_type` | String | Content type identifier (indexed) |
| `draft` | Boolean | Draft status (default: false, indexed) |
| `hash` | String | MD5 hash of file contents for change detection (32 chars, unique, indexed) |
| `frontmatter` | JSONB | Frontmatter metadata |
| `created_at` | Timestamp | Creation timestamp with timezone (indexed) |
| `updated_at` | Timestamp | Last update timestamp with timezone (indexed) |

Includes a composite index on `filepath` and `hash` for efficient change detection.

### Tags

Stores unique tags across all documents:

| Column | Type | Description |
|--------|------|-------------|
| `id` | Integer | Auto-incrementing primary key |
| `name` | String | Tag name (unique) |

### Document_Tags

Pivot table managing the many-to-many relationship between documents and tags:

| Column | Type | Description |
|--------|------|-------------|
| `id` | Integer | Auto-incrementing primary key |
| `document_id` | Integer | Foreign key to documents (indexed) |
| `tag_id` | Integer | Foreign key to tags (indexed) |

### Headings

Stores extracted headings from markdown documents for navigation and search:

| Column | Type | Description |
|--------|------|-------------|
| `id` | Integer | Auto-incrementing primary key |
| `document_id` | Integer | Foreign key to documents (cascade delete) |
| `text` | String | Heading text content |
| `level` | Integer | Heading level 1-6 (unsigned tiny integer) |
| `section` | String | URL fragment/anchor for the heading |

The headings table is automatically populated during indexing. Prezet parses the markdown content, extracts all headings, and adds the document's title as a level 1 heading at the top. Headings are regenerated whenever the document's content changes.
