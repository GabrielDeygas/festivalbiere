<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{

    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->unique()->sentence(10),
            'user_id' => User::inRandomOrder()->first()->id ?? null,
            'beer_id' => Beer::inRandomOrder()->first()->id ?? null,
        ];
    }
}
