<?php

namespace App\Actions;

use BenBjurstrom\Prezet\Actions\UpdateIndex;
use BenBjurstrom\Prezet\Models\Document;

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
