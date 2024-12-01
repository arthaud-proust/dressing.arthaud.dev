<?php

namespace App\Dtos;

use App\Models\Dressing;
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

    public function fromModel(Dressing $dressing): DressingDto
    {
        return new self(
            $dressing->id,
            $dressing->name
        );
    }
}
