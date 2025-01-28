<?php

namespace App\Data;

use BenBjurstrom\Prezet\Data\FrontmatterData;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CustomFrontmatterData extends FrontmatterData
{
    #[Rules(['nullable', 'bool'])]
    public ?bool $legacy;
}
