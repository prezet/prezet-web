<?php

namespace App\Http\Controllers;

use Prezet\Prezet\Data\DocumentData;
use Prezet\Prezet\Models\Document;
use Prezet\Prezet\Prezet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController
{
    public function __invoke(Request $request): View
    {
        $doc = Prezet::getDocumentModelFromSlug('introduction');
        $nav = Prezet::getSummary();
        $md = Prezet::getMarkdown($doc->filepath);
        $html = Prezet::parseMarkdown($md)->getContent();
        $headings = Prezet::getHeadings($html);
        $docData = Prezet::getDocumentDataFromFile($doc->filepath);
        $linkedData = json_encode(Prezet::getLinkedData($docData), JSON_UNESCAPED_SLASHES);

        return view('pages.index', [
            'document' => $docData,
            'linkedData' => $linkedData,
            'headings' => $headings,
            'body' => $html,
            'nav' => $nav,
        ]);
    }
}
