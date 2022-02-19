<?php

use App\Models\Translations\RoleTranslation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RoleTranslation::TABLE, function (Blueprint $table) {
            $table->foreignId(RoleTranslation::ROLE_ID)->constrained();
            $table->string(RoleTranslation::LOCALE, 2)->index();
            $table->string(RoleTranslation::TITLE);
            $table->unique([RoleTranslation::LOCALE, RoleTranslation::ROLE_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RoleTranslation::TABLE);
    }
}
