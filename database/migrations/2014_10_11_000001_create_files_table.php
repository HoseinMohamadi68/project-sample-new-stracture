<?php

use App\Models\File\File;
use App\Models\File\RootFile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(File::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(File::ROOT_FILE_ID);
            $table->string(File::NAME);
            $table->string(File::EXTENSION);
            $table->boolean(File::ENABLED)->default(false);
            $table->timestamps();

            $table->foreign(File::ROOT_FILE_ID)->references(RootFile::ID)->on(RootFile::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(File::TABLE);
    }
}
