<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1,10),
            'publisher_id' => fake()->numberBetween(1,10),
            'title' =>  fake()->realText(50),
            'description' => fake()->realText(250),
            'number_of_copies' => fake()->numberBetween(1,40),
            'number_of_pages' => fake()->numberBetween(250,400),
            'publisher_year' => fake()->year(),
            'price' => fake()->numberBetween(15,30),
            'isbn' => fake()->numerify('1#00####'),
            'cover_image' => "covers/".'fa'.fake()->numberBetween(1,5).".png"
        ];
    }
}
