<?php

namespace App\Dtos;

use App\Enums\DressingColor;
use App\Models\Dressing;
use Spatie\LaravelData\Dto;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DressingDto extends Dto
{
    public function __construct(
        public int $id,
        public string $name,
        public DressingColor $color,
        public int|Optional $clothesCount,
    ) {
    }

    public static function fromModel(Dressing $dressing): self
    {
        return new self(
            $dressing->id,
            $dressing->name,
            $dressing->color,
            $dressing->clothes->count()
        );
    }
}
