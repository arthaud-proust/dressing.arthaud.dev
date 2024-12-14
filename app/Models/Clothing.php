<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Clothing extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ClothingFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'clothes';

    protected $fillable = [
        'dressing_id',
        'description',
        'clothes_category_id',
    ];

    public function dressing(): BelongsTo
    {
        return $this->belongsTo(Dressing::class);
    }

    public function clothesCategory(): BelongsTo
    {
        return $this->belongsTo(ClothesCategory::class);
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(256)
            ->height(256)
            ->sharpen(10);
    }
}
