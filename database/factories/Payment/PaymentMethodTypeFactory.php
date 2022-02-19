<?php

namespace Database\Factories\Payment;

use App\Models\Payment\PaymentMethodType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethodType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            PaymentMethodType::TITLE => $this->faker->unique()->name
        ];
    }
}
