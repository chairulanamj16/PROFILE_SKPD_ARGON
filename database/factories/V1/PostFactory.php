<?php

namespace Database\Factories\V1;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\V1\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'office_id' => 1,
            'uuid' => str()->uuid(),
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'excercept' => fake()->sentence(),
            'thumb' => 'https://placehold.co/' . fake()->numberBetween(300, 800) . 'x' . fake()->numberBetween(200, 600) . '?text=Thumb',
            'show_tapinkab' => 1,
        ];
    }
}
