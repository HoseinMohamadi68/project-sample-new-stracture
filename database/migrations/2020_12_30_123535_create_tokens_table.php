<?php

use App\Models\User\Token;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Token::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Token::AGENT)->nullable();
            $table->string(Token::FIREBASE_TOKEN)->nullable();
            $table->longText(Token::TOKEN_STRING);
            $table->unsignedBigInteger(Token::USER_ID);
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
        Schema::dropIfExists(Token::TABLE);
    }
}
