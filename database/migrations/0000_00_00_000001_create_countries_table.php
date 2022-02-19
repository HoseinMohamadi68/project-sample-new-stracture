<?php

use App\Models\Country\Country;
use App\Models\Currency\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Country::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Country::CURRENCY_ID);
            $table->float(Country::DEFAULT_VAT)->default(2.0);
            $table->integer(Country::DEFAULT_WARRANTY_DAYS)->default(14);
            $table->boolean(Country::IS_EEU)->default(false);
            $table->float(Country::MAX_TAX_FREE_TRADE)->nullable();
            $table->float(Country::MAX_SMALL_BUSINESS_TRADE)->nullable();
            $table->string(Country::ISO2, 2);
            $table->string(Country::ISO3, 3);
            $table->timestamps();
            $table->foreign(Country::CURRENCY_ID)->references(Currency::ID)->on(Currency::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Country::TABLE);
    }
}
