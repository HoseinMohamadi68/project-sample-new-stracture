<?php

use App\Models\Language\Language;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(User::TABLE, function (Blueprint $table) {
            $table->id();
            $table->boolean(User::APPROVED)->default(false);
            $table->foreignId(User::LANGUAGE_ID)->nullable()->constrained();
            $table->foreignId(User::COUNTRY_ID)->nullable()->constrained();
            $table->string(User::FIRST_NAME, 150)->nullable();
            $table->string(User::LAST_NAME, 200)->nullable();
            $table->string(User::MOBILE,13)->unique();
            $table->string(User::PASSWORD)->nullable();
            $table->string(User::EMAIL, 150)->nullable();
            $table->string(User::CHARGE)->default(0);
            $table->string(User::PHONE, 13)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(User::TABLE);
    }
}
