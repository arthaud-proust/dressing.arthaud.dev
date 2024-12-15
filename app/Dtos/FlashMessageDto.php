<?php

namespace App\Dtos;

use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FlashMessageDto extends Dto
{
    #[Computed]
    public string $id;

    public function __construct(
        public string $content
    ) {
        $this->id = Str::uuid();
    }
}
