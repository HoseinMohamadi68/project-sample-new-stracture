<?php

namespace Database\Factories\Country;

use App\Models\Country\Country;
use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            Country::CURRENCY_ID => Currency::factory(),
            Country::DEFAULT_VAT => $this->faker->randomFloat(1.0, 23.5),
            Country::DEFAULT_WARRANTY_DAYS => $this->faker->randomNumber(),
            Country::MAX_SMALL_BUSINESS_TRADE => $this->faker->randomFloat(2.0, 50.0),
            Country::MAX_TAX_FREE_TRADE => $this->faker->randomFloat(2.0, 50.0),
            Country::IS_EEU => rand(0, 1),
            Country::ISO2 => $this->faker->unique()->lexify('??'),
            Country::ISO3 => $this->faker->unique()->lexify('???'),
        ];
    }
}
