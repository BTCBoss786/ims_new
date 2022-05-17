<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255', new AlphaSpaces],
            'gstin' => ['nullable', 'alpha_num', 'size:15', 'unique:customers'],
            'address1' => ['required', 'string', 'max:255'],
            'address2' => ['required', 'string', 'max:255'],
            'city' => ['required', 'min:3', 'max:255', new AlphaSpaces],
            'state' => ['required', 'integer', 'exists:App\Models\State,id']
        ];
    }
}
