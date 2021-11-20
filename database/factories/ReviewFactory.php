<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'content' => $this->faker->sentence(5, true),
            'rating' => $this->faker->numberBetween(1, 5)
        ];
    }
}
