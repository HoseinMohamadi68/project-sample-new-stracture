<?php

use App\Models\Translations\CountryTranslation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CountryTranslation::TABLE, function (Blueprint $table) {
            $table->foreignId(CountryTranslation::COUNTRY_ID)->constrained();
            $table->string(CountryTranslation::LOCALE, 2)->index();
            $table->string(CountryTranslation::NAME);
            $table->unique([CountryTranslation::LOCALE, CountryTranslation::COUNTRY_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CountryTranslation::TABLE);
    }
}
