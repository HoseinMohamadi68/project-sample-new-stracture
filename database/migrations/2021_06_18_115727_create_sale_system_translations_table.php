<?php

use App\Models\Translations\SaleSystemTranslation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleSystemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SaleSystemTranslation::TABLE, function (Blueprint $table) {
            $table->foreignId(SaleSystemTranslation::SALE_SYSTEM_ID)->constrained();
            $table->string(SaleSystemTranslation::LOCALE, 2)->index();
            $table->string(SaleSystemTranslation::NAME);
            $table->text(SaleSystemTranslation::DESCRIPTION);
            $table->unique([SaleSystemTranslation::LOCALE, SaleSystemTranslation::SALE_SYSTEM_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(SaleSystemTranslation::TABLE);
    }
}
