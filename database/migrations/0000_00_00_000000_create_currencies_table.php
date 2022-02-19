<?php

use App\Models\Currency\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Currency::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Currency::TITLE, 50)->unique();
            $table->float(Currency::RATIO)->unsigned();
            $table->boolean(Currency::IS_DEFAULT);
            $table->string(Currency::SYMBOL, 10)->unique();
            $table->string(Currency::ISO3, 3)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
