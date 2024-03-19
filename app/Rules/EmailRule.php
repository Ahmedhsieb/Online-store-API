<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Contracts\Validation\Rule;


class EmailRule implements Rule
{


    public function passes($attribute, $value)
    {
        $regex = '/^([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))$/u';
        if(preg_match($regex,strtolower($value))){
            return true;
        }
        return false;

    }

    public function message()
    {
        return 'This must be Email (example@example.com)';
    }
}
