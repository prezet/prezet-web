<?php

namespace App\Actions;

use Prezet\Prezet\Actions\UpdateIndex;
use Prezet\Prezet\Models\Document;

class CustomUpdateIndex extends UpdateIndex
{
    protected function updateHeadings(Document $document, ?string $content): void
    {
        // Don't add headings for legacy documents
        if($document->frontmatter->legacy) {
            return;
        }

        parent::updateHeadings($document, $content);
    }
}
