<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Models\Language\Language;
use App\Models\LocalizableModel;
use App\Models\Translations\RoleTranslation;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

/**
 * Class RoleRequest
 *
 * @package App\Http\Requests
 */
class RoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Role::COMPANY_VISIBILITY => 'required|boolean',
            Role::OWNER_VISIBILITY => 'required|boolean',
            'permissions' => 'sometimes|array',
            LocalizableModel::LOCALIZATION_KEY => 'required|array',
            LocalizableModel::LOCALIZATION_KEY . '.*.locale' => [
                'required',
                'distinct',
                Rule::exists(Language::TABLE, Language::ALPHA2)
            ],
            LocalizableModel::LOCALIZATION_KEY . '.*.' . RoleTranslation::TITLE => [
                'required',
                'string',
                Rule::unique(
                    RoleTranslation::TABLE,
                    RoleTranslation::TITLE
                )->where(
                    function ($query) {
                        $query->when(!empty($this->role), function ($checkUniqueQuery) {
                            $checkUniqueQuery->where(RoleTranslation::ROLE_ID, '<>', $this->role->getId());
                        });
                    }
                ),
            ],
        ];
    }
}
