<?php

namespace App\Helpers;
use Illuminate\Contracts\Validation\Rule;

class MimeCheckRules implements Rule
{
    protected $customValue;

    public function __construct(array $customValue)
    {
        $this->customValue = $customValue;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $ext = $value->getClientOriginalExtension();
        return in_array($ext, $this->customValue);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a file of type:'.implode(',',$this->customValue).'.';
    }
}