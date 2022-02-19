<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\BaseRequest;
use App\Models\Language\Language;

class LanguageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            Language::IS_LTR => 'required|boolean',
        ];
    }
}
