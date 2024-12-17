<?php

namespace App\Dtos\Overview;

use App\Dtos\DressingDto;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DressingOverviewDto extends Dto
{
    public function __construct(
        public DressingDto $dressing,
        public int $clothesCount,
    ) {
    }
}
