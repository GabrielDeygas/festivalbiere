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
        static $usedPairs = [];

        $userIds = User::pluck('id')->toArray();
        $beerIds = Beer::pluck('id')->toArray();

        do {
            $userId = $this->faker->randomElement($userIds);
            $beerId = $this->faker->randomElement($beerIds);

            $pair = "{$userId}-{$beerId}";

            $exists = in_array($pair, $usedPairs) || Review::where('user_id', $userId)->where('beer_id', $beerId)->exists();
        } while ($exists);

        $usedPairs[] = $pair;

        return [
            'note' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->unique()->sentence(10),
            'user_id' => $userId,
            'beer_id' => $beerId,
        ];
    }
}
