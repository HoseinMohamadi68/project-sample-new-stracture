<?php

namespace Database\Seeders;

use App\Models\File\File;
use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        $coach = User::first();
        $frontIdentityCard = File::factory()->create();
        $backIdentityCard = File::factory()->create();
        $businessCertification = File::factory()->create();
        $network = SaleSystem::factory()->create();

        $parent = Partner::factory()->create(
            [
                Partner::SALE_SYSTEM_ID => $network->getId(),
                Partner::USER_ID => $user->getId(),
                Partner::COACH_ID => $coach->getId(),
                Partner::BACK_IDENTITY_CARD_ID => $backIdentityCard->getId(),
                Partner::FRONT_IDENTITY_CARD_ID => $frontIdentityCard->getId(),
                Partner::BUSINESS_CERTIFICATION_ID => $businessCertification->getId(),
            ]
        );
        $parent2 = Partner::factory()->create(
            [
                Partner::SALE_SYSTEM_ID => $network->getId(),
                Partner::USER_ID => $user->getId(),
                Partner::COACH_ID => $coach->getId(),
                Partner::BACK_IDENTITY_CARD_ID => $backIdentityCard->getId(),
                Partner::FRONT_IDENTITY_CARD_ID => $frontIdentityCard->getId(),
                Partner::BUSINESS_CERTIFICATION_ID => $businessCertification->getId(),
            ]
        );
        $child = Partner::factory()->count(3)->create([
            Partner::PARENT_ID=> $parent->getId(),
            Partner::SALE_SYSTEM_ID => $network->getId(),
        ]);
    }
}
