<?php

namespace App\Models;

use App\Enums\DressingColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dressing extends Model
{
    /** @use HasFactory<\Database\Factories\DressingFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "color",
    ];

    protected function casts(): array
    {
        return [
            'color' => DressingColor::class,
        ];
    }

    protected static function booted(): void
    {
        static::created(static function (self $dressing) {
            $dressing->user->clothesCategories()->each(function (ClothesCategory $clothesCategory) use ($dressing) {
                ClothesCategoryRequirement::firstOrCreate([
                    'dressing_id' => $dressing->id,
                    'clothes_category_id' => $clothesCategory->id,
                ], [
                    'min' => 0,
                ]);
            });
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function clothes(): HasMany
    {
        return $this->hasMany(Clothing::class);
    }

    public function clothesCategoryRequirements(): HasMany
    {
        return $this->hasMany(ClothesCategoryRequirement::class);
    }
}
