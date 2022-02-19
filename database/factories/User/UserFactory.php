<?php

namespace Database\Factories\User;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            User::APPROVED => $this->faker->boolean,
            User::MOBILE => '09' . (string)$this->faker->numerify('#########'),
            User::FIRST_NAME => $this->faker->firstName,
            User::LAST_NAME => $this->faker->lastName,
            User::EMAIL => $this->faker->email,
            User::CHARGE => (string)$this->faker->numberBetween(0, 9999999999),
            User::PASSWORD => bcrypt(123),
            User::PHONE => (string)rand(10000000000, 999999999999),
        ];
    }
}
