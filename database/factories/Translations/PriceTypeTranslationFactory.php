<?php

namespace Database\Factories\Translations;

use App\Models\Translations\PriceTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceTypeTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceTypeTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            PriceTypeTranslation::LOCALE => $this->faker->unique()->languageCode,
            PriceTypeTranslation::NAME => $this->faker->name
        ];
    }
}
