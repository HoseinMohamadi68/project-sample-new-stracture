<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate(
            [
                User::EMAIL => 'john@doe.com',
            ],
            [
                User::FIRST_NAME => 'John',
                User::MOBILE => '09346879584',
                User::LAST_NAME => 'Doe',
                User::APPROVED => 1,
                User::PASSWORD => bcrypt(123),
                User::EMAIL => 'john@doe.com',
                User::CHARGE => '10000000',
                User::PHONE => '0218749976',
            ]
        );
    }
}
