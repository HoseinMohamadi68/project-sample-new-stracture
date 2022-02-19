<?php

namespace Database\Factories\Translations;

use App\Models\Country\Country;
use App\Models\Translations\CountryTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;


class CountryTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CountryTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            CountryTranslation::COUNTRY_ID => Country::factory(),
            CountryTranslation::LOCALE => $this->faker->unique()->languageCode,
            CountryTranslation::NAME => $this->faker->name,
        ];
    }
}
