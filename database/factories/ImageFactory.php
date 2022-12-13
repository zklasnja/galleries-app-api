<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'urls' => fake()->imageUrl(),
            'gallery_id' => fake()->numberBetween($min = 1, $max = 10),
            'user_id' => fake()->numberBetween($min = 1, $max = 1),
        ];
    }
}
