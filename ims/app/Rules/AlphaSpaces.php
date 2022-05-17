<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaSpaces implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }

    public function message()
    {
        return trans('validation.alpha_spaces');
    }
}
