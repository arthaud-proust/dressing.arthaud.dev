<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClothesCategoryRequirement extends Model
{
    /** @use HasFactory<\Database\Factories\ClothesCategoryRequirementFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'clothes_category_id',
        'dressing_id',
        'min',
    ];

    public function dressing(): BelongsTo
    {
        return $this->belongsTo(Dressing::class);
    }

    public function clothesCategory(): BelongsTo
    {
        return $this->belongsTo(ClothesCategory::class);
    }
}
