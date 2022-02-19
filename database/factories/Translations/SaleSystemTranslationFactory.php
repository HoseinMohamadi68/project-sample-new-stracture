<?php

namespace Database\Factories\Translations;

use App\Models\SaleSystem\SaleSystem;
use App\Models\Translations\SaleSystemTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleSystemTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleSystemTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            SaleSystemTranslation::SALE_SYSTEM_ID => SaleSystem::factory(),
            SaleSystemTranslation::LOCALE => $this->faker->unique()->languageCode,
            SaleSystemTranslation::NAME => $this->faker->name,
            SaleSystemTranslation::DESCRIPTION => $this->faker->text,
        ];
    }
}
