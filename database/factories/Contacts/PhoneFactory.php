<?php

namespace Database\Factories\Contacts;

use App\Models\Contacts\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            Phone::TYPE => $this->faker->randomElement([Phone::MOBILE, Phone::PHONE, Phone::FAX]),
            Phone::NUMBER => $this->faker->phoneNumber
        ];
    }
}
