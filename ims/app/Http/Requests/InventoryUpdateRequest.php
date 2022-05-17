<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InventoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255', Rule::unique('inventories')->ignore($this->inventory)->where('description', $this->description), new AlphaSpaces],
            'description' => ['nullable', 'string', 'min:3','max:255'],
            'hsn' => ['required', 'digits_between:4,8'],
            'rate' => ['required', 'numeric', 'gte:0'],
            'unit' => ['required', 'integer', 'exists:App\Models\Unit,id'],
            'category' => ['required', 'integer', 'exists:App\Models\Category,id'],
            'tax' => ['required', 'integer', 'exists:App\Models\Tax,id']
        ];
    }
}
