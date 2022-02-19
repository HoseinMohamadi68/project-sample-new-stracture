<?php

namespace Database\Seeders;

use App\Constants\PaymentMethodTypeTitle;
use App\Models\Payment\PaymentMethodType;
use Illuminate\Database\Seeder;
use ReflectionClass;

class PaymentMethodTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = new ReflectionClass(PaymentMethodTypeTitle::class);

        $payments = [];
        foreach ($class->getConstants() as $key => $value) {
            array_push($payments, ['title' => $value]);
        }

        PaymentMethodType::insert($payments);
    }
}
