<?php

namespace App\Dtos;
use Spatie\LaravelData\Dto;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserDto extends Dto
{
    public function __construct(
        public string $email
    )
    {
    }
}
