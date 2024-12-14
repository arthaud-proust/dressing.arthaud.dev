<?php

namespace App\Dtos;

use App\Models\Clothing;
use App\Models\Media;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use function now;

#[TypeScript]
class ClothingDto extends Dto
{
    /**
     * @param array<int, string> $imageUrls
     */
    public function __construct(
        public int $id,
        public int $clothes_category_id,
        public array $imageUrls,
        public array $thumbUrls,
        public ?string $description,
    ) {
    }

    public static function fromModel(Clothing $clothing): self
    {
        return new self(
            $clothing->id,
            $clothing->clothes_category_id,
            $clothing->getMedia()->map(function (Media $media) {
                return $media->getTemporaryUrl(now()->addHour());
            })->toArray(),
            $clothing->getMedia()->map(function (Media $media) {
                return $media->hasGeneratedConversion('thumb')
                    ? $media->getTemporaryUrl(now()->addHour(), 'thumb')
                    : $media->getTemporaryUrl(now()->addHour());
            })->toArray(),
            $clothing->description,
        );
    }
}
