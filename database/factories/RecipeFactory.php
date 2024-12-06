<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'ingredients' => $this->faker->words(5, true),
            'steps' => $this->faker->paragraphs(3, true),
            'user_id' => User::inRandomOrder()->first()->id ?? null,
        ];
    }
}