<?php

use App\Models\Language\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Language::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Language::ALPHA2, 2)->unique();
            $table->string(Language::TITLE, 100);
            $table->boolean(Language::IS_LTR)->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Language::TABLE);
    }
}
