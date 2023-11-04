<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Painting>
 */
class PaintingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'year' => fake()->year(),
            'title' => fake()->words(2, true),
            'description' => fake()->text(),
            'material' => fake()->randomElement(['acrylic', 'oil', 'watercolor', 'gouache', 'encaustic', 'other']),
            "category" => fake()->randomElement(["realism", "photorealism", "expressionism", "impressionism", "abstract", "surrealism", "pop art", "other"]),
            'dimension' =>  fake()->numberBetween(50,150) . ' X ' . fake()->numberBetween(50,150),
            'status' => fake()->randomElement(['on display', 'on review']),
        ];
    }
}
