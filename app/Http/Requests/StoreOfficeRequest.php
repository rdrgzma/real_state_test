<?php

namespace App\Http\Requests;

use App\Models\Office;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('office_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:255',
                'required',
                'unique:offices',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
