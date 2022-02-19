<?php

use App\Models\Contacts\Phone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Phone::TABLE, function (Blueprint $table) {
            $table->id();
            $table->enum(Phone::TYPE, [Phone::MOBILE, Phone::PHONE, Phone::FAX])
                ->comment('impload mobile,phone,fax');
            $table->string(Phone::NUMBER);
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
        Schema::dropIfExists('phones');
    }
}
