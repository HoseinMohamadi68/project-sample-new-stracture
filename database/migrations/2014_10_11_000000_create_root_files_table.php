<?php

use App\Models\File\RootFile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRootFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RootFile::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(RootFile::PATH);
            $table->string(RootFile::CONTENT_HASH)->unique();
            $table->string(RootFile::MIME_TYPE);
            $table->unsignedBigInteger(RootFile::SIZE);
            $table->boolean(RootFile::SYNCED)->default(false);
            $table->tinyInteger(RootFile::RETRY)->nullable();
            $table->timestamp(RootFile::NEXT_RETRY)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RootFile::TABLE);
    }
}
