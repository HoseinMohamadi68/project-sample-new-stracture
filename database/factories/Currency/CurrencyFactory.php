<?php

namespace Database\Factories\Currency;

use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model =Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            Currency::TITLE => $this->faker->word,
            Currency::RATIO => $this->faker->randomFloat(2, 1, 100 ),
            Currency::IS_DEFAULT => $this->faker->boolean,
            Currency::SYMBOL => $this->faker->word,
            Currency::ISO3 => strtoupper(Str::random(rand(3,3))),
        ];
    }
}
