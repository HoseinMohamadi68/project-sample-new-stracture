<?php

namespace Database\Seeders;

use App\Models\Price\PriceType;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(
             [
                 LanguageSeeder::class,
                 CurrencySeeder::class,
                 CountrySeeder::class,
                 UserSeeder::class,
                 RoleSeeder::class,
                 PermissionSeeder::class,
                 FileSeeder::class,
                 PaymentMethodTypeSeeder::class,
             ]
         );
    }
}
