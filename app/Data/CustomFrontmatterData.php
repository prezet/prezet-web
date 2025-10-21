<?php

namespace App\Data;

use Prezet\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    #[Rules(['nullable', 'bool'])]
    public ?bool $legacy;

    #[Rules(['string', 'in:article,category,video,index'])]
    public string $contentType;
}
