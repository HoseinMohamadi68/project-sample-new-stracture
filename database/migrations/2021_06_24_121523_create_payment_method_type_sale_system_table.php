<?php

use App\Models\Payment\PaymentMethodType;
use App\Models\SaleSystem\SaleSystem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTypeSaleSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_type_sale_system', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_type_id');
            $table->unsignedBigInteger('sale_system_id');
            $table->unique(['sale_system_id', 'payment_method_type_id'], 'payment_method_type_sale_system_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method_type_sale_system');
    }
}
