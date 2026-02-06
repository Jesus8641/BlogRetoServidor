<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            "titulo" => $this->faker->word(),
            "contenido" => $this->faker->text(),
            "autor" => $this->faker->randomElement(['Unax', 'Yeray', 'Andrea']),
            "fecha" => $this->faker->dateTime()
        ];
    }
}
