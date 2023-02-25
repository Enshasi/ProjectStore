<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $words ;
    public function __construct($words)
    {
        $this->words = $words ;
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
        return !in_array(strtolower($value) , $this->words); //False (show message)
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is Not Allowed is (Rule)';
    }
}
