<?php

use App\Models\Translations\PriceTypeTranslation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PriceTypeTranslation::TABLE, function (Blueprint $table) {
            $table->foreignId(PriceTypeTranslation::PRICE_TYPE_ID)->constrained()->onDelete('cascade');;
            $table->string(PriceTypeTranslation::LOCALE, 2)->index();
            $table->string(PriceTypeTranslation::NAME);
            $table->unique([PriceTypeTranslation::LOCALE, PriceTypeTranslation::PRICE_TYPE_ID]);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(PriceTypeTranslation::TABLE);
    }
}
