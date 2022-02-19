<?php

namespace Database\Seeders;

use App\Models\LocalizableModel;
use App\Models\SaleSystem\SaleSystem;
use App\Models\Translations\SaleSystemTranslation;
use App\Models\User\User;
use App\Repositories\SaleSystem\SaleSystemRepository;
use Illuminate\Database\Seeder;

class SaleSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SaleSystemRepository $repository)
    {
        $user = User::first();
        $data = [
            SaleSystem::USER_ID => $user->getID(),
            SaleSystem::DOMAIN => 'network.test',
            SaleSystem::REGISTER_NUMBER => 'test',
            SaleSystem::REGISTER_OFFICE => 'test',
            SaleSystem::PHONE => '+1-212-9876543',
            SaleSystem::FAX => '+1-212-9876543',
            SaleSystem::HAS_NETWORK => true,
            SaleSystem::HAS_BTOB => true,
            SaleSystem::HAS_BTOC => true,
            SaleSystem::HAS_WAREHOUSE => true,
            SaleSystem::HAS_DELIVERY => true,
            SaleSystem::WARRANTY_DAYS => 5,
            SaleSystem::MAX_CLIENT_ROOT => 5,
            LocalizableModel::LOCALIZATION_KEY => [
                [
                    SaleSystemTranslation::LOCALE => config('app.locale'),
                    SaleSystemTranslation::NAME => 'test',
                    SaleSystemTranslation::DESCRIPTION => 'this is a test description',
                ]
            ]
        ];

        $repository->store($data);
    }
}
