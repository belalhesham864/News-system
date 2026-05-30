<?php

namespace Database\Factories;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           $files = File::files(public_path('uploads/img'));

    return [
        'path' => 'uploads/img/' . collect($files)->random()->getFilename(),
    ];
    }
}
