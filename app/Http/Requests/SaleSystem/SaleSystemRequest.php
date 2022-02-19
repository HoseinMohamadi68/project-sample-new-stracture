<?php

namespace App\Http\Requests\SaleSystem;

use App\Http\Requests\BaseRequest;
use App\Models\Language\Language;
use App\Models\LocalizableModel;
use App\Models\SaleSystem\SaleSystem;
use App\Models\Translations\SaleSystemTranslation;
use App\Models\Translations\RoleTranslation;
use App\Models\User\User;
use Illuminate\Validation\Rule;

class SaleSystemRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            SaleSystem::USER_ID => ['required', Rule::exists(User::TABLE, User::ID)],
            SaleSystem::DOMAIN => [
                'required',
                'regex:/^(([a-z0-9][a-z0-9-]*)?((\.[a-z]{2,6})|(\.[a-z]{2,6})(\.[a-z]{2,6})))$/i'
            ],
            SaleSystem::REGISTER_NUMBER => ['required', 'string'],
            SaleSystem::REGISTER_OFFICE => ['required', 'string'],
            SaleSystem::PHONE => ['required'],
            SaleSystem::FAX => ['required'],
            SaleSystem::HAS_NETWORK => ['required', 'bool'],
            SaleSystem::HAS_BTOB => ['required', 'bool'],
            SaleSystem::HAS_BTOC => ['required', 'bool'],
            SaleSystem::HAS_WAREHOUSE => ['required', 'bool'],
            SaleSystem::HAS_DELIVERY => ['required', 'bool'],
            SaleSystem::WARRANTY_DAYS => ['required', 'numeric'],
            SaleSystem::MAX_CLIENT_ROOT => ['required', 'numeric'],
            LocalizableModel::LOCALIZATION_KEY => 'required|array',
            LocalizableModel::LOCALIZATION_KEY . '.*.locale' => [
                'required',
                'distinct',
                Rule::exists(Language::TABLE, Language::ALPHA2)
            ],
            LocalizableModel::LOCALIZATION_KEY . '.*.' . SaleSystemTranslation::NAME => [
                'required',
                'string',
                Rule::unique(
                    SaleSystemTranslation::TABLE,
                    SaleSystemTranslation::NAME
                )->where(
                    function ($query) {
                        $query->when(
                            !empty($this->saleSystem),
                            function ($checkUniqueQuery) {
                                $checkUniqueQuery->where(
                                    SaleSystemTranslation::SALE_SYSTEM_ID,
                                    '<>',
                                    $this->saleSystem->getId()
                                );
                            }
                        );
                    }
                ),
            ],
            LocalizableModel::LOCALIZATION_KEY . '.*.' . SaleSystemTranslation::DESCRIPTION => [
                'required',
                'string'
            ],
        ];
    }
}
