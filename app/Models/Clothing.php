<?php

namespace App\Models;

use App\Enums\ClothingCategory;
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
        'category',
    ];

    protected function casts(): array
    {
        return [
            'category' => ClothingCategory::class,
        ];
    }

    public function dressing(): BelongsTo
    {
        return $this->belongsTo(Dressing::class);
    }
}
