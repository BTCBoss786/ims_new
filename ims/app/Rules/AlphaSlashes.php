<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaSlashes implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return preg_match('/^[\pL\pN\/\-]+$/u', $value);
    }

    public function message()
    {
        return trans('validation.alpha_slashes');
    }
}
