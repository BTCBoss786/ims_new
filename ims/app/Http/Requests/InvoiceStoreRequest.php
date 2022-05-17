<?php

namespace App\Http\Requests;

use App\Rules\AlphaSlashes;
use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer' => ['required', 'integer', 'exists:App\Models\Customer,id'],
            'inv_ref' => ['required', Rule::unique('invoices')->where('inv_date', $this->inv_date), new AlphaSlashes],
            'inv_date' => ['required', 'date', 'before_or_equal:'.date('Y-m-d')],
            'chal_no' => ['nullable', new AlphaSlashes],
            'chal_date' => ['required_with:chal_no', 'nullable', 'date', 'before_or_equal:'.date('Y-m-d')],
            'po_no' => ['nullable', new AlphaSlashes],
            'reverse_charge' => ['required', 'boolean'],
            'transporter_name' => ['nullable', 'min:3', 'max:255', new AlphaSpaces],
            'lr_no' => ['required_with:transporter_name', 'nullable', 'numeric'],
            'vehicle_no' => ['required_with:transporter_name', 'nullable', 'alpha_num', 'size:10'],
            'inventory' => ['required', 'array', 'min:1'],
            'inventory.*' => ['required', 'array', 'size:4'],
            'inventory.*.id' => ['required', 'integer', 'distinct', 'exists:App\Models\Inventory,id'],
            'inventory.*.qty' => ['required', 'numeric', 'min:0'],
            'inventory.*.rate' => ['required', 'numeric', 'min:0'],
            'inventory.*.disc' => ['nullable', 'integer', 'between:0,100'],
        ];
    }
}
