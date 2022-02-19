<?php

namespace Database\Factories\Price;

use App\Models\Price\PriceType;
use App\Models\Translations\PriceTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceTypeTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PriceType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            PriceTypeTranslation::PRICE_TYPE_ID => PriceType::factory(),
            PriceTypeTranslation::LOCALE => $this->faker->locale,
            PriceTypeTranslation::NAME => $this->faker->name,
        ];
    }
}
