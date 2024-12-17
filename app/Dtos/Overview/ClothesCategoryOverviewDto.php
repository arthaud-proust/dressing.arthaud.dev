<?php

namespace App\Dtos\Overview;

use App\Dtos\ClothesCategoryDto;
use App\Dtos\DressingDto;
use App\Models\ClothesCategory;
use App\Models\Dressing;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ClothesCategoryOverviewDto extends Dto
{
    #[Computed]
    public int $clothesCount;

    public function __construct(
        public ClothesCategoryDto $category,
        /** @var DressingOverviewDto[]> */
        public Collection $dressings,
    ) {
        $this->clothesCount = $this->dressings->sum('clothesCount');
    }

    public static function fromModel(ClothesCategory $clothesCategory): self
    {
        return new self(
            ClothesCategoryDto::from($clothesCategory),
            DressingOverviewDto::collect(
                $clothesCategory->user->dressings->map(function (Dressing $dressing) use ($clothesCategory) {
                    return new DressingOverviewDto(
                        DressingDto::from($dressing),
                        $dressing->clothes()->where('clothes_category_id', $clothesCategory->id)->count(),
                    );
                })
            )
        );
    }
}
