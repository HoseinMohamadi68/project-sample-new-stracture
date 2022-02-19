<?php

namespace Database\Factories\SaleSystem;

use App\Models\SaleSystem\SaleSystem;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleSystemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleSystem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            SaleSystem::USER_ID => User::factory(),
            SaleSystem::DOMAIN => $this->faker->domainName(),
            SaleSystem::REGISTER_NUMBER => $this->faker->phoneNumber(),
            SaleSystem::REGISTER_OFFICE => $this->faker->name(),
            SaleSystem::PHONE => $this->faker->phoneNumber(),
            SaleSystem::FAX => $this->faker->phoneNumber(),
            SaleSystem::HAS_NETWORK => $this->faker->boolean(),
            SaleSystem::HAS_BTOB => $this->faker->boolean(),
            SaleSystem::HAS_BTOC => $this->faker->boolean(),
            SaleSystem::HAS_WAREHOUSE => $this->faker->boolean(),
            SaleSystem::HAS_DELIVERY => $this->faker->boolean(),
            SaleSystem::WARRANTY_DAYS => rand(1,5),
            SaleSystem::MAX_CLIENT_ROOT => rand(1,5),
            SaleSystem::IS_ACTIVE => rand(0,1),
        ];
    }
}
