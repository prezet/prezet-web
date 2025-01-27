<?php

namespace App\Actions;

use BenBjurstrom\Prezet\Actions\GetSummary;
use Illuminate\Support\Collection;

class CustomGetSummary extends GetSummary
{
    public function handle(?string $filepath): Collection
    {
        if (str_contains(request()->path(), 'v0.x')) {
            $filepath = 'SUMMARYv0.md';
        }

        return parent::handle($filepath);
    }
}
