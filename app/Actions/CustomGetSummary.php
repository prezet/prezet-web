<?php

namespace App\Actions;

use Prezet\Prezet\Actions\GetSummary;
use Illuminate\Support\Collection;

class CustomGetSummary extends GetSummary
{
    public function handle(?string $filepath): Collection
    {
        $path = request()->path();

        if (str_contains($path, 'v0.x')) {
            $filepath = 'SUMMARYv0.md';
        } elseif (str_contains($path, 'v1.0-rc')) {
            $filepath = 'SUMMARYv1rc.md';
        }

        return parent::handle($filepath);
    }
}
