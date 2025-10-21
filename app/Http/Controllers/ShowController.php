<?php

namespace App\Http\Controllers;

use Prezet\Prezet\Prezet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowController
{
    public function __invoke(Request $request, string $slug): View
    {
        $doc = Prezet::getDocumentModelFromSlug($slug);

        if($doc->frontmatter->contentType === 'index') {
            abort(404);
        }

        $nav = Prezet::getSummary();
        $md = Prezet::getMarkdown($doc->filepath);
        $html = Prezet::parseMarkdown($md)->getContent();
        $headings = Prezet::getHeadings($html);
        $docData = Prezet::getDocumentDataFromFile($doc->filepath);
        $linkedData = json_encode(Prezet::getLinkedData($docData), JSON_UNESCAPED_SLASHES);

        return view('pages.show', [
            'document' => $docData,
            'linkedData' => $linkedData,
            'headings' => $headings,
            'body' => $html,
            'nav' => $nav,
        ]);
    }
}
