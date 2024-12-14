<?php

namespace App\Dtos;

use App\Models\ClothesCategory;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ClothesCategoryDto extends Dto
{
    /**
     * @param array<int, string> $imageUrls
     */
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }

    public static function fromModel(ClothesCategory $clothesCategory): self
    {
        return new self(
            $clothesCategory->id,
            $clothesCategory->name,
        );
    }
}
