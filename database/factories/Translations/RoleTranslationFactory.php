<?php

namespace Database\Factories\Translations;

use App\Models\Translations\RoleTranslation;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            RoleTranslation::ROLE_ID => Role::factory(),
            RoleTranslation::LOCALE => $this->faker->unique()->languageCode,
            RoleTranslation::TITLE => $this->faker->name,
        ];
    }
}
