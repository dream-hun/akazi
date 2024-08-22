<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:companies,name,'.request()->route('company')->id,
            ],
            'about' => [
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'required',
            ],
            'logo' => [
                'required',
            ],
        ];
    }
}
