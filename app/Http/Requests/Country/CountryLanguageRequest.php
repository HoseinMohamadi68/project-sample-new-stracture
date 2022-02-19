<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\BaseRequest;
use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\Language\Language;
use App\Models\LocalizableModel;
use App\Models\Translations\CountryTranslation;
use App\Models\User\Permission;
use Illuminate\Validation\Rule;

class CountryLanguageRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_ids' => 'required|array',
            'language_ids.*' => ['required', Rule::exists(Language::TABLE, Language::ID)]
        ];
    }
}
