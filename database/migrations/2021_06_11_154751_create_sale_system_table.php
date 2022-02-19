<?php

use App\Models\SaleSystem\SaleSystem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SaleSystem::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(SaleSystem::USER_ID);
            $table->string(SaleSystem::DOMAIN);
            $table->string(SaleSystem::REGISTER_NUMBER);
            $table->string(SaleSystem::REGISTER_OFFICE);
            $table->string(SaleSystem::PHONE, 15);
            $table->string(SaleSystem::FAX, 15);
            $table->boolean(SaleSystem::HAS_NETWORK)->default(true);
            $table->boolean(SaleSystem::HAS_BTOB)->default(true);
            $table->boolean(SaleSystem::HAS_BTOC)->default(true);
            $table->boolean(SaleSystem::HAS_WAREHOUSE)->default(true);
            $table->boolean(SaleSystem::HAS_DELIVERY)->default(true);
            $table->integer(SaleSystem::WARRANTY_DAYS);
            $table->integer(SaleSystem::MAX_CLIENT_ROOT)->default(5);
            $table->boolean(SaleSystem::IS_ACTIVE)->default(false);
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
        Schema::dropIfExists(SaleSystem::TABLE);
    }
}
