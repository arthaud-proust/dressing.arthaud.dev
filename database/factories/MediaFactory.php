<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function config;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        $name = Str::uuid();
        return [
            // use ->for(User::factory(), 'model') when creating a media attached to a user.
            // Change User class in function of your needs
            // 'model_type' => ,
            // 'model_id' => ,

            'uuid' => $name,
            'collection_name' => 'default',
            'name' => $name,
            'file_name' => $name,
            'mime_type' => null,
            'disk' => config('media-library.disk_name'),
            'conversions_disk' => null,
            'size' => $this->faker->randomNumber(),
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => null,
        ];
    }
}
