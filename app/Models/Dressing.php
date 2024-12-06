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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function clothes(): HasMany
    {
        return $this->hasMany(Clothing::class);
    }
}
