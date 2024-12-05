<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BeerFactory extends Factory
{
    protected $model = Beer::class;

    public function definition()
    {
        $imgs = ['biere1.jpg', 'biere2.jpg', 'biere3.jpg', 'biere4.jpg'];

        return [
            'name' => $this->faker->words(2, true),
            'abv' => $this->faker->randomFloat(1, 3.0, 12.0),
            'type' => $this->faker->randomElement(['Blonde', 'Brune', 'IPA', 'Porter', 'Lager']),
            'category' => $this->faker->randomElement(['Belgian Ale', 'India Pale Ale', 'Pilsner', 'Dark Ale']),
            'flavor' => $this->faker->randomElement(['Fruité', 'Maltée', 'Fumée', 'Céréalière', 'Amère']),
            'img' => basename(Arr::random($imgs)),
            'country_id' => Country::inRandomOrder()->first()->id ?? null,
        ];
    }
}
