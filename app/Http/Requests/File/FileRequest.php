<?php

namespace App\Http\Requests\File;

use App\Http\Requests\BaseRequest;

class FileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimetypes:text/csv,image/jpg,image/jpeg,image/png,application/pdf',
        ];
    }
}
