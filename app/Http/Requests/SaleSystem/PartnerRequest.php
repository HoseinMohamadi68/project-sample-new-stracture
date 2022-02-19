<?php

namespace App\Http\Requests\SaleSystem;

use App\Http\Requests\BaseRequest;
use App\Models\File\File;
use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Illuminate\Validation\Rule;

class PartnerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            Partner::SALE_SYSTEM_ID => ['required', Rule::exists(SaleSystem::TABLE, SaleSystem::ID)],
            Partner::USER_ID => ['required', Rule::exists(User::TABLE, User::ID)],
            Partner::COACH_ID => ['required', Rule::exists(User::TABLE, User::ID)],
            Partner::FRONT_IDENTITY_CARD_ID => ['required', Rule::exists(File::TABLE, File::ID)],
            Partner::BACK_IDENTITY_CARD_ID => ['required', Rule::exists(File::TABLE, File::ID)],
            Partner::BUSINESS_CERTIFICATION_ID => ['required', Rule::exists(File::TABLE, File::ID)],
//            Partner::COUNTRY_ID => [],TODO:: AFTER COUNTRY MODEL ADDED SET THIS
            Partner::PARENT_ID => ['nullable', Rule::exists(Partner::TABLE, Partner::ID)],
            Partner::MOBILE => ['required'],
            Partner::BANK_NAME => ['required', 'string'],
            Partner::IBAN => ['nullable', 'string'],
            Partner::DEFAULT_WARRANTY_DAYS => ['required', 'numeric'],
            Partner::SWIFT => ['nullable', 'string'],
            Partner::RECEIVE_VAT_RESPONSIBLE => ['required', 'bool'],
            Partner::SEND_VAT_RESPONSIBLE => ['required', 'bool'],
            Partner::ACTIVE_AUTO_BONUS => ['required', 'bool'],
            Partner::ACTIVE_TRAINING_BONUS => ['required', 'bool'],
            Partner::POST_DELIVERY_FACTOR => ['required', 'bool'],
            Partner::RECEIVE_COMMISSION => ['required', 'bool'],
            Partner::CAN_BUY => ['required', 'bool'],
            Partner::TRANSPORTATION_RATIO_PERCENTAGE => ['required', 'numeric', 'min:0', 'max:100'],
            Partner::OVER_PERSONAL_TURNOVER => ['required', 'bool'],
            Partner::CAN_SEE_DOWN_LINE => ['required', 'bool'],
            Partner::INHOUSE_SALE => ['required', 'bool'],
            Partner::HAS_NETWORK => ['required', 'bool'],
            Partner::HAS_BTOB => ['required', 'bool'],
            Partner::HAS_BTOC => ['required', 'bool'],
            Partner::HAS_WAREHOUSE => ['required', 'bool'],
            Partner::HAS_DELIVERY => ['required', 'bool'],
            Partner::WARRANTY_DAYS => ['required', 'numeric'],
            Partner::MAX_CLIENT_ROOT => ['required', 'numeric'],
        ];
    }
}
