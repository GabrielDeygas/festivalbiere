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

        do {
            $user = User::inRandomOrder()->first();
            $beer = Beer::inRandomOrder()->first();

            $exists = \App\Models\Review::where('user_id', $user->id)
                ->where('beer_id', $beer->id)
                ->exists();
        } while ($exists);

        return [
            'note' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->unique()->sentence(10),
            'user_id' => $user->id,
            'beer_id' => $beer->id,
        ];
    }
}
