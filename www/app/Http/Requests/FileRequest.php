<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'folder_id' => 'required',
            'files' => 'required'
        ];
    }
}
