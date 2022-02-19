<?php

namespace Database\Factories\SaleSystem;

use App\Models\File\File;
use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            Partner::SALE_SYSTEM_ID => SaleSystem::factory(),
            Partner::USER_ID => User::factory(),
            Partner::COACH_ID => User::factory(),
            Partner::FRONT_IDENTITY_CARD_ID => File::factory(),
            Partner::BACK_IDENTITY_CARD_ID => File::factory(),
            Partner::BUSINESS_CERTIFICATION_ID => File::factory(),
            Partner::COUNTRY_ID => 1,//TODO::AFETR ADD COUNTRY MODEL CHANGE THIS
            Partner::PARENT_ID => null,
            Partner::LEFT_TREE => 0,
            Partner::RIGHT_TREE => 0,
            Partner::MOBILE => $this->faker->phoneNumber,
            Partner::BANK_NAME => $this->faker->name,
            Partner::IBAN => $this->faker->iban(),
            Partner::DEFAULT_WARRANTY_DAYS => rand(5, 15),
            Partner::SWIFT => $this->faker->name,
            Partner::RECEIVE_VAT_RESPONSIBLE => (bool) rand(0, 1),
            Partner::SEND_VAT_RESPONSIBLE => (bool) rand(0, 1),
            Partner::ACTIVE_AUTO_BONUS => (bool) rand(0, 1),
            Partner::ACTIVE_TRAINING_BONUS => (bool) rand(0, 1),
            Partner::POST_DELIVERY_FACTOR => (bool) rand(0, 1),
            Partner::RECEIVE_COMMISSION => (bool) rand(0, 1),
            Partner::CAN_BUY => (bool) rand(0, 1),
            Partner::TRANSPORTATION_RATIO_PERCENTAGE => rand(1, 100),
            Partner::OVER_PERSONAL_TURNOVER => (bool) rand(0, 1),
            Partner::CAN_SEE_DOWN_LINE => (bool) rand(0, 1),
            Partner::INHOUSE_SALE => (bool) rand(0, 1),
            Partner::HAS_NETWORK => (bool) rand(0, 1),
            Partner::HAS_BTOB => (bool) rand(0, 1),
            Partner::HAS_BTOC => (bool) rand(0, 1),
            Partner::HAS_WAREHOUSE => (bool) rand(0, 1),
            Partner::HAS_DELIVERY => (bool) rand(0, 1),
            Partner::WARRANTY_DAYS => rand(0, 1),
            Partner::MAX_CLIENT_ROOT => rand(1, 10),
            Partner::IS_ACTIVE => (bool) rand(0, 1),
        ];
    }
}
