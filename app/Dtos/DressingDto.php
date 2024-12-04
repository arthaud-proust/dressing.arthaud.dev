<?php

namespace App\Dtos;

use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DressingDto extends Dto
{
    public function __construct(
        public int $id,
        public string $name
    ) {
    }
}
