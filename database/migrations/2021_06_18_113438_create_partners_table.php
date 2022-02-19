<?php

use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\File\File;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Partner::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Partner::SALE_SYSTEM_ID);
            $table->unsignedBigInteger(Partner::USER_ID);
            $table->unsignedBigInteger(Partner::COACH_ID);
            $table->unsignedBigInteger(Partner::FRONT_IDENTITY_CARD_ID);
            $table->unsignedBigInteger(Partner::BACK_IDENTITY_CARD_ID);
            $table->unsignedBigInteger(Partner::BUSINESS_CERTIFICATION_ID);
            $table->unsignedBigInteger(Partner::COUNTRY_ID);
            $table->unsignedBigInteger(Partner::PARENT_ID)->nullable();
            $table->integer(Partner::LEFT_TREE)->default(0);
            $table->integer(Partner::RIGHT_TREE)->default(0);
            $table->string(Partner::MOBILE, 20);
            $table->string(Partner::BANK_NAME);
            $table->string(Partner::IBAN);
            $table->integer(Partner::DEFAULT_WARRANTY_DAYS);
            $table->string(Partner::SWIFT)->nullable();
            $table->smallInteger(Partner::TRANSPORTATION_RATIO_PERCENTAGE);
            $table->boolean(Partner::OVER_PERSONAL_TURNOVER);
            $table->integer(Partner::WARRANTY_DAYS)->default(14);
            $table->integer(Partner::MAX_CLIENT_ROOT)->default(5);
            $table->boolean(Partner::CAN_SEE_DOWN_LINE);
            $table->boolean(Partner::INHOUSE_SALE);
            $table->boolean(Partner::RECEIVE_COMMISSION);
            $table->boolean(Partner::POST_DELIVERY_FACTOR);
            $table->boolean(Partner::RECEIVE_VAT_RESPONSIBLE);
            $table->boolean(Partner::SEND_VAT_RESPONSIBLE);
            $table->boolean(Partner::ACTIVE_AUTO_BONUS);
            $table->boolean(Partner::ACTIVE_TRAINING_BONUS);
            $table->boolean(Partner::CAN_BUY);
            $table->boolean(Partner::HAS_NETWORK)->default(true);
            $table->boolean(Partner::HAS_BTOB)->default(true);
            $table->boolean(Partner::HAS_BTOC)->default(true);
            $table->boolean(Partner::HAS_WAREHOUSE)->default(true);
            $table->boolean(Partner::HAS_DELIVERY)->default(true);
            $table->boolean(Partner::IS_ACTIVE)->default(false);
            $table->timestamps();

            $table->foreign(Partner::FRONT_IDENTITY_CARD_ID)->references(File::ID)->on(File::TABLE);
            $table->foreign(Partner::BACK_IDENTITY_CARD_ID)->references(File::ID)->on(File::TABLE);
            $table->foreign(Partner::BUSINESS_CERTIFICATION_ID)->references(File::ID)->on(File::TABLE);
            $table->foreign(Partner::SALE_SYSTEM_ID)->references(SaleSystem::ID)->on(SaleSystem::TABLE);
            $table->foreign(Partner::USER_ID)->references(User::ID)->on(User::TABLE);
            $table->foreign(Partner::COACH_ID)->references(User::ID)->on(User::TABLE);
            $table->foreign(Partner::PARENT_ID)->references(Partner::ID)->on(Partner::TABLE);
//            $table->foreign(Partner::COUNTRY_ID)->references(Country::ID)->on(Country::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Partner::TABLE);
    }
}
