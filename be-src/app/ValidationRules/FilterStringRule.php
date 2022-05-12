<?php

namespace App\ValidationRules;

use Illuminate\Contracts\Validation\Rule;

class FilterStringRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/^(\\$?\w+(:([\w\\- ]+,)*[\w\\- ]+)?;)*(\\$?\w+(:([\w\\- ]+,)*[\w\\- ]+)?;?)$/", $value);
    }

    public function message()
    {
        return 'The :attribute must be conform to filter string format.';
    }

}
